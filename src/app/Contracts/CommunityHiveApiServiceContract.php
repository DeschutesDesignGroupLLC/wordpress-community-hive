<?php

namespace CommunityHive\App\Contracts;

interface CommunityHiveApiServiceContract
{
    public function callApi(string $endpoint, array $data = []): mixed;
}
