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
    <img src="https://images.unsplash.com/photo-1557862921-37829c790f19?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=751&q=80" alt="person">
    <div>
        <h4>{{ auth()->user()->name }}</h4>
        @if(auth()->user()->user_role == 1)
        <small>Admin</small>
        @else
        <small>Member</small>
        @endif
    </div>
</div>