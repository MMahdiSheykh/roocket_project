@component('admin.layouts.content', ['title' => 'Edit category'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">Edit user</li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item"><a href="/admin/users">Users panel</a></li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editing a category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.categories.update', $category->id) }}"
                      method="POST">
                    @csrf
                    @method('patch')

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName3" class="col-sm-2 col-form-label">category name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                       placeholder="Enter your category name"
                                       value="{{ old('name', $category->name) }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-left mr-2" style="width: 150px;">
                                Edit category
                            </button>
                            <a href="{{ route('admin.categories.index') }}"
                               class="btn btn-default float-left">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
