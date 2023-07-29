@component('admin.layouts.content', ['title' => 'Create new category'])
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
                    <h3 class="card-title">Creating a new category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName3" class="col-sm-2 col-form-label">Category name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                       placeholder="Enter your category name">
                            </div>
                            @if(request('parent_id'))
                                @php
                                    $parent = \App\Models\Category::find(request('parent_id'));
                                @endphp
                                <label for="inputEmail3" class="col-sm-2 col-form-label mt-3">Parent category</label>
                                <div class="col-sm-10 mt-3">
                                    <input type="text" class="form-control" id="inputEmail3" disabled
                                           value="{{ $parent->name }}">
                                    <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-left mr-2" style="width: 150px;">
                                Save category
                            </button>
                            <a href="{{ route('admin.categories.index') }}"
                               class="btn btn-default float-left">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
