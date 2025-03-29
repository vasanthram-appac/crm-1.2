@extends('layouts/app')

@section('title','User Dashboard')

@section('css')
<style>
    .odd {
        background-color: #0515263d !important;
    }

    .buttons-csv {
        background-color: #01152b !important;
        color: #fff !important;
    }

    .buttons-excel {
        background-color: #01152b !important;
        color: #fff !important;
    }

    .buttons-collection {
        background-color: #01152b !important;
        color: #fff !important;
    }
</style>
@endsection

@section('content')


<div class="row m-0 appac_hide">
<div class="profile my-3 col-12 col-lg-12 col-xl-12 col-xxl-12">
        <div class="profile-head">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 ">
    <div class="row  col-wrap p-0">
   
        <div class="col-lg-12 col-xl-12 col-xxl-6 pr-20 h-100  p-0 u-dash">
        <a class="stretched-link" href="profile"></a>
        <div class="bio  rounded-30 bg-white h-100  client-li  profile-div">
     

            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
            </div>

            <div class="row m-0 justify-content-between profile-col align-items-center">
  <div class="col-lg-4 col-xl-3 col-xxl-4">

        
             <div class="pro-img">
            
               
             <img class="w-100" src="{{ request()->session()->has('profilephoto') && request()->session()->get('profilephoto') ? asset('uploadphoto/' . request()->session()->get('profilephoto'))  : asset('asset/image/avatar/' . request()->session()->get('avatarphoto').'.png') }}" alt="{{request()->session()->get('fname')}}">


                </div>
                
 
                <div class="ud">
                    <h4 class="u-name">{{$user->fname}} {{$user->lname}}</h4>
</div>
                <div class="ud">
                    <p class='u-mail'>{{$user->empid}}</p>
                </div>

</div>
<div class="col-lg-8 col-xl-8 col-xxl-8">
<!-- <div class="d-flex justify-content-end mb-2"></div> -->
    <div class="d-grid-2 profile-val">
    <div class=""><p class="label">Role</p><p class=val>{{$profile->designation}}</p></div>
    <div class=""><p class="label">Department</p><p class=val>{{$profile->department}}</p></div>
    <div class=""><p class="label">Birthday</p><p class=val>{{$profile->dob}}</p></div>
    <div class=""><p class="label">Blood Group</p><p class=val>{{$profile->bloodgroup}}</p></div>
    <div class=""><p class="label">Phone no </p><p class=val>{{$user->mno}}</p></div>
    <div class=""><p class="label">Personal Mail</p><p class=val>{{$profile->personalemailid}}</p></div>
</div>
</div>




            </div>
            </div>
            
</div>
<div class="col-lg-6 col-xl-6 col-xxl-6">
<div class="bio  rounded-30 bg-white h-100  admin report-d  client-li  profile-div">
    <div class="widget-body">
    <h5 class="d-flex task flex-wrap gap-1 mb-1 justify-content-between align-items-center  tsak hed">
    Daily Report<span>
    @if ($reportactive > 0)
        <p style="padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #38A800 !important; background-color: #F6FFF1;font-size:14px;font-weight:400;">
        {{ $reportactive }}   Active
        </p>
    @else
       
        <p style="padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #F41B1B !important; background-color: #FFF0F0;font-size:14px;font-weight:400;">
            0 Inactive
        </p>
    @endif</span>
</h5>
<div class="row align-items-center my-3">
<div class="piechart-leads col-12 col-md-6 col-lg-4 align-content-center h-100 p-0">
   <div>
   <h5><span class="bh">{{$totals['total']['hours']}}</span>  Hr  <span class="bh">{{$totals['total']['mins']}}</span>  mins</h5>
   </div> 
</div>
<div class="piechart-leads col-12 col-md-6 col-lg-8">

