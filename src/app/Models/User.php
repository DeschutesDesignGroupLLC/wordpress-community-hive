<?php

namespace CommunityHive\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * CommunityHive\App\Models\User
 *
 * @method static User|Collection|static[]|static|null find($id, $columns = [])
 *
 * @mixin \WP_User
 * @mixin \Eloquent
 */
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

    public function asWordpressUser(): \WP_User|false
    {
        return get_user_by('id', $this->getKey());
    }
}
