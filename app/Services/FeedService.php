<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class FeedService
{
    public function getFeed(array $param, $limit = 5, $offset = 0)
    {
        // $cacheKey = $this->generateCacheKey($param, $limit, $offset);

        // Získat čas posledního požadavku
        // $lastRequestTime = Cache::get($cacheKey);

        // Pokud byl požadavek proveden příliš brzy, vrátit výjimku
        // if ($lastRequestTime && now()->diffInSeconds($lastRequestTime) < 2) {
        //     throw new \Exception('Request frequency limit exceeded', 429);
        // }

        // Uložit čas aktuálního požadavku
        // Cache::put($cacheKey, now(), 60); // Cache na 60 sekund

        Inertia::render('Profile/Profile', [
            'Hello' => 'World',
        ]);

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
        $posts = $query->with(['user' => function ($query) {
            $query->select('id', 'username', 'avatar', 'first_name', 'last_name', 'rank_points', 'created_at');
        }])->limit($limit)->offset($offset)->latest()->get();
        
        if ($posts->isEmpty()) {
            throw new \Exception('No more posts to show', 404);
        }

        return $posts;
    }

    private function generateCacheKey(array $param, $offset)
    {
        return 'feed_' . md5(json_encode($param)) . '_offset_' . $offset;
    }
}