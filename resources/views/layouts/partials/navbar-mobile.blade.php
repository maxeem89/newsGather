<style>
    .rotate {
        animation: rotation 8s infinite linear;
    }

    @keyframes rotation {
        from {
            transform:rotateY(0deg);
        }
        to {
            transform: rotatey(359deg);
        }
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light " style="background:#424B5C ; !important;">

    <div class="container-fluid">
        <a href="{{route('out.home')}}"><img class="rotate" src="{{asset("logo.jpg")}}" style="width: 90px; margin-right: 5px"></a>
        <label class="rotate" style="color: #eeeeee">News Gathering </label>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white"  href="{{route('out.home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Resources
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($resources as $resource)
                            <li><a class="dropdown-item" href="{{ route('resources.show.out', ['resource' => $resource->id]) }}">{{$resource->name}}</a></li>
                        @endforeach
                    </ul>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn " style="margin: 2px ;color: #ffffff ; background: #A6AEBB" type="submit">Search</button>
                <a href="{{ route('login.out') }}" class="btn text-white" style=" margin: 2px ;background-color: #A6AEBB">login</a>
            </form>
        </div>
    </div>
</nav>
<script>
    function rotateImage() {
        var img = document.getElementById('myimage');
        img.style.transform = 'rotate(90deg)';
    }
</script>
