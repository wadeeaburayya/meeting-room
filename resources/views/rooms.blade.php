<!DOCTYPE html>
<html lang="en">

<head>s
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0cd5175097.js" crossorigin="anonymous"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />

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
                document.addEventListener('DOMContentLoaded', function () {
                    // Modal ve butonu seç
                    var modal = document.getElementById("userModal");
                    var btn = document.getElementById("addNewUserBtn");
                    var span = document.getElementsByClassName("close")[0];

                    // Butona tıkladığında modalı aç
                    btn.onclick = function () {
                        modal.style.display = "block";
                    }

                    // Çarpıya (x) tıkladığında modalı kapat
                    span.onclick = function () {
                        modal.style.display = "none";
                    }

                    // Kullanıcı modal dışına tıklarsa kapat
                    window.onclick = function (event) {
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
                                <td >Marketing Meeting Room</td>
                                <td colspan="3"> 1</td>
                             
                                
                                <td>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">Dropdown button</button>
                                        <ul class="dropdown-menu">
                                          <li><a href="#">Edit</a></li>
                                          <li><a href="#">Delete</a></li>
                                        </ul>
                                      </div>
                                      
                            </tr>
                            <tr>
                                <td> 2</td>
                                <td> Marketing Meeting Room</td>
                                <td colspan="3"> 2</td>
                               
                                
                                <td>
                                    <div class="dropdown">
                                        <button class="dropdown-btn">Options</button>
                                        <div class="dropdown-content">
                                            <a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </div>
                                    </div>
                            </tr>
                        </tr>
                        <tr>
                            <td> 3</td>
                            <td> Marketing Meeting Room</td>
                            <td colspan="3"> 3</td>
                           
                            
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-btn">Options</button>
                                    <div class="dropdown-content">
                                        <a href="#">Edit</a>
                                        <a href="#">Delete</a>
                                    </div>
                                </div>
                        </tr>
                           </tr>
                            <tr>
                                <td> 4</td>
                                <td> Marketing Meeting Room</td>
                                <td colspan="3"> 4</td>
                               
                                
                                <td>
                                    <div class="dropdown">
                                        <button class="dropdown-btn">Options</button>
                                        <div class="dropdown-content">
                                            <a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </div>
                                    </div>
                            </tr>
                        </tr>
                        <tr>
                            <td> 5</td>
                            <td> Marketing Meeting Room</td>
                            <td colspan="3"> 5</td>
                           
                            
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-btn">Options</button>
                                    <div class="dropdown-content">
                                        <a href="#">Edit</a>
                                        <a href="#">Delete</a>
                                    </div>
                                </div>
                        </tr>
                    </tr>
                    <tr>
                        <td> 6</td>
                        <td> Marketing Meeting Room</td>
                        <td colspan="3"> 6</td>
                       
                        
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-btn">Options</button>
                                <div class="dropdown-content">
                                    <a href="#">Edit</a>
                                    <a href="#">Delete</a>
                                </div>
                            </div>
                    </tr>
                    </table>
                </section>
            </main>
    </body>

</html>