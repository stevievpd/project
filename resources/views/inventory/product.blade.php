@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/inventory/style.inventory.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

@section('sidebar_content')
@section('content')
    <h2 class="titleh1">Products</h2>
    <div id="container inventoryContainer" class=" mx-4" id="main">
        <div class="card inventoryCard">
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Huawei Matebook D14</td>
                                <td>Ryzen 5 AMD</td>
                                <td>Laptop</td>
                                <td>50000</td>

                                <td>
                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: green !important"><i class="fa-solid fa-arrow-trend-up"></i>
                                            Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Huawei Matebook D15</td>
                                <td>I5 12th Gen</td>
                                <td>Laptop</td>
                                <td>60000</td>

                                <td>
                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: red !important"><i class="fa-solid fa-arrow-trend-down"></i>
                                            Out of stock</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            var table = $('#data-table').DataTable({});
        });
    </script>
@endsection
@endsection
