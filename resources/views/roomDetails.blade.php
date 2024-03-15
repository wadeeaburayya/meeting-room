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
                <h2>Room Settings</h2>
                <div class="form">
                    <form id="roomDetailsForm" action="{{ route('roomDetails.update', $room->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div id="error-message"></div>
                        <div class="field">
                            <label for="room_name">Room Name</label>
                            <input id="room_name" type="text" name="room_name" value="{{ old('room_name', $room->room_name) }}" required />
                        </div>
                        <div class="field">
                            <label for="room_floor">Floor:</label><br>
                            <select name="room_floor" id="room_floor">
                                <option value="1" {{ $room->room_floor == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $room->room_floor == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $room->room_floor == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $room->room_floor == 4 ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $room->room_floor == 5 ? 'selected' : '' }}>5</option>
                            </select>
                        </div>
                        <div style="height: 200px; overflow-y: auto;">
                            <table>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="users[]" value="{{ $user->id }}" {{ in_array($user->id, $selectedUsers) ? 'checked' : '' }} />
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <button class="btn btn-primary" id="saveRoomDetails" type="submit">Save</button>
                        <a href="{{ route('rooms') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                    <div id="successModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div class="modal-body">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ asset('images/green_tick_icon.jpg') }}" alt="Success Icon">
                                </div>
                                <p id="successMessage"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#saveRoomDetails').click(function(e) {
                e.preventDefault();
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: $('#roomDetailsForm').attr('action'),
                    type: 'POST',
                    data: $('#roomDetailsForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        showModal(response.success);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Log the detailed error message
                        var errorMessage = JSON.parse(xhr.responseText).error; // Extract error message from JSON response
                        $('#error-message').text(errorMessage); // Update the content of the error message element
                    }
                });
            });
        });

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
</body>

</html>