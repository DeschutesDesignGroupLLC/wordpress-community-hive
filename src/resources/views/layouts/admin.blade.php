<link href="{{ asset('app.css') }}" rel="stylesheet">
<div class='font-montserrat my-5 mr-3 md:mr-5'>
    <h1 class='text-xl font-bold pb-4 text-black'>{{ $title ?? 'Settings' }}</h1>
    <div class='bg-white p-4 ring-1 ring-black ring-opacity-10 shadow-md rounded-md text-slate-600'>
        @yield('content')
        <hr class="h-px my-4 bg-gray-200 border-0">
        <div class='flex justify-center items-center space-x-4'>
            <a class='hover:text-secondary' href='https://www.communityhive.com/privacy' target='_blank'>Community Hive Privacy Policy</a>
            <a class='hover:text-secondary' href='https://www.communityhive.com/' target='_blank'>CommunityHive.com</a>
        </div>
    </div>
</div>
<script src="{{ asset('app.js') }}"></script>