@php
    // Define color mapping for each type
    $typeColors = [
       
        'WIP' => '#3e5b82',     // Blue
        'AMC' => '#579bf4a3',     // Orange
        'SEO' => '#6a8bb3',     // Red
        'POST' => '#3e5b82',    // Purple
        'S Post' => '#01377e',  // Indigo
		 'Others' => '#2f416a',  // Green
    ];

    // Remove 'total' from the $totals array if it exists
    $filteredTotals = array_filter($totals, function($key) {
        return $key !== 'total';
    }, ARRAY_FILTER_USE_KEY);
@endphp

<div class="progress-bars report row-gap-1">
    @foreach($filteredTotals as $total)
        @php
            // Calculate progress percentage (avoid division by zero)
            $totalHours = $totals['total']['hours'] * 60 + $totals['total']['mins'];
            $currentHours = $total['hours'] * 60 + $total['mins'];
            $progress = $totalHours > 0 ? round(($currentHours / $totalHours) * 100, 2) : 0;

            // Get the color for the current type
            $fillColor = $typeColors[$total['type']] ?? '#000'; // Default to black if type not found
        @endphp

        <div style="margin-bottom: 10px;" class="">
            <div class="p-0">
                <h5 class="m-0">{{ $total['type'] }}</h5>
                {{ $total['hours'] }} Hrs 
                {{ $total['mins'] }} Mins
                -  <span class="pg-clr">{{ $progress }}%</span>
            </div>
            <div style="background: #f1f1f1; padding: 0px; border-radius: 5px; overflow: hidden; height: 10px; width: 100%; margin-top: 5px;">
                <div style="width: {{ $progress }}%; background: {{ $fillColor }}; height: 100%; padding: 5px 15px; color: white; display: flex; justify-content: center; align-items: center; font-size: 11px;">
                   
                </div>
            </div>
        </div>
    @endforeach
</div>

</div>

                    
</div>
</div>

</div>
    
</div>





     
    


     

   

    



<!-- <div class="col-lg-6 col-xl-6 col-xxl-3 dash-pie-chart">
<div class="bio  rounded-30 bg-white h-100   client-li   piechart-leads profile-div">
<div class="g-data ps-3"><a href="/accounts">
              
                    <h3 class="text-center">Work Hours</h3>
        
                
</a>
            </div>
    </div>
</div> -->
<div class="col-lg-6 col-xl-6 col-xxl-2 dash-pie-chart">

<div class="bio  rounded-30 w-100  piechart-leads "><a href="taskview">
<h5 class="d-flex task flex-wrap gap-1 justify-content-between  align-items-end task hed">Tasks<span style="font-size:16px;font-weight:400;">{{date('Y')}}</span></h5>
               <div class="h-100 align-content-center  mb-3">

                   <div class="svg-d">
                        

                    
<svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="50" height="50"><defs><image  width="100" height="100" id="img1" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAAAXNSR0IB2cksfwAAAANQTFRF////p8QbyAAAABhJREFUeJxjZEAGjKO8Ud4ob5Q3yqMxDwAZswBlkgbYQgAAAABJRU5ErkJggg=="/><image  width="79" height="92" id="img2" href="data:image/png;base64,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"/></defs><style></style><use style="display:none" href="#img1" x="0" y="0"/><use  href="#img2" x="11" y="4"/></svg>

                    </div>
                    <h3 class="text-center ">Total Tasks</h3>
                     <h4>      {{ $task }}</h4>
                </div></div> </a>
            </div>

      

