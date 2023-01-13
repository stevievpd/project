{{-- ADD NEW ACCOUNT LIST MODAL --}}
<!-- Start Add Schedule -->
<div class="modal fade" id="newAccountListModal" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeTitle">Add Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <form class="row g-3" action="/addSchedule" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control accountName" name="account_name" required>
                        <label for="Account Name">Account Name</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        
                        <select class="form-control status" name="status" required>
                            <option value="1" style="color:green;">Active</option>
                            <option value="2" style="color:red;">Inactive</option>
                        </select>
                        <label for="Account Name">Status</label>
                    </div>
                    <div class="col-md-12 form-floating">
                        <input type="text" class="form-control description" name="description" required>
                        <label for="Account Name">Description</label>
                    </div>

                    <div class="mb-2">
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-danger opacity-75">Cancel</button>
                        <button type="submit" class="btn btn-success opacity-75 float-end"
                            name="addSchedule">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Add SCHEDULE -->
{{-- ADD NEW ACCOUNT LIST MODAL END --}}