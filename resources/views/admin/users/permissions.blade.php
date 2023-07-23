@component('admin.layouts.content', ['title' => 'Save permission'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">Create user</li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item"><a href="/admin/users">Users panel</a></li>
    @endslot

    @slot('script')
        <script>
            $('#rules').select2({
                'placeholder' : 'Please select your positions'
            })
            $('#permissions').select2({
                'placeholder' : 'Please select your permissions'
            })
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Save permission for users</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.users.permissions.store', $user->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Permissions</label>
                        <select class="form-control" name="permissions[]" id="permissions" multiple>
                            @foreach (App\Models\Permission::all() as $permission)
                                <option value="{{ $permission->id }}" {{ in_array($permission->id , $user->permissions->pluck('id')->toArray() ) ? 'selected' : '' }}>{{ $permission->name }}
                                    - {{ $permission->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Rules</label>
                        <select class="form-control" name="rules[]" id="rules" multiple>
                            @foreach (App\Models\Rule::all() as $rule)
                                <option value="{{ $rule->id }}" {{ in_array($rule->id , $user->rules->pluck('id')->toArray() ) ? 'selected' : '' }}>{{ $rule->name }}
                                    - {{ $rule->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-left mr-2" style="width: 150px;">
                            Save position
                        </button>
                        <a href="{{ route('admin.rule.index') }}" class="btn btn-default float-left">Cancel</a>
                    </div>
{{--            </div>--}}
            </form>
        </div>
    </div>
    </div>
@endcomponent
