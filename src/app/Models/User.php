<?php

namespace CommunityHive\App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string
     */
    protected $primaryKey = 'ID';

    public function groupHash(): string
    {
        $hash = array_filter($this->asWordpressUser()?->roles);
        natcasesort($hash);

        return implode(',', $hash);
    }

    public function asWordpressUser(): \WP_User|false
    {
        return get_user_by('id', $this->getKey());
    }
}