<div class="col-lg-6 col-xl-6 col-xxl-4 dash-pie-chart">
<div class="bio  rounded-30 bg-white h-100  w-100  piechart-leads  client-li  profile-div"><a href='workreport'>
    <div class="widget-body p-0  h-100">
        <h5 class="d-flex flex-wrap gap-1 justify-content-between  align-items-end task  hed">Reports<span style="font-size:16px;font-weight:400;">{{date('M').' '.date('Y')}}</span></h5>
        <div class="h-100 d-flex justify-content-around">

       
      
        <div class="col-6 col-lg-6 p-0  align-content-center">
            <div class="svg-d">
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="50" height="50"><defs><image  width="100" height="100" id="img1" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAAAXNSR0IB2cksfwAAAANQTFRF////p8QbyAAAABhJREFUeJxjZEAGjKO8Ud4ob5Q3yqMxDwAZswBlkgbYQgAAAABJRU5ErkJggg=="/><image  width="87" height="87" id="img2" href="data:image/png;base64,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"/></defs><style></style><use style="display:none" href="#img1" x="0" y="0"/><use  href="#img2" x="6" y="6"/></svg>
            </div>
          
         
           <h3 class="text-center">Total</h3>
            <h4 class="task">{{$totalhours[0]->totalcount}}</h4>
            </div>
           
            
          
            
            <div class="col-6 col-lg-6 p-0   align-content-center">
                <div class="svg-d">
                <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="60px" viewBox="0 0 24 24"><path fill="#999797" fill-rule="evenodd" d="m12.6 11.503l3.891 3.891l-.848.849L11.4 12V6h1.2zM12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-1.2a8.8 8.8 0 1 0 0-17.6a8.8 8.8 0 0 0 0 17.6"/></svg>

                </div>
          
   
            <h3 class="text-center">Hours</h3>
            <h4 class="task">{{$hours}} : {{$remainingMinutes}}</h4>
            </div>
       
           

           
     
        </div>
        </div></a>
    </div>
</div>

<div class="col-lg-6 col-xl-6 col-xxl-6 dash-pie-chart">
<div class="bio  rounded-30 bg-white h-100  client-li  profile-div w-100  piechart-leads"><a href="/applyleave">
    <div class="widget-body p-0">
    <h5 class="d-flex flex-wrap gap-1 justify-content-between align-items-end task  hed">Leaves<span style="font-size:16px;font-weight:400;">12</span></h5>
    <div class="row">
        <div class="col-lg-6">
        <div class="d-flex p-0 ad row my-3  row-gap-2 h-100  leave-report align-items-center">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 p-0  align-content-center">
            <h4  class=" text-center">{{ $totalLeavesTaken }}</h3>    
            <h5 class="text-center">Taken</h5>
          
            </div>
            <div class="col-6  col-sm-6 col-md-6 col-lg-6 p-0  align-content-center">
            <h4  class=" text-center">{{$remainingCasualLeaves }}</h3>
            <h5 class="text-center">Casual</h5>
            </div>

            <div class="col-6  col-sm-6 col-md-6 col-lg-6 p-0  align-content-center">
            <h4 class=" text-center">{{$remainingSickLeaves }}</h3>
            <h5 class="text-center">Sick</h5>
            </div>

            <div class="col-6  col-sm-6 col-md-6 col-lg-6 p-0  align-content-center">
            <h4  class=" text-center">{{$remainingCasualLeaves +  $remainingSickLeaves }}</h3>
            <h5 class="text-center">Remaining</h5>
            </div>
            </div>
        </div>
        <div class="col-lg-6 align-content-center">
        <div class=" h-auto client-li p-3 mt-2 round-br">
    <h6 class="task">Note:</h6>
        <div class="bio p-0  h-auto  client-li ">
                
                <p class="task">1. Remaining Sick Leaves: {{ $remainingCasualLeaves }}</p>
                <p class="task">2. Remaining Casual Leaves:{{ $remainingSickLeaves }}</p>
                </div>
</div>
        </div>
   
    </div>
   

      
 

        </div></a>
    </div>
    </div>

<!-- 
    <div class="col-lg-6 col-xl-6 col-xxl-3 dash-pie-chart" style="position:relative;">
      <div class="bio  rounded-30 bg-white  client-li h-100 profile-div w-100  piechart-leads"><a href="/celebration" class="stretched-link">

      <div class="row  g-2 p-0">
      <div class="col-lg-12 p-0 m-0">
<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=Asia%2FKolkata&showPrint=0&showTitle=0&src=c3VyeWEuYXBwYWNAZ21haWwuY29t&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4uaW5kaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%23D81B60&color=%230B8043" style="border-width:0" width="100%" min-height="250px" height="300px" frameborder="0" scrolling="no"></iframe>
</div>
                    </div>
