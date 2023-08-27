<link href="{{ asset('admin.css') }}" rel="stylesheet">
<div class='ch-font-montserrat ch-my-5 ch-mr-3 md:ch-mr-5'>
    <h1 class='ch-text-xl ch-font-bold ch-pb-4 ch-text-black'>{{ $title ?? 'Settings' }}</h1>
    <div class='ch-bg-white ch-p-4 ch-ring-1 ch-ring-black ch-ring-opacity-10 ch-shadow-md ch-rounded-md text-slate-600'>
        @yield('content')
        <hr class="ch-h-px ch-my-4 ch-bg-gray-200 ch-border-0">
        <div class='ch-flex ch-justify-center ch-items-center ch-space-x-4'>
            <a class='ch-text-secondary hover:ch-text-gray-500' href='https://www.communityhive.com/privacy' target='_blank'>Community Hive
                Privacy Policy</a>
            <a class='ch-text-secondary hover:ch-text-gray-500' href='https://www.communityhive.com/' target='_blank'>CommunityHive.com</a>
        </div>
    </div>
</div>
<script src="{{ asset('admin.js') }}"></script>
