<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAdoptionController;
use App\Http\Controllers\ChatController;


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
Route::get('/pets', [PetController::class, 'index'])
    ->name('pets.index');


// Pet Care
Route::get('/pet-care', function () {
    return view('care.index');
})->name('pet-care');


// About Us
Route::get('/about-us', function () {
    return view('about.index');
})->name('about-us');


// Contact
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');


/*
|--------------------------------------------------------------------------
| Contact Store
|--------------------------------------------------------------------------
|
| ต้อง Login ก่อนส่งข้อความ
|
*/

Route::post('/contact', [ChatController::class, 'sendContact'])
    ->middleware('auth')
    ->name('contact.store');


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('dashboard');
    })
        ->middleware('verified')
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Chat
    |--------------------------------------------------------------------------
    */

    // โหลด Chat
    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat.index');


    // โหลดข้อความของ Conversation
    Route::get('/chat/messages', [ChatController::class, 'messages'])
        ->name('chat.messages');


    /*
    |--------------------------------------------------------------------------
    | สำคัญ
    |--------------------------------------------------------------------------
    |
    | ใช้ /chat/conversation/{conversation}
    |
    | ต้องให้ตรงกับ widget.blade.php
    |
    */

    Route::get('/chat/conversation/{conversation}', [ChatController::class, 'conversation'])
        ->name('chat.conversation');


    // จำนวนข้อความที่ยังไม่ได้อ่าน
    Route::get('/chat/unread', [ChatController::class, 'unread'])
        ->name('chat.unread');


    // ส่งข้อความ
    Route::post('/chat/messages', [ChatController::class, 'send'])
        ->name('chat.send');


    // อ่านข้อความแล้ว
    Route::post('/chat/read', [ChatController::class, 'markAsRead'])
        ->name('chat.read');


    /*
    |--------------------------------------------------------------------------
    | Pet Management
    |--------------------------------------------------------------------------
    */

    // เพิ่มสัตว์เลี้ยง
    Route::get('/pets/create', [PetController::class, 'create'])
        ->name('pets.create');

    // บันทึกสัตว์เลี้ยง
    Route::post('/pets', [PetController::class, 'store'])
        ->name('pets.store');

    // แก้ไข
    Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])
        ->name('pets.edit');

    // อัปเดต
    Route::put('/pets/{pet}', [PetController::class, 'update'])
        ->name('pets.update');

    // ลบ
    Route::delete('/pets/{pet}', [PetController::class, 'destroy'])
        ->name('pets.destroy');

    // เปลี่ยนสถานะรับเลี้ยง
    Route::patch('/pets/{pet}/toggle-adopt', [PetController::class, 'toggleAdopt'])
        ->name('pets.toggle-adopt');


    /*
    |--------------------------------------------------------------------------
    | Pet Show
    |--------------------------------------------------------------------------
    */

    Route::get('/pets/{pet}', [PetController::class, 'show'])
        ->name('pets.show');


    /*
    |--------------------------------------------------------------------------
    | Adoption
    |--------------------------------------------------------------------------
    */

    Route::get('/adoption/create', [PetController::class, 'createAdoptionForm'])
        ->name('adoption.create');

    Route::post('/adoption', [UserController::class, 'store'])
        ->name('adoption.store');

    Route::get('/adoption/confirmation/{adoption}', [UserController::class, 'confirmation'])
        ->name('adoption.confirmation');


    /*
    |--------------------------------------------------------------------------
    | Admin Adoptions
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/adoptions', [AdminAdoptionController::class, 'index'])
                ->name('adoptions.index');

            Route::get('/adoptions/{adoption}', [AdminAdoptionController::class, 'show'])
                ->name('adoptions.show');

            Route::patch('/adoptions/{adoption}/approve', [AdminAdoptionController::class, 'approve'])
                ->name('adoptions.approve');

            Route::patch('/adoptions/{adoption}/reject', [AdminAdoptionController::class, 'reject'])
                ->name('adoptions.reject');
        });


    /*
    |--------------------------------------------------------------------------
    | Actor Management
    |--------------------------------------------------------------------------
    */

    Route::get('/actor', [ActorController::class, 'index'])
        ->name('actor.index');

    Route::get('/actor/create', [ActorController::class, 'create'])
        ->name('actor.create');

    Route::post('/actor', [ActorController::class, 'store'])
        ->name('actor.store');

    Route::get('/actor/{actor}/edit', [ActorController::class, 'edit'])
        ->name('actor.edit');

    Route::put('/actor/{actor}', [ActorController::class, 'update'])
        ->name('actor.update');

    Route::delete('/actor/{actor}', [ActorController::class, 'destroy'])
        ->name('actor.destroy');


    /*
    |--------------------------------------------------------------------------
    | Movie Management
    |--------------------------------------------------------------------------
    */

    Route::get('/movie', [MovieController::class, 'index'])
        ->name('movie.index');

    Route::get('/movie/create', [MovieController::class, 'create'])
        ->name('movie.create');

    Route::post('/movie', [MovieController::class, 'store'])
        ->name('movie.store');

    Route::get('/movie/{movie}/edit', [MovieController::class, 'edit'])
        ->name('movie.edit');

    Route::put('/movie/{movie}', [MovieController::class, 'update'])
        ->name('movie.update');

    Route::delete('/movie/{movie}', [MovieController::class, 'destroy'])
        ->name('movie.destroy');

});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';