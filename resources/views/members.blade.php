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
                    <form id="newUserForm" action="{{ route('members.store') }}" method="POST">
                        @csrf
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name"><br>
                        @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email"><br>
                        @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('email') as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <select name="user_role">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                        @if ($errors->has('user_role'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('user_role') as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password"><br><br>
                        @if ($errors->has('password'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('password') as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <button type="submit">Create</button>
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
                            <td id="status{{ $user->id }}">
                                @if ($user->user_status == 0)
                                <p class="status active">Active</p>
                                @else
                                <p class="status deactive">Inactive</p>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">ACTIONS <i class="fa-solid fa-chevron-down"></i></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('user.edit', $user->id) }}">Edit</a></li>
                                        <li>
                                            <form id="activationForm{{ $user->id }}" action="{{ route('user.activation', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" id="activateBtn{{ $user->id }}" class="btn-link">{{ $user->user_status == 0 ? 'Deactivate' : 'Activate' }}</button>
                                            </form>
                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#activateBtn{{ $user->id }}').click(function(e) {
                                                        e.preventDefault(); // Prevent default form submission
                                                        // Get CSRF token
                                                        var csrfToken = '{{ csrf_token() }}';
                                                        $.ajax({
                                                            url: $('#activationForm{{ $user->id }}').attr('action'),
                                                            type: 'PATCH',
                                                            data: $('#activationForm{{ $user->id }}').serialize(),
                                                            headers: {
                                                                'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                                                            },
                                                            success: function(response) {
                                                                // Show success modal
                                                                showModal(response.message);
                                                                // Update status cell content
                                                                var statusCell = $('#status{{ $user->id }}');
                                                                if (response.user_status == 0) {
                                                                    statusCell.html('<p class="status active">Active</p>');
                                                                    $('#activateBtn{{ $user->id }}').text('Deactivate');
                                                                } else {
                                                                    statusCell.html('<p class="status deactive">Inactive</p>');
                                                                    $('#activateBtn{{ $user->id }}').text('Activate');
                                                                }
                                                            },
                                                            error: function(xhr, status, error) {
                                                                console.error(xhr.responseText);
                                                            }
                                                        });
                                                    });
                                                });
                                                // Function to show modal with success message
                                                function showModal(message) {
                                                    var modal = document.getElementById("successModal");
                                                    var span = document.getElementsByClassName("close")[0];
                                                    var successMessage = document.getElementById("successMessage");
                                                    successMessage.textContent = message;
                                                    modal.style.display = "block";
                                                    // Close the modal when user clicks on the close button
                                                    span.onclick = function() {
                                                        modal.style.display = "none";
                                                    }
                                                    // Close the modal when user clicks anywhere outside of it
                                                    window.onclick = function(event) {
                                                        if (event.target == modal) {
                                                            modal.style.display = "none";
                                                        }
                                                    }
                                                }
                                            </script>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <div id="successModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div class="modal-body">
                                    <img src="{{ asset('images/green_tick_icon.jpg') }}" alt="Success Icon">
                                    <p id="successMessage">Success!</p>
                                </div>
                            </div>
                        </div>
                        
                </table>
            </section>
        </main>
</body>
</html>