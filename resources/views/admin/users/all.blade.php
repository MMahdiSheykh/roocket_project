@component('admin.layouts.content', ['title' => 'Users panel'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin/users/create">Create user</a></li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item active">Users panel</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users list</h3>

                    <div class="card-tools d-flex align-items-center">
                        <div>
                            @can('see-admin-button')
                                <a href="{{ request()->fullUrlWithQuery(['admin' => 1]) }}"
                                   class="btn btn-primary btn-sm mr-1">Admins</a>
                            @endcan
                            @can('see-staff-button')
                                <a href="{{ request()->fullUrlWithQuery(['staff' => 1]) }}"
                                   class="btn btn-primary btn-sm mr-3">Staffs</a>
                            @endcan
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Email status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        @foreach ($users as $user)
                            <tbody>
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if ($user->email_verified_at != null)
                                    <td>
                                            <span class="badge badge-success">Verified at
                                                {{ $user->email_verified_at->format('Y/m/d') }}</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge badge-danger">Not verified</span>
                                    </td>
                                @endif
                                <td class="d-flex">
                                    @can('see-permission-button')
                                        @if(($user->is_staff == 1))
                                            <a href="{{ route('admin.users.permissions', $user->id) }}"
                                               class="btn btn-md btn-outline-secondary mr-2">Permissions</a>
                                        @endif
                                    @endcan
                                    @can('edit-user')
                                        <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                           class="btn btn-md btn-outline-primary mr-2">Edit</a>
                                    @endcan
                                    @can('delete-user')
                                        <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
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
                    {{ $users->appends(['search' => request('search') ])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
