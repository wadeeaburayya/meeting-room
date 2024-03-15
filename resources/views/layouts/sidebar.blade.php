<input type="checkbox" id="nav-toggle">
<!-- Sidebar -->
<section class="sidebar">
    <div class="sidebar-brand">
        <h2>
            <span><i class="fab fa-font-awesome-alt"></i></span>
            <span>Döveç </span>
        </h2>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="active">
                    <span><i class="fas fa-tachometer-alt"></i> </span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('selectRoom') }}">
                    <span><i class="fa-solid fa-calendar-days"></i></span>
                    <span>Meeting List</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}">
                    <span><i class="fa-solid fa-user-tie"></i> </span>
                    <span>My Account</span>
                </a>
            </li>
            <li>
                <a href="{{ route('notifications') }}">
                    <span><i class="fa-solid fa-bell"></i> </span>
                    <span>Notifications</span>
                    @if ($unseenNotificationsCount > 0)
                        <span class="notification-badge">{{ $unseenNotificationsCount }}</span>
                    @endif
                </a>
            </li>
            @if (auth()->user()->user_role == 1)
                <li>
                    <a href="{{ route('members') }}">
                        <span><i class="fas fa-users"></i> </span>
                        <span>Members</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('rooms') }}">
                        <span><i class="fa-brands fa-intercom"></i> </span>
                        <span>Rooms</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                    <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                    <span>{{ __('Logout') }}</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
    </div>
</section>
