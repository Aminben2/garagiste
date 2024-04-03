@extends('admin.index')
@section('content')
    @component('admin.components.break-crump', ['title' => 'User Management', 'page' => 'Users', 'subpage' => ''])
    @endcomponent
    <div class="card">
        @if (!empty(session('status')))
            @component('admin.components.seccuss-alert', [
                'title' => __('Success Alerts'),
                'subTitle' => session('status'),
            ])
            @endcomponent
        @endif
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                @component('admin.components.search-bar', ['route' => route('users'), 'searchItem' => 'user'])
                @endcomponent
                <div class="ms-auto">
                    <a href="{{ route('invoices.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>Add New
                        User</a>
                </div>
                @component('admin.components.import-export-modal', [
                    'importRoute' => route('users.import'),
                    'title' => 'Users',
                    'exportRoute' => route('users.export'),
                ])
                @endcomponent
            </div>
            @if (count($users) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>User#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>address</th>
                                <th>Roles</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $user->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>

                                        @foreach ($user->roles as $role)
                                            @php
                                                $color = match ($role->id) {
                                                    1 => '#3b5998',
                                                    2 => '#3c8dbc',
                                                    3 => '#f56954',
                                                    default => '#0073b7',
                                            }; @endphp
                                            <span style="color: {{ $color }}">{{ $role->name }}, </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('user.details', ['user' => $user]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('users.edit', ['user' => $user]) }}" class=""><i
                                                    class='bx bxs-edit'></i></a>
                                            <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}"
                                                class="ms-3 d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    onclick="setDeleteFormAction('{{ route('users.destroy', ['user' => $user]) }}')"
                                                    class="btn p-0">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @component('admin.components.delete-modal')
                    @endcomponent
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">There are no users!</div>
                </div>
            @endif

        </div>
    </div>

@endsection
