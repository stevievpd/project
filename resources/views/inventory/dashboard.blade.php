@extends('layouts.app')

<link rel="stylesheet" href="/css/inventory/style.dashboard.css">


@section('content')
    <div class="container">
        <div class="text-center titleHead  rounded">
            <h1 class=" heading">Dashboard</h1>
        </div>
        <div class="gallery-image">
            <div class="img-box rounded">
                <a href="/product">
                    <img src="https://www.svgrepo.com/show/397166/package.svg" alt="" />
                    <div class="transparent-box">
                        <div class="caption">
                            <h3>View Products</h3>
                            <p class="opacity-low">Manage your products</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="img-box rounded">
                <a href="/supplier">
                    <img src="https://www.svgrepo.com/show/246780/group-user.svg" alt="" />
                    <div class="transparent-box">
                        <div class="caption">
                            <h3>View Suppliers</h3>
                            <p class="opacity-low">Manage your suppliers</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="img-box rounded">
                <a href="/warehouse">
                    <img src="https://www.svgrepo.com/show/192541/warehouse.svg" alt="" />
                    <div class="transparent-box">
                        <div class="caption">
                            <h3>View Warehouse</h3>
                            <p class="opacity-low">Manage your Warehouse</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <style>
        body {
            font-family: Raleway;
            background-color: #aecfe5;
        }
    </style>
@endsection
