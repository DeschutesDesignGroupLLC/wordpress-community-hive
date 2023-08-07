<?php

namespace CommunityHive\App\Contracts;

interface CommunityHiveApiServiceContract
{
    /**
     * @return array|mixed
     */
    public function callApi($endpoint): mixed;
}
