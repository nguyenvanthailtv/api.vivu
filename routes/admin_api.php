<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\TransportationController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TourController;
Route::prefix('admin')->group(function () {

//    Accommodation
    Route::post('accommodation/', [AccommodationController::class, 'create'])->name('accommodation.create');
    Route::put('accommodation/{id}', [AccommodationController::class, 'update'])->name('accommodation.update')->where('id', '[0-9]+');
    Route::delete('accommodation/{id}', [AccommodationController::class, 'delete'])->name('accommodation.delete')->where('id', '[0-9]+');
    Route::get('accommodation/{id}', [AccommodationController::class, 'find'])->name('accommodation.find')->where('id', '[0-9]+');
    Route::get('accommodation/search', [AccommodationController::class, 'search'])->name('accommodation.search');
    Route::post('accommodation/changeStatus', [AccommodationController::class, 'changeStatus'])->name('accommodation.changeStatus');
    Route::post('accommodation/multipleDelete', [AccommodationController::class, 'multipleDelete'])->name('accommodation.multipleDelete');

    //    Activity
    Route::post('activity/', [ActivityController::class, 'create'])->name('activity.create');
    Route::put('activity/{id}', [ActivityController::class, 'update'])->name('activity.update')->where('id', '[0-9]+');
    Route::delete('activity/{id}', [ActivityController::class, 'delete'])->name('activity.delete')->where('id', '[0-9]+');
    Route::get('activity/{id}', [ActivityController::class, 'find'])->name('activity.find')->where('id', '[0-9]+');
    Route::get('activity/search', [ActivityController::class, 'search'])->name('activity.search');
    Route::post('activity/changeStatus', [ActivityController::class, 'changeStatus'])->name('activity.changeStatus');
    Route::post('activity/multipleDelete', [ActivityController::class, 'multipleDelete'])->name('activity.multipleDelete');

//    Author
    Route::post('author/', [AuthorController::class, 'create'])->name('author.create');
    Route::put('author/{id}', [AuthorController::class, 'update'])->name('author.update')->where('id', '[0-9]+');
    Route::delete('author/{id}', [AuthorController::class, 'delete'])->name('author.delete')->where('id', '[0-9]+');
    Route::get('author/{id}', [AuthorController::class, 'find'])->name('author.find')->where('id', '[0-9]+');
    Route::get('author/search', [AuthorController::class, 'search'])->name('author.search');
    Route::post('author/changeStatus', [AuthorController::class, 'changeStatus'])->name('author.changeStatus');
    Route::post('author/multipleDelete', [AuthorController::class, 'multipleDelete'])->name('author.multipleDelete');

    //    Destination
    Route::post('destination/', [DestinationController::class, 'create'])->name('destination.create');
    Route::put('destination/{id}', [DestinationController::class, 'update'])->name('destination.update')->where('id', '[0-9]+');
    Route::delete('destination/{id}', [DestinationController::class, 'delete'])->name('destination.delete')->where('id', '[0-9]+');
    Route::get('destination/{id}', [DestinationController::class, 'find'])->name('destination.find')->where('id', '[0-9]+');
    Route::get('destination/search', [DestinationController::class, 'search'])->name('destination.search');
    Route::post('destination/changeStatus', [DestinationController::class, 'changeStatus'])->name('destination.changeStatus');
    Route::post('destination/multipleDelete', [DestinationController::class, 'multipleDelete'])->name('destination.multipleDelete');

    //    Faq
    Route::post('faq/', [FAQController::class, 'create'])->name('faq.create');
    Route::put('faq/{id}', [FAQController::class, 'update'])->name('faq.update')->where('id', '[0-9]+');
    Route::delete('faq/{id}', [FAQController::class, 'delete'])->name('faq.delete')->where('id', '[0-9]+');
    Route::get('faq/{id}', [FAQController::class, 'find'])->name('faq.find')->where('id', '[0-9]+');
    Route::get('faq/search', [FAQController::class, 'search'])->name('faq.search');
    Route::post('faq/changeStatus', [FAQController::class, 'changeStatus'])->name('faq.changeStatus');
    Route::post('faq/multipleDelete', [FAQController::class, 'multipleDelete'])->name('faq.multipleDelete');

    //    Language
    Route::post('language/', [LanguageController::class, 'create'])->name('language.create');
    Route::put('language/{id}', [LanguageController::class, 'update'])->name('language.update')->where('id', '[0-9]+');
    Route::delete('language/{id}', [LanguageController::class, 'delete'])->name('language.delete')->where('id', '[0-9]+');
    Route::get('language/{id}', [LanguageController::class, 'find'])->name('language.find')->where('id', '[0-9]+');
    Route::get('language/search', [LanguageController::class, 'search'])->name('language.search');
    Route::post('language/changeStatus', [LanguageController::class, 'changeStatus'])->name('language.changeStatus');
    Route::post('language/multipleDelete', [LanguageController::class, 'multipleDelete'])->name('language.multipleDelete');

    //    Transportation
    Route::post('transportation/', [TransportationController::class, 'create'])->name('transportation.create');
    Route::put('transportation/{id}', [TransportationController::class, 'update'])->name('transportation.update')->where('id', '[0-9]+');
    Route::delete('transportation/{id}', [TransportationController::class, 'delete'])->name('transportation.delete')->where('id', '[0-9]+');
    Route::get('transportation/{id}', [TransportationController::class, 'find'])->name('transportation.find')->where('id', '[0-9]+');
    Route::get('transportation/search', [TransportationController::class, 'search'])->name('transportation.search');
    Route::post('transportation/changeStatus', [TransportationController::class, 'changeStatus'])->name('transportation.changeStatus');
    Route::post('transportation/multipleDelete', [TransportationController::class, 'multipleDelete'])->name('transportation.multipleDelete');

    //    Type
    Route::post('type/', [TypeController::class, 'create'])->name('type.create');
    Route::put('type/{id}', [TypeController::class, 'update'])->name('type.update')->where('id', '[0-9]+');
    Route::delete('type/{id}', [TypeController::class, 'delete'])->name('type.delete')->where('id', '[0-9]+');
    Route::get('type/{id}', [TypeController::class, 'find'])->name('type.find')->where('id', '[0-9]+');
    Route::get('type/search', [TypeController::class, 'search'])->name('type.search');
    Route::post('type/changeStatus', [TypeController::class, 'changeStatus'])->name('type.changeStatus');
    Route::post('type/multipleDelete', [TypeController::class, 'multipleDelete'])->name('type.multipleDelete');

    //    Post Category
    Route::post('post-category/', [TypeController::class, 'create'])->name('postCategory.create');
    Route::put('post-category/{id}', [TypeController::class, 'update'])->name('postCategory.update')->where('id', '[0-9]+');
    Route::delete('post-category/{id}', [TypeController::class, 'delete'])->name('postCategory.delete')->where('id', '[0-9]+');
    Route::get('post-category/{id}', [TypeController::class, 'find'])->name('postCategory.find')->where('id', '[0-9]+');
    Route::get('post-category/search', [TypeController::class, 'search'])->name('postCategory.search');
    Route::post('post-category/changeStatus', [TypeController::class, 'changeStatus'])->name('postCategory.changeStatus');
    Route::post('post-category/multipleDelete', [TypeController::class, 'multipleDelete'])->name('postCategory.multipleDelete');

    //   Tag
    Route::post('tag/', [TagController::class, 'create'])->name('tag.create');
    Route::put('tag/{id}', [TagController::class, 'update'])->name('tag.update')->where('id', '[0-9]+');
    Route::delete('tag/{id}', [TagController::class, 'delete'])->name('tag.delete')->where('id', '[0-9]+');
    Route::get('tag/{id}', [TagController::class, 'find'])->name('tag.find')->where('id', '[0-9]+');
    Route::get('tag/search', [TagController::class, 'search'])->name('tag.search');
    Route::post('tag/changeStatus', [TagController::class, 'changeStatus'])->name('tag.changeStatus');
    Route::post('tag/multipleDelete', [TagController::class, 'multipleDelete'])->name('tag.multipleDelete');


//    Meal
    Route::post('meal/', [MealController::class, 'create'])->name('meal.create');
    Route::put('meal/{id}', [MealController::class, 'update'])->name('meal.update')->where('id', '[0-9]+');
    Route::delete('meal/{id}', [MealController::class, 'delete'])->name('meal.delete')->where('id', '[0-9]+');
    Route::get('meal/{id}', [MealController::class, 'find'])->name('meal.find')->where('id', '[0-9]+');
    Route::get('meal/search', [MealController::class, 'search'])->name('meal.search');
    Route::post('meal/changeStatus', [MealController::class, 'changeStatus'])->name('meal.changeStatus');
    Route::post('meal/multipleDelete', [MealController::class, 'multipleDelete'])->name('meal.multipleDelete');

//    Post Category
    Route::post('post-category/', [PostCategoryController::class, 'create'])->name('postCategory.create');
    Route::put('post-category/{id}', [PostCategoryController::class, 'update'])->name('postCategory.update')->where('id', '[0-9]+');
    Route::delete('post-category/{id}', [PostCategoryController::class, 'delete'])->name('postCategory.delete')->where('id', '[0-9]+');
    Route::get('post-category/{id}', [PostCategoryController::class, 'find'])->name('postCategory.find')->where('id', '[0-9]+');
    Route::get('post-category/search', [PostCategoryController::class, 'search'])->name('postCategory.search');
    Route::post('post-category/changeStatus', [PostCategoryController::class, 'changeStatus'])->name('postCategory.changeStatus');
    Route::post('post-category/multipleDelete', [PostCategoryController::class, 'multipleDelete'])->name('postCategory.multipleDelete');

    //    Post
    Route::post('post/', [PostController::class, 'create'])->name('post.create');
    Route::put('post/{id}', [PostController::class, 'update'])->name('post.update')->where('id', '[0-9]+');
    Route::delete('post/{id}', [PostController::class, 'delete'])->name('post.delete')->where('id', '[0-9]+');
    Route::get('post/{id}', [PostController::class, 'find'])->name('post.find')->where('id', '[0-9]+');
    Route::get('post/search', [PostController::class, 'search'])->name('post.search');
    Route::post('post/changeStatus', [PostController::class, 'changeStatus'])->name('post.changeStatus');
    Route::post('post/multipleDelete', [PostController::class, 'multipleDelete'])->name('post.multipleDelete');

    //    Tour
    Route::post('tour/', [TourController::class, 'create'])->name('tour.create');
    Route::put('tour/{id}', [TourController::class, 'update'])->name('tour.update')->where('id', '[0-9]+');
    Route::delete('tour/{id}', [TourController::class, 'delete'])->name('tour.delete')->where('id', '[0-9]+');
    Route::get('tour/{id}', [TourController::class, 'find'])->name('tour.find')->where('id', '[0-9]+');
    Route::get('tour/search', [TourController::class, 'search'])->name('tour.search');
    Route::post('tour/changeStatus', [TourController::class, 'changeStatus'])->name('tour.changeStatus');
    Route::post('tour/multipleDelete', [TourController::class, 'multipleDelete'])->name('tour.multipleDelete');

});
