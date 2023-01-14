@extends('layouts.app')

@section('content')
    @include('layouts.modals')
    @include('layouts/modal.InventoryModal')
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Inventory</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Products</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn-download">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Download PDF</span>
            </a>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-package'></i>
                <span class="text">
                    <h3>20</h3>
                    <p>Total Products</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-bell-ring'></i>
                <span class="text">
                    <h3>125</h3>
                    <p>Low on stock</p>
                </span>
            </li>
            <li>
                <i class='bx bx-error'></i>
                <span class="text">
                    <h3>482</h3>
                    <p>Out of stock</p>
                </span>
            </li>
        </ul>
        <div class="table-data">
            <div class="card">
                <div class="card-body">
                    <ul class="navbar">
                        <li>
                            <a href="#" class="tab active" data-id="home">
                                <span class="text">Product</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="profile">
                                <span class="text">Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="messages">
                                <span class="text">Supplier</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="settings">
                                <span class="text">Warehouse</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newProduct">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add new product
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>
                                        <tr class="">
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Supplier Price</th>
                                            <th scope="col">Retail Price</th>
                                            <th scope="col">WholeSale Price</th>
                                            <th scope="col">Max Discount</th>
                                            <th scope="col">QoH</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <?php
                                            $status = $product->product_qoh ? '<span class ="badge text-bg-success bg-opacity-25 percent" style="color: green !important">Active</span>' : '<span class ="badge text-bg-danger bg-opacity-25 percent" style="color: red !important">Out of Stock</span>';
                                            ?>
                                            <tr>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->product_supplier_price }}</td>
                                                <td>{{ $product->product_retail_price }}</td>
                                                <td>{{ $product->product_wholesale_price }}</td>
                                                <td>{{ $product->product_max_discount }}</td>
                                                <td>{{ $product->product_qoh }}</td>
                                                <td>{{ $product->product_unit }}</td>
                                                <td><?= $status ?></td>
                                                <td> <a data-id="{{ $product->id }}"
                                                        class="btn btn-sm btn-success btnEditProd"><i
                                                            class="fa-solid fa-user-pen"></i></a>
                                                    <a data-del="{{ $product->id }}"
                                                        class="btn btn-sm btn-danger btnDeleteProd"><i
                                                            class="fa-solid fa-delete-left"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newCategory">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Category
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $cat)
                                            <tr>
                                                <td>{{ $cat->category_name }}</td>
                                                <td>{{ $cat->category_description }}</td>
                                                <td> <a data-id="{{ $cat->id }}"
                                                        class="btn btn-sm btn-success btnEditCat"><i
                                                            class="fa-solid fa-user-pen"></i></a>
                                                    <a data-del="{{ $cat->id }}"
                                                        class="btn btn-sm btn-danger btnDeleteCat"><i
                                                            class="fa-solid fa-delete-left"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newDepartment">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Supplier
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Business Name</th>
                                            <th>Contact Number</th>
                                            <th>Email Address</th>
                                            <th>Address</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplier as $sup)
                                            <tr>
                                                <td>{{ $sup->supplier_name }}</td>
                                                <td>{{ $sup->supplier_phone }}</td>
                                                <td>{{ $sup->supplier_email }}</td>
                                                <td>{{ $sup->supplier_address }}</td>
                                                <td>{{ $sup->note }}</td>
                                                <td>Active</td>
                                                <td> <a data-id="{{ $sup->id }}"
                                                        class="btn btn-sm btn-success btnEditProd"><i
                                                            class="fa-solid fa-user-pen"></i></a>
                                                    <a data-del="{{ $sup->id }}"
                                                        class="btn btn-sm btn-danger btnDeleteProd"><i
                                                            class="fa-solid fa-delete-left"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#newWarehouse">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Warehouse
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Warehouse #</th>
                                            <th>Warehouse Name</th>
                                            <th>Warehouse Description</th>
                                            <th>ABBR</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($warehouse as $wh)
                                            <tr>
                                                <td>{{ $wh->id }}</td>
                                                <td>{{ $wh->warehouse_name }}</td>
                                                <td>{{ $wh->warehouse_description }}</td>
                                                <td>{{ $wh->abrr }}</td>
                                                <td>Active</td>
                                                <td> <a data-id="{{ $wh->id }}"
                                                        class="btn btn-sm btn-success btnEditWarehouse"><i
                                                            class="fa-solid fa-user-pen"></i></a>
                                                    <a data-del="{{ $wh->id }}"
                                                        class="btn btn-sm btn-danger btnDeleteWarehouse"><i
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
            </div>
        </div>
    </main>

    {{-- TAB PANE SCRIPTS --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add active class on tab click
            $(".tab").on("click", function() {
                var categoryId = $(this).data("id");

                $(".tab, .tab-pane").removeClass("active");
                $(this).addClass("active");
                $("#" + categoryId).addClass("active");
            });
        });
    </script>


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

            $(document).on('click', '.btnEditCat', function() {
                var catId = $(this).attr("data-id");
                var url = "/editCategory";
                $.get(url + '/' + catId, function(data) {
                    //success data
                    $('#catId').val(data.id);
                    $('#categoryName').val(data.category_name);
                    $('#categoryDescription').val(data.category_description);
                    $('#editCategoryModal').modal('show');
                })
            });

            $(document).on('click', '.btnEditWarehouse', function() {
                var warehouseId = $(this).attr("data-id");
                var url = "/editWarehouse";
                $.get(url + '/' + warehouseId, function(data) {
                    //success data
                    $('#warehouseId').val(data.id);
                    $('#warehouseName').val(data.warehouse_name);
                    $('#warehouseDescription').val(data.warehouse_description);
                    $('#Abrr').val(data.abrr);
                    $('#editWarehouseModal').modal('show');
                })
            });

            // DELETE SCRIPTS
            $('.btnDeleteCat').on('click', function() {
                const cat_id = $(this).attr("data-del");
                $('.catId').val(cat_id);
                $('#deleteCategoryModal').modal('show');
            });

            $('.btnDeleteProd').on('click', function() {
                const prod_id = $(this).attr("data-del");
                $('.prodId').val(prod_id);
                $('#deleteProductModal').modal('show');
            });
            $('.btnDeleteWarehouse').on('click', function() {
                const warehouse_id = $(this).attr("data-del");
                $('.warehouseId').val(warehouse_id);
                $('#deleteWarehouseModal').modal('show');
            });


            $(document).ready(function() {
                $('#inventoryList').DataTable({
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All']
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]

                });
            });
            $(document).ready(function() {
                $('#categoryList').DataTable({
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All']
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]

                });
            });

        });
    </script>
@endsection
