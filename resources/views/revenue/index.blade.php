@extends('layouts.app')

@section('title', 'Revenue')

@section('css')
<style>
 .progress-bar-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .progress-bar-label {
        width: 300px; /* Adjust as needed */
        margin-right: 10px;
    }
    .progress-bar-label.price{
        width:150px;
    }
    .d-blo-700{display:none;}
    .progress-bar {
        width:90%;
        margin:0px 15px;
        background-color: #ddd;
        height: 20px;
        flex-grow: 1;
        border-radius: 5px;
        overflow: hidden;
    }

    .progress-bar-inner {
        background-color:#9dceec; 
        height: 100%;
        text-align: right;
        padding-right: 5px;
        color: white;
        font-weight: bold;
        transition: width 1s ease-in-out;
        
    }



    @media(max-width:900px){
        .progress-bar-label {
    width: 250px;
    margin-right: 10px;
}

@media(max-width:700px){
    .d-non-700{display:none;}
    .d-blo-700{display:block;}
}
    }
</style>

@endsection

@section('content')

<div class="row m-0 appac_hide">
<div class="profile col-12 my-2 col-lg-12 col-xl-12 d-flex flex-wrap justify-content-between align-items-center gap-2 col-xxl-12">
        <div class="profile-head my-3">
            <h1 class="ch2 comp-name m-0">Revenue</h1>
        </div>
        <div class="controls text-center   d-flex gap-2">
        <button id="toggleSort" class="frm-btn pri-text-color  bcreate d-flex gap-2 justify-content-between">
        <span id="toggleIcon" class="arrow">&#9650;</span> Sort
    </button>
</div>
    </div>
    <div class="col-lg-12 col-sm-12 ">
    <div class="row  col-wrap p-0">
   
        <div class="col-lg-12 col-xl-12 col-xxl-12 pr-20 h-100  p-0 u-dash">
        <a class="stretched-link" href="profile"></a>
       
<div id="accountList" class="bio rounded-30 bg-white h-100 client-li profile-div">
    @php
        // Get the highest total value
        $highestAccount = collect($accounts)->sortByDesc('total')->first();
    @endphp
    @foreach ($accounts as $account)
        @php
            // Calculate percentage relative to the highest total
            $percentage = ($account->total / $highestAccount->total) * 100;
        @endphp
        <div class="progress-bar-container" data-total="{{ $account->total }}">
            <span class="progress-bar-label">{{ $account->company_name }}</span>
            <div class="progress-bar p-0">
                <div class="progress-bar-inner p-0" style="width: 0;" data-percentage="{{ $percentage }}"></div>
            </div>
            <span class="progress-bar-label price fw-bold  pl-4">Rs: {{ number_format($account->total) }}</span>
        </div>
    @endforeach
</div>

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@endsection

@section('script')
<script>

document.addEventListener('DOMContentLoaded', () => {
    const accountList = document.getElementById('accountList');
    const toggleSort = document.getElementById('toggleSort');
    const toggleIcon = document.getElementById('toggleIcon');

    let isAscending = true; // Default to ascending order

    const sortAccounts = () => {
        const items = Array.from(accountList.querySelectorAll('.progress-bar-container'));
        items.sort((a, b) => {
            const totalA = parseFloat(a.getAttribute('data-total'));
            const totalB = parseFloat(b.getAttribute('data-total'));
            return isAscending ? totalA - totalB : totalB - totalA;
        });
        items.forEach(item => accountList.appendChild(item));
        toggleIcon.innerHTML = isAscending ? '&#9650;' : '&#9660;'; // Toggle arrow
        isAscending = !isAscending; // Switch order for next click
    };

    toggleSort.addEventListener('click', sortAccounts);

    // Animate progress bars
    const animateProgressBars = () => {
        const progressBars = accountList.querySelectorAll('.progress-bar-inner');
        progressBars.forEach(bar => {
            const percentage = bar.getAttribute('data-percentage');
            bar.style.transition = 'width 1s ease';
            bar.style.width = `${percentage}%`;
        });
    };

    animateProgressBars();
});

</script>
@endsection