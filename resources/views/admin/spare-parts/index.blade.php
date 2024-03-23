@extends('admin.index')
@section('content')

    @component('admin.components.break-crump', ['title' => 'Spare parts', 'page' => 'Spare parts', 'subpage' => ''])
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
                    <form method="GET" action="{{ route('spare-parts') }}">
                        <input type="text" name="search" class="form-control ps-5 radius-30" placeholder="Search Part"
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

                <div class="ms-auto"><a href="{{ route('spare-parts.create') }}"
                        class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Part</a>
                </div>
            </div>
            @if (count($spareParts) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Spare Part#</th>
                                <th>Name</th>
                                <th>Reference</th>
                                <th>Supplier</th>
                                <th>Price</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spareParts as $s)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" aria-label="..."
                                                    name="items[]" value="{{ $s->id }}">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $s->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $s->partName }}</td>
                                    <td>{{ $s->partReference }}</td>
                                    <td>{{ $s->supplier }}</td>
                                    <td>{{ $s->price }}</td>
                                    <td>
                                        <a href="{{ route('spare-part.details', ['spare_part' => $s]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('spare-parts.edit', ['spare_part' => $s]) }}"
                                                class=""><i class='bx bxs-edit'></i></a>
                                            <form method="POST"
                                                action="{{ route('spare-parts.destroy', ['spare_part' => $s]) }}"
                                                class="ms-3 d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $s->id }}" class="btn p-0">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $s->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $s->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{ $s->id }}">Confirm
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Are you sure you want to delete this
                                                                part?</div>
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
                    <div class="text-white">There are no spare-parts!</div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function clearSearch() {
            window.location.href = "{{ route('spare-parts') }}"; // Redirect to the same route to clear the search query
        }
    </script>


@endsection
