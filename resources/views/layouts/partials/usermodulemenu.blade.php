  @php
  $route = explode('.', Route::currentRouteName())[0];
  @endphp

  <ul class="nav nav-tabs my-4 justify-content-end mb-0">
      <li class="nav-item">
          <a class="nav-link @if($route=='profile') active @endif" href="/profile"><b>Profile</b></a>
      </li>
      @if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM063' || request()->session()->get('empid') == 'AM003' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8')
      <li class="nav-item">
          <a class="nav-link @if($route=='leaveapproval') active @endif" href="/leaveapproval"><b>Leave Approvel</b></a>
      </li>
      @endif
      <li class="nav-item">
          <a class="nav-link @if($route=='applyleave') active @endif" href="/applyleave"><b>Employee Leave</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route=='celebration') active @endif" href="/celebration"><b>Celebration</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route=='resignation') active @endif" href="/resignation"><b>Resignation</b></a>
      </li>
  </ul>