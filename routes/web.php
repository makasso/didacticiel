<?php

use App\Http\Controllers\Admin\ExamenController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\Frontend\AuthStudenController;
use App\Http\Controllers\Frontend\AuthStudentController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

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

Route::controller(App\Http\Controllers\Login\LoginUserController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login-user', 'userLogin')->name('user.login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/', function () {
    redirect('/admin/dashboard');
})->middleware(['auth', 'isAdmin']);

Route::get('/home', function () {
    redirect('/admin/dashboard');
})->middleware(['auth', 'isAdmin']);

Route::prefix('admin')->middleware(['isAdmin', 'auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::controller(App\Http\Controllers\Login\LoginUserController::class)->group(function () {
        Route::get('/profile/edit', 'updateProfile')->name('admin.profile.edit');
        Route::put('/profile/edit', 'updateProfileUser')->name('admin.profile.update');
        Route::get('/profile/password', 'updatePassword')->name('admin.profile.password');
        Route::put('/profile/password', 'updatePasswordUser')->name('admin.profile.password-update');
    });

    Route::controller(App\Http\Controllers\Admin\ProfController::class)->group(function () {

        Route::get('/prof/courses', 'getCourses')->name('admin.prof.courses');
        Route::get('/prof/show-courses', 'showCourses')->name('admin.prof.show.courses');
        Route::post('/prof/add-courses', 'addCourses')->name('admin.prof.add.courses');
        Route::get('/prof/delete-course', 'deleteCourse')->name('admin.prof.delete.course');

        Route::get('/prof', 'index')->name('admin.prof.index');
        Route::get('/prof/create', 'create')->name('admin.prof.create');
        Route::post('/prof/create', 'store')->name('admin.prof.store');
        Route::get('/prof/{user}/edit', 'edit')->name('admin.prof.edit');
        Route::put('/prof/{user}', 'update')->name('admin.prof.update');
        Route::delete('/prof/{user}/delete', 'destroy')->name('admin.prof.destroy');
        Route::get('/prof/{user}/', 'show')->name('admin.prof.show');

    });


    Route::controller(App\Http\Controllers\Admin\CompanyController::class)->group(function () {
        Route::get('/company', 'index')->name('admin.company.index');
        Route::get('/company/create', 'create')->name('admin.company.create');
        Route::post('/company', 'store')->name('admin.company.store');
        Route::get('/company/{id}/edit', 'edit')->name('admin.company.edit');
        Route::put('/company/{id}', 'update')->name('admin.company.update');
        Route::delete('/company/{id}/delete', 'destroy')->name('admin.company.destroy');
        Route::get('/company/{id}/', 'show')->name('admin.company.show');

    });

    // controller category
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('admin.category.index');
        Route::get('/category/create', 'create')->name('admin.category.create');
        Route::post('/category', 'store')->name('admin.category.store');
        Route::get('/category/{category}/edit', 'edit')->name('admin.category.edit');
        Route::put('/category/{category}', 'update')->name('admin.category.update');
        Route::delete('/category/{category}', 'destroy')->name('admin.category.destroy');
        Route::get('/category/{category}/', 'show')->name('admin.category.show');

    });

    // controller course
    Route::controller(App\Http\Controllers\Admin\CourseController::class)->group(function () {
        Route::get('/course', 'index')->name('admin.course.index');
        Route::get('/course/create', 'create')->name('admin.course.create');
        Route::post('/course', 'store')->name('admin.course.store');
        Route::get('/course/{course_id}/edit', 'edit')->name('admin.course.edit');
        Route::put('/course/{course_id}', 'update')->name('admin.course.update');
        Route::delete('/course/{course}/delete', 'destroy')->name('admin.course.destroy');
        Route::get('/course/teachers', 'getTeachers')->name('admin.course.getTeachers');
        Route::get('/course/{course_id}/', 'show')->name('admin.course.show');

    });

    // Route module
    Route::get('/module', [ModuleController::class, 'index'])->name('admin.module.index');
    Route::get('/module/create', [ModuleController::class, 'create'])->name('admin.module.create');
    Route::post('/module/create', [ModuleController::class, 'store'])->name('admin.module.store');
    Route::get('/module/{module_id}/edit', [ModuleController::class, 'edit'])->name('admin.module.edit');
    Route::put('/module/{module_id}/update', [ModuleController::class, 'update'])->name('admin.module.update');
    Route::delete('/module/{module_id}/delete', [ModuleController::class, 'destroy'])->name('admin.module.destroy');
    Route::get('/module/{module_id}/', [ModuleController::class, 'show'])->name('admin.module.show');


    // controller Q&A Module
    Route::controller(App\Http\Controllers\Admin\QnAModuleController::class)->group(function () {
        Route::get('/qna-ans-module', 'index')->name('admin.qnaans-module.index');
        Route::get('/qna-ans-module/create', 'create')->name('admin.qnaans-module.create');
        Route::post('/qna-ans-module/create', 'store')->name('admin.qnaans-module.store');
        Route::get('/qna-ans-module/get-qna-details', 'getQnaDetails')->name('admin.qnaans-module.getQnaDetails');
        Route::get('/qna-ans-module/delete-ans', 'deleteAns')->name('admin.qnaans-module.deleteAns');
        Route::post('/qna-ans-module/update', 'update')->name('admin.qnaans-module.updateQna');
        Route::delete('/qna-ans-module/{id}/delete', 'delete')->name('admin.qnaans-module.deleteQna');

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
        Route::get('/slider/{slider}/edit', 'edit')->name('admin.slider.edit');
        Route::put('/slider/{slider}', 'update')->name('admin.slider.update');
        Route::delete('/slider/{slider_id}/delete', 'destroy')->name('admin.slider.delete');
        Route::get('/slider/{slider_id}/', 'show')->name('admin.slider.show');

        Route::get('/slider-image/{slider_image_id}/delete', 'destroyImage')->name('admin.slider.delete-image');
        Route::get('/slider-videos/{slider_video_id}/delete', 'destroyVideo')->name('admin.slider.delete-video');
    });

    // route quiz
    Route::get('/quiz', [QuizController::class, 'index'])->name('admin.quiz.index');

    // route examen
    Route::controller(ExamenController::class)->group(function () {
        Route::get('/examen', 'index')->name('admin.examen.index');
        Route::get('/examen/create', 'create')->name('admin.examen.create');
        Route::post('/examen/create', 'store')->name('admin.examen.store');
        Route::put('/examen/{examen_id}/update', 'update')->name('admin.examen.update');
        Route::delete('/examen/{examen_id}/delete', 'destroy')->name('admin.examen.destroy');
        Route::get('/examen/{examen_id}/', 'show')->name('admin.examen.show');

    });

    // controller Q&A Examen
    Route::controller(App\Http\Controllers\Admin\QnAController::class)->group(function () {
        // qna examens routing
        Route::get('/qna-questions-exam', 'getQuestionsExamen')->name('admin.qna.examen');
        Route::post('/qna-questions-exam/add', 'addQuestionsExamen')->name('admin.qna-add.examen');
        Route::get('/qna-questions-exam/add', 'getExamenQuestions')->name('admin.qna-show.examen');
        Route::get('/qna-questions-exam/delete', 'deleteExamenQuestions')->name('admin.qna-delete.examen');
        Route::get('/qna-exam', 'getExamen')->name('admin.qna.index');
    });

    // Certificate Controller
    Route::get('/certificates', [CertificateController::class, 'index'])->name('admin.certificate');
    Route::get('/certificates/{certificate_id}/', [CertificateController::class, 'show'])->name('admin.certificate.show');

});

