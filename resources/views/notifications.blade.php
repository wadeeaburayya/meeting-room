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
            <h2>Notifications</h2>
            @if (count($notifications) > 0)
                @foreach ($notifications as $notification)
                <div class="notification-card">
                    <div class="notification-card-inner">
                        <p class="notification-description">{{ $notification->message }}</p>
                        <!-- Mark as Read button -->
                        <form action="{{ route('mark-as-read', ['id' => $notification->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="mark-as-read-btn">Mark as Read</button>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <p>No notifications found.</p>
            @endif
        </div>
    </main>
</body>

</html>
