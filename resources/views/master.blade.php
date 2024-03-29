<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <script> var BASE_URL = "{{ url('') }}/";</script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('js/prefixfree.min.css') }}"></script>
    </head>
    <body data-spy="scroll" data-target=".navbar-fixed-top">

        <header>

            <!-- Fixed navbar -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop<b class="caret"></b></a>
                                <ul class="dropdown-menu multi-column" style="width: <?php

                                        $count = 0;

                                        foreach ($categories as $cat){
                                            if($cat['sub_category'] == 0){
                                                if($count < 7){
                                                    ++$count;
                                                }
                                            }
                                        }

                                        echo 120 * $count;

                                ?>px">
                                    <?php $counter = 0; ?>
                                    @foreach($categories as $row)

                                        @unless($row['sub_category'])
                                                <div class="col-sm-12" style="width: 120px">
                                                    <div class="row">
                                                        <ul class="multi-column-dropdown">

                                                        <li class="text-uppercase"><a href="{{ url('shop/' . $row['url']) }}"><b>{{ $row['title'] }}</b></a></li>
                                                        {{--<li class="divider"></li>--}}
                                                        @foreach($categories as $sub_row)

                                                            @if($sub_row['sub_category'] == $row['id'])
                                                                <li><a href="{{ url('shop/' . $row['url']) . '/' . $sub_row['url'] }}">- {{ $sub_row['title']}}</a></li>
                                                            @endif
                                                        @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                        @endunless

                                    @endforeach

                                </ul>
                            </li>
                            @if($menu)
                                @foreach($menu as $item)
                                    <li><a href="{{ url($item['url']) }}">{{ $item['link'] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="row">
                            <ul class="nav navbar-nav pull-right row" style="font-size: 0.8em;">
                                @if($total_cart = Cart::getTotalQuantity() )
                                    <li class="fixer"><a style="background-color: #FFFFFF; color: #a94442;" href="{{ url('shop/checkout') }}"><span class="glyphicon glyphicon-shopping-cart"></span> <span style="font-size: 14px;"><b>{{ $total_cart }}</b></span></a></li>
                                @endif
                                @if( !Session::has('user_id') )
                                    <li><a href="{{ url('user/signin') }}">Sign in</a></li>
                                    <li><a href="{{ url('user/signup') }}">Sign up</a></li>
                                @else

                                    <li><a href="{{ url('user/profile/' . Session::get('user_id') ) }}"><span class="glyphicon glyphicon-user"></span> {{ Session::get('user_name') }}</a></li>

                                    @if(Session::has('is_admin'))
                                        <li><a href="{{ url('cms/dashboard') }}"><span class="glyphicon glyphicon-th-large"></span> Dashboard</a></li>
                                    @endif
                                    <li><a href="{{ url('user/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                                @endif
                            </ul>
                        </div>
                    </div><!--/.nav-collapse -->
                </div>
                <div class="container">

                    {{-- Searchbar --}}
                    <div class="form-group-search">
                        <form action="" method="get" autocomplete="off" class="input-group">
                            <input type="text" name="search" id="search-input" class="form-control search" placeholder="Search for...">
                            <span class="input-group-btn">
                                {{--<a href="{{ url('search/') }}" type="button" name="submit" class="btn btn-default" type="button" style="height: 34px;">Search</a>--}}
                                <button type="submit" name="submit" class="btn btn-default" type="button" style="height: 34px;">Search</button>
                            </span>
                        </form>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="search-result" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    {{-- END Searchbar --}}

                </div>
                {{-- Error Message --}}
                @if($errors->any()) @include('includes.errors') @endif
                @if(Session::has('sm')) @include('includes.sm') @endif
            </nav>
        </header>

        @yield('slider')

        <div class="container">
            <br>
            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            <footer>
                <div class="row foot">
                    <div class="col-md-12">
                        <p class="text-center">Copyright &copy; Computercraft {{ date('Y') }}</p>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.container -->

        <script type="text/javascript" src="{{ asset('lib/jquery/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('lib/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/lightbox.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    </body>
</html>