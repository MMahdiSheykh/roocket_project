@component('admin.layouts.content', ['title' => 'Control panel'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">Control panel</li>
        <li class="breadcrumb-item"><a href="/admin/users">Users list</a></li>
    @endslot

    <h2>Control panel</h2>
@endcomponent
