<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Category;
use App\Models\Book;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $bookCounts = array();
        foreach ($categories as $category){
            $bookCounts[$category->name] = Book::where('category_id', $category->id)->count();
        }
        
        $data = [
            'title' => 'All Categories',
            'categories' => $categories,
            'book_counts' => $bookCounts
        ];
        return view('category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = strtolower($request->input('name'));
        $category->save();

        Session::flash('success_add', "Category '".strtolower($request->name)."' Successfully added");
        return redirect(route('admin.category.index'));

    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $old_name = Category::find($id)->name;
        $category->name = strtolower($request->input('name'));
        $category->save();
        Session::flash('success_edit', "Change category '".$old_name."' to '".$category->name."'");
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        Session::flash('success_delete', "Category '".$category->name."' deleted successfully");
        return redirect()->route('admin.category.index');
    }
}
