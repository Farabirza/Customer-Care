<style>
:root { --sidebar-width: 240px; }
/* ========================== Navigation start ========================== */
#sidebar {
    z-index: 9;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: var(--sidebar-width);
    transition: all ease-in-out 0.5s;
    transition: all 0.5s;
    overflow-y: auto;
    background: #0091f7;
} 

.mobile-nav-toggle {
  position: fixed;
  right: 15px;
  top: 15px;
  z-index: 9;
  border: 0;
  font-size: 24px;
  transition: all 0.4s;
  outline: none !important;
  color: #fff;
  width: 40px;
  height: 40px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  line-height: 0;
  border-radius: 50px;
  cursor: pointer;
} .mobile-nav-active {
  overflow: hidden;
} .mobile-nav-active #sidebar {
  left: 0;
}

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

#header { position: relative; }

#main, #header-inner { margin-left: var(--sidebar-width); }

#main { padding: 20px; }

@media (max-width: 1199px) {
    #toggle-sidebar { display: none; }
    #main, #container-header { padding-left: 0 }
    #sidebar {
        left: calc(var(--sidebar-width) * -1);
    }
}

</style>

<!-- ======= Mobile nav toggle button ======= -->
<i class="bi bi-list mobile-nav-toggle bg-dark d-xl-none"></i>

<div id="sidebar" class="d-flex flex-column flex-shrink-0">
  <div class="py-4 px-3">
    <h3 class="display-5 text-light flex-start gap-2 fs-12"><i class='bx bx-headphone'></i>Customer Care</h3>
  </div>
  <div id="sidebar-menu" class="p-3">
      <nav class="nav-menu navbar">
          <ul>
              <a href="/dashboard"><li id="link-complain" class="nav-link mb-3"><i class='bx bx-message-rounded-dots'></i><span>Keluhan saya</span></li></a>
              <li id="link-edit" class="nav-link mb-3"><i class='bx bxs-dashboard'></i><span role="button" data-bs-toggle="collapse" data-bs-target="#submenu-dashboard" aria-expanded="true" aria-controls="submenu-dashboard" class="d-flex align-items-center">Dashboard<i class='bx bx-chevron-down nav-drop'></i></span></li>
              <ul class="bx-ul collapse nav-submenu mb-3" id="submenu-dashboard">
                  <li id="link-edit_profile" class="nav-list"><a href='/dashboard/edit/profile'>Profile</a></li>
              </ul>
              <form action="/logout" method="post" class="m-0">
                @csrf
                <button class="btn" type="submit"><li id="link-wizard" class="nav-link mb-3"><i class="bx bx-log-out-circle me-1"></i><span>Logout</span></li></button>
              </form>
          </ul>
      </nav>
  </div>
</div>

<div id="header" class="bg-white px-2 py-3 shadow">
    <div id="header-inner" class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-primary flex-between">
                <div class="flex-start gap-2">
                    <span id="toggle-sidebar" role="button" class="btn"><i class='bx bx-menu'></i></span>
                    <h1 class="fs-18 display-5 flex-start text-darkBlue mb-0">
                      @if(isset($page_title))
                      {!! $page_title !!}
                      @else
                      <i class="bx bxs-dashboard me-3"></i><span>Dashboard</span>
                      @endif
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// toggle sidebar
var sidebar_width = $('#sidebar').outerWidth();
$('#toggle-sidebar').click(function() {
    toggleSidebar(sidebar_show);
});
$('.mobile-nav-toggle').click(function() {
    toggleSidebar(sidebar_show);
});
$(window).resize(function() {
    if($(window).width() < 1199) {
        $('#sidebar').css('left', sidebar_width*-1);
        $('#header-inner').css('padding-left', 0);
        $('#main').css('padding-left', 0);
        sidebar_show = false;
    } else {
        $('#sidebar').css('left', 0);
        $('#header-inner').css('padding-left', sidebar_width);
        $('#main').css('padding-left', sidebar_width);
        sidebar_show = true;
    }
});
function toggleSidebar(show) {
    if(show == true) {
        $('#sidebar').css('left', sidebar_width*-1);
        if($(window).width() > 1199) {
          $('#header-inner').animate({'padding-left': 0});
          $('#main').animate({'padding-left': 0});
        }
        sidebar_show = false;
    } else {
        $('#sidebar').css('left', 0);
        if($(window).width() > 1199) {
          $('#header-inner').animate({'padding-left': sidebar_width});
          $('#main').animate({'padding-left': sidebar_width});
        }
        sidebar_show = true;
    }
};

$(document).ready(function(){
  if($(window).width() < 1199) {
      $('#sidebar').removeClass('show');
      sidebar_show = false;
  } else {
      $('#sidebar').removeClass('show').addClass('show');
      sidebar_show = true;
  }
});
</script>