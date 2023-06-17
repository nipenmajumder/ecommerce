<header class="sticky-top">
    <!-- logo and search bar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('frontend/image/banner/logo-v22.webp')}}"
                                                                  alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex w-75 mx-5" role="search">
                    <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        @guest
                            <a class="nav-link" href="{{route('login')}}">লগইন/রেজিস্টার</a>
                        @endguest
                        @auth
                            <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- menu bar -->
    <div class="bg-body-tertiary border-bottom">
        <ul class="nav container">
            <li class="nav-item">
                <a class="nav-link text-secondary-emphasis" aria-current="page" href="{{route('home')}}">হোম</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary-emphasis" href="#">বই</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary-emphasis" href="{{route('subjects')}}">বিষয়</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary-emphasis" href="{{route('publications')}}">প্রকাশক</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary-emphasis" href="{{route('authors')}}">লেখক</a>
            </li>
        </ul>
    </div>
</header>
