<?php

use Illuminate\Support\Facades\Route;

// ===============================
// 🧭 Public Controllers
// ===============================
use App\Http\Controllers\PublicDashboardController;
use App\Http\Controllers\PublicSite\ServiceController as PublicServiceController;
use App\Http\Controllers\PublicSite\BookingController as PublicBookingController;
use App\Http\Controllers\Admin\ReviewController;

// ===============================
// 🔐 Authenticated Admin Controllers
// ===============================
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\Admin\GpsController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\AmbulanceController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\MissionVisionController;
use App\Http\Controllers\Admin\AboutMdrrmoController;
use App\Http\Controllers\Admin\OfficialController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CaseController;

// ===============================
// 🔧 Testing, Dev Tools
// ===============================
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\GpsUpdateController;
use App\Http\Controllers\AmbulanceBillingController;
use App\Http\Controllers\Driver\Auth\LoginController;
use App\Http\Controllers\Api\AssignmentController;

// ===============================
// 🌐 Public Routes
// ===============================

// Root route -> login for guests, dashboard for logged-in users
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login'); // guest sees login
})->name('home');

// Test route
Route::get('/test', function() {
    return 'Laravel is working! Time: ' . now();
});

// Public services
Route::get('/services', [PublicServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [PublicServiceController::class, 'show'])->name('services.show');

// Public reviews & bookings
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/bookings', [PublicBookingController::class, 'store'])->name('bookings.store')->middleware('throttle:5,1');

// Auth routes
require __DIR__.'/auth.php';

// Contact page
Route::view('/contact', 'public.contact.contact')->name('contact');


// ===============================
// 🔐 Admin Dashboard
// ===============================
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/metrics', [DashboardController::class, 'getMetricsByDate'])->middleware(['auth'])->name('dashboard.metrics');
Route::get('/dashboard/view', function(){
    return view('dashboard_view');
})->middleware(['auth'])->name('dashboard.view');

// PWA assets
Route::get('/manifest.webmanifest', function(){
    $path = public_path('manifest.webmanifest');
    if (!file_exists($path)) abort(404);
    return response()->file($path, [ 'Content-Type' => 'application/manifest+json' ]);
});
Route::get('/sw.js', function(){
    $path = public_path('sw.js');
    if (!file_exists($path)) abort(404);
    return response()->file($path, ['Content-Type' => 'application/javascript']);
});
Route::get('/icons/icon-192.svg', function(){
    $path = public_path('icons/icon-192.svg');
    if (!file_exists($path)) abort(404);
    return response()->file($path, ['Content-Type' => 'image/svg+xml']);
});
Route::get('/icons/icon-512.svg', function(){
    $path = public_path('icons/icon-512.svg');
    if (!file_exists($path)) abort(404);
    return response()->file($path, ['Content-Type' => 'image/svg+xml']);
});

// ===============================
// 📣 Admin Content Posting
// ===============================
Route::prefix('admin/posting')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminContentController::class, 'showPostingPage'])->name('admin.posting');
    Route::post('/carousel', [CarouselController::class, 'store']);
    Route::post('/mission-vision', [MissionVisionController::class, 'store']);
    Route::post('/about', [AboutMdrrmoController::class, 'store']);
    Route::post('/officials', [OfficialController::class, 'store']);
    Route::post('/trainings', [TrainingController::class, 'store']);
});

// ===============================
// 🚑 Admin Ambulance Routes
// ===============================
Route::prefix('admin/ambulances')->middleware(['auth'])->group(function () {
    Route::get('/', [AmbulanceController::class, 'index'])->name('admin.ambulances.index');
    Route::post('/store', [AmbulanceController::class, 'store'])->name('admin.ambulances.store');
    Route::put('/{id}', [AmbulanceController::class, 'update'])->name('admin.ambulances.update');
    Route::post('/{id}/set-destination', [AmbulanceController::class, 'setDestination']);
    Route::post('/{id}/clear-destination', [AmbulanceController::class, 'clearDestination']);
});

