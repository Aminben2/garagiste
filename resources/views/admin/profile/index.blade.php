@extends('layouts.index')
@section('content')
    @component('admin.components.break-crump', ['title' => 'Admin Profile', 'page' => 'Edit', 'subpage' => ''])
    @endcomponent
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">

                    @component('admin.profile.components.update-profile-form', ['user' => $user])
                    @endcomponent
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @component('admin.profile.components.reset-password-form')
                    @endcomponent
                </div>
            </div>
        </div>
        <script>
            // Smoothly show the success alert
            document.getElementById('successAlert').style.opacity = 1;

            // Smoothly hide the success alert after 5 seconds
            setTimeout(function() {
                document.getElementById('successAlert').style.opacity = 0;
                setTimeout(function() {
                    document.getElementById('successAlert').style.display = 'none';
                }, 500);
            }, 5000);
        </script>
    </div>
@endsection
