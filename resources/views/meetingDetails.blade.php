<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    <title>Meeting Details</title>
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
                <h2>Meeting Details</h2>
                <div class="form">
                    <form id="meetingDetailsForm"
                        action="{{ route('meetingDetails.update', $reservation->reservation_id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div id="error-message"></div>
                        <div class="field">
                            <label for="reservation_topic">Reservation Topic</label>
                            <input id="reservation_topic" type="text" name="reservation_topic"
                                value="{{ old('reservation_topic', $reservation->reservation_topic) }}" required />
                        </div>
                        <div class="field">
                            <label for="reservation_description">Reservation Description</label>
                            <textarea id="reservation_description" type="text" name="reservation_description" required>{{ old('reservation_description', $reservation->reservation_description) }}</textarea>
                        </div>
                        <input type="hidden" name="start_time">
                        <input type="hidden" name="end_time">
                        <div style="margin-bottom: 30px;">
                            <button id="cancelMeeting" class="btn" style="background-color:brown; color: white;"
                                type="button">Cancel Meeting</button>
                            @php
                                $currentDateTime = date('Y-m-d H:i:s');
                                $diff = strtotime($reservation->start_time) - strtotime($currentDateTime);
                                $diff = $diff / 60;
                            @endphp
                            @if (0  < $diff && $diff <= 15 && $reservation->reservation_status != 1)
                                <button id="confirmReservation" class="btn"
                                    style="background-color: green; color: white;" type="button">Confirm</button>
                            @elseif($reservation->reservation_status == 1)
                                <p style="margin-top: 10px;">
                                    <strong>Meeting is Confirmed</strong>
                                    <i class="fas fa-check-circle" style="color: green;"></i>
                                </p>
                            @endif
                        </div>
                        <a href="/page?selectedRoomId={{ $reservation->room_id }}" class="btn btn-secondary">Cancel</a>
                        <button class="btn btn-primary" id="saveReservationDetails" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-body">
                <p id="confirmationMessage"></p>
                <div class="modal-buttons">
                    <button id="confirmButton" class="btn">Yes</button>
                    <button id="cancelButton" class="btn">No</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#saveReservationDetails').click(function(e) {
                e.preventDefault();
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: $('#meetingDetailsForm').attr('action'),
                    type: 'POST',
                    data: $('#meetingDetailsForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        showModal(response.success);
                        setTimeout(function() {
                            location.reload();
                        }, 3500);
                    },

                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Log the detailed error message
                        var errorMessage = JSON.parse(xhr.responseText)
                            .error; // Extract error message from JSON response
                        $('#error-message').text(
                            errorMessage); // Update the content of the error message element
                    }
                });
            });
        });

        $('#confirmReservation').click(function(e) {
            $('#confirmationModal').css('display', 'block');
            $('#confirmationMessage').text('Are you sure you want to confirm this meeting?');
            $('#confirmButton').click(function() {
                updateReservationStatus(1);
                $('#confirmationModal').css('display', 'none');
            });
            $('#cancelButton').click(function() {
                $('#confirmationModal').css('display', 'none');
            });
        });

        $('#cancelMeeting').click(function(e) {
            $('#confirmationModal').css('display', 'block');
            $('#confirmationMessage').text('Are you sure you want to cancel this meeting?');
            $('#confirmButton').click(function() {
                updateReservationStatus(2);
                $('#confirmationModal').css('display', 'none');
            });
            $('#cancelButton').click(function() {
                $('#confirmationModal').css('display', 'none');
            });
        });

        function showModalConfirmation(message, callback) {
            if (confirm(message)) {
                callback();
            }
        }

        function updateReservationStatus(status) {
            var csrfToken = '{{ csrf_token() }}';
            $.ajax({
                url: '{{ route('meetingDetails.activation', $reservation->reservation_id) }}',
                type: 'POST',
                data: {
                    reservation_status: status,
                    _method: 'PATCH',
                    _token: csrfToken
                },
                success: function(response) {
                    showModal(response.success);
                    setTimeout(function() {
                        location.reload();
                    }, 3500);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    var errorMessage = JSON.parse(xhr.responseText).error;
                    $('#error-message').text(errorMessage);
                }
            });
        }

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
