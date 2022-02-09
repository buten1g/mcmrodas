<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class CatalogController extends Controller
{
    /**
     * Show the catalog.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function catalog()
    {
        $products = Product::orderby('position')->get();
        //
        return view('catalog', compact('products'));
    }
    /**
     * Show the modal catalog.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function modal_product(Product $product)
    {
        $colors = $product->colors->pluck('name', 'name')->prepend('Selecione', '');
        $sizes = $product->sizes->pluck('name', 'name')->prepend('Selecione', '');
        return view('partials.modal-product', compact('product', 'colors', 'sizes'));
    }
    /**
     * Show the modal catalog.
     *
     * @return json
     */

    public function modal_product_add(Product $product, Request $request)
    {
        Cart::add([
            'id' => $product->id,
            'name' => $product->reference,
            'qty' => $request->quantity,
            'price' => floatval($product->price),
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'observation' => $request->observation
            ]
        ])->associate(cProduct::class);
    }
    /**
     * Show cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cart()
    {
        //Cart::destroy();
        //dd(Cart::subtotal());
        $items = Cart::content();
        $total = Cart::subtotal('2', ',', '.');
        $totalToCalc = Cart::subtotal('2', ',', '.');
        $count = Cart::count();
        return view('cart', compact('items', 'total', 'count', 'totalToCalc'));
    }

    /**
     * PDF cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pdf(Request $request)
    {
        $fullName = $request->fullName ?? 'Não identificado';

        //
        $items = Cart::content();
        $count = Cart::count();
        $subTotal =  Cart::subtotal('2', ',', '.');
        $total = number_format((Cart::subtotal('2', '.', '')), 2);
        $data = Carbon::now()->format('d/m/Y');
        //
        $html = view('pdf', compact('items', 'total', 'count', 'fullName', 'data', 'subTotal'))->render();

        //return $html;

        //
        Cart::destroy();
        //
        return PDF::loadHTML($html)->setPaper('a4')->stream('meu-pedido.pdf');
    }

    /**
     * Cart remove.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function product_remove($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['msg', 'success']);
    }

    /**
     * Show products of category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function products(Category $category)
    {
        $products = $category->products;
        return view('catalog', compact('products'));
    }
}
