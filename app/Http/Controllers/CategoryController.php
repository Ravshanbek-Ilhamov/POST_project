<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin.category.categories',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'tr' => $request->tr,
            'active' => $request->active,
        ]);
    
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'tr' => $request->tr,
            'active' => $request->active,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            session()->flash('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'There was an issue deleting the category.');
        }
        return redirect('/category');
    }
}
