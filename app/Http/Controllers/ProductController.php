<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//
use Image;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderby('position')->get();
        return view('painel.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getCategoryOptions(null, 'Selecione');
        $sizes = Size::orderby('name')->pluck('name', 'id');
        $colors = Color::orderby('name')->pluck('name', 'id');
        return view('painel.products.create', compact('categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => "required|image",
            'name' => "required"
        ]);
        //
        $image_name = date('U') . rand() . '.jpg';
        $upload = $request->file('image');
        $path = $image_name;
        //
        $image = Image::make($upload)->resize(394, 749, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save();
        Storage::disk('public')->put($path, $image);
        //

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->position = 0;
        $product->image = $image_name;
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->price = $request->price;
        $product->observation = $request->observation;
        $product->save();
        //
        $product->colors()->attach($request->colors);
        $product->sizes()->attach($request->sizes);
        //
        if ($product) {
            $type = "success";
            $msg = 'Página inserida com sucesso.';
        } else {
            $type = "error";
            $msg = 'Houve um erro ao inserir a página.';
        }
        return redirect()->route('painel.products.index')->with($type, $msg);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::getCategoryOptions(null, 'Selecione');
        $sizes = Size::orderby('name')->pluck('name', 'id');
        $colors = Color::orderby('name')->pluck('name', 'id');
        // $colors_selected = $product->colors->pluck('name','id');
        return view('painel.products.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $old_path = $product->image;
        $product = $product->fill($request->all());
        //
        $upload = $request->file('image');
        if ($upload) {
            //
            if (Storage::disk('public')->exists($old_path)) {
                Storage::disk('public')->delete($old_path);
            }
            //
            $image_name = date('U') . rand() . '.jpg';
            $path = $image_name;
            //
            $image = Image::make($upload)->resize(394, 749, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();
            Storage::disk('public')->put($path, $image);
            //
            $product->image = $image_name;
        }
        $product->save();
        //
        $product->colors()->sync($request->colors);
        $product->sizes()->sync($request->sizes);
        //
        if ($product) {
            $type = "success";
            $msg = 'Página editada com sucesso.';
        } else {
            $type = "error";
            $msg = 'Houve um erro ao editar a página.';
        }
        return redirect()->route('painel.products.index')->with($type, $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['msg' => 'Página removida com Sucesso.'], 200);
    }
    /**
     * Set ordering to a products list
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productsOrdering(Request $request)
    {
        $products = Product::orderby('position')->get();
        return view('painel.products.ordering', compact('products'));
    }

    /**
     * Set ordering to a products list
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productsOrderingPost(Request $request)
    {
        if ($request->has('ids')) {
            $arr = explode(',', $request->input('ids'));

            foreach ($arr as $sortOrder => $id) {
                $product = Product::find($id);
                $product->position = $sortOrder;
                $product->save();
            }
            return response()->json(['msg' => 'Ordem atualizada.'], 200);
        }
    }
}
