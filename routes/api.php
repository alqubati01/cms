<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->group(function () {
    Route::post('/posts/{post}', [\App\Http\Controllers\API\PostController::class, 'addComment'])->name('api.posts.addComment');
    Route::post('/videos/{video}', [\App\Http\Controllers\API\VideoController::class, 'addComment'])->name('api.videos.addComment');
    Route::post('/podcasts/{podcast}', [\App\Http\Controllers\API\PodcastController::class, 'addComment'])->name('api.podcasts.addComment');

    Route::get('/profile/{profile}', [\App\Http\Controllers\API\ProfileController::class, 'show'])->name('api.profile.show');
    Route::put('/profile/{profile}', [\App\Http\Controllers\API\ProfileController::class, 'changePassword'])->name('api.profile.changePassword');
});

Route::get('/posts', [\App\Http\Controllers\API\PostController::class, 'index'])->name('api.posts.index');
Route::get('/posts/{post}', [\App\Http\Controllers\API\PostController::class, 'show'])->name('api.posts.show');

Route::get('/videos', [\App\Http\Controllers\API\VideoController::class, 'index'])->name('api.videos.index');
Route::get('/videos/{video}', [\App\Http\Controllers\API\VideoController::class, 'show'])->name('api.videos.show');

Route::get('/podcasts', [\App\Http\Controllers\API\PodcastController::class, 'index'])->name('api.podcasts.index');
Route::get('/podcasts/{podcast}', [\App\Http\Controllers\API\PodcastController::class, 'show'])->name('api.podcasts.show');

Route::get('/tags', [\App\Http\Controllers\API\TagController::class, 'index'])->name('api.tags.index');
Route::get('/tags/{tag}', [\App\Http\Controllers\API\TagController::class, 'show'])->name('api.tags.show');

Route::get('/posts/tag/{tag}', [\App\Http\Controllers\API\TagController::class, 'getPostsByTag'])->name('api.posts.tags.index');
Route::get('/videos/tag/{tag}', [\App\Http\Controllers\API\TagController::class, 'getVideosByTag'])->name('api.videos.tags.index');
Route::get('/podcasts/tag/{tag}', [\App\Http\Controllers\API\TagController::class, 'getPodcastsByTag'])->name('api.podcasts.tags.index');

Route::get('/categories', [\App\Http\Controllers\API\CategoryController::class, 'index'])->name('api.categories.index');
Route::get('/categories/{category}', [\App\Http\Controllers\API\CategoryController::class, 'show'])->name('api.categories.show');

Route::get('/posts/category/{category}', [\App\Http\Controllers\API\CategoryController::class, 'getPostsByCategory'])->name('api.posts.categories.index');
Route::get('/videos/category/{category}', [\App\Http\Controllers\API\CategoryController::class, 'getVideosByCategory'])->name('api.videos.categories.index');
Route::get('/podcasts/category/{category}', [\App\Http\Controllers\API\CategoryController::class, 'getPodcastsByCategory'])->name('api.podcasts.categories.index');
