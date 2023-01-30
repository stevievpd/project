<style>
    .form-control {
        border-bottom-style: groove;
    }
</style>
{{-- <!-- Start error modal --> --}}
<div class="modal fade" id="errorModalAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="z-index: 4000">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#b30000">ERROR!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-danger p-2 text-white bg-opacity-75 text-center">
                <h6>Please Insert Proper Data.</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- <!-- error modal end --> --}}
{{-- <!-- Start error modal --> --}}
<div class="modal fade" id="errorModalTrial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="z-index: 2050">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#b30000">ERROR!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-danger p-2 text-white bg-opacity-75 text-center">
                <h5>Trial Balance is not Equal!</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- <!-- error modal end --> --}}

{{-- <!-- modal New Journal Entry ADD--> --}}
<div class="modal fade w-80" id="journalEntryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 2023">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-book"></i> Create Journal
                    Entry</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addJournalEntry" id="journAdd" method="POST">
                    @csrf
                    <div class="">
                        <div class="row py-2 align-items-start">
                            <div class="col input-group">
                                <span class="input-group-text" id="basic-addon1">JOURNAL CODE</span>
                                <input type="text" class="form-control code text-dark bg bg-white" name="entry_code" id="sample"
                                    value="MSC-<?php echo (new DateTime())->format('mY'); ?>-00{{ $journCount }}" style="--bs-text-opacity: .5;"
                                    readonly>
                            </div>
                            <div class="col input-group">
                                <span class="input-group-text" id="basic-addon1">Date</span>
                                <input type="date" class="form-control journDate" name="entry_date"
                                    value="<?php echo (new DateTime())->format('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class=" p-2 row align-items-start">
                            <div class="col-12 px-4 py-2 g-2 row align-items-start">
                                <div class="col-6 form-floating">
                                    <input type="text" class="title form-control" name="title"
                                        style="text-transform:uppercase"
                                        onkeyup="this.value = this.value.toUpperCase();" placeholder="Description"
                                        required>
                                    <label for="" class="text-muted">Transaction Title</label>
                                </div>
                                <div class="col-6 form-floating">
                                    <input type="text" class="form-control user" id="username" name="added_by"
                                        value="{{ Auth::user()->name }}" readonly>
                                    <label for="account" class="">Creator</label>
                                </div>
                                <div class="col-6 form-floating">
                                    <input type="text" class="description form-control" name="description"
                                        style="text-transform:capitalize" placeholder="Description">
                                    <label for=""class="text-muted">Remarks</label>
                                </div>
                                <div class="col-6 form-floating">
                                    <input type="text" class="partner form-control" name="partner"
                                        placeholder="Partner">
                                    <label for="" class="text-muted">Partner</label>
                                </div>
                                <div class="col-6 form-floating">
                                    <select class="journal form-control" onchange="load(this)" name="journal" id="">
                                        <option value="Miscellaneous" data-id="MSC">Miscellaneous Operations</option>
                                        <option value="Invoices" data-id="INV">Customer Invoices</option>
                                    </select>
                                    <label for="" class="text-muted">Journal</label>
                                </div>
                            </div>
                            <div class="col-12 g-2 py-2 row shadow-lg p-2 mb-3 bg-body rounded border">
                                <div class="journTitle">
                                    <span class="item">Journal Items</span>
                                </div>

                                <div class="col-6 form-floating ">
                                    <select class="form-control account" name="account" id="accountListJourn">
                                        <option value="" style="color:red;">Select</option>
                                        @foreach ($accountList as $account)
                                            <option value="{{ $account->id }}|{{ $account->type }}"
                                                style="color:rgb(100, 100, 100);">{{ $account->code }}
                                                {{ $account->account_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="account name" class="">Account Name</label>
                                </div>
                                {{-- <div class="col-6 form-floating">
                                    <select class="form-control group" name="group" id="groupListJourn">
                                        <option value="" style="color:red;">Select</option>
                                        @foreach ($groupList as $group)
                                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="account" class="">Group</label>
                                </div> --}}
                                <div class="col-6 form-floating">
                                    <input type="number" class="form-control amount" id="amountJourn"
                                        onchange="this.value = Math.abs(this.value)">
                                    <label for="" class="">Amount</label>
                                </div>

                                <div class="col-6 form-floating">
                                    <select class="form-control type" onchange="myFunction(this)" name="type" id="typeId">
                                        <option value="" style="color:red;">Select</option>
                                        <option value="1" style="color:rgb(100, 100, 100);">DEBIT</option>
                                        <option value="2" style="color:rgb(100, 100, 100);">CREDIT</option>
                                    </select>
                                    <label for="" class="">TYPE</label>
                                </div>
                                <div class="col-6">
                                    <button type="button" class=" btn btn-success p-3  amount form-control"
                                        name="amount" id="myButton">Add Journal Item</button>
                                </div>

                            </div>
                        </div>

                        <table id="tableJourn" class="table table-stripped table-bordered gx-3">
                            <colgroup>

                                <col width="30%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="5%">
                            </colgroup>
                            <thead>
                                <tr class="bg-dark bg-gradient text-white">
                                    <th>Account Name</th>
                                    <th>Account Type</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Tool</th>
                                </tr>
                            </thead>
                            <tbody id="bodys"></tbody>
                            <tfoot>
                                <tr class="bg-gradient-secondary">
                                </tr>
                                <tr class=" border">
                                    <th></th>
                                    <th class="text-center">Total</th>
                                    <th class="text-right totalDebit">0.00</th>
                                    <th class="text-right totalCredit">0.00</th>
                                </tr>

                                <tr class=" border">
                                    <th colspan="2" class="text-center"></th>
                                    <th colspan="2" class="text-center totalBalanceJourn" id="totalCol">0</th>
                                </tr>

                            </tfoot>
                            <input type="hidden" name="totalcatch" id="totalcatch" readonly value="0">
                        </table>

                        <noscript id="cloneThis">
                            <tr>
                                <td class="">
                                    <input type="hidden" class="accountName" name="account_ids[]" value="">
                                    <input type="hidden" class="groupName" name="group_ids[]" value="">
                                    <input type="hidden" class="amount" name="amounts[]" value="">
                                    <input type="hidden" class="amountType" name="amountType[]" value="">
                                    <span class="accountsD" id="accD"></span>
                                </td>
                                <td class="groupsD"></td>
                                <td class="debitAmounts text-right"></td>
                                <td class="creditAmounts text-right"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline btn-danger btn-flat delRow" id="deleteRow"
                                        type="button"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </noscript>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="border-radius: 50px">Close</button>
                <button type="submit" class="btn btn-primary" name="journAddnewEntry"
                    style="border-radius: 50px">Create Journal Entry</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- <!-- modal New Journal Entry END --> --}}


