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
    @include('layouts/modal.InventoryModal')
    <div id="container inventoryContainer" class=" mx-4" id="main">
        <div class="row align-items-start ">
            <div class="titleHead">
                <h2 class="titleh1">Products</h2>
            </div>
            <div class="card dashboardCardContainer p-3 mb-4">
                <div class="row">
                    <div class="col-4">
                        <div class="card p-4">
                            <div class="container text-center">
                                <div class="row justify-content-start">
                                    <div class="col-4">
                                        <box-icon type='solid' name='package' size="lg"></box-icon>
                                    </div>
                                    <div class="col-4">
                                        <h1>1</h1>
                                    </div>
                                    <div class="col-4">
                                        <h5>Total Products</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card p-4">
                            <div class="container text-center">
                                <div class="row justify-content-start">
                                    <div class="col-4">
                                        <box-icon type='solid' name='package' size="lg"></box-icon>
                                    </div>
                                    <div class="col-4">
                                        <h1>2</h1>
                                    </div>
                                    <div class="col-4">
                                        <h5>Low Stock Products</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card p-4">
                            <div class="container text-center">
                                <div class="row justify-content-start">
                                    <div class="col-4">
                                        <box-icon type='solid' name='package' size="lg"></box-icon>
                                    </div>
                                    <div class="col-4">
                                        <h1>2</h1>
                                    </div>
                                    <div class="col-4">
                                        <h5>Out of Stock Products</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card inventoryCardContainer p-4">
                <div class="card-header text-white" style="background-color: #ffff;">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                            data-bs-target="#newProduct">
                            <span>
                                <i class="fa fa-plus"></i>
                                Add new product
                            </span>
                        </button>

                    </div>
                </div>

                <div class="card-body table-responsive ">
                    <table id="inventoryList" class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-center">Product</th>
                                <th scope="col" class="text-center">Category</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($product as $prod)
                                <?php
                                $status = $prod->quantity ? '<span class ="badge text-bg-success bg-opacity-25 percent" style="color: green !important">Active</span>' : '<span class ="badge text-bg-danger bg-opacity-25 percent" style="color: red !important">Out of Stock</span>';
                                ?>
                                <tr>
                                    <td>{{ $prod->id }}</td>
                                    <td>{{ $prod->category_name }}</td>
                                    <td>{{ $prod->quantity }}</td>
                                    <td>{{ $prod->price }}</td>
                                    <td><?= $status ?></td>
                                    <td> <a data-id="{{ $prod->id }}" class="btn btn-sm btn-success btnEditProd"><i
                                                class="fa-solid fa-user-pen"></i></a>
                                        <a data-del="{{ $prod->id }}" class="btn btn-sm btn-danger btnDelete"><i
                                                class="fa-solid fa-delete-left"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // EDIT scripts for modals
            $(document).on('click', '.btnEditProd', function() {
                var prodId = $(this).attr("data-id");
                var url = "/editProduct";
                $.get(url + '/' + prodId, function(data) {
                    //success data
                    $('#prodId').val(data.id);
                    $('#productName').val(data.product_name);
                    $('#productDescription').val(data.product_description);
                    $('#price').val(data.price);
                    $('#quantity').val(data.quantity);
                    $("div.categorySelect select").val(data.category_id).change();
                    $('#editProductModal').modal('show');
                })
            });

            $(document).ready(function() {
                $('#inventoryList').DataTable({
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All']
                    ],

                });
            });
        });
    </script>
@endsection
@endsection
