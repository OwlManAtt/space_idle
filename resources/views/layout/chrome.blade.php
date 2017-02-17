<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Space Idle - @yield('title')</title>

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id='stars'></div>
        <div id='stars2'></div>
        <div id='stars3'></div>        

        <div class="container">
            <!-- Static navbar -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">Space Idle</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown active">
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Station <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Construction</a></li>
                                    <li><a href="#">Research Lab</a></li>
                                    <li><a href="#">Docking Bays</a></li>
                                </ul>
                            </li>
                            <li><a href="/harvest">Harvesting</a></li>
                            <li><a href="#">Politics</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Messages <span class='badge'>1,233</span> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notifications <span class='badge'>2</span></a></li>
                                    <li><a href="#">Mail <span class='badge'>1,231</span></a></li>
                                </ul>
                            </li>
                            <li><a href='#'>Forums</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                        @if (Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ Auth::user()->avatar }}" class="img-nav-avatar img-circle">
                                    {{ Auth::user()->display_name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Settings</a></li>
                                    <li><a href="#">Refer a Friend</a></li>
                                    <li><a href="/user/logoff">Log Off</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">with Facebook</a></li>
                                    <li><a href="/user/login/google">with Google</a></li>
                                </ul>
                            </li>
                        @endif
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </nav>
            
            @yield('page')

            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">
                            <li class="pull-right"><a href="#top">Back to top</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="https://github.com/owlmanatt/space_idle/">GitHub</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>

                        <p>Copyright &copy; Gentle Games 2017. All rights reserved.</p>
                        <p>Gentle Games and Space Idle are trademarks of the Yasashii Syndicate.</p>
                    </div>
                </div>
            </footer>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
