@extends('layouts.admin', [
    'title' => 'Community Hive Settings'
])

@section('content')
    <div class='flex flex-col justify-center items-center space space-y-6 py-4 max-w-4xl mx-auto'>
        <div class='text-3xl font-bold tracking-tight leading-6 text-secondary'>Community Hive Content</div>

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