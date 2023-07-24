<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookFormValidation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function authBook(){
        
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        // dd(Book::where('user_id', $this->user_id)->with(['category','user'])->orderBy('id')->get());
        $data = [
            'title' => 'My Books',
            'books' => Book::where('user_id', $user_id)->with(['category','user'])->orderBy('created_at','desc')->get(),
            'categories' => Category::all(),
            'category_id' => -1 // Tidak ada data ini dalam database
        ];
        return view('book.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function filter(Request $request){
        $user_id = auth()->user()->id;
        $data =[
            'categories' => Category::all()
        ];
        $category_id = $request->input('category_id');

        if($category_id){
            $category = Category::find($category_id);
            $books = Book::where('user_id', $user_id)->with(['category','user'])->where('category_id',$category_id)->orderBy('id')->get();
            $data['books'] = $books;
            $data['category_id'] = $category_id;
            $data['title'] = "Books with category '".ucfirst($category->name)."'";
        } else {
            return redirect()->route('my.book.index');
        }

        return view('book.index',$data);
    }
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
        $book->cover = $path_cover;
        $book->file = $path_file;
        $book->user_id = $user_id;
        $book->total = $request->input('total');
        $book->category_id = $request->input('category_id');

        $book->save();
        Session::flash('success_add', 'Book Successfully added');
        return redirect(route('my.book.index'));
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_id = auth()->user()->id;
        if($user_id !== Book::find($id)->user_id){
            abort(404);
        }
        
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
        $book->total = $request->input('total');
        $book->category_id = $request->input('category_id');

        $book->save();
        Session::flash('success_edit', 'Book updated successfully');
        return redirect(route('my.book.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_id = auth()->user()->id;
        if($user_id !== Book::find($id)->user_id){
            abort(404);
        }

        $book = Book::find($id);
        $book_title = $book->title;
        $book->delete();

        Session::flash('success_delete', "Book '".$book_title."' deleted successfully");
        return redirect(route('my.book.index'));
    }
}
