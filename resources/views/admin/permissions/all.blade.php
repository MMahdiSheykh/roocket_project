@component('admin.layouts.content', ['title' => 'Accesses'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin/users/create">Create user</a></li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item active">Users panel</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Accesses</h3>

                    <div class="card-tools d-flex align-items-center">
                        <div>
                            <a href="{{ route('admin.permission.create') }}" class="btn btn-primary btn-sm mr-1">Create new access</a>
                        </div>
                        <form action="" method="get">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Search"
                                    value="{{ request('search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default" style="height: 31px">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>Access type</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @foreach ($permissions as $permission)
                            <tbody>
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->label }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.permission.edit', $permission->id) }}"
                                            class="btn btn-md btn-outline-primary mr-2">Edit</a>
                                        <form action="{{ route('admin.permission.destroy', $permission->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $permissions->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
