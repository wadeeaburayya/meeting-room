<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <title>Dashboard</title>
    <style>
        .timetable {
            border-collapse: collapse;
            width: 100%;
        }
        .timetable th,
        .timetable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .timetable th {
            background-color: #f2f2f2;
        }
        #error-message {
            color: #D8000C;
            background-color: #FFD2D2;
            border: 1px solid #D8000C;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: none;
        }
        #error-message p {
            font-weight: bold;
            margin-bottom: 5px;
        }
        #error-message ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        #error-message li {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <header>
        @include('layouts.topbar')
    </header>
    <main>
        <div style="margin-top: 25px;" class="main-content">
            <div style="display: flex; margin-left: 15px;">
                <div id="reservationModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <form id="reservationForm">
                            @csrf
                            <div id="error-message"></div>
                            <label for="reservation_topic" class="form-label">Reservation Topic</label><br>
                            <input type="text" id="reservation_topic" class="form-control"
                                name="reservation_topic"><span class="error-message"
                                id="reservation_topic_error"></span><br>
                            <label for="reservation_description" class="form-label">Reservation Description</label><br>
                            <textarea name="reservation_description" class="form-control" id="reservation_description" cols="30"
                                rows="10"></textarea><span class="error-message"
                                id="reservation_description_error"></span>
                            <input type="hidden" name="day" value="">
                            <input type="hidden" name="start_time" value="">
                            <input type="hidden" name="end_time" value="">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="room_id" value="{{ $selectedRoomId }}">
                            <div class="form-control" style="height: 150px; overflow-y: scroll;">
                                @foreach ($users as $user)
                                    <input type="checkbox" name="attendees[]" value="{{ $user->id }}" checked>  
                                    <label for="attendees">{{ $user->name }}</label><br>
                                @endforeach
                            </div>                            
                            <button type="submit" class="btn btn-secondary">Save </button>
                            <span type="button" class="btn btn-primary close"
                                style="font-size: 15px; color: white; float: left;" data-bs-dismiss="modal">Close</span>
                        </form>
                    </div>
                </div>
                <div id="cancelledMeetingModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="modal-body">
                            <p style="text-align: center; font-size: 20px; font-weight: bold;">This meeting time has
                                been passed.</p>
                        </div>
                    </div>
                </div>
                @if (isset($date))
                    <button class="week-button" id="currentWeekBtn">Current Week</button>
                @else
                    <button class="week-button" id="nextWeekBtn">Next Week</button>
                @endif
            </div>
            @php
                $roomInfo = $rooms->where('id', $selectedRoomId)->first();
                $roomName = $roomInfo->room_name;
            @endphp
            <h2 style="text-align: center" ;>{{ $roomName }} Room</h2>
            <div style="overflow-x: auto;">
                <table class="table timetable" style="border-collapse: separate; border-spacing: 5px;">
                    <thead>
                        <tr>
                            <th style="background-color: #d5d1defe; cursor: default;">Day</th>
                            @foreach ($timeslots as $timeslot)
                                <th style="background-color: #d5d1defe; cursor: default;">{{ $timeslot }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($days as $day)
                            <tr>
                                <td style="background-color: #d5d1defe; cursor: default;">{{ $day->name }}</td>
                                @foreach ($timeslots as $timeslot)
                                    @php
                                        $currentDateTime = date(
                                            'Y-m-d H:i',
                                            strtotime('monday this week ' . $day->name . ' ' . $timeslot),
                                        );
                                        $nextDateTime = date(
                                            'Y-m-d H:i',
                                            strtotime('monday next week ' . $day->name . ' ' . $timeslot),
                                        );
                                        $dateTime = isset($date) ? $nextDateTime : $currentDateTime;
                                        $reservationFound = false;
                                        $reservationTopic = '';
                                    @endphp
                                    @foreach ($reservations as $reservation)
                                        @php
                                            $startTimeFormatted = date(
                                                'Y-m-d H:i',
                                                strtotime($reservation->start_time),
                                            );
                                        @endphp
                                        @if ($startTimeFormatted == $dateTime && $reservation->reservation_status != 2)
                                            @php
                                                $reservationFound = true;
                                                $reservationTopic = $reservation->reservation_topic;
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($reservationFound)
                                        @if ($reservation->user_id == Auth::user()->id)
                                            @if ($reservation->reservation_status == 0)
                                                <td style="background-color: #3B71CA; color:white; cursor: pointer;"
                                                    data-reservation-id="{{ $reservation->reservation_id }}"
                                                    data-room-id="{{ $selectedRoomId }}"
                                                    data-time="{{ $dateTime }}">
                                                    <a style="color:white"
                                                        href="{{ route('meetingDetails.edit', $reservation->reservation_id) }}">
                                                        <div>
                                                            <strong>{{ $reservationTopic }}</strong>
                                                        </div>
                                                    </a>
                                                </td>
                                            @elseif($reservation->reservation_status == 1)
                                                <td style="background-color: #505f57; color: white;"
                                                    data-room-id="{{ $selectedRoomId }}"
                                                    data-time="{{ $dateTime }}">
                                                    <div>
                                                        <strong>{{ $reservationTopic }}</strong>
                                                    </div>
                                                </td>
                                            @elseif($reservation->reservation_status == 2)
                                                <td style="background-color: #d5d1defe; cursor: pointer; transition: background-color 0.3s ease; padding: 10px;"
                                                    class="slots" data-room-id="{{ $selectedRoomId }}"
                                                    data-time="{{ $dateTime }}">
                                                    <div>
                                                        +
                                                    </div>
                                                </td>
                                            @elseif($reservation->reservation_status == 3)
                                                <td class="cancelledMeeting"
                                                    style="background-color: #DC4C64; color: white; cursor: pointer;"
                                                    data-room-id="{{ $selectedRoomId }}"
                                                    data-time="{{ $dateTime }}">
                                                    <div>
                                                        <strong>{{ $reservationTopic }}</strong>
                                                    </div>
                                                </td>
                                            @elseif($reservation->reservation_status == 4)
                                                <td style="background-color: #14A44D; color: white;"
                                                    data-room-id="{{ $selectedRoomId }}"
                                                    data-time="{{ $dateTime }}">
                                                    <div>
                                                        <strong>{{ $reservationTopic }}</strong>
                                                    </div>
                                                </td>
                                            @endif
                                        @else
                                            @if (
                                                $reservation->reservation_status == 0 ||
                                                    $reservation->reservation_status == 1 ||
                                                    $reservation->reservation_status == 3 ||
                                                    $reservation->reservation_status == 4)
                                                <td data-reservation-id="{{ $reservation->reservation_id }}"
                                                    data-room-id="{{ $selectedRoomId }}"
                                                    data-time="{{ $dateTime }}">
                                                    <div>
                                                        <strong>{{ $reservationTopic }}</strong>
                                                    </div>
                                                </td>
                                            @elseif($reservation->reservation_status == 2)
                                                <td style="background-color: #d5d1defe; cursor: pointer; transition: background-color 0.3s ease; padding: 10px;"
                                                    class="slots" data-room-id="{{ $selectedRoomId }}"
                                                    data-time="{{ $dateTime }}">
                                                    <div>
                                                        +
                                                    </div>
                                                </td>
                                            @endif
                                        @endif
                                    @else
                                        <td style="background-color: #d5d1defe; cursor: pointer; transition: background-color 0.3s ease; padding: 10px;"
                                            class="slots" data-room-id="{{ $selectedRoomId }}"
                                            data-time="{{ $dateTime }}">
                                            <div>
                                                +
                                            </div>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="successModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body">
                    <div style="display: flex; justify-content: center;">
                        <img src="{{ asset('images/green_tick_icon.jpg') }}" alt="Success Icon">
                    </div>
                    <p id="successMessage">
                        Reservation has been done successfully.
                    </p>
                    <p><span style="color:#DC4C64; font-style:italic; text-align:center;">IMPORTANT</span> *Please do
                        not forget to confirm the reservation before <span style="font-weight: bolder;">15</span>
                        minutes of the meeting time.*</p>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#currentWeekBtn').click(function() {
                changeWeek(0);
            });
            $('#nextWeekBtn').click(function() {
                changeWeek(1);
            });
            function changeWeek(weekOffset) {
                var date = new Date("{{ date('Y-m-d', strtotime('monday this week')) }}");
                date.setDate(date.getDate() + (weekOffset * 7));
                var formattedDate = date.toISOString().split('T')[0];
                if (weekOffset == 0) {
                    window.location.href = "{{ route('page') }}?selectedRoomId={{ $selectedRoomId }}";
                } else {
                    window.location.href = "{{ route('page') }}?selectedRoomId={{ $selectedRoomId }}&date=" +
                        formattedDate;
                }
            }
            var startTime;
            $('.close').click(function() {
                $('#reservationModal').css('display', 'none');
                $('#cancelledMeetingModal').css('display', 'none');
            });
            $('.cancelledMeeting').click(function() {
                $('#cancelledMeetingModal').css('display', 'block');
            });
            $('.slots').click(function() {
                $('#reservationModal').css('display', 'block');
                var day = $(this).closest('tr').find('td:first').text();
                console.log("Day:", day);
                startTime = $(this).data('time');
                var endTimeSlot = $(this).next('td');
                var endTime = endTimeSlot.data('time');
                console.log("Start Time:", startTime);
                console.log("End Time:", endTime);
                // Check if it's the last td
                if (endTimeSlot.length === 0) {
                    endTime = startTime.split(' ')[0] + ' 19:00';
                    console.log("End Time:", endTime);
                }
                $('#reservationForm input[name="day"]').val(day);
                $('#reservationForm input[name="start_time"]').val(startTime);
                $('#reservationForm input[name="end_time"]').val(endTime);
            });
            $('#reservationForm').submit(function(e) {
                e.preventDefault();
                var csrfToken = "{{ csrf_token() }}";
                $.ajax({
                    type: 'POST',
                    url: "{{ route('page.store') }}",
                    data: $('#reservationForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        var reservationTopic = response.reservationTopic;
                        $('#reservationModal').css('display', 'none');
                        $('.slots[data-time="' + startTime + '"]').html('<div><strong>' +
                            reservationTopic + '</strong></div>');
                        $('#reservationForm')[0].reset();
                        $('#successModal').fadeIn();
                        setTimeout(function() {
                            $('#successModal').fadeOut();
                            window.location.reload();
                        }, 4000);
                    },
                    error: function(response) {
                        console.log(response.responseJSON
                            .message); // Log the 'Please fill all fields' message
                        var message = response.responseJSON.message;
                        $('#error-message').text(message);
                        $('#error-message').css('display', 'block');
                    }
                });
            });
            $('#editReservationForm').submit(function(e) {
                e.preventDefault();
                var csrfToken = "{{ csrf_token() }}";
                $.ajax({
                    type: 'POST',
                    url: "{{ route('page.update') }}",
                    data: $('#editReservationForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        var reservationTopic = response.reservationTopic;
                        $('#editReservationModal').css('display', 'none');
                        $('.editSlot[data-reservation-id="' + $(
                                '#editReservationForm input[name="edit_reservation_id"]')
                            .val() + '"]').html('<div><strong>' + reservationTopic +
                            '</strong></div>');
                        $('#editReservationForm')[0].reset();
                        $('#successModal').fadeIn();
                        setTimeout(function() {
                            $('#successModal').fadeOut();
                            window.location.reload();
                        }, 4000);
                    },
                    error: function(response) {
                        console.log(response.responseJSON
                            .message); // Log the 'Please fill all fields' message
                        var message = response.responseJSON.message;
                        $('#edit-error-message').text(message);
                        $('#edit-error-message').css('display', 'block');
                    }
                });
            })
        });
    </script>
</body>
</html>
