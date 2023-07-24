@extends('layouts.base')

@section('title')
{{$title}}
@endsection

@section('extra_style')
<style>
    table {
    border-collapse: collapse;
    width: 100%;
  }
  th, td {
    border: 1px solid black;
    padding: 15px;
    word-wrap: break-word; /* Untuk memecah kata jika melebihi lebar sel */
  }
</style>
@endsection

@section('content')
<div>
</div>
<div style="width: 70%; margin: 0 auto; text-align: left;">
    <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Tambah Buku</button>
    <table id="myTable" class="display">
        <thead>
            <th>Cover</th>
            <th>Name</th>
            <th>Description</th>
            <th>File</th>
        </thead>
    
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td><img style="height: 150px; object-fit:cover" src="{{$book->cover}}" alt="cover_image"></td>
                <td>{{$book->name}}</td>
                <td>{{$book->description}}</td>
                <td><a href="{{$book->file}}">Unduh</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('extra_scripts')    
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endsection