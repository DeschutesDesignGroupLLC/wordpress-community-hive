<?php

namespace CommunityHive\App\Services;

use CommunityHive\App\Contracts\CommunityHiveUserServiceContract;
use CommunityHive\App\Models\Subscription;
use CommunityHive\App\Models\User;

class CommunityHiveUserService implements CommunityHiveUserServiceContract
{
    public function syncUsers(array $data = []): array
    {
        $response = [];
        $seen = [];
        $userIds = array_keys($data);

        User::query()->whereIn('id', $userIds)->each(function (User $user) use ($data, &$response, &$seen) {
            $groupHash = $this->groupHashForUser($user);

            if ($groupHash !== $data[$user->getKey()]) {
                $response[$user->getKey()] = $groupHash;
            }

            $seen[] = $user->getKey();
        });

        Subscription::query()->where('confirmed', '=', false)->whereIn('user_id', $userIds)->update([
            'confirmed' => true,
        ]);

        $deleted = array_values(array_diff($userIds, $seen));

        foreach ($deleted as $del) {
            $response[$del] = 'guest';
        }

        return $response;
    }

    public function unfollowUser($userId = null): void
    {
        Subscription::query()->where('user_id', '=', $userId)->delete();
    }

    public function groupHashForUser(?User $user = null): string
    {
        if ($user) {
            $hash = array_filter($user->asWordpressUser()?->roles);
            natcasesort($hash);

            return implode(',', $hash);
        }

        return 'guest';
    }
}
