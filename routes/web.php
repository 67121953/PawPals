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


/*
|--------------------------------------------------------------------------
| Contact
|--------------------------------------------------------------------------
|
| Contact จะส่งข้อความผ่านระบบ Chat
| สำหรับผู้ใช้ที่ Login
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
    | Dashboard & Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

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

    // เปิดหน้า Chat
    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat.index');

    // ดึงข้อความใน Conversation
    Route::get('/chat/messages', [ChatController::class, 'messages'])
        ->name('chat.messages');

    // ส่งข้อความ
    Route::post('/chat/messages', [ChatController::class, 'send'])
        ->name('chat.send');

    // ทำเครื่องหมายว่าอ่านแล้ว
    Route::post('/chat/read', [ChatController::class, 'markAsRead'])
        ->name('chat.read');


    /*
    |--------------------------------------------------------------------------
    | Pet Management
    |--------------------------------------------------------------------------
    |
    | /pets/create ต้องอยู่ก่อน /pets/{pet}
    |
    */

    // เพิ่มสัตว์เลี้ยง
    Route::get('/pets/create', [PetController::class, 'create'])
        ->name('pets.create');

    // บันทึกสัตว์เลี้ยง
    Route::post('/pets', [PetController::class, 'store'])
        ->name('pets.store');

    // แก้ไขสัตว์เลี้ยง
    Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])
        ->name('pets.edit');

    // อัปเดตสัตว์เลี้ยง
    Route::put('/pets/{pet}', [PetController::class, 'update'])
        ->name('pets.update');

    // ลบสัตว์เลี้ยง
    Route::delete('/pets/{pet}', [PetController::class, 'destroy'])
        ->name('pets.destroy');

    // เปลี่ยนสถานะการรับเลี้ยง
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

    // หน้าแบบฟอร์มขอรับเลี้ยง
    Route::get('/adoption/create', [PetController::class, 'createAdoptionForm'])
        ->name('adoption.create');

    // บันทึกข้อมูลการขอรับเลี้ยง
    Route::post('/adoption', [UserController::class, 'store'])
        ->name('adoption.store');

    // หน้ายืนยันการขอรับเลี้ยง
    Route::get('/adoption/confirmation/{adoption}', [UserController::class, 'confirmation'])
        ->name('adoption.confirmation');


    /*
    |--------------------------------------------------------------------------
    | Admin Adoptions
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')->name('admin.')->group(function () {

        // รายการคำขอรับเลี้ยง
        Route::get('/adoptions', [AdminAdoptionController::class, 'index'])
            ->name('adoptions.index');

        // รายละเอียดคำขอรับเลี้ยง
        Route::get('/adoptions/{adoption}', [AdminAdoptionController::class, 'show'])
            ->name('adoptions.show');

        // อนุมัติ
        Route::patch('/adoptions/{adoption}/approve', [AdminAdoptionController::class, 'approve'])
            ->name('adoptions.approve');

        // ปฏิเสธ
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
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';