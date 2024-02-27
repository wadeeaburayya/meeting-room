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
        <!-- Navbar Header End Here -->
        <!-- Main Content -->
        <main>
            <div class="main-schedular">
                <div class="days-column" style="text-align: center; margin-bottom: 20px;">
                </div>
                <div class="d-flex align-items-center" style="margin-bottom: 30px;">
                    <label for="meetingRoomSelect">Choose a Meeting Room:</label>
                    <select id="meetingRoomSelect">
                        @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->room_name }}</option>
                        @endforeach
                    </select>
                    <form>
                        <label class="mb-0">
                            <input type="date" name="party" min="2024-01-01" max="2026-04-30" />
                        </label>
                    </form>
                </div>
                <!-- Button trigger modal -->
                <!-- Modal -->
                <!-- Modal Tetikleyici -->
                <!-- Modal Yapısı -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="topic" class="form-label">Topic</label>
                                    <input type="email" class="form-control" id="topic">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Note</label>
                                    <input type="text" class="form-control" id="note">
                                </div>
                            </div>
                            <div class="form-buton">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-secondary">Save </button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var modal = document.getElementById('exampleModal');
                        var closeModalButton = modal.querySelector('.btn-close');
                        var saveChangesButton = modal.querySelector('.btn-primary');
                        var modalOpener = document.querySelector('.timeslot');
                        modalOpener.addEventListener('click', function() {
                            modal.style.display = 'block';
                        });
                        closeModalButton.addEventListener('click', function() {
                            modal.style.display = 'none';
                        });
                        saveChangesButton.addEventListener('click', function() {
                            var name = document.getElementById('name').value;
                            var topic = document.getElementById('topic').value;
                            // Yeni label oluşturma
                            var newLabel = document.createElement('div');
                            newLabel.className = 'custom-label';
                            newLabel.innerHTML = `<div class="label-row">Satır 1: ${name}</div><div class="label-row">Satır 2: ${topic}</div>`;
                            // Label'ı timeslot'un üzerine ekleyin
                            var labelContainer = document.getElementById('labelContainer');
                            var plussign = document.getElementById('plussign');
                            if (plussign.style.display === "block") {
                                plussign.style.display = "none"
                            } else {
                                plussign.style.display = "block"
                            }
                            labelContainer.appendChild(newLabel);
                            console.log('Changes saved!');
                            modal.style.display = 'none';
                        });
                        window.addEventListener('click', function(event) {
                            if (event.target == modal) {
                                modal.style.display = 'none';
                            }
                        });
                    });
                </script>
                <div class="main-schedular">
                    <div class="days-column">
                        <h1></h1>
                    </div>
                    <div class="grids">
                        <div class="grids-head">
                            <div class="hours"> </div>
                            <div class="hours"> 08:00 AM </div>
                            <div class="hours"> 09:00 AM </div>
                            <div class="hours"> 10:00 AM </div>
                            <div class="hours"> 11:00 AM </div>
                            <div class="hours"> 12:00 AM </div>
                            <div class="hours"> 13:00 PM </div>
                            <div class="hours"> 14:00 PM </div>
                            <div class="hours"> 15:00 PM </div>
                            <div class="hours"> 16:00 PM </div>
                            <div class="hours"> 17:00 PM </div>
                            <div class="hours"> 18:00 PM </div>
                        </div>
                        <div class="grids-row">
                            <div class="day">Pazartesi</div>
                            <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="timeslot">
                                <div id="labelContainer">
                                    <div style="display: block;" id="plussign">+</div>
                                </div>
                            </div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                        </div>
                        <div class="grids-row">
                            <div class="day">Salı</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                        </div>
                        <div class="grids-row">
                            <div class="day">Çarşamba</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                        </div>
                        <div class="grids-row">
                            <div class="day">Perşembe</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                        </div>
                        <div class="grids-row">
                            <div class="day">Cuma</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                        </div>
                        <div class="grids-row">
                            <div class="day">Cumartesi</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                            <div class="timeslot" onclick="openModal()">+</div>
                        </div>
                        <!-- Cards End Here -->
                        <!-- Add More Components Here -->
        </main>
        <!-- Main Content End Here -->
    </div>
</body>
</html>