<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Services\FeedService;

class HomeController extends Controller
{
    protected $feedService;

    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;       
    }

    public function index()
    {
        $parameters = [
            //
        ];

        $feed = $this->feedService->getFeed($parameters);


        return Inertia::render('Dashboard', [
            'feed' => $feed,       
        ]);
    }
}
