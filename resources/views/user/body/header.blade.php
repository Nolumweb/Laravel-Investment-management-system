<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-light" height="20">
                    </span>
                </a>
            </div>

<button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
<i class="ri-menu-2-line align-middle"></i>
</button>

<!-- App Search-->
<form class="app-search d-none d-lg-block">
<div class="position-relative">
<input type="text" class="form-control" placeholder="Search...">
<span class="ri-search-line"></span>

</div>
</form>
{{-- {{ ucfirst(trans(Auth::user()->name)) }} --}}

</div>
<div class="text-white">{{ __('Hi, welcome') }} </div>
<div class="d-flex">


    <div class="dropdown d-inline-block user-dropdown">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle header-profile-user" src="{{ Auth::user()->profile_photo_url }}"
                alt="Header Avatar">
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>


<div class="dropdown-menu dropdown-menu-end">
<!-- item-->
<a class="dropdown-item" href="{{ route('profile.show') }}"><i class="ri-user-line align-middle me-1"></i>{{ __('Profile') }} </a>
<div class="dropdown-divider"></div>





     <form method="POST" action="{{ route('logout') }}">
    @csrf
    <div class="dropdown-item text-danger"><i class="ri-shut-down-line align-middle me-1 text-danger"></i>
    <x-responsive-nav-link  :href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
        <b class="text-danger">{{ __('Log Out') }}</b>
    </x-responsive-nav-link>
</div>
</form> 

</div>
</div>



        </div>
    </div>
</header>
