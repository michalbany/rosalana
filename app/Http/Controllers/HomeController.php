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

    public function index(Request $request)
    {
        $feed = [];
        $offset = $request->header('offset', 0);

        $parameters = [
            // vaše parametry
        ];

        try {
            $feed = $this->feedService->getFeed($parameters, 5, $offset);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return Inertia::render('Dashboard', [
            'feed' => Inertia::lazy(fn () => $feed),
            'offset' => Inertia::lazy(fn () => $offset + count($feed)),
            'errors' => session()->get('error'),
            'flash' => [
                'error' => fn () => session()->pull('error'),
            ]
        ]);

    }
}
