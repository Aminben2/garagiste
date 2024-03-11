@extends('admin.index')
@section('content')
    <div class="card">
        @if (!empty(session('status')))
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Success</h6>
                        <div class="text-white">{{ session('status') }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <input type="text" class="form-control ps-5 radius-30" placeholder="Search User"> <span
                        class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                </div>
                <div class="ms-auto"><a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>Add New User</a></div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
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
                    <tbody>
                        @if (count($users) > 0)
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
                                                    <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}" class="ms-3 d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}" class="btn p-0">
                                                            <i class="bx bxs-trash text-danger"></i>
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel{{ $user->id }}">Modal title</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">Are you sure you want to delete this user?</div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                                <div class="text-white">There are no users!</div>
                            </div>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
