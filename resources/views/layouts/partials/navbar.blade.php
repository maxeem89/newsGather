<header class="p-3text-white" style="background-color: #6574cd">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white">Home</a></li>
                @auth
                    @role('admin')
                    <li><a href="{{ route('users.index') }}" class="nav-link px-2 text-white">Users</a></li>
                    <li><a href="{{ route('roles.index') }}" class="nav-link px-2 text-white">Roles</a></li>
                    <li><a href="{{ route('permissions.index') }}" class="nav-link px-2 text-white">Permissions</a></li>
                    <li><a href="{{ route('resources.index') }}" class="nav-link px-2 text-white">Resources</a></li>
                    <li><a href="{{ route('categories.index') }}" class="nav-link px-2 text-white">Categories</a></li>
                    <li><a href="{{ route('news.index') }}" class="nav-link px-2 text-white">News</a></li>
                    @endrole
                @endauth
            </ul>

            @auth
                {{auth()->user()->name}}&nbsp;&nbsp;({{ isset(auth()->user()->roles[0]['name']) ? auth()->user()->roles[0]['name'] : "Unknown"}})&nbsp;
                <div class="col-md-2">
                    <button form="formout" type="submit" class="btn btn-info btn-sm">Logout</button>
                    <form id="formout" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf

                    </form>
                </div>
            @endauth

            @guest
                <div class="text-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                </div>
            @endguest
        </div>
    </div>
</header>
