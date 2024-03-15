<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    <title>Dashboard</title>
</head>

<body>
    @include('layouts.sidebar')
    <header>
        @include('layouts.topbar')
    </header>
    <main>
        <div style="margin-top: 15px;" class="main-content">
            @foreach($rooms as $room)
            <div class="room-card">
                <a href="{{ route('page', ['selectedRoomId' => $room->id]) }}" class="room-link">
                    <div class="room-card-inner">
                        <h2 class="room-title">Room: {{ $room->room_name }}</h2>
                        <p class="room-description">Floor: {{ $room->room_floor }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </main>
</body>

</html>