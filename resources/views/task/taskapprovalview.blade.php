<style>
.select2-container {
    z-index: 99999 !important; /* Higher than Bootstrap modal */
}

.select2-container--default .select2-selection--multiple {
    border: 0 !important;
    padding-bottom: 0.6rem !important;
    padding-top: 0.25rem !important;
}
</style>

<div class="modal-body cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Task</h4>
        </div>
        <div class="modal-body mb-0 overflow-auto">

                 <table class="dataTable mt-6 table table-bordered ">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.No</th>
                            <th class="text-grey">Employee Name</th>
                            <th class="text-grey">Design Checking</th>
                            <th class="text-grey">Spelling Check</th>
                            <th class="text-grey">Space Symbols Checking</th>
                            <th class="text-grey">Overall Content Checking</th>
                            <th class="text-grey">CTA Checking</th>
                            <th class="text-grey">Overall Letter Alighment</th>
                            <th class="text-grey">Logo Checking</th>
                            <th class="text-grey">Title Case</th>
                            <th class="text-grey">Remark</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($task)>0)
                        @foreach($task as $key => $tasks)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tasks->fname}}</td>
                            <td>{{$tasks->design_checking}}</td>
                            <td>{{$tasks->spelling_check}}</td>
                            <td>{{$tasks->space_symbols_checking}}</td>
                            <td>{{$tasks->overall_content_checking}}</td>
                            <td>{{$tasks->cta_checking}}</td>
                            <td>{{$tasks->overall_letter_alighment}}</td>
                            <td>{{$tasks->logo_checking}}</td>
                            <td>{{$tasks->title_case}}</td>
                            <td>{{$tasks->remark}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

         

        </div>
    </div>
</div>


