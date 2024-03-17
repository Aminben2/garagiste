<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Dashrock</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bx bx-arrow-back"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                @foreach (auth()->user()->roles->pluck('name')->toArray() as $role)
                    @if ($role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}"><i class="bx bx-radio-circle"></i>Admin
                                Dashboard</a>
                        </li>
                    @endif
                    @if ($role === 'client')
                        <li>
                            <a href="{{ route('dashboard') }}"><i class="bx bx-radio-circle"></i>Client Dashboard</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">

                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User management</div>
            </a>
            <ul>
                <li> <a href="{{ route('users') }}"><i class="bx bx-radio-circle"></i>Users</a>
                </li>
                <li> <a href="{{ route('users.create') }}"><i class="bx bx-radio-circle"></i>Add user</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"> <i class="lni lni-car-alt"></i>
                </div>
                <div class="menu-title">Vehicle management</div>
            </a>
            <ul>
                <li> <a href="{{ route('vehicles') }}"><i class="bx bx-radio-circle"></i>Vehicles</a>
                </li>
                <li> <a href="{{ route('vehicles.create') }}"><i class="bx bx-radio-circle"></i>Add Vehicle</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Spare Parts</div>
            </a>
            <ul>
                <li> <a href="{{ route('spare-parts') }}"><i class="bx bx-radio-circle"></i>Spare parts</a>
                </li>
                <li> <a href="{{ route('spare-parts.create') }}"><i class="bx bx-radio-circle"></i>Add Part</a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
