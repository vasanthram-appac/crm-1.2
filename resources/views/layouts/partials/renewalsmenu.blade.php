  @php
  $route = explode('.', Route::currentRouteName())[0];
  @endphp

          <ul class="nav nav-tabs  my-4  justify-content-end  mb-0  ">
            <li class="nav-item">
                <a class="nav-link @if($route=='hosting') active @endif" href="/hosting"><b>Hosting</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='domain') active @endif" href="/domain"><b>Domain</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='email') active @endif" href="/email"><b>email</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='ssl') active @endif" href="/ssl"><b>SSL</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='dmcontract') active @endif" href="/dmcontract"><b>DM Contract</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='plans') active @endif" href="/plans"><b>Plans</b></a>
            </li>
        </ul>