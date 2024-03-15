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
        <div id="roomModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body">
                    <h2>Create New Room</h2>
                    <form id="newUserForm" action="{{ route('rooms.store') }}" method="post">
                        @csrf
                        <label for="room_name">Room Name:</label><br>
                        <input type="text" id="room_name" name="room_name"><br>
                        <label for="room_floor">Floor:</label><br>
                        <select name="room_floor" id="room_floor">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label for="users[]">Users:</label><br>
                        <select name="users[]" id="users" multiple>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <button type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // Elemanları seç
            document.addEventListener('DOMContentLoaded', function() {
                // Modal ve butonu seç
                var modal = document.getElementById("roomModal");
                var btn = document.getElementById("addNewRoomBtn");
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
        </script>
        <main class="table" id="customers_table">
            <section class="table__header">
                <div>
                    <button type="button" id="addNewRoomBtn" class="btn btn-single">Add New Room</button>
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Floor <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td> {{ $room->id }} </td>
                            <td>{{ $room->room_name }}</td>
                            <td> {{ $room->room_floor }}</td>
                            <td id="status{{ $room->id }}">
                                @if($room->room_status == 0)
                                <p class="status active">Active</p>
                                @else
                                <p class="status deactive">Inactive</p>
                                @endif
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">ACTIONS <i class="fa-solid fa-chevron-down"></i></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('roomDetails.edit', $room->id) }}">Edit</a></li>
                                        <li>
                                            <form id="activationForm{{ $room->id }}" action="{{ route('roomDetails.activation', $room->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" id="activateBtn{{ $room->id }}" class="btn-link">{{ $room->room_status == 0 ? 'Deactivate' : 'Activate' }}</button>
                                            </form>
                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#activateBtn{{ $room->id }}').click(function(e) {
                                                        e.preventDefault(); // Prevent default form submission
                                                        // Get CSRF token
                                                        var csrfToken = '{{ csrf_token() }}';
                                                        $.ajax({
                                                            url: $('#activationForm{{ $room->id }}').attr('action'),
                                                            type: 'PATCH',
                                                            data: $('#activationForm{{ $room->id }}').serialize(),
                                                            headers: {
                                                                'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                                                            },
                                                            success: function(response) {
                                                                // Show success modal
                                                                showModal(response.message);
                                                                // Update status cell content
                                                                var statusCell = $('#status{{ $room->id }}');
                                                                if (response.room_status == 0) {
                                                                    statusCell.html('<p class="status active">Active</p>');
                                                                    $('#activateBtn{{ $room->id }}').text('Deactivate');
                                                                } else {
                                                                    statusCell.html('<p class="status deactive">Inactive</p>');
                                                                    $('#activateBtn{{ $room->id }}').text('Activate');
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