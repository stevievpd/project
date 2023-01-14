 {{-- =============================================== Inventory MODAL ================================================================ --}}
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

 <!-- Start Add Product -->
 <div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="productTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="productTitle">Add Product</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body  ">

                 <form class="row g-3" action="/addProduct" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control productName" name="product_name" required>
                         <label for="productName">Product name</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control productDescription" name="product_description"
                             required>
                         <label for="productDescription">Product Description</label>
                     </div>
                     <div class="col-12 form-floating">
                         <select class="form-control categorySelection" name="category" aria-label="Select Category"
                             required>
                             <option value="0" selected>- Select -</option>
                             @foreach ($category as $cat)
                                 <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                             @endforeach
                         </select>
                         <label for="categorySelection">Category</label>
                     </div>
                     <div class="col-md-6 form-floating">
                         <input type="number" class="form-control price" name="price" required>
                         <label for="price">Price</label>
                     </div>
                     <div class="col-md-6 form-floating">
                         <input type="number" class="form-control quantity" name="quantity" required>
                         <label for="quantity">Quantity</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-success float-end" name="addProduct">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>


 {{-- EDIT PRODUCT --}}
 <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="productTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="productTitle">Add Product</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body  ">

                 <form class="row g-3" action="/updateProduct" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')
                     <div class="col-md-12 form-floating">
                         <input type="hidden" name="prod_id" id="prodId">
                         <input type="text" class="form-control productName" id="productName" name="product_name"
                             required>
                         <label for="productName">Product name</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control productDescription" id="productDescription"
                             name="product_description" required>
                         <label for="productDescription">Product Description</label>
                     </div>
                     <div class="col-12 form-floating categorySelect">
                         <select class="form-control categorySelection" name="category" id="category"
                             aria-label="Select Category" required>
                             @foreach ($category as $cat)
                                 <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                             @endforeach
                         </select>
                         <label for="categorySelection">Category</label>
                     </div>
                     <div class="col-md-6 form-floating">
                         <input type="number" class="form-control price" name="price" id="price" required>
                         <label for="price">Price</label>
                     </div>
                     <div class="col-md-6 form-floating">
                         <input type="number" class="form-control quantity" name="quantity" id="quantity"
                             required>
                         <label for="quantity">Quantity</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-success float-end" name="editProduct">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 {{-- DELETE PRODUCT --}}

 <div>
     <div id="deleteProductModal" class="modal fade">
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
                 <form class="row g-3" action="/deleteProduct" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')

                     <div class="modal-body">
                         <input type="hidden" class="prodId" name="prod_id">
                         <p>Do you really want to delete these product? This process cannot be undone.</p>
                     </div>
                     <div class="modal-footer justify-content-center">
                 </form>
                 <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                 <button type="submit" class="btn btn-danger">Delete</button>
             </div>
         </div>
     </div>
 </div>



 {{-- ADD CATEGORY --}}
 <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="categoryTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="categoryTitle">Add Category</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body  ">

                 <form class="row g-3" action="/addCategory" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control categoryName" name="category_name" required>
                         <label for="categoryName">Category Name</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control categoryDescription" name="category_description"
                             required>
                         <label for="categoryDescription">category Description</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-success float-end" name="addProduct">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 {{-- EDIT  CATEGORY --}}
 <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="categoryTitle">Add Category</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body  ">
                 <form class="row g-3" action="/updateCategory" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')
                     <div class="col-md-12 form-floating">
                         <input type="hidden" name="cat_id" id="catId">
                         <input type="text" class="form-control categoryName" name="category_name"
                             id="categoryName" required>
                         <label for="categoryName">Category Name</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control categoryDescription" name="category_description"
                             id="categoryDescription" required>
                         <label for="categoryDescription">category Description</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-success float-end" name="addProduct">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 {{-- DELETE CATEGORY --}}
 <div>
     <div id="deleteCategoryModal" class="modal fade">
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
                 <form class="row g-3" action="/deleteCategory" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')

                     <div class="modal-body">
                         <input type="hidden" class="catId" name="cat_id">
                         <p>Do you really want to delete these category ? This process cannot be undone.</p>
                     </div>
                     <div class="modal-footer justify-content-center">
                 </form>
                 <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                 <button type="submit" class="btn btn-danger">Delete</button>
             </div>
         </div>
     </div>
 </div>


 {{-- ADD WAREHOUSE --}}
 <div class="modal fade" id="newWarehouse" tabindex="-1" role="dialog" aria-labelledby="warehouseTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="warehouseTitle">Add Warehouse</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body  ">

                 <form class="row g-3" action="/addWarehouse" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control warehouseName" name="warehouse_name" required>
                         <label for="warehouseName">Warehouse Name</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control warehouseDescription" name="warehouse_description"
                             required>
                         <label for="warehouseDescription">Warehouse Description</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control abrr" name="abrr" required>
                         <label for="warehouseDescription">ABBR</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-success float-end" name="addWarehouse">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 {{-- EDIT WAREHOUSE --}}
 <div class="modal fade" id="editWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="warehouseTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="warehouseTitle">Edit Warehouse</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body  ">

                 <form class="row g-3" action="/updateWarehouse" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')
                     <div class="col-md-12 form-floating">
                         <input type="hidden" name="warehouse_id" id="warehouseId">
                         <input type="text" class="form-control warehouseName" id="warehouseName" name="warehouse_name" required>
                         <label for="warehouseName">Warehouse Name</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control warehouseDescription" id ="warehouseDescription" name="warehouse_description"
                             required>
                         <label for="warehouseDescription">Warehouse Description</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control abrr" id ="Abrr" name="abrr" required>
                         <label for="warehouseDescription">ABBR</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-success float-end" name="editWarehouse">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>


  {{-- DELETE WAREHOUSE --}}
  <div>
    <div id="deleteWarehouseModal" class="modal fade">
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
                <form class="row g-3" action="/deleteWarehouse" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    @method('PATCH')

                    <div class="modal-body">
                        <input type="hidden" class="warehouseId" name="warehouse_id">
                        <p>Do you really want to delete these warehouse ? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                </form>
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
