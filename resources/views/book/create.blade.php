@extends('layouts.base')
@section('title')
    {{$title}}
@endsection


@section('content')
<div style="width: 40%; margin: 0 auto; text-align: left; margin-top:20px">
  <p class="text-blue-900 font-bold text-4xl dark:text-white">Add New Book</p>
<div style="margin-top: 20px"> 
 
<form enctype="multipart/form-data" method="post" action={{Auth()->user()->role === 'admin' ? route('admin.book.store') : route('my.book.store')}}>
    @method('post')
    @csrf
    <div class="mb-1">
      <label for="book_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Title</label>
      <input value="{{old('title')}}" type="text" name="title" id="book_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="The title of the book">
    </div>
    @error('title')
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
      <span class="font-medium">{{$message}}</span>
    </div>
    @enderror
    <div class="mb-1">     
        <label for="book_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Description</label>
        <textarea name="description" id="book_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="The description of the book">{{old('description')}}</textarea>
    </div>
    @error('description')
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
      <span class="font-medium">{{$message}}</span>
    </div>
    @enderror
    <div class="mb-4" style="width: 30%">
      <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Total</label>
      <input required type="number" name="total" min="1" id="total" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="The total of book" required>
    </div>

    <div class="mb-6" style="width: 50%">
        <label for="book_categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Category</label>
        <select id="book_categories" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @foreach ($categories as $category)
            <option {{old('category_id') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{ucFirst($category->name) }}</option>
        @endforeach
        </select>
    </div>
    <div class="mb-6">
      <div style="display:flex; gap: 10px">
          <div style="flex:1">    
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Book Cover (Images)</label>
            <input required name="cover" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" accept=".jpeg, .jpg, .png">
          </div>
          <div style="flex:1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Book File (Pdf)</label>
            <input required name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" accept=".pdf">
          </div>  
      </div>
    </div>  

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Book</button>
  </form>
</div>
</div>
@endsection