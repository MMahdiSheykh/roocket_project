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
                            <a href="{{ request()->fullUrlWithQuery(['approved' => 'approved']) }}"
                               class="btn btn-primary btn-sm mr-1">Approved</a>
                            <a href="{{ request()->fullUrlWithQuery(['approved' => 'unapproved']) }}"
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
                            <th>Commenter</th>
                            <th>Parent ID</th>
                            <th>Reference</th>
                            <th>Content</th>
                            <th>Approve</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        @foreach ($comments as $comment)
                            <tbody>
                            <tr>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->parent_id }}</td>
                                <td>{{ $comment->commentable_id }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>
                                    @if($comment->approved == 1)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Unapproved</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    @if($comment->approved == 0)
                                        <form action="{{ route('admin.comments.update', $comment->id) }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <button class="btn btn-primary mr-2" type="submit">Approve</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.comments.update', $comment->id) }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <button class="btn btn-outline-primary mr-2" type="submit">Not approve
                                            </button>
                                        </form>
                                    @endif
                                    <form
                                        action="{{ route('admin.comments.destroy', ['comment' => $comment->id]) }}"
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
                    {{ $comments->appends(['search' => request('search') ])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
