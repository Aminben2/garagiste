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
                <li> <a href="index.html"><i class="bx bx-radio-circle"></i>Default</a>
                </li>
                <li> <a href="index2.html"><i class="bx bx-radio-circle"></i>Alternate</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
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

    </ul>
    <!--end navigation-->
</div>
