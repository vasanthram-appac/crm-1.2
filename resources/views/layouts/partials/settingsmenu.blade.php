  @php
  $route = explode('.', Route::currentRouteName())[0];
  @endphp

     

        <ul class="nav nav-tabs  my-4  justify-content-end  mb-0  ">
            <li class="nav-item">
                <a class="nav-link @if($route=='sociallogin') active @endif"  href="/sociallogin"><b>Social Login</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='questionnaire') active @endif"  href="/questionnaire"><b>Questionnaire</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='documentupload') active @endif"  href="/documentupload"><b>Document Upload</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='googlesheet') active @endif"  href="/googlesheet"><b>Google Sheet</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='backup') active @endif"  href="/backup"><b>Backup</b></a>
            </li>
           
        </ul>