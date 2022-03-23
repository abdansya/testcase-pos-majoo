<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{$routeIndex == 'dashboard' ? 'active' : ''}}" href="{{route('dashboard')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19zm2-4h8v2H8v-2z"/></svg>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{$routeIndex == 'categories' ? 'active' : ''}}" href="{{route('categories')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M6 7V4a1 1 0 0 1 1-1h6.414l2 2H21a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-3v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3zm0 2H4v10h12v-2H6V9zm2-4v10h12V7h-5.414l-2-2H8z"/></svg>
                    <span class="ms-2">Kategori</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="position-absolute bottom-0 col-12 p-3">
        <form action="{{route('logout')}}" method="post">
            @csrf
            <div class="d-grid">
                <button class="btn btn-danger" type="submit">Sign out</button>
            </div>
        </form>
    </div>
</nav>