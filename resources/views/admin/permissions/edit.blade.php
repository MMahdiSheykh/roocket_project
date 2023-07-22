@component('admin.layouts.content', ['title' => 'Edit permission'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">Create user</li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item"><a href="/admin/users">Users panel</a></li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editing a permission</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.permission.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('patch')

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName3" class="col-sm-2 col-form-label">Permission name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                    placeholder="Enter your permission name" value="{{ old('name', $permission->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">label</label>
                            <div class="col-sm-10">
                                <input type="text" name="label" class="form-control" id="inputEmail3"
                                    placeholder="Enter your permission label" value="{{ old('label', $permission->label) }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-left mr-2" style="width: 150px;">
                            Edit permission</button>
                            <a href="{{ route('admin.permission.index') }}" class="btn btn-default float-left">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
