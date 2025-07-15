@extends('layouts.app')

@section('title', 'Fiscal')

@section('css')
<style>
    .odd {
        background-color: #0515263d !important;
    }

    .buttons-csv,
    .buttons-excel,
    .buttons-collection {
        background-color: #01152b !important;
        color: #fff !important;
    }
    .custom-tooltip {
    position: absolute;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    pointer-events: none; /* Prevent interfering with mouse events */
    transform: translate(-50%, 0);
}
#piechart_3d > div:first-child {
  height:600px;
}
/* #piechart_3d >  div:first-child  div {
  top: 100px;
} */
.google-visualization-tooltip{height:auto !important;font-size:22px !important;}

#piechart_3d svg {
  transform:scale(1.3);
}
.select2-container{width:100% !important;}

@media(max-width:1100px){
    #piechart_3d > div:first-child div {
        left: 0% !important;
    }
    #piechart_3d > div:first-child {
    height: 470px;
}#piechart_3d >  div:first-child  div {
  top: 20px;
}
.bio.fiscal-d{padding-bottom:0px !important}
.select2-container{width:250px !important;}

#piechart_3d > div:first-child {
  height:400px;
}
}

@media(max-width:600px){
    #piechart_3d > div:first-child div {
        left: 4% !important;
    }
}

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

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="appac_show"></div>
<div class="row m-0 appac_hide  pb-5">
<div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
        <a id="preback" href="javascript:history.back()">Back</a>
        <ul class="nav nav-tabs my-4 justify-content-end mb-0">
            @if(request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8')
            <li class="nav-item">
            <a class="nav-link" href="/purchaseorder"><b>Purchase Order</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/vendorlist"><b>Vendor List</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/paymententry"><b>Receipt Entry</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/asset_library"><b>Asset Library</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user"><b>Employee</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/fiscal"><b>Fiscal</b></a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="/salary"><b>Salary</b></a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="/payslip"><b>Payslip</b></a>
            </li>
            @endif      
        </ul>
    </div>
    <div class="col-12">
  
        <div class="row  col-wrap  bg-white gap-0 rounded-30">
      
            <div class=" col-lg-12 col-xl-4 col-md-12 col-sm-4">
                     <div class="bio fiscal-d  h-100  client-li  profile-div align-content-center ps-5">
                        <h1 class="ch-2">History Total Counts</h1>
                   
                    <div class=" row" id="firstRow">
                        <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;"></div>
                        <div class="widget-body">
                            <h3>Year Range</h3>
                            <div class=" w-100  no-wrap align-items-center p-0  ">
                                <div class="control-group  p-0 my-2">
                                {!! Form::label('reportrange', 'Select Date Range *', ['class' => 'label-color control-label ']) !!}
                                @php
                                $currentYear = date('Y'); // Get the current year
                                $startYear = 2018; // Define the starting year
                                $endYear = $currentYear; // Include the next range automatically
                                @endphp
                            </div>

                                <select name="yearrange" class="form-control select2">
                                    @for ($year = $startYear; $year <= $endYear; $year++)
                                        <option value="{{ $year }}-{{ $year + 1 }}">
                                        {{ $year }}-{{ $year + 1 }}
                                        </option>
                                        @endfor
                                </select>

                            </div>

                          
                                <label class="err_lbl"></label>
                                <div class="btn-g2  my-3  m-0  p-0">
                                    <button type="submit" name="sub_form" class="frm-btn pri-text-color" onclick="year()"> Submit </button>
                                </div>
                   
                          
                        </div>
                    </div>
                    <h3 id="fromdate"></h3>
                    <h3 id="count"></h3>
                    <h3 id="totalamount"></h3>
                </div>
            </div>
          
 


            <div class="col-lg-12 col-xl-8 col-md-12 col-sm-8">
                    <div class="table-responsive p-0" style="height:100%;">
                        <div id="piechart_3d" style="width: 100%; height:100%;min-height:365px;max-height:530px !important;text-align:center;margin:auto;transform: scale(0.6);" class="p-0"></div>
                    </div>
                </div>
            </div>
          
    </div>


  
<div class="profile col-12 my-2 col-lg-12 col-xl-12 d-flex flex-wrap justify-content-between align-items-center gap-2 col-xxl-12  pt-5">
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

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $(document).ready(function() {
        // Apply Select2 to elements with the "select2" class
        $('.select2').select2({
            placeholder: "Select a Website", // Placeholder text
            allowClear: true // Option to clear the selection
        });
    });
</script>

<script>

    function year() {

         var date = $('select[name="yearrange"]').val();
        if (!date) {
            date = "2018-2019";
        }
        // alert(id);
        $.ajax({
            url: "{{ action([App\Http\Controllers\Fiscal::class, 'index']) }}",
            type: 'GET',
            data: {
                date: date
            },
            success: function(response) {
                $('#totalamount').html('Total Amount: RS. ' + response.total);

                $('#fromdate').html('Fiscal ' + response.fromdate + ' / ' + response.todate);

                $('#count').html('Number of Clients: ' + response.count);

                group(response.Rtotal);
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorString = '';

                for (var key in errors) {
                    errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                }

                $('#errorModal .error-modal').html(errorString);
                $('#errorModal').modal('show');
            }
        });
    }

    $(document).ready(function() {
         year();
        group(@json($Rtotal));

    });

    function group(totalr){
      
        const container = document.getElementById("piechart_3d");
        if (!container) {
            console.error("Container #piechart_3d not found");
            return;
        }

        const data = new google.visualization.DataTable();
        data.addColumn("string", "Company Name");
        data.addColumn("number", "Total Score");
        data.addColumn({
            type: "string",
            role: "tooltip",
            p: {
                html: true
            }
        });

        // Add rows of data to the table
        totalr.forEach(item => {
            if (item.company_name && item.total_score !== undefined) {
                data.addRow([
                    item.company_name,
                    item.total_score,
                    `${item.company_name}: ${item.total_score}`
                ]);
            } else {
                console.warn("Skipping invalid data:", item);
            }
        });

        const options = {
            is3D: true,
            sliceVisibilityThreshold: 0,
            animation: {
                duration: 1000,
                easing: "out"
            },
            colors: ["#708094", "#01377E", "B9B7C8", "#5784C1", "#2F416A"],
            tooltip: {
                trigger:onload,
                isHtml: true
            },
            pieSliceText: "label",
            legend: {
                position: "top",
                alignment: "center",
                textStyle: {
                    fontSize: 12
                }
            },
            chartArea: {
                width: "200%",
                height: "200%"
            },
        };

        const chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);



 
    }

    // Google Chart
    google.charts.load('current', {
        packages: ['corechart']
    });
</script>
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