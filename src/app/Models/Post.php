<?php

namespace CommunityHive\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * CommunityHive/App/Models/Post
 *
 * @method static Builder|Post forCommunityHive()
 *
 * @mixin \WP_Post
 * @mixin \Eloquent
 */
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

        $builder->where(function ($builder) {
            $builder->where(function () use ($builder) {
                if ($tags = get_option('community_hive_tags')) {
                    $builder->whereExists(function (\Illuminate\Database\Query\Builder $builder) use ($tags) {
                        $builder->select(DB::raw(1))
                            ->from('term_relationships')
                            ->whereIn('term_relationships.term_taxonomy_id', explode(',', $tags))
                            ->whereColumn('term_relationships.object_id', 'posts.id');
                    });
                }

                if ($categories = get_option('community_hive_categories')) {
                    $builder->orWhereExists(function (\Illuminate\Database\Query\Builder $builder) use ($categories) {
                        $builder->select(DB::raw(1))
                            ->from('term_relationships')
                            ->whereIn('term_relationships.term_taxonomy_id', explode(',', $categories))
                            ->whereColumn('term_relationships.object_id', 'posts.id');
                    });
                }
            });
        });

        $builder->orderBy('post_date', 'desc');
        $builder->limit(10);
    }
}
