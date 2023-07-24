<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    
    @yield('extra_css')
    <style>
        body {
        }
    </style>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.tailwindcss.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
        {{-- Ini Navbar --}}
        <div>
            @include('layouts.navbar')

        </div>
    <div>
        @yield('content')

    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.5/js/dataTables.tailwindcss.min.js"></script> --}}
    <script src="https://cdn.tailwindcss.com/3.3.3"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>
    @yield('extra_scripts')
</html>