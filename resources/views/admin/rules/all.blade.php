@component('admin.layouts.content', ['title' => 'Positions'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin/users/create">Create user</a></li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item active">Users panel</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of positions</h3>

                    <div class="card-tools d-flex align-items-center">
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
                        @foreach ($rules as $rule)
                            <tbody>
                            <tr>
                                <td>{{ $rule->name }}</td>
                                <td>{{ $rule->label }}</td>
                                <td class="d-flex">
                                    @can('edit-position')
                                        <a href="{{ route('admin.rule.edit', $rule->id) }}"
                                           class="btn btn-md btn-outline-primary mr-2">Edit</a>
                                    @endcan
                                    @can('delete-position')
                                        <form action="{{ route('admin.rule.destroy', $rule->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $rules->appends(['search' => request('search') ])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
