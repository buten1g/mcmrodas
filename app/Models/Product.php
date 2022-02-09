<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['image', 'category_id', 'position', 'name', 'reference', 'price', 'observation'];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The sizes that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'size_product', 'product_id', 'size_id')->withTimestamps();
    }

    /**
     * The colors that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'color_product', 'product_id', 'color_id')->withTimestamps();
    }

    //
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace([".", ","], ["", "."], $value) ?: 0;
    }
    public function getPriceFormatedAttribute()
    {
        if($this->attributes['price'] != 0){
            return 'R$ '.number_format($this->attributes['price'], 2, ',', '.');
        }else{
            return 'Não informado';
        }
    }
}
