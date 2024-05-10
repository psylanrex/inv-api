<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\Crons\CronService;
use DB;

class TestController extends Controller
{
    public function index()
    { 
    
        return 'Ready to test, boss!';

    }

    
}
