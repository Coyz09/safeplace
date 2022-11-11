@section('navbar')


<nav>
    <div class="sidebar-top">
      <img src="./Images/Logo.png" class="logo" alt="">
    </div>

    <div class="Safeplace">
      <h3>SafePlace</h3>
    </div>

    <div class="sidebar-links">
      <ul>


        <li class="tooltip-element">
          <a href="/dashboard">
            <div class="icon">
              <i class='bx bx-tachometer'></i>
              <i class='bx bxs-tachometer'></i>
            </div>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="tooltip-element">
          <a href="/verifieduser">
            <div class="icon">
              <i class='bx bxs-user-check'></i>
              <i class='bx bxs-user-check'></i>
            </div>
            <span>Verified Users</span>
          </a>
        </li>

        <li class="tooltip-element">
          <a href="/unverifieduser">
            <div class="icon">
              <i class='bx bxs-user-x' ></i>
              <i class='bx bxs-user-x' ></i>
            </div>
            <span>Unverified Users</span>
          </a>
        </li>

        <li class="tooltip-element">
          <a href="/barangay">
            <div class="icon">
              <i class='bx bxs-institution'></i>
              <i class='bx bxs-institution'></i>
            </div>
            <span>Barangays</span>
          </a>
        </li>

        <li class="tooltip-element">
          <a href="/hospital">
            <div class="icon">
              <i class='bx bxs-clinic'></i>
              <i class='bx bxs-clinic'></i>
            </div>
            <span>Hospitals</span>
          </a>
        </li>

        <li class="tooltip-element">
          <a href="/policestation">
            <div class="icon">
              <i class='bx bxs-bank' ></i>
              <i class='bx bxs-bank' ></i>
            </div>
            <span>Police Stations</span>
          </a>
        </li>

       
       <!-- <li class="tooltip-element">
         <a href="/user">
           <div class="icon">
             <i class='bx bxs-user' ></i>
             <i class='bx bxs-user' ></i>
           </div>
           <span>Users</span>
         </a>
       </li> -->
       
     @if(auth()->guard('web')->user()->role == 'superadmin')
       
        <li class="tooltip-element">
          <a href="/user">
            <div class="icon">
              <i class='bx bxs-user' ></i>
              <i class='bx bxs-user' ></i>
            </div>
            <span>Users</span>
          </a>
        </li>

        @elseif(auth()->guard('web')->user()->role == 'admin')
            <!-- <div class="icon">
             
            </div>         -->
         @endif

      </ul>


    <div class="sidebar-footer">
      <a href="#" class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <div class="admin-profile hide">
          <img src="./img/face-1.png" alt="">
          <div class="admin-info">
            <h3>John Doe</h3>
            <h5>Admin</h5>
          </div>
        </div>
        <a href="{{ route('user.logout') }}" class="log-out">
          <i class='text-light bx bx-log-out'></i>
        </a>
      </div>
      <div class="tooltip">
        <span class="show">John Doe</span>
        <span>Logout</span>
        <a href="{{ route('user.logout') }}" class="log-out">
          <i class='text-light bx bx-log-out'></i>
        </a>
      </div>
    </div>
  </nav>
