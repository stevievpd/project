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
                         <input type="text" name="prod_id" id="prodId">
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
                             <option value="0" selected>- Select -</option>
                             @foreach ($category as $cat)
                                 <option value="{{ $cat->cat_id }}">{{ $cat->category_name }}</option>
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
