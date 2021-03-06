<!DOCTYPE html>
<html>
    <head>
        <title>
            @yield('title', env('APP_NAME'))
        </title>

        <!-- Load CSS files. -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

{{--        <!-- Load JS files. -->--}}
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <style type="text/css">
            .nav-fix {
                margin-top: 25px;
            }
        </style>

        @yield('header')
    </head>
    <body>
        @yield('navigation')
        <div class="container-fluid nav-fix">
            <div class="row">
                <div class="col-lg-2">
                    @yield('left-sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <h4 class="card-header bg-info">
                            @yield('title')
                        </h4>
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    @yield('right-sidebar')
                </div>
            </div>
        </div>
        @yield('footer')
    </body>
</html>