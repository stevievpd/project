 {{-- =============================================== Inventory MODAL ================================================================ --}}
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

 <!-- Start Add Cash Advance -->
 <div class="modal fade" id="newCashAdvance" tabindex="-1" role="dialog" aria-labelledby="cashAdvanceTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="cashAdvanceTitle">Add Cash Advance</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body  ">

                 <form class="row g-3" action="/addCashAdvance" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     <div class="col-12 form-floating">
                         <input type="date" class="form-control date datepicker" name="date" required>
                         <label for="date">Date</label>
                     </div>
                     <div class="col-12 form-floating">
                         <select class="form-control employeeSelection" name="employee" aria-label="Select employee"
                             required>
                             <option value="0" selected>- Select -</option>
                             @foreach ($employee as $emp)
                                 <option value="{{ $emp->id }}">{{ $emp->first_name }}{{ $emp->last_name }}
                                 </option>
                             @endforeach
                         </select>
                         <label for="employeeSelection">Employee Name</label>
                     </div>
                     <div class="col-12 form-floating">
                         <input type="number" class="form-control amount" name="amount" required>
                         <label for="amount">Amount</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control description" name="description" required>
                         <label for="description">Description</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-success float-end" name="addCashAdvance">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Add Cash Advance -->

 <!-- Start Edit Cash Advance -->
 <div class="modal fade" id="CashAdvanceEditModal" tabindex="-1" role="dialog" aria-labelledby="cashAdvanceTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="cashAdvanceTitle">Add Cash Advance</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body  ">

                 <form class="row g-3" action="/updateCashAdvance" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')
                     <div class="col-12 form-floating">
                         <input type="hidden" name="cashadvance_id" id="cashAdvanceId">
                         <input type="date" class="form-control date datepicker" name="date" id="date"
                             required>
                         <label for="date">Date</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control employee" name="employee" id="employee" readonly>
                         <label for="employee">Employee Name</label>
                     </div>
                     <div class="col-12 form-floating">
                         <input type="number" class="form-control amount" name="amount" id="amount" required>
                         <label for="amount">Amount</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control description" name="description" id="description"
                             required>
                         <label for="description">Description</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-success float-end"
                             name="editCashAdvance">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Edit Cash Advance -->

 <!-- Start Delete Cash Advance -->
 <div id="deleteCashAdvanceModal" class="modal fade">
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
             <form class="row g-3" action="/deleteCashAdvance" method="POST" enctype="multipart/form-data"
                 autocomplete="off">
                 @csrf
                 @method('PATCH')

                 <div class="modal-body">
                     <input type="hidden" class="cashAdvanceId" name="cashadvance_id">
                     <p>Do you really want to delete these Cash Advance? This process cannot be undone.</p>
                 </div>
                 <div class="modal-footer justify-content-center">
             </form>
             <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
             <button type="submit" class="btn btn-danger">Delete</button>
         </div>
     </div>
 </div>
 </div>
 <!-- Edit Delete Cash Advance -->

 <!-- Start Add Deduction -->
 <div class="modal fade" id="newDeduction" tabindex="-1" role="dialog" aria-labelledby="deductionTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deductionTitle">Add Deduction</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body">

                 <form class="row g-3" action="/addDeduction" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf

                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control depart" name="description" required>
                         <label for="description">Description</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="number" class="form-control depart" name="amount" required>
                         <label for="amount">Amount</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal"
                             class="btn btn-danger opacity-75">Cancel</button>
                         <button type="submit" class="btn btn-success opacity-75 float-end"
                             name="addDeduction">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Add Deduction -->


 <!-- Start Edit Deduction -->

 <div class="modal fade" id="DeductionEditModal" tabindex="-1" role="dialog" aria-labelledby="deductionTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deductionTitle">Edit Deduction</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body">

                 <form class="row g-3" action="/updateDeduction" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')
                     <div class="col-md-12 form-floating">
                         <input type="hidden" name="deduction_id" id="deductionId">
                         <input type="text" class="form-control description" name="description" id="deductionDescription"
                             required>
                         <label for="description">Description</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="number" class="form-control amount" name="amount" id="deductionAmount" required>
                         <label for="amount">Amount</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal"
                             class="btn btn-danger opacity-75">Cancel</button>
                         <button type="submit" class="btn btn-success opacity-75 float-end"
                             name="addDeduction">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
   <!-- End Edit Deduction -->



  <!-- Start Delete Deduction-->
  <div id="deleteDeductionModal" class="modal fade">
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
            <form class="row g-3" action="/deleteDeduction" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <input type="hidden" class="deductionId" name="deduction_id">
                    <p>Do you really want to delete these Deduction? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
            </form>
            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>
</div>