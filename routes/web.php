<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\ExamenController;
use App\Http\Controllers\Frontend\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/loginUser', function(){
    redirect('/');
});


Route::controller(App\Http\Controllers\Login\LoginUserController::class)->group(function () {
    Route::get('/', 'loginUser')->name('login');
    Route::post('/login-user', 'userLogin')->name('user.login');
    Route::post('/logout', 'logout')->name('logout');

});

// Route::get('/', [App\Http\Controllers\Login\LoginUserController::class, 'loginUser']);


Route::get('/home', function () {
    redirect('/admin/dashboard');
})->middleware(['auth', 'isAdmin']);


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function (){

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::controller(App\Http\Controllers\Login\LoginUserController::class)->group(function () {
        Route::get('/profile/edit', 'updateProfile')->name('admin.profile.edit');
        Route::put('/profile/edit', 'updateAdminProfile')->name('admin.profile.edit');
        Route::get('/profile/password', 'updatePassword')->name('admin.profile.password');
        Route::put('/profile/password', 'updateAdminPassword')->name('admin.profile.password');

    });


    // controller du prof
    Route::controller(App\Http\Controllers\Admin\ProfController::class)->group(function () {
        Route::get('/prof', 'index')->name('admin.prof.index');
        Route::get('/prof/create', 'create')->name('admin.prof.create');
        Route::post('/prof/create', 'store')->name('admin.prof.store');
        Route::get('/prof/{user}/edit', 'edit');
        Route::put('/prof/{user}', 'update');
        Route::get('/prof/{user}/delete', 'destroy');

    });

    // controller category
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('admin.category.index');
        Route::get('/category/create', 'create')->name('admin.category.create');
        Route::post('/category', 'store')->name('admin.category.store');
        Route::get('/category/{category}/edit', 'edit')->name('admin.category.edit');
        Route::put('/category/{category}', 'update')->name('admin.category.update');
        Route::delete('/category/{category}', 'destroy')->name('admin.category.destroy');

    });

    // controller course
    Route::controller(App\Http\Controllers\Admin\CourseController::class)->group(function () {
        Route::get('/course', 'index')->name('admin.course.index');
        Route::get('/course/create', 'create')->name('admin.course.create');
        Route::post('/course', 'store')->name('admin.course.store');
        Route::get('/course/{course}/edit', 'edit')->name('admin.course.edit');
        Route::put('/course/{course}', 'update')->name('admin.course.update');
        Route::delete('/course/{course}/delete', 'destroy')->name('admin.course.destroy');

    });


    // route module
    Route::get('/module', [App\Http\Controllers\Admin\QnAModuleController::class, 'index'])->name('admin.module.index');


    // controller Q&A Module
    Route::controller(App\Http\Controllers\Admin\QnAModuleController::class)->group(function () {
        Route::get('/qna-ans-module', 'index')->name('admin.qnaans-module.index');
        Route::post('/qna-ans-module/create', 'create')->name('admin.qnaans-module.create');
        Route::get('/qna-ans-module/get-qna-details', 'getQnaDetails')->name('admin.qnaans-module.getQnaDetails');
        Route::get('/qna-ans-module/delete-ans', 'deleteAns')->name('admin.qnaans-module.deleteAns');
        Route::post('/qna-ans-module/update', 'update')->name('admin.qnaans-module.updateQna');
        Route::post('/qna-ans-module/delete', 'delete')->name('admin.qnaans-module.deleteQna');


        // qna module rounting
        Route::get('/quiz-questions-module', 'getQuestionsModule')->name('admin.quiz.module');
        Route::post('/quiz-questions-module/add', 'addQuestionsModule')->name('admin.quiz-add.module');
        Route::get('/quiz-questions-module/add', 'getModuleQuestions')->name('admin.quiz-show.module');
        Route::get('/quiz-questions-module/delete', 'deleteModuleQuestions')->name('admin.quiz-delete.module');

    });


    // controller slider
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('/slider', 'index')->name('admin.slider.index');
        Route::get('/slider/create', 'create')->name('admin.slider.create');
        Route::post('/slider', 'store')->name('admin.slider.store');
        Route::get('/slider/{slider}/edit', 'edit');
        Route::put('/slider/{slider}', 'update');
        Route::get('/slider/{slider_id}/delete', 'destroy');

        Route::get('/slider-image/{slider_image_id}/delete', 'destroyImage');

        Route::get('/slider-videos/{slider_video_id}/delete', 'destroyVideo');

    });

    // route quiz
    Route::get('/quiz', [QuizController::class, 'index'])->name('admin.quiz.index');


    // route examen
    Route::get('/examen', [ExamenController::class, 'index'])->name('admin.examen.index');


    // controller Q&A Examen
    Route::controller(App\Http\Controllers\Admin\QnAController::class)->group(function () {
        Route::get('/qna-ans', 'index')->name('admin.qnaans.index');
        Route::post('/qna-ans/create', 'create')->name('admin.qnaans.create');
        Route::get('/qna-ans/get-qna-details', 'getQnaDetails')->name('admin.qnaans.getQnaDetails');
        Route::get('/qna-ans/delete-ans', 'deleteAns')->name('admin.qnaans.deleteAns');
        Route::post('/qna-ans/update', 'update')->name('admin.qnaans.updateQna');
        Route::post('/qna-ans/delete', 'delete')->name('admin.qnaans.deleteQna');


        // qna examens rounting
        Route::get('/qna-questions-exam', 'getQuestionsExamen')->name('admin.qna.examen');
        Route::post('/qna-questions-exam/add', 'addQuestionsExamen')->name('admin.qna-add.examen');
        Route::get('/qna-questions-exam/add', 'getExamenQuestions')->name('admin.qna-show.examen');
        Route::get('/qna-questions-exam/delete', 'deleteExamenQuestions')->name('admin.qna-delete.examen');
        Route::get('/marks', 'loadMarks')->name('admin.marks.examen');
        Route::post('/marks-update', 'updateMarks')->name('update.marks.examen');

        // examen reviews routes
        Route::get('/review-examens', 'reviewExamens')->name('admin.review.examen');
        Route::get('/get-reviewed-qna', 'reviewQna')->name('reviewQna');

        Route::post('/approved-qna', 'approvedQna')->name('approvedQna');

    });

});


Route::prefix('prof')->middleware(['web', 'auth', 'isProf'])->group(function (){
    // controller slider
    Route::controller(App\Http\Controllers\Prof\DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('prof.dashboard');
        Route::get('/course', 'index')->name('prof.course.index');
        Route::get('/examen', 'indexExamen')->name('prof.examen.index');

    });


    Route::controller(App\Http\Controllers\Login\LoginUserController::class)->group(function () {
        Route::get('/profile/edit', 'updateProfileProf')->name('profile.prof.edit');
        Route::get('/profile/password', 'updatePasswordProf')->name('profile.prof.password');
    });


});

// controller frontend
Route::group(['middleware'=>['auth', 'isProf']] ,function () {
    Route::get('/examen/{id}', [FrontendController::class, 'frondtendExamen'])->name('frondtendExamen');
    Route::post('/examen-submit', [FrontendController::class, 'examenSubmit'])->name('submitExamen');

    Route::get('/cours/{id}', [FrontendController::class, 'frondtendCourse'])->name('frondtendCourse');

});
