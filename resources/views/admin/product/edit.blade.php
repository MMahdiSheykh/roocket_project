@component('admin.layouts.content', ['title' => 'Edit product'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">Create product</li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item"><a href="/admin/users">Products panel</a></li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.product.update', $product->id) }}"
                      method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                       placeholder="Enter name of product" value="{{ old('name', $product->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" id="inputEmail3"
                                       placeholder="Enter description of product" value="{{ old('product', $product->description) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" name="price" class="form-control" id="inputEmail3"
                                       placeholder="Enter new price" value="{{ old('price', $product->price) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Inventory</label>
                            <div class="col-sm-10">
                                <input type="number" name="inventory" class="form-control"
                                       id="inputPassword3"
                                       placeholder="Enter new inventory" value="{{ old('inventory', $product->inventory) }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-left mr-2" style="width: 90px;">Edit
                        </button>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-default float-left">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
