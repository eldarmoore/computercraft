<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/carousel.css') }}">
    </head>
    <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{ url('') }}"><img src="{{ asset('images/logo.svg') }}" alt="" height="20"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop<span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            @foreach($categories as $row)

                                @unless($row['sub_category'])
                                <li class="text-uppercase"><a href="shop">{{ $row['title'] }}</a></li>
                                    @foreach($categories as $sub_row)
                                        @if($sub_row['sub_category'] == $row['id'])
                                            <li><a href="{{ url('shop/' . $row['url']) . '/' . $sub_row['url'] }}">- {{ $sub_row['title'] }}</a></li>
                                            @endif
                                    @endforeach
                                    <li role="separator" class="divider"></li>
                                @endunless

                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ url('contact') }}">Contact</a></li>
                    <li><a href="{{ url('about') }}">About</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="{{ url('user/signin') }}">Sign in</a></li>
                    <li><a href="{{ url('user/signup') }}">Sign up</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <br><br><br>

    @yield('slider')


    @yield('content')


    <hr>

    <div class="container">
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">Copyright &copy; Computercraft {{ date('Y') }}</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

        <script type="text/javascript" src="{{ asset('lib/jquery/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('lib/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    </body>
</html>