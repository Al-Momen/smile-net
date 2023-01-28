<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\ExtensionController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ManageSubscribers;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\PodcastController as AdminPodcastController;
use App\Http\Controllers\Admin\SmsTemplateController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\User\FavouriteSongsController;
use App\Http\Controllers\User\PodcastController;
use App\Http\Controllers\User\ProducerController;
use App\Http\Controllers\User\UserSocialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [LoginController::class,'showLoginForm'])->name('login');
        Route::post('/attempt-login', [LoginController::class,'login'])->name('login-attempt');
        Route::get('logout',  [LoginController::class,'logout'])->name('logout');



     Route::middleware('admin')->group(function () {
        Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
        Route::get('profile',[AdminController::class,'profile'])->name('profile');
        Route::post('profile',[AdminController::class,'profileUpdate'])->name('profile.update');
        Route::get('password',[AdminController::class,'password'])->name('password');
        Route::post('password',[AdminController::class,'passwordUpdate'])->name('password.update');

    //     //Notification
    //     Route::get('notifications','AdminController@notifications')->name('notifications');
    //     Route::get('notification/read/{id}','AdminController@notificationRead')->name('notification.read');
    //     Route::get('notifications/read-all','AdminController@readAll')->name('notifications.readAll');

    //     //Report Bugs
    //     Route::get('request-report','AdminController@requestReport')->name('request.report');
    //     Route::post('request-report','AdminController@reportSubmit');

        Route::get('system-info',[AdminController::class,'systemInfo'])->name('system.info');


        // Users Manager
        Route::get('users', [ManageUsersController::class,'allUsers'])->name('users.all');
        Route::get('users/active',  [ManageUsersController::class,'activeUsers'])->name('users.active');
        Route::get('users/banned',  [ManageUsersController::class,'bannedUsers'])->name('users.banned');
        Route::get('users/email-verified', [ManageUsersController::class,'emailVerifiedUsers'])->name('users.email.verified');
        Route::get('users/email-unverified',  [ManageUsersController::class,'emailUnverifiedUsers'])->name('users.email.unverified');
        Route::get('users/sms-unverified',  [ManageUsersController::class,'smsUnverifiedUsers'])->name('users.sms.unverified');
        Route::get('users/sms-verified',  [ManageUsersController::class,'smsVerifiedUsers'])->name('users.sms.verified');
        Route::get('users/kyc-verified',  [ManageUsersController::class,'kycVerifiedUsers'])->name('users.kyc.verified');
        Route::get('users/kyc-unverified',  [ManageUsersController::class,'kycUnVerifiedUsers'])->name('users.kyc.unverified');
        Route::get('users/with-balance',  [ManageUsersController::class,'usersWithBalance'])->name('users.with.balance');

        Route::get('users/{scope}/search', [ManageUsersController::class,'search'])->name('users.search');
        Route::get('user/detail/{id}', [ManageUsersController::class,'detail'] )->name('users.detail');
        Route::post('user/update/{id}',  [ManageUsersController::class,'update'])->name('users.update');
        Route::post('user/add-sub-balance/{id}',  [ManageUsersController::class,'addSubBalance'])->name('users.add.sub.balance');
        Route::get('user/send-email/{id}',  [ManageUsersController::class,'showEmailSingleForm'])->name('users.email.single');
        Route::post('user/send-email/{id}',  [ManageUsersController::class,'sendEmailSingle'])->name('users.email.single');
        // Route::get('user/login/{id}', 'ManageUsersController@login')->name('users.login');
        // Route::get('user/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');
        // Route::get('user/deposits/{id}', 'ManageUsersController@deposits')->name('users.deposits');
        // Route::get('user/deposits/via/{method}/{type?}/{userId}', 'ManageUsersController@depositViaMethod')->name('users.deposits.method');

    //     // Login History
    //     Route::get('users/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');

        Route::get('users/send-email', [ManageUsersController::class,'showEmailAllForm'])->name('users.email.all');
        Route::post('users/send-email', [ManageUsersController::class,'sendEmailAll'])->name('users.email.send');
    //     Route::get('users/email-log/{id}', 'ManageUsersController@emailLog')->name('users.email.log');
    //     Route::get('users/email-details/{id}', 'ManageUsersController@emailDetails')->name('users.email.details');


     // Kyc Manager
     Route::get('manage/kyc', [KycController::class,'manageKyc'])->name('manage.kyc');
     Route::get('edit/kyc/', [KycController::class,'editKyc'] )->name('edit.kyc');
     Route::post('edit/update/',  [KycController::class,'updateKyc'])->name('update.kyc');


     Route::prefix('podcasts')->name('podcasts.')->group(function () {
        Route::get('list', [AdminPodcastController::class,'seasonList'])->name('list');
        Route::post('make/featured', [AdminPodcastController::class,'makeFeatured'])->name('featured');
        Route::delete('delete', [AdminPodcastController::class,'deleteSeason'])->name('delete');
        Route::post('change/status', [AdminPodcastController::class,'changeStatusSeason'])->name('status');
    });
     Route::prefix('subscriber')->name('subscriber.')->group(function () {
        Route::get('list', [ManageSubscribers::class,'subscriberList'])->name('list');
        Route::post('delete', [ManageSubscribers::class,'subscriberDelete'])->name('delete');
        Route::post('send-email', [ManageSubscribers::class,'sendEmailAll'])->name('email.send');
    });

    //     // Report
    //     Route::get('report/transaction', 'ReportController@transaction')->name('report.transaction');
    //     Route::get('report/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');
    //     Route::get('report/login/history', 'ReportController@loginHistory')->name('report.login.history');
    //     Route::get('report/login/ipHistory/{ip}', 'ReportController@loginIpHistory')->name('report.login.ipHistory');
    //     Route::get('report/email/history', 'ReportController@emailHistory')->name('report.email.history');


        // Admin Support
        Route::get('tickets', [SupportTicketController::class,'tickets'])->name('ticket');
        Route::get('tickets/pending',  [SupportTicketController::class,'pendingTicket'])->name('ticket.pending');
        Route::get('tickets/closed',  [SupportTicketController::class,'closedTicket'])->name('ticket.closed');
        Route::get('tickets/answered',  [SupportTicketController::class,'answeredTicket'])->name('ticket.answered');
        Route::get('tickets/view/{id}',  [SupportTicketController::class,'ticketReply'])->name('ticket.view');
        Route::post('ticket/reply/{id}',  [SupportTicketController::class,'ticketReplySend'])->name('ticket.reply');
        Route::get('ticket/download/{ticket}',  [SupportTicketController::class,'ticketDownload'])->name('ticket.download');
        Route::post('ticket/delete',  [SupportTicketController::class,'ticketDelete'])->name('ticket.delete');


        // Language Manager
        Route::get('/language', [LanguageController::class,'langManage'])->name('language.manage');
        Route::post('/language', [LanguageController::class,'langStore'])->name('language.manage.store');
        Route::post('/language/delete/{id}', [LanguageController::class,'langDel'])->name('language.manage.del');
        Route::post('/language/update/{id}', [LanguageController::class,'langUpdate'])->name('language.manage.update');
        Route::get('/language/edit/{id}', [LanguageController::class,'langEdit'])->name('language.key');
        Route::post('/language/import', [LanguageController::class,'langImport'])->name('language.importLang');



        Route::post('language/store/key/{id}', [LanguageController::class,'storeLanguageJson'])->name('language.store.key');
        Route::post('language/delete/key/{id}',[LanguageController::class,'deleteLanguageJson'])->name('language.delete.key');
        Route::post('language/update/key/{id}', [LanguageController::class,'updateLanguageJson'])->name('language.update.key');



         // General Setting
        Route::get('general-setting',[GeneralSettingController::class,'index'])->name('setting.index');
        Route::post('general-setting', [GeneralSettingController::class,'update'])->name('setting.update');
        Route::get('optimize', [GeneralSettingController::class,'optimize'])->name('setting.optimize');

        // Logo-Icon
        Route::get('setting/logo-icon', [GeneralSettingController::class,'logoIcon'])->name('setting.logo.icon');
        Route::post('setting/logo-icon', [GeneralSettingController::class,'logoIconUpdate'])->name('setting.logo.icon');

    //     //Custom CSS
    //     Route::get('custom-css','GeneralSettingController@customCss')->name('setting.custom.css');
    //     Route::post('custom-css','GeneralSettingController@customCssSubmit');


        //Cookie
        Route::get('cookie',[GeneralSettingController::class,'cookie'])->name('setting.cookie');
        Route::post('cookie-update',[GeneralSettingController::class,'cookieSubmit'])->name('setting.cookie.update');


        // Plugin
        Route::get('extensions', [ExtensionController::class,'index'])->name('extensions.index');
        Route::post('extensions/update/{id}', [ExtensionController::class,'update'])->name('extensions.update');
        Route::post('extensions/activate', [ExtensionController::class,'activate'])->name('extensions.activate');
        Route::post('extensions/deactivate', [ExtensionController::class,'deactivate'])->name('extensions.deactivate');



        // Email Setting
        Route::get('email-template/global', [EmailTemplateController::class,'emailTemplate'])->name('email.template.global');
        Route::post('email-template/global', [EmailTemplateController::class,'emailTemplateUpdate'])->name('email.template.global.update');
        Route::get('email-template/setting',  [EmailTemplateController::class,'emailSetting'])->name('email.template.setting');
        Route::post('email-template/setting',  [EmailTemplateController::class,'emailSettingUpdate'])->name('email.template.setting');
        Route::get('email-template/index',  [EmailTemplateController::class,'index'])->name('email.template.index');
        Route::get('email-template/{id}/edit',  [EmailTemplateController::class,'edit'])->name('email.template.edit');
        Route::post('email-template/{id}/update', [EmailTemplateController::class,'update'] )->name('email.template.update');
        Route::post('email-template/send-test-mail', [EmailTemplateController::class,'sendTestMail'])->name('email.template.test.mail');



        // SMS Setting
        Route::get('sms-template/global', [SmsTemplateController::class,'smsTemplate'])->name('sms.template.global');
        Route::post('sms-template/global', [SmsTemplateController::class,'smsTemplateUpdate'])->name('sms.template.global');
        Route::get('sms-template/setting',[SmsTemplateController::class,'smsSetting'])->name('sms.templates.setting');
        Route::post('sms-template/setting', [SmsTemplateController::class,'smsSettingUpdate'])->name('sms.template.setting');
        Route::get('sms-template/index', [SmsTemplateController::class,'index'])->name('sms.template.index');
        Route::get('sms-template/edit/{id}', [SmsTemplateController::class,'edit'])->name('sms.template.edit');
        Route::post('sms-template/update/{id}', [SmsTemplateController::class,'update'])->name('sms.template.update');
        Route::post('email-template/send-test-sms', [SmsTemplateController::class,'sendTestSMS'])->name('sms.template.test.sms');

        // SEO
        Route::get('seo', [FrontendController::class,'seoEdit'])->name('seo');


        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {


            Route::get('templates', 'FrontendController@templates')->name('templates');
            Route::post('templates', 'FrontendController@templatesActive')->name('templates.active');

            Route::get('frontend-sections/{key}', [FrontendController::class,'frontendSections'])->name('sections');
            Route::post('frontend-content/{key}', [FrontendController::class,'frontendContent'])->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', [FrontendController::class,'frontendElement'])->name('sections.element');
            Route::post('remove', [FrontendController::class,'remove'])->name('remove');

            // Page Builder
            Route::get('manage-pages', 'PageBuilderController@managePages')->name('manage.pages');
            Route::post('manage-pages', 'PageBuilderController@managePagesSave')->name('manage.pages.save');
            Route::post('manage-pages/update', 'PageBuilderController@managePagesUpdate')->name('manage.pages.update');
            Route::post('manage-pages/delete', 'PageBuilderController@managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'PageBuilderController@manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'PageBuilderController@manageSectionUpdate')->name('manage.section.update');
            //Home Banner
            Route::get('home/banner', [FrontendController::class,'homeBanner'])->name('home.banner');
            Route::post('home/banner', [FrontendController::class,'homeBannerUpdate']);
        });
     });
});
Route::name('user.')->group(function () {
    Route::get('/login', [AuthLoginController::class,'showLoginForm'])->name('login');
    Route::post('/login',[AuthLoginController::class,'login']);
    Route::get('logout', [AuthLoginController::class,'logout'])->name('logout');

    Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
    Route::post('register',  [RegisterController::class,'register'])->middleware('regStatus');
    Route::post('check-mail', 'Auth\RegisterController@checkUser')->name('checkUser');

    Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('password/email',  [ForgotPasswordController::class,'sendResetCodeEmail'])->name('password.email');
    Route::get('password/code-verify', [ForgotPasswordController::class,'codeVerify'] )->name('password.code.verify');
    Route::post('password/reset',  [ResetPasswordController::class,'reset'])->name('password.update');
    Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('password/verify-code', [ForgotPasswordController::class,'verifyCode'])->name('password.verify.code');
});
Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('authorization', [AuthorizationController::class,'authorizeForm'])->name('authorization');
        Route::get('resend-verify', [AuthorizationController::class,'sendVerifyCode'])->name('send.verify.code');
        Route::post('verify-email', [AuthorizationController::class,'emailVerification'])->name('verify.email');
        Route::post('verify-sms', [AuthorizationController::class,'smsVerification'])->name('verify.sms');
        Route::post('verify-g2fa', [AuthorizationController::class,'g2faVerification'])->name('go2fa.verify');

        Route::middleware(['checkStatus'])->group(function () {
            Route::get('dashboard', [UserController::class,'home'])->name('home');
            Route::get('profile-setting', [UserController::class,'profile'])->name('profile.setting');
            Route::post('profile-setting',  [UserController::class,'submitProfile']);
            Route::get('change-password', [UserController::class,'changePassword'])->name('change.password');
            Route::post('change-password',  [UserController::class,'submitPassword']);
            Route::get('latest/songs',[UserController::class,'latestSongs'])->name('latest.songs');

        // Producer Routes
        Route::prefix('producer')->name('producer.')->group(function () {
            Route::get('profile', [ProducerController::class,'producerProfile'])->name('profile');
            Route::get('season',[ProducerController::class,'getMp3'])->name('mp3');
            // Route::get('create/', [ProducerController::class,'producerCreate'])->name('create');

            //startd manage profile
            Route::get('manage/profile', [ProducerController::class,'manageProfile'])->name('manage.profile');
            Route::post('create/profile', [ProducerController::class,'createProfile'])->name('create.profile');
            Route::post('update/profile', [ProducerController::class,'updateProfile'])->name('update.profile');
            //ended manage profile


            //startd manage team
            Route::get('manage/team', [ProducerController::class,'manageTeam'])->name('manage.team');
            Route::get('create/team', [ProducerController::class,'createTeam'])->name('create.team');
            Route::post('store/team', [ProducerController::class,'storeTeam'])->name('store.team');
            Route::get('edit/team/{id}', [ProducerController::class,'editTeam'])->name('edit.team');
            Route::post('update/team', [ProducerController::class,'updateTeam'])->name('update.team');
            Route::post('delete/team', [ProducerController::class,'deleteTeam'])->name('delete.team');
            //ended manage team


            //startd manage Radio Program
            Route::get('manage/radio-program', [ProducerController::class,'manageRadioProgram'])->name('manage.radio.program');
            Route::get('create/radio-program', [ProducerController::class,'createRadioProgram'])->name('create.radio.program');
            Route::post('store/radio-program', [ProducerController::class,'storeRadioProgram'])->name('store.radio.program');
            Route::get('edit/radio-program/{id}', [ProducerController::class,'editRadioProgram'])->name('edit.radio.program');
            Route::post('update/radio-program', [ProducerController::class,'updateRadioProgram'])->name('update.radio.program');
            Route::post('delete/radio-program', [ProducerController::class,'deleteRadioProgram'])->name('delete.radio.program');
            //ended manage Radio Program

            //startd manage News
            Route::get('manage/news', [ProducerController::class,'manageNews'])->name('manage.news');
            Route::get('create/news', [ProducerController::class,'createNews'])->name('create.news');
            Route::post('store/news', [ProducerController::class,'storeNews'])->name('store.news');
            Route::get('edit/news/{id}', [ProducerController::class,'editNews'])->name('edit.news');
            Route::post('update/news', [ProducerController::class,'updateNews'])->name('update.news');
            Route::post('delete/news', [ProducerController::class,'deleteNews'])->name('delete.news');
            //ended manage News

            //startd manage video
            Route::get('manage/video', [ProducerController::class,'manageVideo'])->name('manage.video');
            Route::get('create/video', [ProducerController::class,'createVideo'])->name('create.video');
            Route::post('store/video', [ProducerController::class,'storeVideo'])->name('store.video');
            Route::get('edit/video/{id}', [ProducerController::class,'editVideo'])->name('edit.video');
            Route::post('update/video', [ProducerController::class,'updateVideo'])->name('update.video');
            Route::post('delete/video', [ProducerController::class,'deleteVideo'])->name('delete.video');
            //ended manage video




        });

         // Podcast Routes
        Route::prefix('podcast')->name('podcast.')->group(function () {
            // Podcast Channel Routes
            Route::prefix('season')->name('season.')->group(function () {
                Route::get('list', [PodcastController::class,'allSeasons'])->name('index');
                Route::get('create', [PodcastController::class,'createSeasons'])->name('create');
                Route::post('store', [PodcastController::class,'storeSeasons'])->name('store');
                Route::get('edit/{id}', [PodcastController::class,'editSeasons'])->name('edit');
                Route::post('update', [PodcastController::class,'updateSeasons'])->name('update');
                Route::post('delete', [PodcastController::class,'deleteSeasons'])->name('delete');
            });
            // Podcast Songs Routes
            Route::prefix('episode')->name('episode.')->group(function () {
                Route::get('list', [PodcastController::class,'allEpisode'])->name('index');
                Route::get('create', [PodcastController::class,'createEdisode'])->name('create');
                Route::post('store', [PodcastController::class,'storeEpisode'])->name('store');
                Route::get('edit/{id}', [PodcastController::class,'editEpisode'])->name('edit');
                Route::post('update', [PodcastController::class,'updateEpisode'])->name('update');
                Route::post('delete', [PodcastController::class,'deleteEpisode'])->name('delete');
                Route::get('mp3',[PodcastController::class,'getMp3'])->name('mp3');


            });
        });

         // Favourite Songs Routes
         Route::prefix('favourite')->name('favourite.')->group(function () {
            Route::get('/song-list', [FavouriteSongsController::class,'favouriteSongs'])->name('index');
            Route::get('/list', [FavouriteSongsController::class,'favMp3'])->name('fav.mp3');
        });
         // Social  Routes
         Route::prefix('social/icons')->name('social.')->group(function () {
            Route::get('/', [UserSocialController::class,'socialIcons'])->name('icons');
            Route::get('/create', [UserSocialController::class,'createSocialIcon'])->name('create');
            Route::post('/create', [UserSocialController::class,'storeSocialIcon']);
            Route::get('/edit/{id}', [UserSocialController::class,'editSocialIcon'])->name('edit');
            Route::post('/update', [UserSocialController::class,'updateSocialIcon'])->name('update');
            Route::post('/delete', [UserSocialController::class,'deleteSocialIcon'])->name('delete');

        });


        //podcast profile
        Route::post('/comments', [SiteController::class,'doComments'])->name('comments');
        Route::post('episode/favorite', [SiteController::class,'favorite'])->name('episode.favorite');
        Route::post('profile/follow', [SiteController::class,'follow'])->name('profile.follow');

        });
    });
});


