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
    return Admin::isAuth() ? view('admin.update-password') : view('admin.login');    
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

Route::get('/admin/code-solution', [Admin::class, 'getCodeSolutions'])->name('code-solution');
Route::post('addCodeSolution',[Admin::class, 'addCodeSolution'])->name('addCodeSolution');
Route::get('/admin/delete-code-solution/{code_solution_id}',[Admin::class, 'deleteCodeSolution'])->name('deleteCodeSolution');
Route::get('/admin/update-code-solution/{code_solution_id}',[Admin::class, 'getSingleCodeSolution'])->name('getSingleCodeSolution');
Route::post('updateCodeSolution',[Admin::class, 'updateCodeSolution'])->name('updateCodeSolution');

Route::get('/admin/categories', [Admin::class, 'getCategories'])->name('categories');
Route::post('addCategory',[Admin::class, 'addCategory'])->name('addCategory');
Route::get('/admin/delete-category/{id}',[Admin::class, 'deleteCategory'])->name('deleteCategory');
Route::get('/admin/update-category/{id}',[Admin::class, 'getSingleCategory'])->name('getSingleCategory');
Route::post('updateCategory',[Admin::class, 'updateCategory'])->name('updateCategory');


Route::get('/admin/articles', [Admin::class, 'getArticles'])->name('articles');
Route::post('addArticle',[Admin::class, 'addArticle'])->name('addArticle');
Route::get('/admin/delete-article/{article_id}',[Admin::class, 'deleteArticle'])->name('deleteArticle');
Route::get('/admin/update-article/{article_id}',[Admin::class, 'getSingleArticle'])->name('getSingleArticle');
Route::post('updateArticle',[Admin::class, 'updateArticle'])->name('updateArticle');

Route::get('/admin/add-tool', function(){
    return Admin::isAuth() ? view('admin.add-tool') : view('admin.login');    
})->name('add-tool');




