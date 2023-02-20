<nav class="navbar navbar-dark bg-warning">

    <div class="container">
        <!-- encabezado del titulo en header -->
        <a class="navbar-brand d-flex justify-content-start align-self-center" href="{{ url('/') }}">
            Tienda Virtual
        </a>
    </div>
    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav">


        <!-- Authentication Links -->
        @guest
        @if (Route::has('login'))
        <li class="nav-item">
            <a class="nav-link active " href="{{ route('login') }}">Login</a>
        </li>
        @endif

        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
        @endif
        @else

    {{-- carro de compras --}}

        <li class="nav-item">
                        <a class="nav-link" href="{{ route('kart')}}"><i class="bi bi-cart">carrito</i></a>
                    </li>

        <!--  aca aparece en la parte superior derecha el nombre de la persona -->

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::User()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                @role('admin')

                <a class="dropdown-item" href="{{ route('products') }}">
                    Products
                </a>

                <!-- users -->
                <a class="dropdown-item" href="{{ route('users') }}">
                    Users
                </a>

                <!-- categories -->
                <a class="dropdown-item" href="{{ route('categories') }}">
                    Categorias
                </a>

                @endrole

                {{-- LOGOUT --}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                </a>
                {{--/--}}

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>

    </div>
    </div>
</nav>
