<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
//
use App\Models\Product;

class Category extends Model
{
    use SoftDeletes;
    use NodeTrait;
    use HasFactory;
    protected $fillable = ['name', 'observation', 'parent_id'];
    //
    /**
     * Get all of the products for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    //
    protected static function makeOptions($items, $initial_label)
    {
        $options = ['' => $initial_label];

        foreach ($items as $item) {
            $options[$item->getKey()] = str_repeat(' ‒ ', $item->depth) . ' ' . $item->name;
        }
        return $options;
    }

    protected static function getCategoryOptions($except = null, $initial_label = 'Menu Principal')
    {
        $query = self::select('id', 'name')->orderby('_lft')->withDepth();
        if ($except) {
            $query->whereNotDescendantOf($except)->where('id', '<>', $except->id);
        }
        return self::makeOptions($query->get(), $initial_label);
    }

}
