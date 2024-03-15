<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    <title>Profile Settings</title>
</head>

<body>
    @include('layouts.sidebar')
    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar Header -->
        <header>
            @include('layouts.topbar')
        </header>
        <div class="wrapper">
            <div class="right">
                <h2>Profile Settings</h2>
                <img class="avatar" src="http://res.cloudinary.com/dikpupfzu/image/upload/v1525474876/profile_avatar.png" alt="">
                <div class="bottom">
                    <h3>Edit Picture</h3>
                    <div class="form-group">
                        <input type="file" id="picture" class="file-input">
                        <label for="picture" class="custom-file-label">Choose File</label>
                    </div>
                </div>
                <div class="form">
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="field">
                            <label for="full_name">Full Name</label>
                            <input id="full_name" type="text" name="name" value="{{ old('full_name', $user->name) }}" />
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" type="text" name="email" value="{{ old('email', $user->email) }}" />
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="old_password">Old Password</label>
                            <input id="old_password" type="password" name="old_password" />
                            @error('old_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="new_password">New Password</label>
                            <input id="new_password" type="password" name="new_password" />
                            @error('new_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                    @if(session('success'))
                    <div class="alert alert-danger">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>