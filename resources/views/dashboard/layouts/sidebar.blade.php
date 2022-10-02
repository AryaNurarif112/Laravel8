<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            {{-- kalau ada request yang url nya adalah dashboard, makan active. Kalau tidak kosongkan(active) --}}
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts"> 
            {{-- kalau ada request yang url nya adalah dashboard/posts, makan active. Kalau tidak kosongkan(active)
            /dashboard/posts dapat dari web.php
            bintang sesudah posts = apapun yang ada setelah link posts, akan membuat link active --}}
            <span data-feather="file-text"></span>
           My Posts
          </a>
        </li>
      </ul>
    </div>
  </nav>