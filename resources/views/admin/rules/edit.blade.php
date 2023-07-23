@component('admin.layouts.content', ['title' => 'Edit position'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">Edit user</li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item"><a href="/admin/users">Users panel</a></li>
    @endslot

    @slot('script')
        <script>
            $('#permissions').select2({
                'placeholder': 'Please select your positions'
            })
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editing a position</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.rule.update', ['rule' => $rule->id]) }}"
                      method="POST">
                    @csrf
                    @method('patch')

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName3" class="col-sm-2 col-form-label">position name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                       placeholder="Enter your position name" value="{{ old('name', $rule->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">position label</label>
                            <div class="col-sm-10">
                                <input type="text" name="label" class="form-control" id="inputEmail3"
                                       placeholder="Enter your position label" value="{{ old('label', $rule->label) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">permissions</label>
                            <select class="form-control" name="permissions[]" id="permissions" multiple>
                                @foreach (App\Models\Permission::all() as $permission)
                                    <option
                                        value="{{ $permission->id }}" {{ in_array($permission->id , $rule->permissions->pluck('id')->toArray() ) ? 'selected' : '' }}>{{ $permission->name }}
                                        - {{ $permission->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-left mr-2" style="width: 150px;">
                                Edit position
                            </button>
                            <a href="{{ route('admin.rule.index') }}" class="btn btn-default float-left">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
