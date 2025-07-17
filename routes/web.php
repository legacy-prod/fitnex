<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WebController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\admin\DocumentRepositoryController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\NewsLetterController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\ClientContactController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\AgentController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\HomeSliderController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PageSettingController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\TrainerController;

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

Route::get('/route-clear', function() {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    $cache = 'Route cache cleared <br /> View cache cleared <br /> Cache cleared <br /> Config cleared <br /> Config cache cleared';
    return $cache;
});
 
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

Route::get('sign-up', [WebController::class, 'SignUp'])->name('sign-up');
Route::post('user/store', [WebController::class, 'storeUser'])->name('user.register.store');

Route::get('email-verification/{token}', [WebController::class, 'verifyEmail'])->name('email-verification');

//admin reset password
Route::get('admin/forgot_password', [AdminController::class, 'forgotPassword'])->name('admin.forgot_password');
Route::get('admin/send-password-reset-link', [AdminController::class, 'passwordResetLink'])->name('admin.send-password-reset-link');
Route::get('admin/reset-password/{token}', [AdminController::class, 'resetPassword'])->name('admin.reset-password');
Route::post('admin/change_password', [AdminController::class, 'changePassword'])->name('admin.change_password');


// User forgot password
Route::get('forgot-password', [WebController::class, 'forgotPassword'])->name('forgot-password');
Route::post('forgot-password', [WebController::class, 'passwordResetLink'])->name('password.reset-link');

// User reset password (from email)
Route::get('reset-password/{verify_token}', [WebController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password', [WebController::class, 'changePassword'])->name('password.change');



Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
Route::post('admin/logout', [AdminController::class, 'logOut'])->name('admin.logout');


Route::post('user/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');

Route::post('/user/profile/update', [UserController::class, 'userUpdateProfile'])->name('user.profile.update');

Route::post('user/logout', [UserController::class, 'logOut'])->name('user.logout');


//Frontend
Route::get('/', [WebController::class, 'index'])->name('index'); 
Route::get('get_states', [WebController::class, 'getStates'])->name('get_states'); 
Route::get('get_cities', [TrainerController::class, 'get_cities'])->name('get_cities');
Route::post('appointment', [WebController::class, 'appointment'])->name('appointment');
Route::get('about-us', [WebController::class, 'AboutUs'])->name('about-us');
Route::get('benefits', [WebController::class, 'Benefits'])->name('benefits');

Route::get('registration', [WebController::class, 'Registration'])->name('registration');
Route::get('events', [WebController::class, 'Events'])->name('events');
Route::get('careers', [WebController::class, 'Careers'])->name('careers');
/* Route::get('how-it-works', [WebController::class, 'HowItWorks'])->name('how-it-works'); */
Route::get('leaderboard', [WebController::class, 'LeaderBoard'])->name('leaderboard');
Route::get('gallery', [WebController::class, 'Gallery'])->name('gallery');
Route::get('contact-us', [WebController::class, 'ContactUs'])->name('contact-us');
Route::get('faqs', [WebController::class, 'Faqs'])->name('faqs');
Route::get('our-services', [WebController::class, 'Services'])->name('our-services');
Route::get('service-details/{slug}', [WebController::class, 'ServiceDetails'])->name('service_details');
Route::get('privacy-policy', [WebController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('term-and-conditions', [WebController::class, 'termAndConditions'])->name('term-and-conditions');
Route::get('reviews', [WebController::class, 'Reviews'])->name('reviews');

Route::get('trainers', [WebController::class, 'Trainers'])->name('trainers');
Route::get('trainer-details/{id}', [WebController::class, 'TrainerDetail'])->name('trainer.detail');

//stripe payment
Route::get('stripe/create', [StripeController::class, 'create'])->name('stripe.create');
Route::get('stripe/checkout/{id}', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::post('stripe/store', [StripeController::class, 'store'])->name('stripe.post');


//documents repository
Route::get('admin/document_repositories/pdf/{slug}', [DocumentRepositoryController::class, 'downloadPDF'])->name('documents.pdf');
Route::get('admin/document_repositories/documentpdf/{id}', [DocumentRepositoryController::class, 'downloadDocumentPDF'])->name('documents.documentspdf');
Route::get('admin/document_repositories/documentshow/{id}', [DocumentRepositoryController::class, 'documentShow'])->name('documents.documentshow');
Route::delete('documents/{id}/delete-file', [DocumentRepositoryController::class, 'deleteFile'])->name('delete-file');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('product/search', [ProductController::class, 'search'])->name('product.search'); 


//NewsLetter
Route::resource('newsletter', NewsLetterController::class);

//Contact
Route::resource('contact', ContactController::class);

//Client Contact
Route::resource('client_contact', ClientContactController::class); 

//ContactUs
Route::resource('contactus', ContactUsController::class);


Route::group(['middleware' => ['auth']], function () { 
    //Roles
    Route::resource('role', RoleController::class);
    
    //Stripe
    Route::get('stripe', [WebController::class, 'Stripe'])->name('stripe');

    //users
    Route::resource('user', UserController::class);

    //permissions
    Route::resource('permission', PermissionController::class);

    //Packages
    Route::resource('package', PackageController::class);

    //Category
    Route::resource('services', CategoryController::class);

    //testimonial
    Route::resource('testimonial', TestimonialController::class);

    //Agents
    Route::resource('agents', AgentController::class);


    //About
    Route::resource('about', AboutUsController::class);

    //Setting
    Route::resource('page', PageController::class);

    //payment
    Route::resource('payment', PaymentController::class);
    
    
    //FAQS
    Route::resource('faq', FAQController::class);
    
    //Banner
    Route::resource('banner', BannerController::class);
    
    //Home Slider
    Route::resource('homeslider', HomeSliderController::class);
    


    //Events
    Route::resource('event', EventController::class);
 
    //Trainers
    Route::resource('trainer', TrainerController::class);
    
    //pages settings
    Route::resource('page', PageController::class);
    Route::resource('page_setting', PageSettingController::class);
});