Route::prefix('prof')
    ->middleware(['web', 'auth', 'isProf'])
    ->group(function () {
        // controller slider
        Route::controller(App\Http\Controllers\Prof\DashboardController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('prof.dashboard');
            Route::get('/course', 'index')->name('prof.course.index');
            Route::get('/course/{course_id}', 'showCourse')->name('prof.course.show');

            Route::get('/course/{course_id}/modules', 'getModules')->name('prof.course.get-modules');
            Route::get('/course/{course_id}/modules/{module_id}', 'showModule')->name('prof.course.show-module');

            Route::get('/slider', 'getSliders')->name('prof.slider.index');
            Route::get('/slider/{slider_id}/', 'showSlider')->name('prof.slider.show');

            Route::get('/examen', 'indexExamen')->name('prof.examen.index');
            Route::get('/examen/{examen_id}', 'showExamen')->name('prof.examen.show');
            Route::get('/course/{course_id}/students', 'students')->name('prof.course.students');

            Route::get('/qna-exam', 'getExamen')->name('prof.qna.index');

        });

        Route::controller(App\Http\Controllers\Admin\QnAController::class)->group(function () {
            Route::get('/qna-questions-exam/add', 'getExamenQuestions')->name('prof.qna-show.examen');
        });

        Route::controller(App\Http\Controllers\Login\LoginUserController::class)->group(function () {
            Route::get('/profile/edit', 'updateProfile')->name('profile.prof.edit');
            Route::get('/profile/password', 'updatePassword')->name('profile.prof.password');
            Route::put('/profile/edit', 'updateProfileUser')->name('profile.prof.update');
            Route::put('/profile/password', 'updatePasswordUser')->name('profile.prof.password-update');
        });

    });

