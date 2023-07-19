@component('admin.layouts.content', ['title' => 'Edit user'])
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
                    <h3 class="card-title">Edit user</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.users.update', ['user' => $user->id]) }}"
                      method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                       placeholder="Enter name of user" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="inputEmail3"
                                       placeholder="Enter email of user" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="inputPassword3"
                                       placeholder="Enter new password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">password confirmation</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" class="form-control"
                                       id="inputPassword3"
                                       placeholder="Confirm new password">
                            </div>
                        </div>
                        @if(is_null($user->email_verified_at))
                            <div class="form-group row">
                                <div class="form-check ml-2">
                                    <input type="checkbox" name="verify" class="form-check-input" id="verify">
                                    <label class="form-check-label" for="verify">The account has been activated</label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-left mr-2" style="width: 90px;">Edit
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default float-left">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
