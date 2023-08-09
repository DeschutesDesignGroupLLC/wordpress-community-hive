@extends('layouts.admin', [
    'title' => 'Community Hive Settings'
])

@section('content')
    <div class='flex flex-col justify-center items-center space space-y-6 py-4'>
        <div class='text-3xl font-bold tracking-tight leading-6 text-slate-700'>Community Hive Content</div>

        <div class='text-base leading-6'>
            Community Hive allows your members to follow their favorite communities to receive updates.
        </div>

        @if(!$activated)
            <form action='admin-post.php' method='POST'>
                <input type='hidden' name='action' value='community_hive_activate_community'>
                <button type="submit" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Activate Community</button>
            </form>
        @else
            <form action='admin-post.php' method='POST'>
                <input type='hidden' name='action' value='community_hive_save_settings'>

                <fieldset>
                    <legend class="sr-only">Categories</legend>
                    <div class="space-y-5">
                        @foreach($categories as $category)
                            <div class="relative flex items-start">
                                <div class="flex h-6 items-center">
                                    <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="comments" class="font-medium text-gray-900">{{ $category->name }}</label>
                                    <p id="comments-description" class="text-gray-500">{{ $category->description && $category->description !== '' ? 'No description' : $category->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>

                <button type="submit" class="mt-4 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Save Settings</button>
            </form>
        @endif
    </div>
@endsection