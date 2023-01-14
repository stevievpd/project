{{-- ADD NEW ACCOUNT LIST MODAL --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<div class="modal fade" id="newAccountListModal" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeTitle">Add Account List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <form class="row g-3" action="/addAccountList" method="POST" enctype="multipart/form-data"
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
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger opacity-75">Cancel</button>
                        <button type="submit" class="btn btn-success opacity-75 float-end"
                            name="addAccountList">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ADD NEW ACCOUNT LIST MODAL END --}}

{{-- EDIT ACCOUNT LIST MODAL --}}

<div class="modal fade" id="editAccountListModal" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeTitle">Edit Account List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <form class="row g-3" action="/updateAccountList" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-6 form-floating">
                        <input type="hidden" id="accountId" name="account_id">
                        <input type="text" class="form-control accountName" name="account_name" id="accountName"
                            required>
                        <label for="Account Name">Account Name</label>
                    </div>
                    <div class="col-md-6 form-floating statusSelect">
                        <select class="form-control status" name="status" required>
                            <option value="1" style="color:green;">Active</option>
                            <option value="2" style="color:red;">Inactive</option>
                        </select>
                        <label for="Account Name">Status</label>
                    </div>
                    <div class="col-md-12 form-floating">
                        <input type="text" class="form-control description" name="description" id="description"
                            required>
                        <label for="Account Name">Description</label>
                    </div>

                    <div class="mb-2">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger opacity-75">Cancel</button>
                        <button type="submit" class="btn btn-success opacity-75 float-end"
                            name="addAccountList">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ADD NEW ACCOUNT LIST MODAL END --}}

{{-- DELETE ACCOUNT LIST MODAL --}}
<div id="deleteAccountListModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100 text-center">Are you sure?</h4>

            </div>
            <form class="row g-3" action="/deleteAccountList" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <input type="hidden" class="deleteAccountId" name="account_id">
                    <p>Do you really want to delete these Account? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
            </form>
            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>
</div>
{{-- DELETE ACCOUNT LIST MODAL END --}}

{{-- ADD NEW GROUP LIST MODAL --}}

<div class="modal fade" id="newGroupListModal" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="groupTitle">Add Group List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <form class="row g-3" action="/addGroupList" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="col-md-12 form-floating">
                        <input type="text" class="form-control groupName" name="group_name" required>
                        <label for="Group Name">Group Name</label>
                    </div>
                    <div class="col-md-6 form-floating typeSelect">
                        <select class="form-control status" name="type" required>
                            <option value="1">Debit</option>
                            <option value="2">Credit</option>
                        </select>
                        <label for="status">Type</label>
                    </div>
                    <div class="col-md-6 form-floating statusSelect">

                        <select class="form-control status" name="status" required>
                            <option value="1" style="color:green;">Active</option>
                            <option value="2" style="color:red;">Inactive</option>
                        </select>
                        <label for="status">Status</label>
                    </div>
                    <div class="col-md-12 form-floating">
                        <input type="text" class="form-control description" name="description" required>
                        <label for="Account Name">Description</label>
                    </div>

                    <div class="mb-2">
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-danger opacity-75">Cancel</button>
                        <button type="submit" class="btn btn-success opacity-75 float-end"
                            name="addGroupList">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ADD NEW GROUP LIST MODAL END --}}

{{-- EDIT GROUP LIST MODAL --}}

<div class="modal fade" id="editGroupListModal" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="groupTitle">Add Group List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <form class="row g-3" action="/updateGroupList" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-12 form-floating">
                        <input type="hidden" name="group_id" id="groupId">
                        <input type="text" class="form-control groupName" name="group_name" id="groupName"
                            required>
                        <label for="Group Name">Group Name</label>
                    </div>
                    <div class="col-md-6 form-floating typeSelect">
                        <select class="form-control status" name="type" required>
                            <option value="1">Debit</option>
                            <option value="2">Credit</option>
                        </select>
                        <label for="status">Type</label>
                    </div>
                    <div class="col-md-6 form-floating statusSelect">

                        <select class="form-control status" name="status" required>
                            <option value="1" style="color:green;">Active</option>
                            <option value="2" style="color:red;">Inactive</option>
                        </select>
                        <label for="status">Status</label>
                    </div>
                    <div class="col-md-12 form-floating">
                        <textarea class="form-control description" name="description" id="descriptions" cols="30" rows="100"
                            required></textarea>
                        <label for="Account Name">Description</label>
                    </div>

                    <div class="mb-2">
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-danger opacity-75">Cancel</button>
                        <button type="submit" class="btn btn-success opacity-75 float-end"
                            name="addGroupList">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- EDIT GROUP LIST MODAL END --}}

