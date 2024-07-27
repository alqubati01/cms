<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//})->middleware('auth')->name('welcome');

//$roles = \App\Models\Role::all();
////        dd($roles);
//$rolesArr = array();
//foreach ($roles as $role) {
//    array_push($rolesArr, $role->name);
//}
//$rolesArr = implode(',', $rolesArr);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
//Route::resource('posts', PostController::class);

Route::get('/videos', [\App\Http\Controllers\VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [\App\Http\Controllers\VideoController::class, 'create'])->name('videos.create');
Route::post('/videos', [\App\Http\Controllers\VideoController::class, 'store'])->name('videos.store');
Route::get('/videos/{video}', [\App\Http\Controllers\VideoController::class, 'show'])->name('videos.show');
Route::get('/videos/{video}/edit', [\App\Http\Controllers\VideoController::class, 'edit'])->name('videos.edit');
Route::put('/videos/{video}', [\App\Http\Controllers\VideoController::class, 'update'])->name('videos.update');
Route::delete('/videos/{video}', [\App\Http\Controllers\VideoController::class, 'destroy'])->name('videos.destroy');

Route::resource('podcasts', \App\Http\Controllers\PodcastController::class);

Route::get('/comments', [\App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
Route::get('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'show'])->name('comments.show');
Route::get('/comment-edit/{comment}', [\App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');


Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');


Route::get('/tags', [\App\Http\Controllers\TagController::class, 'index'])->name('tags.index');
Route::post('/tags', [\App\Http\Controllers\TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{tag}', [\App\Http\Controllers\TagController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{tag}', [\App\Http\Controllers\TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag}', [\App\Http\Controllers\TagController::class, 'destroy'])->name('tags.destroy');

Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::put('/change-password/{user}', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('users.updatePassword');
Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

Route::get('/permissions', [\App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
Route::post('/permissions', [\App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
Route::get('/permissions/{permission}', [\App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
Route::put('/permissions/{permission}', [\App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
Route::delete('/permissions/{permission}', [\App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');

Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
Route::post('/roles', [\App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}', [\App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [\App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}', [\App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');

Route::get('/roles-permissions', [\App\Http\Controllers\RolePermissionController::class, 'index'])->name('roles.permissions.index');
Route::get('/roles-permissions/{role}', [\App\Http\Controllers\RolePermissionController::class, 'edit'])->name('roles.permissions.edit');
Route::put('/roles-permissions/{role}', [\App\Http\Controllers\RolePermissionController::class, 'update'])->name('roles.permissions.update');
Route::delete('/roles-permissions/{role}', [\App\Http\Controllers\RolePermissionController::class, 'destroy'])->name('roles.permissions.destroy');

Route::get('/subscriptions', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');

Route::get('/profile/{profile}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/{profile}', [\App\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile.changePassword');

Route::get('/test', function (\Illuminate\Http\Request $request) {
    $user = $request->user();

//    dd($user->hasRole('admin', 'author', 'editor', 'user'));

//    dd($user->hasPermissionTo('edit post'));
//    dd($user->can('edit post'));
//    dd($user->can('delete post'));
//    dd($user->can('manage tags'));

//    $user->givePermissionTo('edit posts', 'delete posts');
//    $user->givePermissionTo(['edit post', 'delete post']);
//    $user->withdrawPermissionTo(['delete post']);
    $user->updatePermissions(['edit post', 'delete post']);

    return new \Illuminate\Http\Response('hello', 200);
});







