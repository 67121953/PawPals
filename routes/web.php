<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAdoptionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// หน้าแรก
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// รายการสัตว์เลี้ยง
Route::get('/pets', [PetController::class, 'index'])->name('pets.index');

// หน้าเพจทั่วไป
Route::get('/pet-care', function () {
    return view('care.index');
})->name('pet-care');

Route::get('/about-us', function () {
    return view('about.index');
})->name('about-us');

Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');

Route::post('/contact', function () {
    return redirect()
        ->route('contact')
        ->with('success', 'ส่งข้อความเรียบร้อยแล้ว ขอบคุณที่ติดต่อเรา');
})->name('contact.store');


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard & Profile
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // =====================================================
    // Pet Show - ดูรายละเอียดสัตว์
    // User และ Admin สามารถเข้าดูได้
    // =====================================================

    Route::get('/pets/{pet}', [PetController::class, 'show'])
        ->name('pets.show');


    // =====================================================
    // Adoption
    // =====================================================

    Route::get('/adoption/create',
        [PetController::class, 'createAdoptionForm']
    )->name('adoption.create');

    Route::post('/adoption',
        [UserController::class, 'store']
    )->name('adoption.store');

    Route::get('/adoption/confirmation/{adoption}',
        [UserController::class, 'confirmation']
    )->name('adoption.confirmation');


    // =====================================================
    // Pet Management
    // =====================================================

    Route::get('/pets/create',
        [PetController::class, 'create']
    )->name('pets.create');

    Route::post('/pets',
        [PetController::class, 'store']
    )->name('pets.store');

    Route::get('/pets/{pet}/edit',
        [PetController::class, 'edit']
    )->name('pets.edit');

    Route::put('/pets/{pet}',
        [PetController::class, 'update']
    )->name('pets.update');

    Route::delete('/pets/{pet}',
        [PetController::class, 'destroy']
    )->name('pets.destroy');

    Route::patch('/pets/{pet}/toggle-adopt',
        [PetController::class, 'toggleAdopt']
    )->name('pets.toggle-adopt');


    // =====================================================
    // Admin Adoptions
    // =====================================================

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/adoptions',
            [AdminAdoptionController::class, 'index']
        )->name('adoptions.index');

        Route::get('/adoptions/{adoption}',
            [AdminAdoptionController::class, 'show']
        )->name('adoptions.show');

        Route::patch('/adoptions/{adoption}/approve',
            [AdminAdoptionController::class, 'approve']
        )->name('adoptions.approve');

        Route::patch('/adoptions/{adoption}/reject',
            [AdminAdoptionController::class, 'reject']
        )->name('adoptions.reject');
    });


    // =====================================================
    // Actor Management
    // =====================================================

    Route::get('/actor',
        [ActorController::class, 'index']
    )->name('actor.index');

    Route::get('/actor/create',
        [ActorController::class, 'create']
    )->name('actor.create');

    Route::post('/actor',
        [ActorController::class, 'store']
    )->name('actor.store');

    Route::get('/actor/{actor}/edit',
        [ActorController::class, 'edit']
    )->name('actor.edit');

    Route::put('/actor/{actor}',
        [ActorController::class, 'update']
    )->name('actor.update');

    Route::delete('/actor/{actor}',
        [ActorController::class, 'destroy']
    )->name('actor.destroy');


    // =====================================================
    // Movie Management
    // =====================================================

    Route::get('/movie',
        [MovieController::class, 'index']
    )->name('movie.index');

    Route::get('/movie/create',
        [MovieController::class, 'create']
    )->name('movie.create');

    Route::post('/movie',
        [MovieController::class, 'store']
    )->name('movie.store');

    Route::get('/movie/{movie}/edit',
        [MovieController::class, 'edit']
    )->name('movie.edit');

    Route::put('/movie/{movie}',
        [MovieController::class, 'update']
    )->name('movie.update');

    Route::delete('/movie/{movie}',
        [MovieController::class, 'destroy']
    )->name('movie.destroy');

});


require __DIR__.'/auth.php';