{{-- DELETE GROUP LIST MODAL --}}
<div id="deleteGroupListModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100 text-center">Are you sure?</h4>

            </div>
            <form class="row g-3" action="/deletegroupList" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <input type="hidden" class="deleteGroupId" name="group_id">
                    <p>Do you really want to delete these Account? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
            </form>
            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>
</div>
{{-- DELETE GROUP LIST MODAL END --}}

{{-- ADD NEW BANK ACCOUNT MODAL --}}
<div class="modal fade" id="newBankAccount" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeTitle">Add Bank Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body  ">

                <form class="row g-3" action="/addBankAccount" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf

                    <div class="col-md-12 form-floating bankSelect">
                        <select class="form-select bankSelection" name="bank_id" aria-label="Select Bank" required>
                            <option value="" style="color:gray;">Select Bank</option>
                            @foreach ($bankMeta as $meta)
                                <option value="{{$meta->id}}">{{$meta->bank_name}}</option>
                            @endforeach
                        </select>
                        <label for="Bank Selection">Bank Name</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="number" class="form-control accountNum" name="account_number" required>
                        <label for="account number">Account Number</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control accountHolder" name="account_holder" required>
                        <label for="lastName">Account Holder</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="email" class="form-control email" name="email" required>
                        <label for="Email">Email</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control Address" name="company">
                        <label for="Address">Company</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="number" class="form-control contactInfo" name="contact" required>
                        <label for="contactInfo">Contact Info</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="number" class="form-control zip" name="zip" required>
                        <label for="contactInfo">Zip Code</label>
                    </div>
                    
                    <div class="col-md-12 form-floating">
                        <input type="text" class="form-control Address" name="address" required>
                        <label for="Address">Address</label>
                    </div>
                    <div class="col-md-12 form-floating">
                        <select class="form-select countrySelection" name="country" aria-label="Select country" required>
                            <option value="" style="color:gray;">Select Country</option>
                            <option value="Philippines">Philippines</option>
                        </select>
                        <label for="Bank Selection">Country</label>
                    </div>
                    <div class="mb-2">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger opacity-75">Cancel</button>
                        <button type="submit" class="btn btn-primary opacity-75 float-end" name="addBankAccount">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- ADD NEW BANK ACCOUNT MODAL --}}
{{-- EDIT BANK ACCOUNT MODAL --}}
<div class="modal fade" id="editBankAccount" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeTitle">Edit Bank Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body  ">

                <form class="row g-3" action="/updateBankAccount" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    @method('PATCH')

                    <div class="col-md-12 form-floating">
                        <select class="form-select bankSelection" name="bank_id" aria-label="Select Bank" required>
                            @foreach ($bankMeta as $meta)
                                <option value="{{$meta->id}}">{{$meta->bank_name}}</option>
                            @endforeach
                        </select>
                        <label for="Bank Selection">Bank Name</label>
                    </div>
                    <input type="hidden" name="bank_id" id="bankId">
                    <div class="col-md-6 form-floating">
                        <input type="number" class="form-control accountNum" name="account_number" id="accountNumber" required>
                        <label for="account number">Account Number</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control accountHolder" name="account_holder" id="accountHolder" required>
                        <label for="lastName">Account Holder</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="email" class="form-control email" name="email" id="email" required>
                        <label for="Email">Email</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control Address" name="company" id="company">
                        <label for="Address">Company</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="number" class="form-control contactInfo" name="contact" id="contact" required>
                        <label for="contactInfo">Contact Info</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="number" class="form-control zip" name="zip" id="zip" required>
                        <label for="contactInfo">Zip Code</label>
                    </div>
                    
                    <div class="col-md-12 form-floating">
                        <input type="text" class="form-control Address" name="address" id="address" required>
                        <label for="Address">Address</label>
                    </div>
                    <div class="col-md-12 form-floating countrySelect">
                        <select class="form-select countrySelection" name="country" aria-label="Select country" id="country" required>
                            <option value="" style="color:gray;">Select Country</option>
                            <option value="Philippines">Philippines</option>
                        </select>
                        <label for="Bank Selection">Country</label>
                    </div>
                    <div class="mb-2">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger opacity-75">Cancel</button>
                        <button type="submit" class="btn btn-primary opacity-75 float-end" name="addBankAccount">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- EDIT BANK ACCOUNT MODAL --}}

{{-- DELETE BANK ACCOUNT MODAL --}}
<div id="deleteBankModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100 text-center">Are you sure?</h4>

            </div>
            <form class="row g-3" action="/deleteBankList" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <input type="hidden" class="deleteBankId" name="bank_id">
                    <p>Do you really want to delete these Bank Account? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
            </form>
            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>
</div>
{{-- DELETE BANK ACCOUNT MODAL END --}}