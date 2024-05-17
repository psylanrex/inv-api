<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\DashboardService;
use App\Services\Dashboard\ReturnedRatedService;
use App\Services\Dashboard\DamagedItemsService;
use App\Services\Dashboard\BadRatingService;
use App\Services\Dashboard\GoodRatingService;

class DashboardController extends Controller
{
    public function index(Request $request, DashboardService $service)
    {

        return $service->handleDashboard($request);

    }

    public function returnedRated(ReturnedRatedService $service)
    {

        return $service->handleReturnedRated();

    }

    public function damagedItems(DamagedItemsService $service)
    {

        return $service->handleDamagedItems();

    }

    public function badRating(BadRatingService $service)
    {

        return $service->handleBadRating();

    }   
    

    public function goodRating(GoodRatingService $service)
    {

        return $service->handleGoodRating();

    }   
    
}