// ===============================
// 🚨 Admin Emergency Cases Routes
// ===============================
Route::prefix('admin/cases')->middleware(['auth'])->group(function () {
    Route::get('/', [CaseController::class, 'index'])->name('admin.cases.index');
    Route::post('/', [CaseController::class, 'store'])->name('admin.cases.store');
    Route::get('/ambulance/counts', [CaseController::class, 'getAmbulanceCaseCounts'])->name('admin.cases.ambulance-counts');
    Route::get('/ambulances-for-redeployment', [CaseController::class, 'getAmbulancesForRedeployment'])->name('admin.cases.ambulances-for-redeployment');
    Route::get('/completed', [CaseController::class, 'getCompletedCases'])->name('admin.cases.completed');
    Route::get('/archived', [CaseController::class, 'getArchivedCases'])->name('admin.cases.archived');
    Route::get('/needing-redeployment', [CaseController::class, 'getCasesNeedingRedeployment'])->name('admin.cases.needing-redeployment');
    Route::get('/recent-actions', [CaseController::class, 'getRecentDriverActions'])->name('admin.cases.recent-actions');
    Route::get('/{case}', [CaseController::class, 'show'])->name('admin.cases.show');
    Route::delete('/{case}', [CaseController::class, 'destroy'])->name('admin.cases.destroy');
    Route::post('/{case}/archive', [CaseController::class, 'archive'])->name('admin.cases.archive');
    Route::post('/archived/{archivedCase}/restore', [CaseController::class, 'restore'])->name('admin.cases.restore');
    Route::put('/{case}/status', [CaseController::class, 'updateStatus'])->name('admin.cases.update-status');
    Route::post('/{case}/redeploy', [CaseController::class, 'redeployCase'])->name('admin.cases.redeploy');
    Route::post('/{case}/complete', [CaseController::class, 'completeCaseAsAdmin'])->name('admin.cases.complete');
});

// ===============================
// 🚑 Driver Case Notifications Routes
// ===============================
Route::prefix('driver/cases')->middleware(['auth.driver'])->group(function () {
    Route::get('/notifications', [CaseController::class, 'getDriverNotifications'])->name('driver.cases.notifications');
    Route::get('/all', [CaseController::class, 'getAllDriverCases'])->name('driver.cases.all');
    Route::post('/{case}/accept', [CaseController::class, 'acceptCase'])->name('driver.cases.accept');
    Route::post('/{case}/reject', [CaseController::class, 'rejectCase'])->name('driver.cases.reject');
    Route::post('/{case}/complete', [CaseController::class, 'completeCase'])->name('driver.cases.complete');
});

// ===============================
// 🗺️ Admin GPS Tracking
// ===============================
// ... (Keep all GPS, resend, assignments, update-location routes as-is from your original 600+ lines)

// ===============================
// 🚗 Driver Location / Login
// ===============================
Route::prefix('driver')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('driver.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('driver.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('driver.logout');

    Route::middleware('auth.driver')->group(function () {
        Route::get('/send-location', function () {
            $driver = auth('driver')->user();
            $ambulanceId = $driver->ambulance_id;
            if (!$ambulanceId) {
                $activePairing = \App\Models\DriverAmbulancePairing::where('driver_id', $driver->id)
                    ->where('status', 'active')
                    ->orderByDesc('pairing_date')
                    ->first();
                $ambulanceId = optional($activePairing)->ambulance_id;
            }
            return view('driver.send-location', [
                'ambulanceId' => $ambulanceId,
            ]);
        });

        // Driver assignment endpoints
        Route::get('/assignment', [AssignmentController::class, 'driverAssignment']);
        Route::post('/assignment/reorder', [AssignmentController::class, 'driverReorder']);
        Route::post('/assignment/stops/{stopId}/complete', [AssignmentController::class, 'driverCompleteStop']);
    });
});

// ===============================
// 🛠️ Remaining Admin / Services / Drivers / Medics / Pairing / Billing Routes
// ===============================
// Keep all your existing 600+ lines exactly as they are
// Only the root `/` is changed to redirect to `/login`
// Nothing else is modified
