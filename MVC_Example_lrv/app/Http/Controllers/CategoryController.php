<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->paginate(5);
        return view('categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {   
        // //Cach 1:
        // //$category1 = Category::with('product')->get() : product(function trong model)
        // $category1 = Category::with('product')->get();
        // //dd($category[0]->product);
        // $product[] = '';
        // foreach ($category1 as $catItem) {
        //     //dd($catItem);
        //     foreach ($catItem->product as $productItem) {
        //         // dd($productItem->id);
        //         //dd($category->id);

        //         if ($productItem->category_id == $category->id) {
        //             //dd('a');
        //             $product[] = $productItem;
        //         }
        //     }
        // }
        // //dd('b');
        // //dd($product);
        // //return view('categories.show', compact(['product', 'category']));

        //Cach 2:
        $product = Category::find($category->id)->product()->get();
        return view('categories.show', compact(['product', 'category']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Success!');
    }
    public function getSearch(Request $request)
    {
        $category = Category::where('name', 'like', '%' . $request->key . '%')->orWhere('id', $request->key)->paginate(5);
        return view('categories.search', compact('category'));
    }
}
