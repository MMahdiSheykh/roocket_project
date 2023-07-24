@component('admin.layouts.content', ['title' => 'Create new product'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">Create product</li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item"><a href="/admin/users">Users panel</a></li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Creating a new product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.product.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName3" class="col-sm-2 col-form-label">Product name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                       placeholder="Enter your product name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" id="inputEmail3"
                                       placeholder="Enter your product description">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" id="inputPassword3"
                                       placeholder="Enter your product price">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-left mr-2"
                                    style="width: 130px;">Save product
                            </button>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-default float-left">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
