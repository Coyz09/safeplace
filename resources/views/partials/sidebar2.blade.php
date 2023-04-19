@section('navbar')

<style>
       
        .badge {
            position: relative;
            top: -20px;
            left: 5px;
            border: 1px solid black;
            border-radius: 50%;
        }

</style>

<nav style = "position: fixed; left: 20px;">
    <div class="sidebar-top">
      <img  href="{{ asset('Images/Logo.png') }}" src="{{ asset('Images/Logo.png') }}" class="logo" alt="">
    </div>

    <div class="Safeplace">
      <h3>SafePlace</h3>
    </div>

    <div class="sidebar-links">
      <ul>
      @if(auth()->guard('web')->user()->role == 'police_station')

      <li class="tooltip-element">
          <a href="/police_notifications">
            <div class="icon">
        
            <i class='bx bxs-bell'> </i>
            <i class='bx bxs-bell'> </i>
            
            </div>
            <!-- <button class="dowload_here"></button> -->
            <span>Notifications</span><span class="badge badge-pill badge-danger" style = "font-size:20px; margin-left: 8px;">{{auth()->guard('web')->user()->notifications()->where('status', '=','unread')->count()}}</span>
            
          </a>
        </li>
      
      <li class="tooltip-element">
          <a href="/policedashboard">
            <div class="icon">
            <!-- <i class='bx bxs-bar-chart-alt-2'></i>
            <i class='bx bxs-bar-chart-alt-2'></i> -->

            <i class='bx bxs-report'></i>
            <i class='bx bxs-report'></i>
            </div>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="tooltip-element">
          <a href="/policestation_user">
            <div class="icon">

            <i class='bx bxs-notepad'></i>
            <i class='bx bxs-notepad'></i>
            </div>
            <span>Police Substation Reports</span>
          </a>
        </li>
        @endif

        @if(auth()->guard('web')->user()->role == 'barangay')

        <li class="tooltip-element">
          <a href="/barangay_notifications">
            <div class="icon">
            <i class='bx bxs-bell'></i>
            <i class='bx bxs-bell'></i>

            </div>
  
                <span>Notifications</span><span class="badge badge-pill badge-danger" style = "font-size:20px; ">{{auth()->guard('web')->user()->notifications()->where('status', '=','unread')->count()}}</span>
      
          </a>
        </li>
      
        <li class="tooltip-element">
          <a href="/barangaydashboard">
            <div class="icon">
            <!-- <i class='bx bxs-bar-chart-alt-2'></i>
            <i class='bx bxs-bar-chart-alt-2'></i> -->

            
            <i class='bx bxs-report'></i>
            <i class='bx bxs-report'></i>
            </div>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="tooltip-element">
          <a href="/barangay_user">
            <div class="icon">
              <!-- <i class='bx bxs-report' ></i>
              <i class='bx bxs-report' ></i> -->

              <i class='bx bxs-notepad'></i>
            <i class='bx bxs-notepad'></i>
            </div>
            <span>Barangay Reports</span>
          </a>
        </li>
        @endif

      </ul>


    <div class="sidebar-footer">
      <a href="#" class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <div class="admin-profile hide">
          <img src="{{asset(auth()->guard('web')->user()->img)}}" height= "50" width="100" alt="">
          <div class="admin-info">
            <h3>{{auth()->guard('web')->user()->name}}</h3>
            <h5>{{auth()->guard('web')->user()->role}}</h5>
          </div>
        </div>
        <a href="{{ route('user.logout') }}" class="log-out">
          <i class='text-light bx bx-log-out'></i>
        </a>
      </div>
      <div class="tooltip">
        <span class="show">{{auth()->guard('web')->user()->name}}</span>
        <span>Logout</span>
        <a href="{{ route('user.logout') }}" class="log-out">
          <i class='text-light bx bx-log-out'></i>
        </a>
      </div>
    </div>
</nav>

