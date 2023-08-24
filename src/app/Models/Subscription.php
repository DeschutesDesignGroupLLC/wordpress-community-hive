<?php

namespace CommunityHive\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * CommunityHive/App/Models/Subscription
 *
 * @method static Subscription|$this create($attributes = [])
 *
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    /**
     * @var string
     */
    protected $table = 'communityhive_subscriptions';

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'confirmed'];

    /**
     * @var string[]
     */
    protected $casts = [
        'confirmed' => 'boolean',
    ];
}
