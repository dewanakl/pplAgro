<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('welcome') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-leaf"></i>
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (Route::current()->uri == 'dashboard') ? 'active' : null }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    @role('owner')
    <li class="nav-item {{ (Route::current()->uri == 'agen') ? 'active' : null }}">
        <a class="nav-link" href="{{ route('agen.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Agen</span>
        </a>
    </li>
    <li class="nav-item {{ (Route::current()->uri == 'pesanan') ? 'active' : null }}">
        <a class="nav-link" href="{{ route('pesanan') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Pesanan</span>
        </a>
    </li>
    <li class="nav-item {{ (Route::current()->uri == 'keuangan') ? 'active' : null }}">
        <a class="nav-link" href="{{ route('keuangan') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Keuangan</span>
        </a>
    </li>
    <li class="nav-item {{ (Route::current()->uri == 'bahanbaku') ? 'active' : null }}">
        <a class="nav-link" href="{{ route('bahanbaku') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Bahan Baku</span>
        </a>
    </li>
    @else
    <li class="nav-item {{ (Route::current()->uri == 'pesanan') ? 'active' : null }}">
        <a class="nav-link" href="{{ route('pesanan') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Pesanan</span>
        </a>
    </li>
    @endrole
    <hr class="sidebar-divider d-none d-md-block">
    {{-- <div class="sidebar-heading">Interface</div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}
</ul>