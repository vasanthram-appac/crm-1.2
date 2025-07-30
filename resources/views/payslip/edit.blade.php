<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Payslip</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($payslip, ['route' => ['payslip.update', $payslip->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('empid', 'Employee*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('empid', $emp, $payslip->empid, ['class' => 'form-select', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('monthyear', 'Month & Year*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select(
                        'monthyear',
                        collect(range(6, 0))->mapWithKeys(function ($x) {
                        $dateKey = date('m-Y', strtotime(date('Y-m') . " -$x month"));
                        $dateValue = date('M-Y', strtotime(date('Y-m') . " -$x month"));
                        return [$dateKey => $dateValue];
                        }),
                        $payslip->month_year,
                        ['class' => 'form-select', 'required' => true]
                        ) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('incentive', 'Incentive', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('incentive', $payslip->specl_amt, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('lop', 'Lop', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('lop', $payslip->lop, ['class' => 'form-control']) !!}

                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('other', 'Other Deductions', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('other', $payslip->other, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('totalleave', 'Total Leaves', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('totalleave', $payslip->totalleave, ['class' => 'form-control']) !!}

                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('pf', 'Provident Fund', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('pf', $payslip->pf, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('pt', 'Professional Tax', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('pt', $payslip->pt, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('tds', 'TDS', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('tds', $payslip->tds, ['class' => 'form-control']) !!}
                    </div>
                </div>

                   <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('summary', 'Summary', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('summary', $payslip->summary, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                </div>

            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center ">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">
                        Update
                    </button>
                    <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">
                        Cancel
                    </button>
                </div>
            </div>
            <br>
            {!! Form::close() !!}
        </div>
    </div>
    <!--/.Content-->
</div>