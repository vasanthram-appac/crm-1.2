    @php
    $route = explode('.', Route::currentRouteName())[0];
    @endphp
    <ul class="nav nav-tabs  my-4  justify-content-end  mb-0  ">
        <li class="nav-item">
            <a class="nav-link @if($route=='accounts') active @endif" href="/accounts"><b>Accounts</b></a>
        </li>
        @if(request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8')
        <li class="nav-item">
            <a class="nav-link @if($route=='proforma') active @endif" href="/proforma"><b>Proforma</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($route=='invoice') active @endif" href="/invoice"><b>Invoice</b></a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link @if($route=='lead') active @endif" href="/lead"><b>Leads</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($route=='opportunity') active @endif" href="/opportunity"><b>Opportunity</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($route=='serverdetails') active @endif" href="/serverdetails"><b>Renewals</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($route=='newnbd') active @endif" href="/newnbd"><b>New NBD</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($route=='dmworks') active @endif" href="/dmworks"><b>DM Works</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($route=='required_input') active @endif" href="/required_input"><b>Required Input</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($route=='expocustomer') active @endif" href="/expocustomer"><b>Expo</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($route=='asset_library') active @endif" href="/asset_library"><b>Asset Library</b></a>
        </li>
    </ul>