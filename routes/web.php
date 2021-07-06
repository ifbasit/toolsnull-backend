<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Main;




/*
|--------------------------------------------------------------------------
| a. ADMIN ROUTES
|--------------------------------------------------------------------------
*/


// 1. AUTHENTICATIONS


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

Route::get('/admin/logout', function() {
        if (Admin::isAuth()) {
           session()->forget('admin');
        }
        return redirect('admin');
})->name('logout');

Route::get('/admin/dashboard', [Admin::class, 'getDashboardStats'])->name('dashboard');


// 2. SETTINGS

// 2.1 PASSWORD

Route::get('/admin/update-password', function(){
    return Admin::isAuth() ? view('admin.update-password') : view('admin.login');    
})->name('update-password');
Route::post('updatePassword',[Admin::class, 'updatePassword'])->name('updatePassword');

// 2.2 SOCIAL LINKS

Route::get('/admin/social-links', [Admin::class, 'getSocialLinks'])->name('social-links');
Route::post('updateSocialLinks',[Admin::class, 'updateSocialLinks'])->name('updateSocialLinks');

// 2.3 PERSONAL INFORMATION

Route::get('/admin/personal-information', [Admin::class, 'getPersonalInformation'])->name('personal-information');
Route::post('updatePersonalInformation',[Admin::class, 'updatePersonalInformation'])->name('updatePersonalInformation');

// 2.4 SITE CONTENT

Route::get('/admin/site-content', [Admin::class, 'getSiteContent'])->name('site-content');
Route::post('updateSiteContent',[Admin::class, 'updateSiteContent'])->name('updateSiteContent');

// 2.5 TESTIMONIALS

Route::get('/admin/testimonials', [Admin::class, 'getAllTestimonials'])->name('testimonials');
Route::post('addTestimonial',[Admin::class, 'addTestimonial'])->name('addTestimonial');
Route::get('/admin/delete-testimonial/{id}',[Admin::class, 'deleteTestimonial'])->name('deleteTestimonial');
Route::get('/admin/update-testimonial/{id}',[Admin::class, 'getSingleTestimonial'])->name('getSingleTestimonial');
Route::post('updateTestimonial',[Admin::class, 'updateTestimonial'])->name('updateTestimonial');

// 3. TAGS

Route::get('/admin/tags', [Admin::class, 'getTags'])->name('tags');
Route::post('addTag',[Admin::class, 'addTag'])->name('addTag');
Route::get('/admin/delete-tag/{id}',[Admin::class, 'deleteTag'])->name('deleteTag');
Route::get('/admin/update-tag/{id}',[Admin::class, 'getSingleTag'])->name('getSingleTag');
Route::post('updateTag',[Admin::class, 'updateTag'])->name('updateTag');

// 4. CODE SOLUTION

Route::get('/admin/code-solution', [Admin::class, 'getCodeSolutions'])->name('code-solution');
Route::post('addCodeSolution',[Admin::class, 'addCodeSolution'])->name('addCodeSolution');
Route::get('/admin/delete-code-solution/{code_solution_id}',[Admin::class, 'deleteCodeSolution'])->name('deleteCodeSolution');
Route::get('/admin/update-code-solution/{code_solution_id}',[Admin::class, 'getSingleCodeSolution'])->name('getSingleCodeSolution');
Route::post('updateCodeSolution',[Admin::class, 'updateCodeSolution'])->name('updateCodeSolution');

// 5. CATEGORIES

Route::get('/admin/categories', [Admin::class, 'getCategories'])->name('categories');
Route::post('addCategory',[Admin::class, 'addCategory'])->name('addCategory');
Route::get('/admin/delete-category/{id}',[Admin::class, 'deleteCategory'])->name('deleteCategory');
Route::get('/admin/update-category/{id}',[Admin::class, 'getSingleCategory'])->name('getSingleCategory');
Route::post('updateCategory',[Admin::class, 'updateCategory'])->name('updateCategory');

// 6. ARTICLES

Route::get('/admin/articles', [Admin::class, 'getArticles'])->name('articles');
Route::post('addArticle',[Admin::class, 'addArticle'])->name('addArticle');
Route::get('/admin/delete-article/{article_id}',[Admin::class, 'deleteArticle'])->name('deleteArticle');
Route::get('/admin/update-article/{article_id}',[Admin::class, 'getSingleArticle'])->name('getSingleArticle');
Route::post('updateArticle',[Admin::class, 'updateArticle'])->name('updateArticle');

// 7. TOOLS

Route::get('/admin/add-tool', [Admin::class, 'getAddToolView'])->name('add-tool');
Route::post('addTool',[Admin::class, 'addTool'])->name('addTool');
Route::get('/admin/tools', [Admin::class, 'getTools'])->name('tools');
Route::get('/admin/delete-tool/{tool_id}',[Admin::class, 'deleteTool'])->name('deleteTool');
Route::get('/admin/update-tool/{tool_id}',[Admin::class, 'getSingleTool'])->name('getSingleTool');
Route::post('updateTool',[Admin::class, 'updateTool'])->name('updateTool');


/*
|--------------------------------------------------------------------------
| b. MAIN ROUTES
|--------------------------------------------------------------------------
*/


// Route::get('/admin', function () {
//     return Admin::isAuth() ? view('admin.dashboard') : view('admin.login');
// });














