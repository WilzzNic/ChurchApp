<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

        <!-- Datatable CSS -->
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
        <link type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css" rel="stylesheet">

        <!-- Datatable Reorder and Responsive CSS -->
        <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.semanticui.min.css">

        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

        <!-- Select2 CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

        @stack('css')
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @unless(Auth::user()->can('guest'))
                @include('layouts.navbars.sidebar')
            @endunless
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    

        <!-- Datatable JS -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.19/dataRender/datetime.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>

        <!-- Datatable Responsive JS-->
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.semanticui.min.js"></script>
        

        <!-- Datepicker JS -->
        <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

        <!-- Select2 JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    </body>
</html>