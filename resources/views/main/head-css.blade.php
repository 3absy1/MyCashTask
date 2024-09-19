    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>@yield('title')</title>

        <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="stylesheet" href="{{asset('assets')}}/css/responsive-datatable-bootstrap.min.css">
    <link href="{{asset('assets')}}/css/datatable-bootstrap5.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets')}}/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets')}}/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets')}}/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/img/favicons/favicon.ico">
    <meta name="msapplication-TileImage" content="{{asset('assets')}}/img/favicons/mstile-150x150.png">
    <script src="{{asset('assets')}}/js/config.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->

    <link href="{{asset('vendors')}}/dropzone/dropzone.min.css" rel="stylesheet">
    <link href="{{asset('assets')}}/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{asset('assets')}}/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <link rel="stylesheet" href="{{asset('assets')}}/css/buttons.bootstrap5.css">



    @yield('css')

    </head>