// controller frontend
Route::group(['middleware' => ['auth:student', 'profIsValid']], function () {
    Route::get('/examen/{id}', [FrontendController::class, 'frondtendExamen'])->name('student.frondtendExamen');
    Route::post('/examen-submit', [FrontendController::class, 'examenSubmit'])->name('student.submitExamen');
    // Course
    Route::get('/cours/{copy_link}', [FrontendController::class, 'frondtendCourse'])->name('student.frontendCourse');
    Route::get('/cours/{copy_link}/module/{module_id}', [FrontendController::class, 'frontendModule'])->name('student.frontendModule');
    Route::get('/cours/{copy_link}/module/{module_id}/quiz', [FrontendController::class, 'frontendModuleQuiz'])->name('student.frontendModule.quiz');

    // Module
    Route::get('/module/{module_id}/quiz', [FrontendController::class, 'getQuiz'])->name('student.frontendModule.getQuiz');
    Route::post('/module/{module_id}/quiz/complete', [FrontendController::class, 'completeQuiz'])->name('student.frontendModule.completeQuiz');
    Route::get('/cours/module/{module_id}/complete', [FrontendController::class, 'completeModule'])->name('student.complete-module');

    //Examen
    Route::get('/cours/{copy_link}/examen', [FrontendController::class, 'passExamen'])->name('student.examen');
    Route::post('/cours/{copy_link}/examen/complete', [FrontendController::class, 'completeExamen'])->name('student.complete-examen');
    Route::get('/cours/{copy_link}/examen/questions', [FrontendController::class, 'getExamen'])->name('student.getExamen');


    Route::get('/certificate/{examen_id}/{student_id}/{certificate_id}', [FrontendController::class, 'generateCertificate'])->name('student.certificate');
    Route::get('/profile/edit', [FrontendController::class, 'editProfile'])->name('student.profile.edit');
    Route::put('/profile/update', [FrontendController::class, 'updateProfileStudent'])->name('student.profile.update');

    Route::get('/dashboard', [FrontendController::class, 'dashboard'])->name('student.dashboard');

});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login-student', [AuthStudentController::class, 'showLoginStudent'])->name('login-student');
    Route::post('/login-student', [AuthStudentController::class, 'LoginStudent'])->name('login-student-post');
    Route::get('/verify-login/{token}', [AuthStudentController::class, 'verifyLogin'])->name('verify-login');
    Route::get('/get-student-name', [AuthStudentController::class, 'getNameByEmail'])->name('student.get-name');
});
