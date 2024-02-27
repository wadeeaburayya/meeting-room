<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <title>Dashboard</title>
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
                    <form action="index.html" method="post">
                        <div class="field">
                            <label for="">Full Name</label>
                            <input class="full_name" type="text" name="full-name" value="" />
                        </div>
                        <div class="field">
                            <label for="">Email</label>
                            <input class="full_name" type="text" name="full-name" />
                        </div>
                        <div class="field">
                            <label for="">Password</label>
                            <input class="full_name" type="text" name="full-name" />
                        </div>
                        <div class="field">
                            <label for="">New Password</label>
                            <input class="full_name" type="text" name="full-name" />
                        </div>
                    </form>
                </div>
                <div class="bottom">
                    <a href="#"><button class="btn btn-primary" type="submit" name="button">Save</button></a>
                    <a href="#"><button class="btn btn-primary" type="cancel" name="button">Cancel</button></a>
                </div>
            </div>
        </div>
</body>
</html>