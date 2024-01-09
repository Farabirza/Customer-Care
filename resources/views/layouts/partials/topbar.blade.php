<style>
#navbar-owner { position: absolute; width: 100%; }
#container-topbar { justify-content: end; display: flex; align-items: center; }
.btn-topbar:hover { background: #fff; color: #202020; transition: .2s ease-in-out; }
@media(max-width: 1199px) {
  #container-topbar { justify-content: start; }
}
</style>

<nav id="navbar-owner" class="navbar bg-dark text-light">
  <div id="container-topbar" class="container-fluid gap-3">
    <span class="fs-9">Welcome, {{Auth::user()->username}}</span>|
    <div class="flex-start">
      <div class="position-relative">
        <i role="button" class="bx bx-bell bx-border btn-topbar" title="Notification" onclick="modalNotification()"></i>
        @if(Auth::user()->notification->where('read', false)->count() > 0)
        <div id="notification-badge" class="position-absolute translate-middle badge rounded-pill bg-danger" style="top:10%; left:85%; font-size: .5em">
            {{Auth::user()->notification->where('read', false)->count()}}
        </div>
        @endif
      </div>
      <i role="button" type="button" class="bx bx-palette bx-border btn-topbar" title="Preference" data-bs-toggle="offcanvas" data-bs-target="#sidebar-preference" aria-controls="sidebar-preference"></i>
      <a href="/dashboard" class="fs-9"><i class="bx bxs-dashboard bx-border btn-topbar" title="Dashboard"></i></a>
      <a href="/dashboard/edit/profile"><i role="button" type="button" class="bx bx-edit-alt bx-border btn-topbar" title="Edit data"></i></a>
    </div>
  </div>
</nav>



