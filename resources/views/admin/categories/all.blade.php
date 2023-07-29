@component('admin.layouts.content', ['title' => 'Categories panel'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin/users/create">Create user</a></li>
        <li class="breadcrumb-item"><a href="/admin">Control panel</a></li>
        <li class="breadcrumb-item active">Categories panel</li>
    @endslot

    @slot('head')
        <style>
            li.list-group-item > ul.list-group {
                margin-top: 10px;
            }
        </style>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories list</h3>

                    <div class="card-tools d-flex align-items-center">
                        <div>
                            <a href="{{ request()->fullUrlWithQuery(['parent' => 'parent']) }}"
                               class="btn btn-primary btn-sm mr-1">Parent categories</a>
                            <a href="{{ request()->fullUrlWithQuery(['parent' => 'child']) }}"
                               class="btn btn-primary btn-sm mr-3">child categories</a>
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
                    @include('admin.layouts.categories-group' , ['categories' => $categories])
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $categories->appends(['search' => request('search') ])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
