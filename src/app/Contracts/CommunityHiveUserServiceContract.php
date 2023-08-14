<?php

namespace CommunityHive\App\Contracts;

use CommunityHive\App\Models\User;

interface CommunityHiveUserServiceContract
{
    public function syncUsers(array $data = []): array;

    public function unfollowUser($userId = null): void;

    public function groupHashForUser(User $user = null): string;
}
