@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/inventory/style.inventory.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

@section('sidebar_content')
@section('content')
    <div id="container inventoryContainer" class=" mx-4" id="main">
        <div class="row align-items-start ">
            <div class="titleHead">
                <h2 class="titleh1">Products</h2>
            </div>
            <div class="card inventoryCardContainer">
                <div class="table-responsive ">
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
                            {{-- @foreach ($product as $prod)
                            <tr>
                                <td>{{ $prod->employee_code }}</td>
                                <td>{{ $prod->first_name }} {{ $emp->last_name }}</td>
                                <td>{{ $prod->email }}</td>
                                <td> <a data-id="{{ $prod->id }}"
                                        class="btn btn-sm btn-success btnEditEmp"><i
                                            class="fa-solid fa-user-pen"></i></a>

                                    <a data-del="{{ $prod->id }}"
                                        class="btn btn-sm btn-danger btnDelete"><i
                                            class="fa-solid fa-delete-left"></i></a>
                                </td>
                            </tr>
                        @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#inventoryList').DataTable({
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
