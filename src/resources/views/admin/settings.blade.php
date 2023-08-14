@extends('layouts.admin', [
    'title' => 'Community Hive Settings'
])

@section('content')
    <div class='flex flex-col justify-center items-center space space-y-6 py-4 max-w-4xl mx-auto'>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 341.7 64" class='w-1/4'>
            <path fill="#2a9c66"
                  d="M0 32.2C-.1 14.5 14.2.1 31.9.1h22.2v25.8H42V3.6h-6.4c-.7 0-1.4.2-2 .4h.1c-2.2.9-3.7 3.1-3.7 5.6v44.9c0 3.3 2.7 6 6 6h6.1V38.2h12.1V64H32.3C14.7 63.9.1 49.9 0 32.2Z"></path>
            <path fill="#2a9c66"
                  d="M33.6 4c.6-.3 1.3-.4 2-.4-.6 0-1.3.2-2 .4ZM66.3 63.9V0h6.1c3.3 0 6 2.7 6 6v51.9c0 3.3-2.7 6-6 6h-6.1Z"></path>
            <path fill="#18203D"
                  d="M95.3 13.4c0-7.6 5.8-13 13.7-13 4.4 0 8 1.6 10.4 4.5l-3.7 3.5c-1.7-1.9-3.8-3-6.3-3-4.7 0-8.1 3.3-8.1 8.1s3.3 8.1 8.1 8.1c2.5 0 4.6-1 6.3-3l3.7 3.5c-2.4 2.9-6 4.5-10.4 4.5-7.9-.2-13.7-5.6-13.7-13.2ZM121.7 13.4c0-7.5 5.8-13 13.8-13s13.8 5.5 13.8 13-5.9 13-13.8 13-13.8-5.5-13.8-13Zm21.6 0c0-4.8-3.4-8.1-7.9-8.1s-7.9 3.3-7.9 8.1 3.4 8.1 7.9 8.1c4.6-.1 7.9-3.3 7.9-8.1ZM177.3 26V10.9l-7.4 12.5h-2.6l-7.4-12.1V26h-5.5V.8h4.8l9.4 15.7L177.9.8h4.8l.1 25.2h-5.5ZM212.3 26V10.9l-7.4 12.5h-2.6l-7.4-12.1V26h-5.5V.8h4.8l9.4 15.7L212.9.8h4.8l.1 25.2h-5.5ZM224.2 14.9V.8h5.8v13.9c0 4.8 2.1 6.8 5.6 6.8s5.6-2 5.6-6.8V.8h5.8v14.1c0 7.4-4.2 11.5-11.4 11.5s-11.4-4.1-11.4-11.5ZM276.5.8V26h-4.8l-12.6-15.3V26h-5.8V.8h4.8l12.5 15.3V.8h5.9ZM283.2.8h5.8V26h-5.8V.8ZM300.6 5.5h-8.1V.7h22v4.8h-8.1V26h-5.8V5.5ZM332 17.1V26h-5.8v-9L316.4.8h6.2l6.7 11.2L336 .8h5.7L332 17.1ZM118.4 38.5v25.2h-5.8V53.4h-11.4v10.3h-5.8V38.5h5.8v9.9h11.4v-9.9h5.8ZM125 38.5h5.8v25.2H125V38.5ZM161.7 38.5l-10.9 25.2H145l-10.9-25.2h6.3l7.7 18 7.8-18h5.8ZM184.6 59v4.7h-19.5V38.5h19v4.7h-13.2v5.5h11.7v4.5h-11.7V59h13.7Z"></path>
        </svg>

        @if(\Illuminate\Support\Facades\Cache::has('error'))
            <div class="rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">{{ \Illuminate\Support\Facades\Cache::pull('error') }}</h3>
                    </div>
                </div>
            </div>
        @endif

        @if(!$activated)
            <div class='text-sm sm:text-base text-black font-light leading-6 text-center'>
                Community Hive allows your members to follow their favorite communities to receive updates.
            </div>

            <form action='admin-post.php' method='POST'>
                <input type='hidden' name='action' value='community_hive_activate_community'>
                <button type="submit" class="rounded-md bg-primary hover:bg-primary/90 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Activate Community</button>
            </form>
        @else
            <div class='text-sm sm:text-base text-black font-light leading-6 text-center'>
                Choose which content types should be shown in Community Hive. User roles are always used when displaying content.
            </div>

            <form action='admin-post.php' method='POST' class='form w-full'>
                <input type='hidden' name='action' value='community_hive_save_settings'>

                <div class='grid grid-row grid-cols-1 md:grid-cols-2 gap-6 md:gap-12'>
                    <div class='flex flex-col justify-between'>
                        <label for="categories" class="mx-auto block text-sm font-medium leading-6 text-gray-900">Categories</label>
                        <select multiple id="categories" name="categories[]" class="mx-auto !form-multiselect !block !w-full !rounded-md !border-0 py-1.5 pl-3 !text-secondary !ring-1 !ring-inset !ring-gray-300 !focus:ring-2 !focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @foreach($categories as $category)
                                <option @selected(\in_array($category->term_taxonomy_id, $categories_selected)) value='{{ $category->term_taxonomy_id }}'>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class='flex flex-col justify-between'>
                        <label for="tags" class="mx-auto block text-sm font-medium leading-6 text-gray-900">Tags</label>
                        <select multiple id="tags" name="tags[]" class="mx-auto !form-multiselect !block !w-full !rounded-md !border-0 py-1.5 pl-3 !text-secondary !ring-1 !ring-inset !ring-gray-300 !focus:ring-2 !focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @foreach($tags as $tag)
                                <option @selected(\in_array($tag->term_taxonomy_id, $tags_selected)) value='{{ $tag->term_taxonomy_id }}'>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full mt-8 rounded-md bg-primary hover:bg-primary/90 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Save Settings</button>
            </form>
        @endif
    </div>
@endsection