<style>

#sidebar {
  background: #0091f7;
  color: #fff;
}

/* ========================== Navigation start ========================== */
.nav-menu * { margin: 0; padding: 0; list-style: none; }
.nav-menu ul { width: 100%; }
.nav-menu > ul > li {
  position: relative;
  white-space: nowrap;
}
.nav-menu .nav-link, .nav-menu li:focus {
  display: flex;
  align-items: center;
  color: #f1f1f1;
  margin-bottom: 8px;
  transition: 0.3s;
  font-size: .9rem;
}
.nav-menu li i, .nav-menu li:focus i {
  padding-right: 8px;
  color: #fff;
}
.nav-menu li:hover, .nav-menu .active, .nav-menu .active:focus, .nav-menu li:hover > a {
  text-decoration: none;
  font-weight: 500;
  color: #f7ef79;
  cursor: pointer;
}
.nav-menu li:hover i, .nav-menu .active i, .nav-menu .active:focus i, .nav-menu li:hover > a i { color: #f7ef79; }
.dropdown-divider { margin: 0 20px; }
.nav-drop { position: absolute; right: 0; }

.nav-submenu { color: #fff; text-indent: 2em; margin-bottom: 10px; }

.nav-list { font-size: .8rem; padding-bottom: 15px; }
/* ========================== Navigation end ========================== */
</style>

<header class="bg-white px-2 py-3 shadow">
    <div id="header-container" class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-primary flex-between">
                <div class="flex-start gap-2">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar"><i class='bx bx-menu'></i></button>
                    <h1 class="fs-18 display-5 flex-start text-darkBlue mb-0">
                      <i class="bx bx-headphone me-3"></i><span>Customer Care</span>
                    </h1>
                </div>
                <div>
                  <p class="m-0">Selamat datang, <a href="/">{{ Auth::user()->name }}</a></p>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarMenu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title flex-start" id="sidebarMenu"><i class="bx bx-headphone me-3"></i><span>Customer Care</span></h5>
    <i class="bx bx-x" data-bs-dismiss="offcanvas" aria-label="Close" role="button"></i>
  </div>
  <div class="offcanvas-body">
    <nav class="nav-menu navbar">
        <ul>
            <a href="/"><li id="link-dashboard" class="nav-link mb-3"><i class='bx bxs-dashboard'></i><span>Dashboard</span></li></a>
            <a href="/keluhanPelanggan"><li id="link-complain" class="nav-link mb-3"><i class='bx bx-message-rounded-dots'></i><span>Keluhan</span></li></a>
            <form action="/logout" method="post" class="m-0">
              @csrf
              <button class="btn" type="submit"><li id="link-wizard" class="nav-link mb-3"><i class="bx bx-log-out-circle me-1"></i><span>Logout</span></li></button>
            </form>
        </ul>
    </nav>
  </div>
</div>

<script>
</script>