{{-- <!-- START DELETE MODAL --> --}}
<div id="deleteJournalModal" class="modal fade">
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
            <form class="row g-3" action="/deleteJournal" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <input type="hidden" class="journId" name="journ_id">
                    <input type="hidden" class="journCode" name="entry_code">
                    <div id="code"><b>
                            <p></p>
                        </b></div>
                    <p>Do you really want to delete these Journal Entry? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
            </form>
            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>
</div>
{{-- <!-- END DELETE MODAL --> --}}


{{-- <!-- modal EDIT JOURNAL ENTRY --> --}}
<div class="modal fade w-80" id="editJournalEntryModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 2023">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-book"></i> Edit Journal
                    Entry</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updateJournal" id="journEdit" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="">
                        <input type="hidden" id="journIdEdit" name="journ_id" readonly>
                        <div class="row py-2 align-items-start">
                            <div class="col input-group">
                                <span class="input-group-text" id="basic-addon1">JOURNAL CODE</span>
                                <input type="text" class="form-control code text-dark bg bg-white"
                                    name="entry_code" id="entryCodeEdit" style="--bs-text-opacity: .5;" readonly>
                            </div>
                            <div class="col input-group">
                                <span class="input-group-text" id="basic-addon1">Date</span>
                                <input type="date" class="form-control journDate" name="entry_date"
                                    id="entryDateEdit">
                            </div>
                        </div>
                        <div class=" p-2 row align-items-start">
                            <div class="col-12 px-4 py-2 g-2 row align-items-start">
                                <div class="col-6 form-floating">
                                    <input type="text" class="title form-control" name="title"
                                        style="text-transform:uppercase" id="titleEdit"
                                        onkeyup="this.value = this.value.toUpperCase();" placeholder="Description"
                                        required>
                                    <label for="" class="text-muted">Transaction Title</label>
                                </div>
                                <div class="col-6 form-floating">
                                    <input type="text" class="form-control user" id="username" name="added_by"
                                        value="{{ Auth::user()->name }}" readonly>
                                    <label for="account" class="">Creator</label>
                                </div>
                                <div class="col-6 form-floating">
                                    <input type="text" class="description form-control" name="description"
                                        id="descriptEdit" style="text-transform:capitalize"
                                        placeholder="Description">
                                    <label for=""class="text-muted">Remarks</label>
                                </div>
                                <div class="col-6 form-floating">
                                    <input type="text" class="partner form-control" name="partner"
                                        id="partnerEdit" placeholder="Partner">
                                    <label for="" class="text-muted">Partner</label>
                                </div>
                                <div class="col-6 form-floating">
                                    <input type="text" class="form-control journ" id="journ" name="journal"
                                         readonly>
                                    <label for="account" class="text-muted">Journal <em>*This Cannot Be Change</em></label>
                                </div>


                            </div>
                            <div class="col-12 g-2 py-2 row shadow-lg p-2 mb-3 bg-body rounded border">
                                <div class="journTitle">
                                    <span class="percent">Journal Items</span>
                                </div>

                                <div class="col-6 form-floating ">
                                    <select class="form-control account" name="account" id="accountListJournEdit">
                                        <option value="" style="color:red;">Select</option>
                                        @foreach ($accountList as $account)
                                            <option value="{{ $account->id }}|{{ $account->type }}">
                                                {{ $account->code }} {{ $account->account_name }}</span></option>
                                        @endforeach
                                    </select>
                                    <label for="account" class="">Account Name</label>
                                </div>
                                {{-- <div class="col-6 form-floating">
                                    <select class="form-control group" name="group" id="groupListJourn">
                                        <option value="" style="color:red;">Select</option>
                                        @foreach ($groupList as $group)
                                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="account" class="">Group</label>
                                </div> --}}
                                <div class="col-6 form-floating">
                                    <input type="number" class="form-control amount" id="amountJournEdit"
                                        onchange="this.value = Math.abs(this.value)">
                                    <label for="" class="">Amount</label>
                                </div>

                                <div class="col-6 form-floating">
                                    <select class="form-control type" name="type" id="typeIdEdit">
                                        <option value="" style="color:red;">Select</option>
                                        <option value="1">DEBIT</option>
                                        <option value="2">CREDIT</option>
                                    </select>
                                    <label for="" class="">TYPE</label>
                                </div>
                                <div class="col-6">
                                    <button type="button" class=" btn btn-success p-3  amount form-control"
                                        name="amount" id="myButtonEdit">Add Journal Item</button>
                                </div>

                            </div>
                        </div>

                        <table id="tableJournEdit" class="table table-stripped table-bordered gx-3">
                            <colgroup>

                                <col width="30%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="5%">
                            </colgroup>
                            <thead>
                                <tr class="bg-dark bg-gradient text-white">
                                    <th>Account Name</th>
                                    <th>Group</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Tool</th>
                                </tr>
                            </thead>
                            <tbody id="bodysEdit"></tbody>
                            <tfoot>
                                <tr class="bg-gradient-secondary">
                                </tr>
                                <tr class=" border">
                                    <th></th>
                                    <th class="text-center">Total</th>
                                    <th class="text-right totalDebit">0.00</th>
                                    <th class="text-right totalCredit">0.00</th>
                                </tr>

                                <tr class=" border">
                                    <th colspan="2" class="text-center"></th>
                                    <th colspan="2" class="text-center totalBalanceJournEdit" id="totalColEdit">0
                                    </th>
                                </tr>

                            </tfoot>
                            <input type="hidden" name="totalcatchEdit" id="totalcatchEdit" readonly value="0">
                        </table>

                        <noscript id="cloneThisEdit">
                            <tr>
                                <td class="">
                                    <input type="hidden" class="accountNameEdit" name="account_idsEdit[]"
                                        value="">
                                    <input type="hidden" class="groupNameEdit" name="group_idsEdit[]"
                                        value="">
                                    <input type="hidden" class="amountEdit" name="amountsEdit[]" value="">
                                    <input type="hidden" class="amountTypeEdit" name="amountTypeEdit[]"
                                        value="">
                                    <span class="accountsDEdit" id="accD"></span>
                                </td>
                                <td class="groupsDEdit"></td>
                                <td class="debitAmountsEdit text-right"></td>
                                <td class="creditAmountsEdit text-right"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline btn-danger btn-flat delRowEdit"
                                        id="deleteRow" type="button"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </noscript>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="border-radius: 50px">Close</button>
                <button type="submit" class="btn btn-primary" name="journEditEntry"
                    style="border-radius: 50px">update Journal Entry</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- <!--END modal EDIT JOURNAL ENTRY --> --}}
<script>
    function load(e){
        document.getElementById("sample").value = e.options[e.selectedIndex].getAttribute('data-id')+'-<?php echo (new DateTime())->format('mY'); ?>-00{{ $journCount }}';
    }
</script>