<nav>
    @auth
        <a href="{{ route('articles.index') }}"><button>All Articles</button></a>
        <a href="{{ route('articles.premium-articles') }}"><button>Premium Articles</button></a>
        <a href="{{ route('articles.my-articles') }}"><button>My Articles</button></a>
        <a href="{{ route('articles.create') }}"><button>New Article</button></a>
        <a href="{{ route('categories.my-categories') }}"><button>My Categories</button></a>
        @can('view-admin')
            <a href="{{ route('admin') }}"><button>Admin</button></a>
        @endcan
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