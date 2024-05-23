<?php

namespace App\Services;

use App\Models\Post;

class FeedService
{
    public function getFeed(array $param)
    {
        $query = Post::query();

        // parametr pro výpis na profilu
        if (isset($param['user_id'])) {
            $query->where('user_id', $param['user_id']);
        }

        // parametr pro výpis v kolekci
        if (isset($param['collection_id'])) {
            $query->where('collection_id', $param['collection_id']);
        }

        // parametr pro výpis v kategorii
        if (isset($param['category'])) {
            $query->where('category', $param['category']);
        }

        // Když je param prázdný, vypíše se stejně všechno
        return $query->with(['user' => function ($query) {
            $query->select('id', 'username', 'avatar', 'first_name', 'last_name', 'rank_points', 'created_at');
        }])->get();


    }
}