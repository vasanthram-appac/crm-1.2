  @php
  $route = explode('.', Route::currentRouteName())[0];
  @endphp

   <ul class="nav nav-tabs my-4 justify-content-end mb-0">
            <li class="nav-item">
                <a class="nav-link @if($route=='workreport') active @endif com ad-btn" href="/workreport"><b>Work Report</b></a>
            </li>
            @if(request()->session()->get('role') != 'user')
            <li class="nav-item">
                <a class="nav-link @if($route=='employeereport') active @endif" href="/employeereport"><b>Employee Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='monthlyreport') active @endif" href="/monthlyreport"><b>Monthly Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='enquiryreport') active @endif" href="/enquiryreport"><b>Enquiry Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='leadhistory') active @endif" href="/leadhistory"><b>Account History</b></a>
            </li>
           
            @endif        
        </ul>