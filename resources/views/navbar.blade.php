<!-- Navigation -->

<nav>

    <a href="{{ route('home') }}">Inici</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('compte_list') }}">Comptes</a>
    <a href="{{ route('client_list') }}">Clients</a>
    <a href="{{ route('estadistiques_list') }}">Estadístiques</a>

    @if (Auth::check()) 
    <p><strong>Has fet login com a: {{Auth::user()->name}}</strong></p>
    
    <form style="display:inline" method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Log Out') }}
            </button>
        </form>
    
    @else

    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a><br><br>

    @endif

</nav>