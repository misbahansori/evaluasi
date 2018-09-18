
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/themify-icons.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body class="skin-default-dark fixed-layout">

    {{-- @include('layouts.loader') --}}

    <div id="main-wrapper">

        @include('layouts.navbar')

        @include('layouts.sidebar')

        <div class="page-wrapper">
            <div class="container-fluid">
                <br>
                @include('layouts.notification')
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    @stack('js')
    @if(Session::has('errors'))
        <script>
            $(document).ready(function(){
                $('#exampleModal').modal({show: true});
            });
        </script>
    @endif
</body>

</html>