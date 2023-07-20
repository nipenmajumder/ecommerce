<header class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset(cache()->get('settings.toArray')['site_logo'])}}" class="img-fluid" width="80" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex w-100 mx-5" role="search" x-data="searchData">
                    <div class="position-relative w-100">
                        <input class="form-control me-2" type="search" placeholder="Search" x-model="search"
                               x-on:input.debounce.500ms="performSearch" aria-label="Search">
                        <div class="position-absolute bg-white shadow border rounded mt-2 w-100 overflow-y-auto" x-cloak
                             x-show="data?.length > 0" style="max-height: 200px;">
                            <ul class="list-group search-results-list">
                                <template x-for="item in data" :key="item.id">
                                    <li class="list-group-item list-group-item-action">
                                        <a :href="route('book-details-slug', item.slug)" class="text-decoration-none">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img :src="item.image" class="img-fluid rounded search-result-image"
                                                         :alt="item.name">
                                                </div>
                                                <div class="col-md-9 d-flex align-items-center">
                                                    <div class="search-result-content">
                                                        <h6 class=" mb-1 text-black" x-text="'Name : ' + item.name"></h6>
                                                        <small class="text-black" x-text="'Author : ' + item.author.name"></small>
                                                        <br>
                                                        <small class="text-black" x-text="'Publication : ' + item.publication.name"></small>
                                                        <br>
                                                        <small class="text-black" x-text="'Price: $ ' +item.sell_price"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        @guest
                            <a class="nav-link" href="{{route('login')}}">লগইন/রেজিস্টার</a>
                        @endguest
                        @role('admin')
                        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                        @endrole
                        @role('customer')
                        <a class="nav-link" href="{{route('customer-dashboard.home')}}">Dashboard</a>
                        @endrole
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <div class="bg-body-tertiary border-bottom">
        <ul class="nav container">
            <ul class="nav container">
                <li class="nav-item">
                    <a class="nav-link text-secondary-emphasis" aria-current="page" href="{{route('home')}}">হোম</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary-emphasis" href="{{route('books')}}">বই</a>
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
        </ul>
    </div>
</header>

