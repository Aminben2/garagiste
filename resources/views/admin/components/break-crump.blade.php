@props(['title', 'page', 'subpage'])
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{ $title }}</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page }}</li>
                @if (!empty('subpage'))
                    <li class="breadcrumb-item active" aria-current="page">{{ $subpage }}</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary">Settings</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                <a class="dropdown-item" href="javascript:;">Manage users</a>
                <a class="dropdown-item" href="javascript:;">Manage roles</a>
                <a class="dropdown-item" href="javascript:;">Manage permissions</a>
                {{-- <a class="dropdown-item" href="javascript:;" onclick="window.location.href = '{{ route('user.index') }}'">Manage users</a>
                <a class="dropdown-item" href="javascript:;" onclick="window.location.href = '{{ route('role.index') }}'">Manage roles</a>
                <a class="dropdown-item" href="javascript:;" onclick="window.location.href = '{{ route('permission.index') }}'">Manage permissions</a> --}}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:;">Backup data</a>
                <a class="dropdown-item" href="javascript:;">Refresh page</a>
            </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->
