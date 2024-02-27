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
        <div id="userModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body">
                    <h2>Create New User</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form id="newUserForm" action="{{ route('members.store') }}" method="POST">
                        @csrf
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name"><br>
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email"><br>
                        <select name="user_role" >
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                        <label for="role">Role:</label><br>
                        <input type="text" id="role" name="user_role"><br>
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password"><br><br>
                        <button type="button">Create</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // Elemanları seç
            document.addEventListener('DOMContentLoaded', function() {
                // Modal ve butonu seç
                var modal = document.getElementById("userModal");
                var btn = document.getElementById("addNewUserBtn");
                var span = document.getElementsByClassName("close")[0];
                // Butona tıkladığında modalı aç
                btn.onclick = function() {
                    modal.style.display = "block";
                }
                // Çarpıya (x) tıkladığında modalı kapat
                span.onclick = function() {
                    modal.style.display = "none";
                }
                // Kullanıcı modal dışına tıklarsa kapat
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            });

            function toggleOptions() {
                var options = document.getElementById("options");
                if (options.style.display === "none") {
                    options.style.display = "block"; // Seçenekleri göster
                } else {
                    options.style.display = "none"; // Seçenekleri gizle
                }
            }
        </script>
        <main class="table" id="customers_table">
            <section class="table__header">
                <div>
                    <button type="button" id="addNewUserBtn" class="btn btn-single">Add New User</button>
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Role <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                            function deleteUser(userId) {
                                var confirmation = confirm("Are you sure you want to delete this user?");
                                if (confirmation) {
                                    var element = document.getElementById(userId);
                                    element.parentNode.removeChild(element);
                                }
                            }
                        </script>
                        @foreach($users as $user)
                        <tr>
                            <td> {{ $user->id }} </td>
                            <td> <img src="images/person.png" alt="">{{ $user->name }}</td>
                            <td> {{ $user->email }} </td>
                            <td> @if ($user->user_role == 0)
                                User
                                @elseif ($user->user_role == 1)
                                Admin
                                @else
                                Unknown Role
                                @endif</td>
                            <td>
                                @if ($user->user_status == 0)
                                <p class="status active">Acitve</p>
                                @else
                                <p class="status deactive">Inactive</p>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                        </tr>
                        @endforeach
                </table>
            </section>
        </main>
</body>

</html>