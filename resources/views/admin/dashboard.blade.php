<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    <title>Dashboard</title>
</head>

<body>
    @include('layouts.sidebar')
    <!-- Sidebar End Here -->
    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar Header -->
        <header>
            @include('layouts.topbar')
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
</body>

</html>