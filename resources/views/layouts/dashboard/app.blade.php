<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files') }}/css/main.css">
    <!-- Font-icon css-->
    {{-- Main Css --}}
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- jquery --}}
    <script src="{{ asset('dashboard_files') }}/js/jquery-3.3.1.min.js"></script>


    {{--  noty  --}}
    <link rel = "stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

        <style>
            label{
                font-weight: bold

            }
        </style>

        @stack('styles')

  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    @include('layouts.dashboard._header ')
    <!-- Sidebar menu-->
   @include('layouts.dashboard._aside')

   @include('dashboard.partials._session')


    <main class="app-content">
      {{--  <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>  --}}


     @yield('content')

    </main>
    <!-- Essential javascripts for application to work-->

    {{-- Popper --}}
    <script src="{{ asset('dashboard_files') }}/js/popper.min.js"></script>

    {{-- Select2 --}}
    <script src="{{ asset('dashboard_files') }}/plugins/select2/select2.min.js"></script>
    <script src="{{ asset('dashboard_files') }}/js/main.js"></script>

     {{--  Movie js  --}}

    <script src="{{ asset('dashboard_files') }}/js/custom/movie.js"></script>


    <script>

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//end of ajax setup


        $(document).ready(function(){

            $(document).on('click' , '.delete', function(e){

                e.preventDefault();

                var that = $(this);
                var n = new Noty({
                    text:"Confirm Deleting Recored",
                    killer:true,
                    buttons:[
                        Noty.button('Yes' , 'btn btn-success  mr-2' , function (){

                            that.closest('form').submit()

                        }),
                        Noty.button('No' , 'btn btn-danger  ' , function (){

                            n.close()

                        }),
                    ]
                });
                n.show();
            });
           
        });//end of document ready
        
        //select2
        
        $('.select2').select2({
            width:'100%'
        });

    </script>


  </body>
</html>
