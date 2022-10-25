<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{route('profile')}}" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{asset('assets/images/profile.png')}}" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{ Auth::user()->name }}</p>
                    <p class="designation">{{ Auth::user()->roles->first()->display_name }}</p>
                </div>
                <div class="icon-container">
                    <i class="icon-bubbles"></i>
                    <div class="dot-indicator bg-danger"></div>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Menu Options</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-accounts')}}">
                    <span class="menu-title">Accounts</span>
                    <i class="icon-user menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-licenses')}}">
                    <span class="menu-title">Licenses</span>
                    <i class="icon-doc menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-transactions')}}">
                    <span class="menu-title">Transactions</span>
                    <i class="icon-briefcase menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin-complaints') }}">
                    <span class="menu-title">Complaints</span>
                    <i class="icon-speech  menu-icon"></i>
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user-payment') }}">
                    <span class="menu-title">Payment</span>
                    <i class="icon-credit-card menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user-complaints') }}">
                    <span class="menu-title">Complaints</span>
                    <i class="icon-speech  menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user-statement')}}">
                    <span class="menu-title">Statement</span>
                    <i class="icon-briefcase menu-icon"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>
