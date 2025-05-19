<style>
    .wrap-input100 {
        position: relative;
    }
	.custom-select-container {
    position: relative;
}

.custom-search-input {
    width: 100%;
    padding: 0.75rem 0.75rem;
    border-radius: 0.375rem;
    margin-bottom: 5px;
}

.custom-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border-radius: 0.375rem;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    display: none; /* Initially hidden */
    max-height: 200px;
    overflow-y: auto;
    z-index: 1000;
    padding: 0;
    margin: 0;
    list-style-type: none;
}

.custom-dropdown li {
    padding: 0.5rem;
    cursor: pointer;
}

.custom-dropdown li:hover {
    background-color: #f0f0f0;
}

    .select2-container {
    z-index: 99999 !important; /* Higher than Bootstrap modal */
}
.select2-container--default .select2-selection--single {
    border: 0 !important;
padding-bottom: 2.2rem !important;
    padding-top: 0.4rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
	height: 26px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
    padding-top: 3rem !important;
}
</style>
<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Report</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => 'workreport.store', 'method' => 'post']) !!}

            <div class="row mb-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('report_date', 'Date*', ['class' => 'form-label']) !!}
                        {!! Form::date('report_date', date('Y-m-d'), ['class' => 'form-control', 'id' => 'txtDate', 'required']) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('client', 'Client Name*', ['class' => 'form-label']) !!}
                        {!! Form::select('client', $accounts, null, ['class' => 'form-select select2' , 'required']) !!}
                        <!-- <div class="custom-select-container">
                        
                            <input type="text" name="client1" id="clientSearch" placeholder="Search Clients..." class="form-control custom-search-input">
                            <input type="hidden" name="client" id="clientSearch1">
                         
                            <ul id="clientDropdown" class="custom-dropdown">
                                @foreach ($accounts as $value => $label)
                                <li class="client-option" data-value="{{ $value }}">{{ $label }}</li>
                                @endforeach
                            </ul>
                        </div> -->
                    </div>
                    <!-- <button type="button" id="removeSelection" style="position: absolute;top: 46px;right: 27px;" class="btn mt-2">X</button> -->
                </div>






            </div>

            <div class="row mb-3">
                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('worktype', 'Work Type*', ['class' => 'label-color py-2']) !!}

                    <div class="mt-2">
                        @foreach ($work_types as $work_type)
                        <div class="form-check form-check-inline">
                            {!! Form::radio('worktype', $work_type->id, false, ['id' => 'worktype_' . $work_type->id, 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('worktype_' . $work_type->id, $work_type->wtype, ['class' => 'label-color']) !!}
                        </div>
                        @endforeach

                        <!-- <div class="form-check form-check-inline">
                            {!! Form::radio('worktype', '0', false, ['id' => 'worktype_others', 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('worktype_others', 'Others', ['class' => 'label-color']) !!}
                        </div> -->
                    </div>
                </div>


                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <div id="type-1">
                            {!! Form::label('wipid', 'WIP List', ['class' => 'form-label']) !!}
                            {!! Form::select('wipid', $wip_list, null, ['class' => 'form-select select2', 'required']) !!}
                        </div>
                        @if (in_array(request()->session()->get('dept_id'), [1, 6, 7]))
                        <label class="form-label mt-3">(OR) Leads Name</label>
                        {!! Form::select('leadid', $leads_list, null, ['class' => 'form-select select2']) !!}
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mb-3">

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('start_time', 'Start Time*', ['class' => 'form-label']) !!}
                        {!! Form::time('start_time', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('end_time', 'End Time*', ['class' => 'form-label']) !!}
                        {!! Form::time('end_time', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('project_name', 'Project Short Description', ['class' => 'form-label']) !!}
                        {!! Form::text('project_name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('status', 'Description*', ['class' => 'form-label']) !!}
                        {!! Form::textarea('status', null, ['class' => 'form-control', 'required', 'rows' => 1]) !!}
                    </div>
                </div>
            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                    <div></div>
                    <div></div>
                    {!! Form::button('Add', ['type' => 'submit', 'class' => 'frm-btn pri-text-color', 'data-id' => '8']) !!}
                    <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">Cancel</button>
                </div>
            </div>
            <br>

            {!! Form::close() !!}


        </div>
    </div>
    <!--/.Content-->
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({
        dropdownParent: $('.customer_modal'), // Ensures dropdown stays inside the modal
        width: '100%' // Makes the select box full width
    });
});

</script>

<script>
    $(document).ready(function() {
        var $clientSearch = $('#clientSearch');
        var $clientDropdown = $('#clientDropdown');
        var $removeSelection = $('#removeSelection');

        // Show dropdown when input is focused
        $clientSearch.on('focus', function() {
            $clientDropdown.show(); // Show the dropdown
        });

        // Hide dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.custom-select-container').length) {
                $clientDropdown.hide(); // Hide the dropdown if clicked outside
            }
        });

        // Filter options based on search input
        $clientSearch.on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            if (searchTerm === '') {
                $clientDropdown.show(); // Show all options if input is empty
            } else {
                $clientDropdown.show(); // Show dropdown if input is not empty
                $clientDropdown.find('.client-option').each(function() {
                    var text = $(this).text().toLowerCase();
                    if (text.includes(searchTerm)) {
                        $(this).show(); // Show matching options
                    } else {
                        $(this).hide(); // Hide non-matching options
                    }
                });
            }
        });

        // Select an option from the dropdown and append to input
        $clientDropdown.on('click', '.client-option', function() {
            var selectedText = $(this).text();
            var selectedValue = $(this).data('value');

            // Append the selected value to the input
            $clientSearch.val(selectedText);
            $('#clientSearch1').val($(this).data('value'));
            // Optionally, you can do something with selectedValue (e.g., store in a hidden input)

            // Hide the dropdown after selection
            $clientDropdown.hide();
        });

        // Remove selected value or reset dropdown when "X" button is clicked
        $removeSelection.click(function() {
            $clientSearch.val(''); // Clear the search input
            $clientDropdown.find('.client-option').show(); // Show all options in the dropdown
            $clientDropdown.show(); // Ensure dropdown is visible
        });

        // If input is empty, show all options
        $clientSearch.on('input', function() {
            if ($clientSearch.val() === '') {
                $clientDropdown.find('.client-option').show(); // Show all options if input is empty
                $clientDropdown.show(); // Show the dropdown
            }
        });
    });

    $(function() {
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        //  alert(maxDate);
        $('#txtDate').attr('max', maxDate);
        var yesterday1 = new Date(new Date().setDate(new Date().getDate() - 120));
        var month = yesterday1.getMonth() + 1;
        var day = yesterday1.getDate();
        var year = yesterday1.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#txtDate').attr('min', maxDate);

    });

    $(document).ready(function() {
        // $("div div").hide();

        $("#type-1").hide();
        $("input[type='radio']").click(function() {
            var test = $(this).val();
            if ($(this).val() == '1') {
                $("#type-" + test).show();
            } else {
                $("#type-1").hide();
            }
            //alert($(this).val());
            //$("div div").hide();

        });
    });
</script>