@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Add New User</h5>
                    <form class="row g-3">
                        <div class="col-md-12 " method="post" action="{{ route('users.store') }}">
                            <label for="input25" class="form-label">First Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input name="firstName" type="text" class="form-control" id="input25"
                                    placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Last Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input name="lastName" type="text" class="form-control" id="input26"
                                    placeholder="Last Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                <input name="email" type="text" class="form-control" id="input27"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input28" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                                <input name="password" type="password" class="form-control" id="input28"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input29" class="form-label">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-microphone'></i></span>
                                <input name="phoneNumber" type="text" class="form-control" id="input29"
                                    placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input30" class="form-label">Role</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-flag'></i></span>
                                <select name="role" class="form-select" id="input30">
                                    <option selected>Open this select menu</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Mechanic</option>
                                    <option value="3">Client</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="input32" class="form-label">Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-buildings'></i></span>
                                <input name="address" type="text" class="form-control" id="input32"
                                    placeholder="Address">
                            </div>
                        </div>

                        <div class="col-md-12">
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
    </div>
@endsection
