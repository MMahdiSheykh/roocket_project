@component('admin.layouts.content', ['title' => 'Create new permission'])
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
                    <h3 class="card-title">Creating a new permission</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.permission.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName3" class="col-sm-2 col-form-label">Permission name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                    placeholder="Enter your permission name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Permission label</label>
                            <div class="col-sm-10">
                                <input type="text" name="label" class="form-control" id="inputEmail3"
                                    placeholder="Enter your permission label">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-left mr-2" style="width: 150px;">
                            Save permission</button>
                            <a href="{{ route('admin.permission.index') }}" class="btn btn-default float-left">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
