@extends('layouts.base')
@section('title')
    {{$title}}
@endsection

@section('extra_css')
<style>
    .boxFile {
    width: 100%;
    height: 100px;
    border: 2px solid black;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    border-radius: 10px;
  }

  .boxFile:hover {
    background-color: #ccc; /* Warna latar belakang ketika dihover */
  }
</style>
@endsection

@section('content')
<div style="display:flex; width: 70%; margin: 0 auto; text-align: left; margin-top:20px">
    <div style="flex: 70%">
    
    <p class="text-blue-900 font-bold text-4xl dark:text-white">Edit Book</p>
    <div style="margin-top: 20px; width:80%"> 
    <form enctype="multipart/form-data" method="post" action={{Auth()->user()->role === 'admin' ? route('admin.book.update',$book->id) : route('my.book.update',$book->id)}}>
        @method('put')
        @csrf
        <div class="mb-6">
        <label for="book_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Title</label>
        <input type="text" name="title" value="{{$book->title}}" id="book_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="The title of the book" required>
        </div>
        <div class="mb-6">     
            <label for="book_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Description</label>
            <textarea name="description" id="book_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="The description of the book">{{$book->description}}</textarea>
        </div>
        <div class="mb-4" style="width: 30%">
            <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Total</label>
            <input value="{{$book->total}}" type="number" name="total" min="1" id="total" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="The total of book" required>
          </div>
        <div class="mb-6" style="width: 50%">
            <label for="book_categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Category</label>
            <select id="book_categories" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ($categories as $category)
                <option {{$category->id === $book->category_id ? 'selected' : ''}} value="{{$category->id}}">{{ucFirst($category->name) }}</option>
            @endforeach
            </select>
        </div>
        <div class="mb-6">
        <div style="display:flex; gap: 10px">
            <div style="flex:1">    
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Book Cover (Images)</label>
                <input name="cover" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" accept=".jpeg, .jpg, .png"">
            </div>
            <div style="flex:1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Book File (Pdf)</label>
                <input name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" accept=".pdf">
            </div>  
        </div>
        </div>  

        <button type="button" data-modal-target="popup-modal-edit" data-modal-toggle="popup-modal-edit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit Book</button>
    </div>
    {{-- Modal Edit --}}
    <div id="popup-modal-edit" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-edit">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cancel</span>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to edit this book?</h3>
                    <button data-modal-hide="popup-modal-edit" type="submit" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Edit</button>
                    <button data-modal-hide="popup-modal-edit" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    {{-- end modal edit --}}

    </div>
    <div style="flex: 30%; display: flex; justify-content: center; align-items: center;">
        <div style="display:flex; flex-direction:column">
            <div style="position: relative; flex:60%">
                <img class="h-auto max-w-lg rounded-lg" style="width: 300px; height:400px; object-fit:cover" src="{{$book->cover}}" alt="image description">
            </div>
            <a href="{{$book->file}}" target="_blank">
            <div style="margin-top:20px; flex: 40%; display:flex; justify-content: center; align-items: center;">
                        <div class="boxFile">
                            <p class="text-2xl text-gray-900 dark:text-white">PDF File</p>
                        </div>
                    </div>
                </a>
        </div>
    </div>
</div>
@endsection