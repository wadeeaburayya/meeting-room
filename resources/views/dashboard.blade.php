<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/0cd5175097.js" crossorigin="anonymous"></script>
    <title>Dashboard | EliteGrid</title>
</head>
<body>
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
                    <a href="index.html" class="active">
                        <span><i class="fas fa-tachometer-alt"></i> </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('page') }}">
                        <span><i class="fa-solid fa-calendar-days"></i></span>
                        <span>Meeting List</span>
                    </a>
                </li>
                <li>
                    <a href="user.html">
                        <span><i class="fa-solid fa-user-tie"></i> </span>
                        <span>My Account</span>
                    </a>
                </li>
                <li>
                    <a href="members.html">
                        <span><i class="fas fa-users"></i> </span>
                        <span>Members</span>
                    </a>
                </li>
                <li>
                    <a href="rooms.html">
                        <span><i class="fa-brands fa-intercom"></i> </span>
                        <span>Rooms</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
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
    <!-- Sidebar End Here -->
    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar Header -->
        <header>
            <div class="header-title">
                <h2>
                    <label for="nav-toggle">
                        <i class="fas fa-bars"></i>
                    </label>
                    Dashboard
                </h2>
            </div>
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="search" placeholder="Search Here">
            </div>
            <div class="user-wrapper">
                <img src="https://images.unsplash.com/photo-1557862921-37829c790f19?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=751&q=80" alt="person">
                <div>
                    <h4>John Doe</h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>
        <!-- Navbar Header End Here -->
        <!-- Main Content -->
        <div class="cards">
            <div class="card-single">
                <div>
                    <h1>{{ $usersCount }}</h1>
                    <span>Members</span>
                </div>
                <div>
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1>{{ $roomsCount }}</h1>
                    <span>Rooms</span>
                </div>
                <div>
                    <i class="far fa-clipboard"></i>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1>{{ $userAdmin }}</h1>
                    <span>Admins</span>
                </div>
                <div>
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <!-- Cards End Here -->
        <!-- Add More Components Here -->
        <div class="meetings-container">
            <div class="meeting-info upcoming-meetings">
                <h3>Upcoming Meetings</h3>
                @foreach($upcomingReservations as $reservation)
                <div class="meeting">
                    <div class="meeting-top">
                        <span>{{ $reservation->room->room_name }}</span>
                    </div>
                    <div class="meeting-bottom">
                        <h5>{{ $reservation->user->name }}</h5>
                        <p>Start Time: <i>{{ $reservation->start_time->format('Y-m-d H:i:s') }}</i></p>
                        <p>End Time: <i>{{ $reservation->end_time->format('Y-m-d H:i:s') }}</i></p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="meeting-info ongoing-meetings">
                <h3>Ongoing Meetings</h3>
                @foreach($ongoingReservations as $reservation)
                <div class="meeting">
                    <div class="meeting-top">
                        <span>{{ $reservation->room->room_name }}</span>
                    </div>
                    <div class="meeting-bottom">
                        <h5>{{ $reservation->user->name }}</h5>
                        <p>Start Time: <i>{{ $reservation->start_time->format('Y-m-d H:i:s') }}</i></p>
                        <p>End Time: <i>{{ $reservation->end_time->format('Y-m-d H:i:s') }}</i></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
</body>
</html>