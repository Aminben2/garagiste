@extends('admin.index')
@section('content')

    @component('admin.components.break-crump', [
        'title' => 'User Management',
        'page' => 'Users',
        'subpage' => 'Clients',
    ])
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
                @component('admin.components.search-bar', ['route' => route('clients'), 'searchItem' => 'Client'])
                @endcomponent
                <div class="ms-auto">
                    <a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>Add New
                        Client</a>
                </div>
            </div>
            @if (count($clients) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Client#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>address</th>
                                <th>View Invoices</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $client->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $client->username }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>
                                        <a href="{{ route('client.invoices', ['client' => $client]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.details', ['user' => $client]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('users.edit', ['user' => $client]) }}" class=""><i
                                                    class='bx bxs-edit'></i></a>
                                            <form method="POST" action="{{ route('users.destroy', ['user' => $client]) }}"
                                                class="ms-3 d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $client->id }}" class="btn p-0">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $client->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $client->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{ $client->id }}">Modal title
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
                    <div class="text-white">There are no Clients!</div>
                </div>
            @endif
        </div>
    </div>
@endsection
