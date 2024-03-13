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
                <div class="position-relative">
                    <form method="GET" action="{{ route('users') }}">
                        <input type="text" name="search" class="form-control ps-5 radius-30" placeholder="Search User"
                            value="{{ request()->input('search') }}">
                        <button type="submit" class="d-none"></button> <!-- to submit the form -->
                        <span class="position-absolute top-50 product-show translate-middle-y"><i
                                class="bx bx-search"></i></span>
                        @if (request()->filled('search'))
                            <!-- Check if search query exists -->
                            <button type="button"
                                class="position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent me-1"
                                onclick="clearSearch()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-x text-primary">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        @endif
                    </form>
                </div>

                <div class="ms-auto"><a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>Add New User</a></div>
            </div>
            @if (count($users) > 0)
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
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $user->id }}" class="btn p-0">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $user->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{ $user->id }}">Modal title
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Are you sure you want to delete this
                                                                user?</div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">There are no users!</div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function clearSearch() {
            window.location.href = "{{ route('users') }}"; // Redirect to the same route to clear the search query
        }
    </script>
@endsection