</a>
                </div>
               

</div> -->

</div>


  
</div>




      


    <div class="modal fade" id="errorModal" role="dialog" style="">
        <div class="modal-dialog cascading-modal float-end me-3" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->

                <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="title ps-3 pt-1">Errors</h4>
                <!--Body-->
                <div class="error-modal px-2 pb-1">

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
</div>


@endsection


@section('script')
<script>
    document.querySelectorAll('.ad .ad-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Remove 'active' class from both buttons
        document.querySelectorAll('.ad .ad-btn').forEach(btn => btn.classList.remove('active'));

        // Add 'active' class to the clicked button
        this.classList.add('active');

        // Toggle the visibility of the sections based on the button clicked
        if (this.classList.contains('pre')) {
            document.querySelector('.pre.pt-3').style.display = 'block';
            document.querySelector('.per.pt-3').style.display = 'none';
        } else if(this.classList.contains('per')) {
            document.querySelector('.per.pt-3').style.display = 'block';
            document.querySelector('.pre.pt-3').style.display = 'none';
        }
        else{
            document.querySelector('.per.pt-3').style.display = 'none';
            document.querySelector('.pre.pt-3').style.display = 'none';
        }
    });
});

</script>
<script>
    document.querySelectorAll('.ot .ad-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Remove 'active' class from both buttons
        document.querySelectorAll('.ot .ad-btn').forEach(btn => btn.classList.remove('active'));

        // Add 'active' class to the clicked button
        this.classList.add('active');

        // Toggle the visibility of the sections based on the button clicked
        if (this.classList.contains('com')) {
            document.querySelector('.com.pt-3').style.display = 'flex';
            document.querySelector('.ban.pt-3').style.display = 'none';
            document.querySelector('.pro.pt-3').style.display = 'none';
            document.querySelector('.upl.pt-3').style.display = 'none';
        } else if(this.classList.contains('ban')) {
            document.querySelector('.ban.pt-3').style.display = 'flex';
            document.querySelector('.com.pt-3').style.display = 'none';
            document.querySelector('.pro.pt-3').style.display = 'none';
            document.querySelector('.upl.pt-3').style.display = 'none';
        }
        else if(this.classList.contains('pro')) {
            document.querySelector('.ban.pt-3').style.display = 'none';
            document.querySelector('.com.pt-3').style.display = 'none';
            document.querySelector('.pro.pt-3').style.display = 'flex';
            document.querySelector('.upl.pt-3').style.display = 'none';
        }
        else {
            document.querySelector('.ban.pt-3').style.display = 'none';
            document.querySelector('.com.pt-3').style.display = 'none';
            document.querySelector('.pro.pt-3').style.display = 'none';
            document.querySelector('.upl.pt-3').style.display = 'flex';
        }
    });
});

</script>

<script>
    $(document).ready(function() {



        $(document).on('submit', 'form', function(e) {
            e.preventDefault();

            var form = $(this);
            var container = form.closest('.modal');

            var formData = new FormData(form[0]); // Create a FormData object

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    $('#session_message').css('display', 'block');
                    $('#session_message').text(response.message);

                    setTimeout(function() {
                        $('#session_message').hide();
                        window.location.reload();
                    }, 2000);
                    if (typeof response.reload !== 'undefined') {
                        $('.appac_show').hide();
                        $('.appac_hide').show();

                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $('.customer_modal').modal('hide');
                        $('.appac_show').hide();
                        $('.appac_hide').show();
                        cat_table.ajax.reload(null, false); // Prevents table state reset on reload
                    }



                },
                error: function(xhr) {
                    // Handle other types of errors (e.g., server error)

                    var errors = xhr.responseJSON.errors;
                    var errorString = '';

                    for (var key in errors) {
                        errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                    }

                    // Show errors in a Bootstrap modal (assuming you are using Bootstrap)
                    $('#errorModal .error-modal').html(errorString);
                    $('#errorModal').modal('show');
                }
            });
        });





    });
</script>
@endsection