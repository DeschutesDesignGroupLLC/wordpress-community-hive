@extends('admin.layout', [
    'title' => 'Community Hive Settings',
])

@section('content')
    <div class='ch-flex ch-flex-col ch-justify-center ch-items-center space ch-space-y-6 ch-py-4 ch-max-w-4xl ch-mx-auto'>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 341.7 64" class='ch-max-w-md'>
            <path fill="#2a9c66"
                d="M0 32.2C-.1 14.5 14.2.1 31.9.1h22.2v25.8H42V3.6h-6.4c-.7 0-1.4.2-2 .4h.1c-2.2.9-3.7 3.1-3.7 5.6v44.9c0 3.3 2.7 6 6 6h6.1V38.2h12.1V64H32.3C14.7 63.9.1 49.9 0 32.2Z">
            </path>
            <path fill="#2a9c66" d="M33.6 4c.6-.3 1.3-.4 2-.4-.6 0-1.3.2-2 .4ZM66.3 63.9V0h6.1c3.3 0 6 2.7 6 6v51.9c0 3.3-2.7 6-6 6h-6.1Z"></path>
            <path fill="#18203D"
                d="M95.3 13.4c0-7.6 5.8-13 13.7-13 4.4 0 8 1.6 10.4 4.5l-3.7 3.5c-1.7-1.9-3.8-3-6.3-3-4.7 0-8.1 3.3-8.1 8.1s3.3 8.1 8.1 8.1c2.5 0 4.6-1 6.3-3l3.7 3.5c-2.4 2.9-6 4.5-10.4 4.5-7.9-.2-13.7-5.6-13.7-13.2ZM121.7 13.4c0-7.5 5.8-13 13.8-13s13.8 5.5 13.8 13-5.9 13-13.8 13-13.8-5.5-13.8-13Zm21.6 0c0-4.8-3.4-8.1-7.9-8.1s-7.9 3.3-7.9 8.1 3.4 8.1 7.9 8.1c4.6-.1 7.9-3.3 7.9-8.1ZM177.3 26V10.9l-7.4 12.5h-2.6l-7.4-12.1V26h-5.5V.8h4.8l9.4 15.7L177.9.8h4.8l.1 25.2h-5.5ZM212.3 26V10.9l-7.4 12.5h-2.6l-7.4-12.1V26h-5.5V.8h4.8l9.4 15.7L212.9.8h4.8l.1 25.2h-5.5ZM224.2 14.9V.8h5.8v13.9c0 4.8 2.1 6.8 5.6 6.8s5.6-2 5.6-6.8V.8h5.8v14.1c0 7.4-4.2 11.5-11.4 11.5s-11.4-4.1-11.4-11.5ZM276.5.8V26h-4.8l-12.6-15.3V26h-5.8V.8h4.8l12.5 15.3V.8h5.9ZM283.2.8h5.8V26h-5.8V.8ZM300.6 5.5h-8.1V.7h22v4.8h-8.1V26h-5.8V5.5ZM332 17.1V26h-5.8v-9L316.4.8h6.2l6.7 11.2L336 .8h5.7L332 17.1ZM118.4 38.5v25.2h-5.8V53.4h-11.4v10.3h-5.8V38.5h5.8v9.9h11.4v-9.9h5.8ZM125 38.5h5.8v25.2H125V38.5ZM161.7 38.5l-10.9 25.2H145l-10.9-25.2h6.3l7.7 18 7.8-18h5.8ZM184.6 59v4.7h-19.5V38.5h19v4.7h-13.2v5.5h11.7v4.5h-11.7V59h13.7Z">
            </path>
        </svg>

        @if (Cache::has('error'))
            <div class="ch-rounded-md ch-bg-red-50 ch-p-4">
                <div class="ch-flex">
                    <svg class="ch-h-5 ch-w-5 ch-text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="ch-ml-3">
                        <h3 class="ch-text-sm ch-font-medium ch-text-red-800 ch-my-0">{{ Cache::pull('error') }}</h3>
                    </div>
                </div>
            </div>
        @endif

        @if (Cache::has('message'))
            <div class="ch-rounded-md ch-bg-green-50 ch-p-4">
                <div class="ch-flex">
                    <svg class="ch-h-5 ch-w-5 ch-text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="ch-ml-3">
                        <h3 class="ch-text-sm ch-font-medium ch-text-green-800 ch-my-0">{{ Cache::pull('message') }}</h3>
                    </div>
                </div>
            </div>
        @endif

        @if (!$followPageSet)
            <div class='ch-text-sm sm:ch-text-base ch-text-black ch-font-light ch-leading-6 ch-text-center'>
                Community Hive requires a Follow Us page to be setup prior to activating your community. This page is intended to be a landing
                page when users click the 'Follow' button on Community Hive.
            </div>

            <div class='ch-text-sm sm:ch-text-base ch-font-medium ch-text-black ch-leading-6 ch-text-center'>
                To setup your Follow Us page, create a new page and place the following shortcode on the page. Once that is completed, click
                Next.
            </div>

            <form action='{{ route('settings.store', ['setup' => true], false) }}' method='post' class='ch-w-full'>
                <div class='ch-flex ch-flex-col ch-space-y-4'>
                    <div class='ch-flex ch-flex-row ch-space-x-2 ch-items-center ch-justify-center'>
                        <div class='ch-font-semibold'>Shortcode:</div>
                        <code class='ch-text-center'>[community_hive_follow]</code>
                    </div>
                    <div class='ch-flex ch-flex-col ch-justify-between'>
                        <label for="follow" class="ch-mx-auto ch-block ch-text-sm ch-font-medium ch-leading-6 ch-text-gray-900">Follow
                            Page</label>
                        <select id="follow" name="follow"
                            class="ch-mx-auto ch-block ch-w-full !ch-rounded-md ch-border-0 !ch-py-1.5 !ch-pl-3 !ch-text-secondary !ch-ring-1 ch-ring-inset ch-ring-gray-300 focus:ch-ring-2 focus:ch-ring-primary sm:ch-text-sm sm:ch-leading-6">
                            @foreach ($pages as $page)
                                <option @selected(get_option('community_hive_follow_page') === (string) $page->ID) value='{{ $page->ID }}'>{{ $page->post_title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="ch-border-none ch-w-full ch-mt-8 ch-rounded-md ch-bg-primary hover:ch-bg-primary/90 ch-px-3.5 ch-py-2.5 ch-text-sm ch-font-semibold ch-text-white ch-shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:ch-outline-primary ch-cursor-pointer">Next</button>
            </form>
        @else
            @if ($activated)
                <div class='ch-text-sm sm:ch-text-base ch-text-black ch-font-light ch-leading-6 ch-text-center'>
                    Community Hive allows your members to follow their favorite communities to receive updates.
                </div>

                <form action='{{ route('settings.index', [], false) }}' method='post' class='ch-w-full'>
                    <button type="submit"
                        class="ch-w-full ch-border-none ch-rounded-md ch-bg-primary hover:ch-bg-primary/90 ch-px-3.5 ch-py-2.5 ch-text-sm ch-font-semibold ch-text-white ch-shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:ch-outline-primary ch-cursor-pointer">Activate
                        Community</button>
                </form>
            @else
                <div class='ch-text-sm sm:ch-text-base ch-text-black ch-font-light ch-leading-6 ch-text-center'>
                    Choose which content types should be shown in Community Hive. User roles are always used when displaying content.
                </div>

                <form action='{{ route('settings.store', [], false) }}' method='post' class='ch-w-full'>
                    <div class='ch-flex ch-flex-col ch-space-y-4'>
                        <div class='ch-grid grid-row ch-grid-cols-1 md:ch-grid-cols-2 ch-gap-x-0 ch-gap-y-6 md:ch-gap-x-12'>
                            <div class='ch-flex ch-flex-col ch-justify-between'>
                                <label for="categories"
                                    class="ch-mx-auto ch-block ch-text-sm ch-font-medium ch-leading-6 ch-text-gray-900">Categories</label>
                                <select multiple id="categories" name="categories[]"
                                    class="ch-mx-auto ch-block ch-w-full !ch-rounded-md ch-border-0 !ch-py-1.5 !ch-pl-3 !ch-text-secondary !ch-ring-1 ch-ring-inset ch-ring-gray-300 focus:ch-ring-2 focus:ch-ring-primary sm:ch-text-sm sm:ch-leading-6">
                                    @foreach ($categories as $category)
                                        <option @selected(\in_array($category->term_taxonomy_id, explode(',', get_option('community_hive_categories')))) value='{{ $category->term_taxonomy_id }}'>{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class='ch-flex ch-flex-col ch-justify-between'>
                                <label for="tags"
                                    class="ch-mx-auto ch-block ch-text-sm ch-font-medium ch-leading-6 ch-text-gray-900">Tags</label>
                                <select multiple id="tags" name="tags[]"
                                    class="ch-mx-auto ch-block ch-w-full !ch-rounded-md ch-border-0 !ch-py-1.5 !ch-pl-3 !ch-text-secondary !ch-ring-1 ch-ring-inset ch-ring-gray-300 focus:ch-ring-2 focus:ch-ring-primary sm:ch-text-sm sm:ch-leading-6">
                                    @foreach ($tags as $tag)
                                        <option @selected(\in_array($tag->term_taxonomy_id, explode(',', get_option('community_hive_tags')))) value='{{ $tag->term_taxonomy_id }}'>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='ch-flex ch-flex-col ch-justify-between'>
                                <label for="login" class="ch-mx-auto ch-block ch-text-sm ch-font-medium ch-leading-6 ch-text-gray-900">Login
                                    Page</label>
                                <select id="login" name="login"
                                    class="ch-mx-auto ch-block ch-w-full !ch-rounded-md ch-border-0 !ch-py-1.5 !ch-pl-3 !ch-text-secondary !ch-ring-1 ch-ring-inset ch-ring-gray-300 focus:ch-ring-2 focus:ch-ring-primary sm:ch-text-sm sm:ch-leading-6">
                                    <option value=''>Use Default Login Page</option>
                                    <option @selected(get_option('community_hive_login_page') === 'disabled') value='disabled'>Disable Login Link</option>
                                    @foreach ($pages as $page)
                                        <option @selected(get_option('community_hive_login_page') === (string) $page->ID) value='{{ $page->ID }}'>{{ $page->post_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='ch-flex ch-flex-col ch-justify-between'>
                                <label for="registration"
                                    class="ch-mx-auto ch-block ch-text-sm ch-font-medium ch-leading-6 ch-text-gray-900">Registration
                                    Page</label>
                                <select id="registration" name="registration"
                                    class="ch-mx-auto ch-block ch-w-full !ch-rounded-md ch-border-0 !ch-py-1.5 !ch-pl-3 !ch-text-secondary !ch-ring-1 ch-ring-inset ch-ring-gray-300 focus:ch-ring-2 focus:ch-ring-primary sm:ch-text-sm sm:ch-leading-6">
                                    <option value=''>Use Default Registration Page</option>
                                    <option @selected(get_option('community_hive_registration_page') === 'disabled') value='disabled'>Disable Registration Link</option>
                                    @foreach ($pages as $page)
                                        <option @selected(get_option('community_hive_registration_page') === (string) $page->ID) value='{{ $page->ID }}'>{{ $page->post_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='ch-flex ch-flex-col ch-justify-between'>
                                <label for="follow" class="ch-mx-auto ch-block ch-text-sm ch-font-medium ch-leading-6 ch-text-gray-900">Follow
                                    Page</label>
                                <select id="follow" name="follow"
                                    class="ch-mx-auto ch-block ch-w-full !ch-rounded-md ch-border-0 !ch-py-1.5 !ch-pl-3 !ch-text-secondary !ch-ring-1 ch-ring-inset ch-ring-gray-300 focus:ch-ring-2 focus:ch-ring-primary sm:ch-text-sm sm:ch-leading-6">
                                    @foreach ($pages as $page)
                                        <option @selected(get_option('community_hive_follow_page') === (string) $page->ID) value='{{ $page->ID }}'>{{ $page->post_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="ch-border-none ch-w-full ch-mt-8 ch-rounded-md ch-bg-primary hover:ch-bg-primary/90 ch-px-3.5 ch-py-2.5 ch-text-sm ch-font-semibold ch-text-white ch-shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:ch-outline-primary ch-cursor-pointer">Save
                        Settings</button>
                </form>
            @endif
        @endif
    </div>
@endsection
