  @php
  $route = explode('.', Route::currentRouteName())[0];
  @endphp

  <ul class="nav nav-tabs my-4 justify-content-end mb-0">
            @if(request()->session()->get('role') != 'user')
            <li class="nav-item">
                <a class="nav-link @if($route=='task') active @endif com ad-btn" href="/task"><b>Task</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='workorderview') active @endif" href="/workorderview"><b>Work Order</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='wip') active @endif" href="/wip"><b>WIP</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='promotion') active @endif" href="/promotion"><b>Promotion</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='design') active @endif" href="/design"><b>Design</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='content') active @endif" href="/content"><b>Content</b></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link @if($route=='taskview') active @endif" href="/taskview"><b>Task View</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='workorder') active @endif" href="/workorder"><b>Work Order View</b></a>
            </li>
        </ul>