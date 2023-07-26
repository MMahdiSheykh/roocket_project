@component('admin.layouts.content', ['title' => 'Comments panel'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin/users/create">Create user</a></li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item active">Comments panel</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Comments list</h3>

                    <div class="card-tools d-flex align-items-center">
                        <div>
                            <a href="{{ request()->fullUrlWithQuery(['approved' => 1]) }}"
                               class="btn btn-primary btn-sm mr-1">Approved</a>
                            <a href="{{ request()->fullUrlWithQuery(['approved' => 0]) }}"
                               class="btn btn-primary btn-sm mr-3">Unapproved</a>
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
                            <th>User ID</th>
                            <th>Parent ID</th>
                            <th>Reference</th>
                            <th>Content</th>
                            <th>Approved</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        @foreach ($comments as $comment)
                            <tbody>
                            <tr>
                                <td>{{ $comment->user_id }}</td>
                                <td>{{ $comment->parent_id }}</td>
                                <td>{{ $comment->commentable_id }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ $comment->approved }}</td>
{{--                                @if ($comment-> != null)--}}
{{--                                    <td>--}}
{{--                                            <span class="badge badge-success">Verified at--}}
{{--                                                {{ $user->email_verified_at->format('Y/m/d') }}</span>--}}
{{--                                    </td>--}}
{{--                                @else--}}
{{--                                    <td>--}}
{{--                                        <span class="badge badge-danger">Not verified</span>--}}
{{--                                    </td>--}}
{{--                                @endif--}}
                                <td class="d-flex">
{{--                                    @can('see-permission-button')--}}
{{--                                        @if(($user->is_staff == 1))--}}
{{--                                            <a href="{{ route('admin.users.permissions', $user->id) }}"--}}
{{--                                               class="btn btn-md btn-outline-secondary mr-2">Permissions</a>--}}
{{--                                        @endif--}}
{{--                                    @endcan--}}
{{--                                    @can('edit-user')--}}
                                        <a href="{{ route('admin.comments.update', $comment->id) }}"
                                           class="btn btn-md btn-outline-primary mr-2">Approve</a>
{{--                                    @endcan--}}
{{--                                    @can('delete-user')--}}
                                        <form action="{{ route('admin.comments.destroy', ['comment' => $comment->id]) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                                        </form>
{{--                                    @endcan--}}
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $comments->appends(['search' => request('search') ])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
