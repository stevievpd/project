@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/humanresources/style.employee.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">


@section('sidebar_content')
@section('content')
    @include('layouts.modals')
    {{-- @include('layouts/modal.HumanResourcesModal') --}}


    <div id="container cont-mains empMenu" class=" mx-4" id="main">
        <div id="content" class="" style="width: 80%; margin:auto;">

            <div class="row" style="width:99%; margin-left:auto; margin-right:auto;">
                <div class="row align-items-start shadow-sm pt-3 mb-4 bg-body rounded"
                    style="width:99%; margin-left:auto; margin-right:auto; ">
                    <div class="text-center titleHead  rounded">
                        <h1 class=" titleh1">Journal Entries</h1>
                    </div>
                </div>

                {{-- session --}}
                @if (Session::has('msg'))
                    <script>
                        $(document).ready(function() {
                            $("#popModalSuccess").modal('show');
                        });
                    </script>
                    <p class="alert alert-info">{{ Session::get('msg') }}</p>
                @endif
                @if (Session::has('msgDel'))
                    <script>
                        $(document).ready(function() {
                            $("#deletePopupModal").modal('show');
                        });
                    </script>
                    <p class="alert alert-danger">{{ Session::get('msgDel') }}</p>
                @endif
                {{-- session --}}

            </div>
            <!-- start of content -->
            <div class="card" style="width:95%; margin-left:auto; margin-right:auto;">

                <div class="card-header">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#journalEntryModal"><i class="fa-regular fa-pen-to-square"></i>
                        Add New Journal
                    </button>
                </div>
                <div class="card-body ">
                    <table id="table1" class="table table-responsive-sm">
                        <colgroup>
                            <col width="15%">
                            <col width="15%">
                            <col width="44%">
                            <col width="16%">
                            <col width="5%">
                        </colgroup>
                        <thead class="table-info border border-secondary ">

                            <tr>
                                <th>Date</th>
                                <th>Journal Code</th>
                                <!-- <th>Partners</th> -->
                                <th class="p-2">
                                    <div class="d-flex w-100 ">
                                        <div class="col-6 px-2 border border-secondary">Description</div>
                                        <div class="col-3 px-2 border border-secondary">Debit</div>
                                        <div class="col-3 px-2 border border-secondary">Credit</div>
                                    </div>
                                </th>
                                <!-- <th>Journal</th> -->
                                <th>Added By</th>
                                <!-- <th>Status</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Date</td>
                                <td>Journal Code</td>
                                <!-- <th>Partners</th> -->
                                <td class="p-2">
                                    <div class="d-flex w-100 ">
                                        <div class="col-6 px-2">Description</div>
                                        <div class="col-3 px-2 ">Debit</div>
                                        <div class="col-3 px-2 ">Credit</div>
                                    </div>
                                </td>
                                <!-- <th>Journal</th> -->
                                <td>Added By</td>
                                <!-- <th>Status</th> -->
                                <td>Action</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>Journal Code</td>
                                <!-- <th>Partners</th> -->
                                <td class="p-2">
                                    <div class="d-flex w-100 ">
                                        <div class="col-6 px-2">Description</div>
                                        <div class="col-3 px-2 ">Debit</div>
                                        <div class="col-3 px-2 ">Credit</div>
                                    </div>
                                </td>
                                <!-- <th>Journal</th> -->
                                <td>Added By</td>
                                <!-- <th>Status</th> -->
                                <td>Action</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>Journal Code</td>
                                <!-- <th>Partners</th> -->
                                <td class="p-2">
                                    <div class="d-flex w-100 ">
                                        <div class="col-6 px-2">Description</div>
                                        <div class="col-3 px-2 ">Debit</div>
                                        <div class="col-3 px-2 ">Credit</div>
                                    </div>
                                </td>
                                <!-- <th>Journal</th> -->
                                <td>Added By</td>
                                <!-- <th>Status</th> -->
                                <td>Action</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>Journal Code</td>
                                <!-- <th>Partners</th> -->
                                <td class="p-2">
                                    <div class="d-flex w-100 ">
                                        <div class="col-6 px-2"> <b> Title</b><br>
                                             <p class="">asd <br></p>
                                             <p class="">asasdadd <br></p>
                                             <p class="">aasdsd <br></p>

                                        </div>
                                        <div class="col-3 px-2 ">Debit</div>
                                        <div class="col-3 px-2 ">Credit</div>
                                    </div>
                                </td>
                                <!-- <th>Journal</th> -->
                                <td>Added By</td>
                                <!-- <th>Status</th> -->
                                <td>Action</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>Journal Code</td>
                                <!-- <th>Partners</th> -->
                                <td class="p-2">
                                    <div class="d-flex w-100 ">
                                        <div class="col-6 px-2">Description</div>
                                        <div class="col-3 px-2 ">Debit</div>
                                        <div class="col-3 px-2 ">Credit</div>
                                    </div>
                                </td>
                                <!-- <th>Journal</th> -->
                                <td>Added By</td>
                                <!-- <th>Status</th> -->
                                <td>Action</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Journal Code</th>

                                <th class="p-2">
                                    <div class="d-flex w-100">
                                        <div class="col-6 px-2 border">Description</div>
                                        <div class="col-3 px-2 border">Debit</div>
                                        <div class="col-3 px-2 border">Credit</div>
                                    </div>
                                </th>
                                <!-- <th>Journal</th> -->
                                <th>Added By</th>
                                <!-- <th>Status</th> -->
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- end of content -->
        </div>

    </div>
    {{-- ============================================================================================================================== --}}

    <style>
        body {
            background-color: #EAF6F6;
        }
    </style>
    {{-- scripts --}}
@endsection
@endsection
