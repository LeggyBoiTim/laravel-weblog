<nav>
    @auth
        <a href="{{ route('articles.create') }}"><button style="margin-right: 1em;">New Article</button></a>
        <a href="{{ route('articles.index') }}"><button>All Articles</button></a>
        <a href="{{ route('articles.premium-articles') }}"><button style="margin-right: 1em;">Premium Articles</button></a>
        <a href="{{ route('articles.my-articles') }}"><button>My Articles</button></a>
        <a href="{{ route('categories.my-categories') }}"><button style="margin-right: 1em;">My Categories</button></a>
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