Route::get('/contact', [SiteController::class,'contact'])->name('contact');
Route::post('/contact-us', [SiteController::class,'contactSubmit'])->name('contact.submit');
Route::post('/subscribe', [SiteController::class,'subscribe'])->name('subscribe');
Route::get('/about', [SiteController::class,'about'])->name('about');
Route::get('/faq', [SiteController::class,'faq'])->name('faq');
Route::get('/change/{lang?}', [SiteController::class,'changeLanguage'])->name('lang');
Route::get('/news/details/{id}', [SiteController::class,'newsDetails'])->name('news.details');

Route::get('/cookie/accept', 'SiteController@cookieAccept')->name('cookie.accept');
Route::get('policy-terms/{slug}/page/{id}', [SiteController::class,'policyAndTerms'])->name('policy.page');

Route::get('placeholder-image/{size}',[SiteController::class,'placeholderImage'])->name('placeholder.image');

Route::get('/{slug}',  [SiteController::class,'pages'])->name('pages');
Route::get('/', [SiteController::class,'index'])->name('home');
Route::get('featured/episodes',[SiteController::class,'featuredMp3'])->name('featured.mp3');

// Podcasts Routes
Route::prefix('podcasts')->name('podcasts.')->group(function () {
    Route::get('list', [SiteController::class,'podcastList'])->name('list');
    Route::get('owner/profile/{id}', [SiteController::class,'podcastOwnerProfile'])->name('owner.profile');
    Route::get('details/{id}/{slug}', [SiteController::class,'podcastDetails'])->name('details');
    Route::get('episode/mp3', [SiteController::class,'podcastMp3'])->name('episode.mp3');
    Route::get('featured/list', [SiteController::class,'featuredPodcastList'])->name('featured.list');
    Route::get('featured/{id}/{slug}', [SiteController::class,'featuredPodcastDetails'])->name('featured.details');
    Route::get('episode/{download}', [SiteController::class,'episodeDownload'])->name('episode.download');


});
// User Support Ticket
Route::prefix('support/ticket')->group(function () {
    Route::get('/', [TicketController::class,'supportTicket'])->name('ticket');
    Route::get('/new', [TicketController::class,'openSupportTicket'])->name('ticket.open');
    Route::post('/create', [TicketController::class,'storeSupportTicket'])->name('ticket.store');
    Route::get('/view/{ticket}', [TicketController::class,'viewTicket'])->name('ticket.view');
    Route::post('/reply/{ticket}', [TicketController::class,'replyTicket'])->name('ticket.reply');
    Route::get('/download/{ticket}', [TicketController::class,'ticketDownload'])->name('ticket.download');
});
