
<header class="p-3 text-white" style="background-color: #f2e7c3">

    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            @guest
                <div class="col-md-1 col-sm-1 offset-11" style="padding-right: 25px">
                    <a href="{{ route('login.out') }}" class="btn btn-outline-light me-2">Login</a>
                </div>
            @endguest
        </div>
    </div>
</header>
