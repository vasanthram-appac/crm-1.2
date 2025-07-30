  @php
  $route = explode('.', Route::currentRouteName())[0];
  @endphp
  <ul class="nav nav-tabs  my-4  justify-content-end  mb-0  ">
      @if(request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM098' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8')
      <li class="nav-item">
          <a class="nav-link @if($route=='purchaseorder') active @endif" href="/purchaseorder"><b>Purchase Order</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'vendorlist') active @endif" href="/vendorlist"><b>Vendor List</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'paymententry') active @endif" href="/paymententry"><b>Receipt Entry</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'inventary') active @endif" href="/inventary"><b>Asset</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'user') active @endif" href="/user"><b>Employee</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'fiscal') active @endif" href="/fiscal"><b>Fiscal</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'salary') active @endif" href="/salary"><b>Salary</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'payslip') active @endif" href="/payslip"><b>Payslip</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'esi') active @endif" href="/esi"><b>ESI</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($route == 'vendorpaymententry') active @endif" href="/vendorpaymententry"><b>Payment Entry</b></a>
      </li>
      @endif
  </ul>  