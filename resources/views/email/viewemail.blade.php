<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Email</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Email</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($email))
                        @foreach($email as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->mailid }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="text-center">No emails found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
    <!--/.Content-->
</div>
