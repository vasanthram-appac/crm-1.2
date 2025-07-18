  @php
  $route = explode('.', Route::currentRouteName())[0];
  @endphp

        <ul class="nav nav-tabs my-4 justify-content-end mb-0">
            <li class="nav-item">
                <a class="nav-link  @if($route=='offerletter') active @endif" href="/offerletter"><b>Offer Letter</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='webproposal') active @endif" href="/webproposal"><b>Web Proposal</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='digitalproposal') active @endif" href="/digitalproposal"><b>Digital Proposal</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route=='ratecards') active @endif" href="/ratecards"><b>Rate Cards</b></a>
            </li>
        </ul>