<?php

namespace CommunityHive\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var string[]
     */
    protected $casts = [
        'post_date' => 'datetime',
        'post_date_gmt' => 'datetime',
        'post_modified' => 'datetime',
        'post_modified_gmt' => 'datetime',
    ];

    public function scopeForCommunityHive(Builder $builder): void
    {
        $builder->where('post_type', '=', 'post');
        $builder->where('post_status', '=', 'publish');
        $builder->limit(10);
    }
}
