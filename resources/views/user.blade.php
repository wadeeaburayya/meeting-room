<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
        <script src="https://kit.fontawesome.com/0cd5175097.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <title>Dashboard | EliteGrid</title>
</head>

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
                <a href="page.html">
                    <span><i class="fas fa-calendar"></i> </span>
                    <span>Meeting List</span>
                </a>
            </li>
            <li>
                <a href="user.html">
                    <span><i class="fas fa-book-reader"></i> </span>
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
                    <span><i class="fas fa-laptop-code"></i> </span>
                    <span>Rooms</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                    <span>Logout</span>
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
            <img src="https://images.unsplash.com/photo-1557862921-37829c790f19?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=751&q=80"
                alt="person">
            <div>
                <h4>John Doe</h4>
                <small>Admin</small>
            </div>
        </div>

    </header>

    <body>
        <div class="wrapper">
            <div class="right">
                <h2>Profile Settings</h2>
                <img class="avatar"
                    src="http://res.cloudinary.com/dikpupfzu/image/upload/v1525474876/profile_avatar.png" alt="">
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