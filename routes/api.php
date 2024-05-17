<?php

use Illuminate\Support\Facades\Route;
use App\Utilities\IncludeRoutes;
use App\Http\Controllers\TestController;

Route::get('/test', [TestController::class, 'index']);


/*

|--------------------------------------------------------------------------
| ACCOUNT ROUTES
|--------------------------------------------------------------------------
|
| protected routes.
|
*/

IncludeRoutes::file('routes/account.php');

/*

|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
|
| public auth routes, except for logout, which is protected.
|
*/

IncludeRoutes::file('routes/auth.php');

/*

|--------------------------------------------------------------------------
| BREAK CACHE ROUTES
|--------------------------------------------------------------------------
|
| public route
|
*/

IncludeRoutes::file('routes/break-cache.php');


/*

|--------------------------------------------------------------------------
| DASHBOARD ROUTES
|--------------------------------------------------------------------------
|
| protected routes
|
*/

IncludeRoutes::file('routes/dashboard.php');

/*



/*

|--------------------------------------------------------------------------
| EARNINGS ROUTES
|--------------------------------------------------------------------------
|
| protected routes
|
*/

IncludeRoutes::file('routes/earnings.php');

/*

|--------------------------------------------------------------------------
| FAQ ROUTES
|--------------------------------------------------------------------------
|
| protected routes
|
*/

IncludeRoutes::file('routes/faq.php');

/*

|--------------------------------------------------------------------------
| HD IMAGES ROUTES
|--------------------------------------------------------------------------
|
| protected routes
|
*/

IncludeRoutes::file('routes/hd-images.php');

/*

|--------------------------------------------------------------------------
| INVOICE ROUTES
|--------------------------------------------------------------------------
|
| protected routes
|
*/

IncludeRoutes::file('routes/invoices.php');

/*

|--------------------------------------------------------------------------
| ITEM ROUTES
|--------------------------------------------------------------------------
|
| protected routes
|
*/

IncludeRoutes::file('routes/items.php');

/*

|--------------------------------------------------------------------------
| PERMISSION DENIED ROUTE
|--------------------------------------------------------------------------
|
|   public route
|
*/

IncludeRoutes::file('routes/permission-denied.php');

/*

/*

|--------------------------------------------------------------------------
| PURCHASE ORDER ROUTES
|--------------------------------------------------------------------------
|
| protected routes
|
*/

IncludeRoutes::file('routes/purchase-orders.php');

/*

|--------------------------------------------------------------------------
| SUPPORT ROUTES
|--------------------------------------------------------------------------
|
| protected routes
|
*/

IncludeRoutes::file('routes/support.php');


