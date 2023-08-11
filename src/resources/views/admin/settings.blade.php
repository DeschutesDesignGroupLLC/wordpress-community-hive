@extends('layouts.admin', [
    'title' => 'Community Hive Settings'
])

@section('content')
    <div class='flex flex-col justify-center items-center space space-y-6 py-4 max-w-4xl mx-auto'>
        <div class='text-3xl font-bold tracking-tight leading-6 text-secondary'>Community Hive Content</div>

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
            <div class='text-base text-black font-light leading-6 text-center'>
                Community Hive allows your members to follow their favorite communities to receive updates.
            </div>

            <form action='admin-post.php' method='POST'>
                <input type='hidden' name='action' value='community_hive_activate_community'>
                <button type="submit" class="rounded-md bg-primary hover:bg-primary/90 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Activate Community</button>
            </form>
        @else
            <div class='text-base text-black font-light leading-6 text-center'>
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