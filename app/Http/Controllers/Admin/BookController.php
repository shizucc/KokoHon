<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BooksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookFormValidation;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function export(){
        $file_name = 'kokohon_report_'.date('d-m-Y');
        return Excel::download(new BooksExport,$file_name.'.xlsx');
    }

    public function index()
    {
        $data = [
            'title' => 'All Books',
            'books' => Book::with(['category','user'])->orderBy('created_at','desc')->get(),
            'categories' => Category::all(),
            'category_id' => -1 // Tidak ada data ini dalam database
        ];
        return view('book.index',$data);
    }

    public function filter(Request $request){
        $data =[
            'categories' => Category::all()
        ];
        $category_id = $request->input('category_id');

        if($category_id){
            $category = Category::find($category_id);
            $books = Book::with(['category','user'])->where('category_id',$category_id)->orderBy('id')->get();
            $data['books'] = $books;
            $data['category_id'] = $category_id;
            $data['title'] = "Books with category '".ucfirst($category->name)."'";
        } else {
            return redirect()->route('admin.book.index');
        }

        return view('book.index',$data);

        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Create Book',
            'categories' => Category::all()
        ];

        return view('book.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookFormValidation $request)
    {
        $user_id = auth()->user()->id;

        $path_cover = Storage::url(($request->cover)->store('images','public'));
        $path_file = Storage::url(($request->file)->store('file','public'));
        $book = new Book;
        
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->total = $request->input('total');
        $book->cover = $path_cover;
        $book->file = $path_file;
        $book->user_id = $user_id;
        $book->category_id = $request->input('category_id');

        $book->save();
        Session::flash('success_add', 'Book Successfully added');
        return redirect(route('admin.book.index'));
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Book',
            'book' => Book::find($id),
            'categories' => Category::all()
        ];

        return view('book.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookFormValidation $request, string $id)
    {
        $book = Book::find($id);
        
        if($request->hasFile('cover')){
            $path_cover = Storage::url(($request->cover)->store('images','public'));
            $book->cover = $path_cover;
        }
        if($request->hasFile('file')){
            $path_file = Storage::url(($request->file)->store('file','public'));
            $book->file = $path_file;

        }

        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->category_id = $request->input('category_id');
        $book->total = $request->input('total');

        $book->save();
        Session::flash('success_edit', 'Book updated successfully');
        return redirect(route('admin.book.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        $book_title = $book->title;
        $book->delete();

        Session::flash('success_delete', "Book '".$book_title."' deleted successfully");
        return redirect(route('admin.book.index'));
    }
}
