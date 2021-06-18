<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;




/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    return Admin::isAuth() ? view('admin.dashboard') : view('admin.login');
});

Route::post('adminLogin',[Admin::class, 'adminLogin'])->name('adminLogin');

Route::get('/admin/logout', function(Request $request) {
    if (Admin::isAuth()) {
       session()->forget('admin');
       return redirect('admin');
    } else {
        return 'An Error Occurred!';
    }
})->name('logout');


Route::get('/admin/dashboard', [Admin::class, 'getDashboardStats'])->name('dashboard');

Route::get('/admin/update-password', function(){
    return Admin::isAuth() ? view('admin.update-password') : view('admin');    
})->name('update-password');
Route::post('updatePassword',[Admin::class, 'updatePassword'])->name('updatePassword');

Route::get('/admin/social-links', [Admin::class, 'getSocialLinks'])->name('social-links');
Route::post('updateSocialLinks',[Admin::class, 'updateSocialLinks'])->name('updateSocialLinks');

Route::get('/admin/personal-information', [Admin::class, 'getPersonalInformation'])->name('personal-information');
Route::post('updatePersonalInformation',[Admin::class, 'updatePersonalInformation'])->name('updatePersonalInformation');

Route::get('/admin/site-content', [Admin::class, 'getSiteContent'])->name('site-content');
Route::post('updateSiteContent',[Admin::class, 'updateSiteContent'])->name('updateSiteContent');

Route::get('/admin/testimonials', [Admin::class, 'getAllTestimonials'])->name('testimonials');
Route::post('addTestimonial',[Admin::class, 'addTestimonial'])->name('addTestimonial');
Route::get('/admin/delete-testimonial/{id}',[Admin::class, 'deleteTestimonial'])->name('deleteTestimonial');
Route::get('/admin/update-testimonial/{id}',[Admin::class, 'getSingleTestimonial'])->name('getSingleTestimonial');
Route::post('updateTestimonial',[Admin::class, 'updateTestimonial'])->name('updateTestimonial');

Route::get('/admin/tags', [Admin::class, 'getTags'])->name('tags');
Route::post('addTag',[Admin::class, 'addTag'])->name('addTag');
Route::get('/admin/delete-tag/{id}',[Admin::class, 'deleteTag'])->name('deleteTag');
Route::get('/admin/update-tag/{id}',[Admin::class, 'getSingleTag'])->name('getSingleTag');
Route::post('updateTag',[Admin::class, 'updateTag'])->name('updateTag');



