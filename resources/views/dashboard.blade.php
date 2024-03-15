<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <title>Dashboard</title>
</head>
<body>
    @include('layouts.sidebar')
    <div class="main-content">
        <header>
            @include('layouts.topbar')
        </header>
        @if(auth()->user()->user_role == 1)
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
        @endif
        <div style="margin-top: 100px;" class="meetings-container">
            <div class="meeting-info upcoming-meetings">
                <h3>Upcoming Meetings</h3>
                @foreach($upcomingReservations as $reservation)
                <div class="meeting">
                    <div class="meeting-top">
                        <span>{{ $reservation->room->room_name }}</span>
                    </div>
                    <div class="meeting-bottom">
                        <h5>{{ $reservation->user->name }}</h5>
                        <p>Topic: {{$reservation->reservation_topic}}</p>
                        <p> Start Time: <i>{{ $reservation->start_time }}</i></p>
                        <p>End Time: <i>{{ $reservation->end_time }}</i></p>
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
                        <p>Topic: {{$reservation->reservation_topic}}</p>
                        <p>Start Time: <i>{{ $reservation->start_time }}</i></p>
                        <p>End Time: <i>{{ $reservation->end_time}}</i></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
</body>
</html>