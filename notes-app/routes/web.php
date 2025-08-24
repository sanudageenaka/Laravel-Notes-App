<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Models\Note;

Route::redirect('/', 'login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->middleware('role:admin')->name('users.index');
    
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    Route::get('/admin/dashboard', function () {
        $notes = Note::with('user')->latest()->paginate(5);
        return view('admin-dashboard', compact('notes'));
    })->middleware('role:admin')->name('admin.dashboard');

    Route::get('/user/dashboard', function () {
        $notes = auth()->user()->notes()->latest()->paginate(5);
        return view('user-dashboard', compact('notes'));
    })->middleware('role:user')->name('user.dashboard');

    Route::resource('notes', NoteController::class);

    Route::patch('/users/{user}/update-role', [UserController::class, 'updateRole'])->middleware('role:admin')->name('users.updateRole');

    // START: Dummy Routes for Template
    $dummyRoutes = [
        'analytics', 'fintech', 'customers', 'orders', 'invoices', 'shop', 'shop-2', 'product', 'cart',
        'cart-2', 'cart-3', 'pay', 'users-tabs', 'users-tiles', 'profile', 'feed', 'forum', 'forum-post',
        'meetups', 'meetups-post', 'credit-cards', 'transactions', 'transaction-details', 'job-listing',
        'job-post', 'company-profile', 'tasks-kanban', 'tasks-list', 'messages', 'inbox', 'calendar',
        'campaigns', 'account', 'notifications', 'apps', 'plans', 'billing', 'feedback', 'changelog',
        'roadmap', 'faqs', 'empty-state', '404', 'onboarding-01', 'onboarding-02', 'onboarding-03',
        'onboarding-04', 'button-page', 'form-page', 'dropdown-page', 'alert-page', 'modal-page',
        'pagination-page', 'tabs-page', 'breadcrumb-page', 'badge-page', 'avatar-page', 'tooltip-page',
        'accordion-page', 'icons-page'
    ];

    foreach ($dummyRoutes as $route) {
        Route::get('/' . $route, function () use ($route) {
            return "Page for [{$route}] coming soon!";
        })->name($route);
    }
    // END: Dummy Routes
});