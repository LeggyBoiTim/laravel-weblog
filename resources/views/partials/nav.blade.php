<nav>
    @auth
        <a href="{{ route('articles.index') }}"><button>All Articles</button></a>
        <a href="{{ route('articles.my-articles') }}"><button>My Articles</button></a>
        <a href="{{ route('articles.create') }}"><button>New Article</button></a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Log out</button>
        </form>
    @else
        <a href="{{ route('login.create') }}"><button>Log in</button></a>
        <a href="{{ route('register.create') }}"><button>Register</button></a>
    @endauth
</nav>