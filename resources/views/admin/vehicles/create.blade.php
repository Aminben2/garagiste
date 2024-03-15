@extends('admin.index')
@section('content')
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Danger Alerts</h6>
                        <div class="text-white">{{ $errors->first() }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Create Vehicle</h5>
                    <form class="row g-3" method="post" action="{{ route('vehicles.store') }}">
                        <div class="col-md-12">
                            @csrf
                            <label for="input25" class="form-label">Make</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-car"></i></span>
                                <input name="make" type="text" class="form-control" id="input25"
                                    placeholder="First Name" value="{{ old('make') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Model</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-display"></i></span>
                                <input name="model" type="text" class="form-control" id="input26"
                                    placeholder="Last Name" value="{{ old('model') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Fuel TYpe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-droplet"></i></span>
                                <input name="fuelType" type="text" class="form-control" id="input26"
                                    placeholder="fuelType" value="{{ old('fuelType') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Registration</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                <input name="registration" type="text" class="form-control" id="input27"
                                    placeholder="registration" value="{{ old('registration') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input28" class="form-label">Select User</label>
                            <input name="user_id" class="form-control" list="users" id="input28"
                                placeholder="Start typing to filter users..." oninput="updateUserId()">
                            <datalist id="users">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" data-user-id="{{ $user->id }}">
                                        {{ $user->username }}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                <button type="reset" class="btn btn-light px-4">Reset</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <script>
            function updateUserId() {
                var input = document.getElementById('input28');
                var selectedOption = input.querySelector('option[value="' + input.value + '"]');
                if (selectedOption) {
                    var userId = selectedOption.getAttribute('data-user-id');
                    input.setAttribute('data-user-id', userId);
                } else {
                    input.removeAttribute('data-user-id');
                }
            }
            document.getElementById('input28').addEventListener('input', function() {
                var input, filter, datalist, options, i;
                input = this;
                filter = input.value.toUpperCase();
                datalist = document.getElementById('users');
                options = datalist.getElementsByTagName('option');
                for (i = 0; i < options.length; i++) {
                    if (options[i].value.toUpperCase().indexOf(filter) > -1) {
                        options[i].style.display = "";
                    } else {
                        options[i].style.display = "none";
                    }
                }
            });
        </script>

    </div>
@endsection
