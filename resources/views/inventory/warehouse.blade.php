@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/inventory/style.inventory.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

@section('sidebar_content')
@section('content')
    @include('layouts.modals')
    <div id="container inventoryContainer" class=" mx-4" id="main">
        <div class="row align-items-start ">
            <div class="titleHead">
                <h2 class="titleh1">Warehouse </h2>
            </div>
        </div>

        <div class="warehouseCardContainer">
            {{-- Employee Details --}}
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

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Warehouse</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Product in
                        Warehouse</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">

                    <div id="warehouseTable" class="card tab-pane fade show active border-0 shadow" role="tabpanel"
                        aria-labelledby="warehouseTableTab" tabindex="0">
                        <div class="card-header text-white" style="background-color: #ffff;">
                            <div class="d-flex justify-content-end pb-4">
                                <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#newProduct">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                        Add New Warehouse
                                    </span>
                                </button>

                            </div>
                        </div>
                        <div class="card-body table-responsive ">
                            <table id="warehouseList" class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="text-center">Warehouse #</th>
                                        <th scope="col" class="text-center">Warehouse Name</th>
                                        <th scope="col" class="text-center">Warehouse Description</th>
                                        <th scope="col" class="text-center">ABBR</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($warehouse as $wh)
                                        <td>{{ $wh->id }}</td>
                                        <td>{{ $wh->warehouse_name }}</td>
                                        <td>{{ $wh->warehouse_description }}</td>
                                        <td>{{ $wh->abrr }}</td>
                                        <td>Active</td>
                                        <td> <a data-id="{{ $wh->id }}" class="btn btn-sm btn-success btnEditProd"><i
                                                    class="fa-solid fa-user-pen"></i></a>
                                            <a data-del="{{ $wh->id }}" class="btn btn-sm btn-danger btnDeleteProd"><i
                                                    class="fa-solid fa-delete-left"></i></a>
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div id="warehouseProductTable" class="card tab-pane fade show active border-0 shadow" role="tabpanel"
                        aria-labelledby="warehouseProductTableTab" tabindex="0">
                        <div class="card-header text-white" style="background-color: #ffff;">
                            <div class="d-flex justify-content-end pb-4">
                                <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#newCategory">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                        Add New Product in Warehouse
                                    </span>
                                </button>

                            </div>
                        </div>

                        <div class="card-body table-responsive ">
                            <table id="productInWareHouseList" class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="text-center">Product #</th>
                                        <th scope="col" class="text-center">Warehouse #</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($warehouseProduct as $wp)
                                        <td>{{ $wp->product_id }}</td>
                                        <td>{{ $wp->warehouse_id }}</td>
                                        <td>{{ $wp->product->product_qoh }}</td>
                                        <td>Active</td>
                                        <td> <a data-id="{{ $wp->id }}"
                                                class="btn btn-sm btn-success btnEditProd"><i
                                                    class="fa-solid fa-user-pen"></i></a>
                                            <a data-del="{{ $wp->id }}"
                                                class="btn btn-sm btn-danger btnDeleteProd"><i
                                                    class="fa-solid fa-delete-left"></i></a>
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#warehouseList').DataTable({
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All']
                    ],

                });
                $('#productInWareHouseList').DataTable({
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All']
                    ],

                });
            });
        </script>
    @endsection
@endsection
