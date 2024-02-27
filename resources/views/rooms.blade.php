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
                    <h2>Create New Room</h2>
                    <form id="newUserForm">
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name"><br>
                        <label for="email">Floor:</label><br>
                        <input type="email" id="email" name="email"><br>
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
        </script>
        <main class="table" id="customers_table">
            <section class="table__header">
                <div>
                    <button type="button" id="addNewUserBtn" class="btn btn-single">Add New Room</button>
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Floor <span class="icon-arrow">&UpArrow;</span></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td>Marketing Meeting Room</td>
                            <td colspan="3"> 1</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                </table>
            </section>
        </main>
</body>
</html>