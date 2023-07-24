@extends('layouts.base')

@section('title')
{{$title}}
@endsection

@section('extra_css')
    <style>
        .modal-content {
            margin-bottom: 10px
        }

        .alert {
            @keyframes fadeInOut {
                0%, 100% { opacity: 0; }
                10%, 90% { opacity: 1; }
            }
        }
    </style>
    
@endsection

@section('content')
<div style="width: 70%;  margin: 0 auto; text-align: left;">
    <p style="margin-top:40px; margin-bottom:15px"  class="text-5xl font-semibold  text-gray-900 dark:text-white">{{$title}}</p>
    <div style="display: flex;">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div style="margin-right:10px">
        <form action={{Auth()->user()->role === 'admin' ? route('admin.book.filter') : route('my.book.filter')}} method="get">
                <select name="category_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">All</option>
                    @foreach ($categories as $in_category) 
                    <option {{$in_category->id == $category_id ? 'selected' : ''}} value="{{$in_category->id}}">{{ucFirst($in_category->name)}}</option>  
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Filter</button>
            </div>
        </form>

        <div style="display: flex; justify-content:flex-end">
            <a style="margin-bottom: 20px" href={{Auth()->user()->role === 'admin' ? route('admin.book.create') : route('my.book.create')}} type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Add New Book</a>
        </div>
    </div>
    
    {{-- Alert 'Berhasil Menambahkan Buku' --}}
    @if(Session::has('success_add'))
    <div class="alert" id="alert">
        <div  class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{Session::get('success_add')}}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
    @endif
    {{-- end of alert 'Berhasil menambahkan buku' --}}

    {{-- alert berhasil mengubah buku --}}
    @if(Session::has('success_edit'))
    <div class="alert" id="alert">
        <div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
              {{Session::get('success_edit')}}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700" data-dismiss-target="#alert-4" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
            </button>
          </div>
    </div>
    @endif
    {{-- end of alert berhasil mengubah buku --}}

    {{-- alert 'berhasil delete buku' --}}
    @if(Session::has('success_delete'))
    <div class='alert' id="alert">
        <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
              {{Session::get('success_delete')}}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
            </button>
          </div>
    </div>
    @endif
    {{-- end of alert 'berhasil delete buku' --}}


    <table id="myTable" class="display">
        <thead>
            <th>Cover</th>
            <th>Name</th>
            <th>Description</th>
            <th>Total</th>
            @if(Auth()->user()->role === 'admin')
            <th>Author</th>
            @endif
            <th>Category</th>
            <th>Action</th>
        </thead>
    
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td><img class="h-auto max-w-lg rounded-lg" style="height: 80px; width:60px; object-fit:cover" src="{{$book->cover}}" alt="cover_image"></td>
                <td>{{$book->title}}</td>
                <td>{{ Str::limit($book->description, 80, '...') }}</td>
                <td>{{$book->total}}</td>
                @if(Auth()->user()->role === 'admin')
                    <td>{{$book->user->name}}</td>
                @endif
                <td>{{ucFirst($book->category->name) }}</td>
                <td>
                    <button type="button" data-modal-target="large-modal-details{{$book->id}}" data-modal-toggle="large-modal-details{{$book->id}}" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Details</button>
                    
                    {{-- Modal Detail --}}
                    <!-- Large Modal -->
                    <div id="large-modal-details{{$book->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                        Book Details
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal-details{{$book->id}}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6" style="display:flex; gap:10px">

                                    <div style="flex:40%; display: flex; justify-content: center; align-items: center;">
                                    
                                        <img class="h-auto max-w-lg rounded-lg" style="height: 330px; width:247px; object-fit:cover" src="{{$book->cover}}" alt="image description">

                                    </div>
                                    <div style="flex:60%; overflow:auto; max-height: 300px;  align-items: center;">
                                        <div class="modal-content">
                                            <p class="text-xl font-bold text-gray-900 text-gray-900 dark:text-white">Title</p>
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                {{$book->title}}
                                            </p>
                                        </div>
                                        <div class="modal-content">
                                            <p 
                                            class="text-xl font-bold text-gray-900 text-gray-900 dark:text-white"
                                            style="width: 200px; white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">
                                            Description
                                            </p>
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                {{$book->description}}
                                            </p>
                                        </div>
                                        <div class="modal-content">
                                            <p class="text-xl font-bold text-gray-900 text-gray-900 dark:text-white">Total</p>
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                {{ $book->total}}
                                            </p>
                                        </div>
                                        <div class="modal-content">
                                            <p class="text-xl font-bold text-gray-900 text-gray-900 dark:text-white">Category</p>
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                {{ ucFirst($book->category->name)}}
                                            </p>
                                        </div>
                                        <div class="modal-content">
                                            <p class="text-xl font-bold text-gray-900 text-gray-900 dark:text-white">Author</p>
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                {{ ucFirst($book->user->name)}}
                                            </p>
                                        </div>
                                        <div class="modal-content">
                                            <p class="text-xl font-bold text-gray-900 text-gray-900 dark:text-white">PDF File</p>
                                            <div style="margin-top: 10; margin-left:10">
                                                <a href="{{$book->file}}" target="_blank" type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-small text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Click Here</a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- {{-- <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                                    </p> --}}
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <a type="button" href={{Auth()->user()->role === 'admin' ? route('admin.book.edit',$book->id) : route('my.book.edit',$book->id)}} class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Edit</a>
                                    <button type="button" data-modal-target="popup-modal-delete{{$book->id}}" data-modal-toggle="popup-modal-delete{{$book->id}}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Modal Delete --}}
                    <div id="popup-modal-delete{{$book->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-delete{{$book->id}}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this book?</h3>
                                    <div class="p-6 text-center flex flex-row justify-center">        
                                            <form action={{Auth()->user()->role === 'admin' ? route('admin.book.destroy',$book->id) : route('my.book.destroy',$book->id)}} method="post">
                                            @csrf
                                            @method('delete')
                                            <button data-modal-hide="popup-modal-delete{{$book->id}}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Yes, I'm sure
                                            </button>
                                        </form>
                                    <button data-modal-hide="popup-modal-delete{{$book->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End of modal delete --}}



                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(Auth()->user()->role ==='admin')
    <div>
        <a type="button" href="{{route('admin.book.export')}}" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Export to Excel</a>
    </div>
    @endif
</div>

@endsection

@section('extra_scripts')    
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );

    document.addEventListener("DOMContentLoaded", function() {
    const alertBox = document.getElementById("alert");
    alertBox.style.display = "block";
    setTimeout(function() {
        alertBox.style.display = "none";
    }, 7000);
});
</script>
@endsection