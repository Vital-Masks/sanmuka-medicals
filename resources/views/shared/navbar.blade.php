<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="{{url('/')}}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('shop')}}">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('medicines')}}">Medicines</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('contact')}}">Contact</a></li>
                    </ul>

                    <ul class="nav-shop flex items-center">
                        <li class="nav-item">
                            <a class="nav-link" class="nav-link" href="{{ route('cart.index') }}">
                                <i class="ti-shopping-cart"></i>
                                @if(Cart::instance('default')->count() > 0)
                                <span class="nav-shop__circle"> {{ Cart::instance('default')->count() }} </span>
                                @endif
                            </a>
                        </li>

                        @if(Auth::check())
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{route('profile')}}">Hi {{ Auth::user()->name }}!</a>
                        </li>

                        <li class="nav-item">
                            <form method="post" action="{{route('logout')}}">
                                @csrf
                                <button type="submit" style="border: none; background: none"> <i class="fas fa-sign-out-alt"></i></button>
                            </form>
                        </li>
                        <li class="nav-item"><a class="button button-header border py-2 px-4" href="{{route('uploadPrescription')}}">Prescription</a></li>
                        @else
                        <ul class="nav">
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{url('/login')}}">Login</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{url('/register')}}">Register</a></li>
                                </ul>
                            </li>
                        </ul>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>