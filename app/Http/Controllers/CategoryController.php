<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::defaultOrder()->withDepth()->get();
        return view('painel.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getCategoryOptions();
        return view('painel.categories.create', compact('categories'));
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
            'name' => "required|unique:categories,name,NULL,id,deleted_at,NULL,parent_id,NULL|max:255",
            'observation' => 'max:255',
        ]);
        $model = new Category($request->all());
        $model->save();
        //
        if ($model) {
            $type = "success";
            $msg = 'Categoria inserida com sucesso.';
        } else {
            $type = "error";
            $msg = 'Houve um erro ao inserir a categoria.';
        }
        return redirect()->route('painel.categories.index')->with($type, $msg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::getCategoryOptions($category);
        return view('painel.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => "required|unique:categories,name,$category->id,id,deleted_at,NULL'|max:255",
            'observation' => 'max:255',
        ]);
        $model = $category->update($request->all());
        //
        if ($model) {
            $type = "success";
            $msg = 'Categoria editada com sucesso.';
        } else {
            $type = "error";
            $msg = 'Houve um erro ao editar a categoria.';
        }
        return redirect()->route('painel.categories.index')->with($type, $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['msg' => 'Categoria removida com Sucesso.'], 200);
    }
}
