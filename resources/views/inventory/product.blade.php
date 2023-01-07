@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/inventory/style.inventory.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
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
        </div>

        <div class="inventoryCardContainer">
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
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Product</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Category</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">

                    <div id="inventoryTable" class="card tab-pane fade show active  border-0" role="tabpanel"
                        aria-labelledby="inventoryTableTab" tabindex="0">
                        <div class="card-header text-white" style="background-color: #ffff;">
                            <div class="d-flex justify-content-end pb-4">
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
                                        <th scope="col" class="text-center">Product Name</th>
                                        <th scope="col" class="text-center">Description</th>
                                        <th scope="col" class="text-center">Supplier Price</th>
                                        <th scope="col" class="text-center">Retail Price</th>
                                        <th scope="col" class="text-center">WholeSale Price</th>
                                        <th scope="col" class="text-center">Max Discount</th>
                                        <th scope="col" class="text-center">QoH</th>
                                        <th scope="col" class="text-center">Unit</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Actions</th>

                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($products as $product)
                                        <?php
                                        $status = $product->product_qoh ? '<span class ="badge text-bg-success bg-opacity-25 percent" style="color: green !important">Active</span>' : '<span class ="badge text-bg-danger bg-opacity-25 percent" style="color: red !important">Out of Stock</span>';
                                        ?>
                                        <tr>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_description }}</td>
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

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div id="inventoryTable" class="card tab-pane fade show active  border-0" role="tabpanel"
                        aria-labelledby="inventoryTableTab" tabindex="0">
                        <div class="card-header text-white" style="background-color: #ffff;">
                            <div class="d-flex justify-content-end pb-4">
                                <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#newCategory">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                        Add new category
                                    </span>
                                </button>

                            </div>
                        </div>

                        <div class="card-body table-responsive ">
                            <table id="categoryList" class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="text-center">Name</th>
                                        <th scope="col" class="text-center">Description</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
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
                </div>
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
@endsection
