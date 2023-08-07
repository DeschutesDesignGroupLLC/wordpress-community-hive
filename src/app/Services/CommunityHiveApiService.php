<?php

namespace CommunityHive\App\Services;

use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CommunityHiveApiService implements CommunityHiveApiServiceContract
{
    /**
     * @return array|mixed
     */
    public function callApi($endpoint): mixed
    {
        $response = Http::baseUrl('https://www.communityhive.com')->get($endpoint);

        if (! $response->successful()) {
            Log::error('community_hive_api_error', $response->json());
        }

        return $response->json();
    }
}
