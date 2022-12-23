<?php

use App\Models\AdminNewsLike;
use App\Models\AdminVipPricing;
use App\Models\AdminNewsComment;
use App\Models\AdminPaypalGetway;
use App\Models\AdminLiveTvComment;
use Doctrine\DBAL\Driver\Middleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\BookController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminVoteController;
use App\Http\Controllers\Payments\PaypalController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminMusicController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminLiveTvController;
use App\Http\Controllers\Admin\AdminMoviesController;
use App\Http\Controllers\Admin\AdminPaypalController;
use App\Http\Controllers\Admin\AdminSocialController;
use App\Http\Controllers\Admin\AdminStripeController;
use App\Http\Controllers\Admin\AdminPricingController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSmileTvController;
use App\Http\Controllers\Frontend\UsersAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminGetwayController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\AdminManageSiteController;
use App\Http\Controllers\Admin\AdminTicketTypeController;
use App\Http\Controllers\Admin\AdminUserManageController;
use App\Http\Controllers\Admin\AdminVideoMusicController;
use App\Http\Controllers\Admin\AdminVipPricingController;
use App\Http\Controllers\Frontend\UserWithDrawController;
use App\Http\Controllers\Admin\AdminMailSeetingController;
use App\Http\Controllers\Payments\StripePaymentController;
use App\Http\Controllers\Frontend\UsersDeshboardController;
use App\Http\Controllers\Admin\AdminLiveTvCommentController;
use App\Http\Controllers\Admin\AdminPriceCurrencyController;
use App\Http\Controllers\Admin\AdminPriceCurrencieController;
use App\Http\Controllers\Admin\ManualPaymentGetwayController;
use App\Http\Controllers\Admin\AdminNewsLikeCommentController;
use App\Http\Controllers\Admin\AdminLiveTvLikeCommentController;
use App\Http\Controllers\Admin\AdminSmileTvLikeCommentController;
use App\Http\Controllers\Frontend\UserBuyManualController;
use App\Http\Controllers\Frontend\UserManualGetwayRequestController;


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

//To clear all cache
Route::get('cc', function () {
    Artisan::call('optimize:clear');
    return "Cleared!";
});


// Admin Login & Logout
Route::get('admin', [AdminAuthController::class, 'getLoginForm'])->name('login.form');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'getLogin'])->name('login-form');
    Route::post('login', [AdminAuthController::class, 'postLogin'])->name('login');
    Route::get('logout', [AdminAuthController::class, 'getLogout'])->name('logout');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    require_once __DIR__ . '/admin/acl.php';
    require_once __DIR__ . '/admin/user.php';
    require_once __DIR__ . '/admin/email.php';
    require_once __DIR__ . '/admin/settings.php';
    require_once __DIR__ . '/admin/sms.php';
    require_once __DIR__ . '/admin/gateways.php';
    require_once __DIR__ . '/admin/extra.php';
});



// --------------------Users all route--------------------
Route::namespace('Frontend')->group(function () {

    // --------------------user page route--------------------
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('top/all/movies', [HomeController::class, 'allTopMovies'])->name('all.top.movies');
    Route::get('ticket-type/pricing', [HomeController::class, 'ticketTypePricing'])->name('ticketTypePricing');
    Route::get('voting', [HomeController::class, 'voting'])->name('voting');
    Route::get('books', [HomeController::class, 'books'])->name('books');
    Route::get('books-details/{id}', [HomeController::class, 'bookTransaction'])->name('book_details');
    Route::get('books-user/profile/{id}', [HomeController::class, 'bookUserProfile'])->name('book.user.profile');
    Route::get('books-admin/profile/{id}', [HomeController::class, 'bookAdminProfile'])->name('book.admin.profile');
    Route::get('live/now', [HomeController::class, 'live_now'])->name('live_now');
    Route::get('live/now/details/{id}', [HomeController::class, 'live_now_details'])->name('live.now.details');
    Route::get('live/now/play/{id}', [HomeController::class, 'liveTvPlay'])->name('live.tv.movies.play');
    Route::get('music', [HomeController::class, 'music'])->name('music');
    Route::get('latest/songs', [HomeController::class, 'latestSongs'])->name('latest.songs');
    Route::get('smile/tv', [HomeController::class, 'smile_tv'])->name('smile_tv_');
    Route::get('smile-tv', [HomeController::class, 'smileTv'])->name('smile_tv');
    Route::get('events', [HomeController::class, 'event'])->name('event');
    Route::get('all/event/plans/{id}', [HomeController::class, 'eventAllPlans'])->name('event.all.plan');
    Route::get('event/plan/pricing/{id}', [HomeController::class, 'eventPlanPricing'])->name('event.plan.pricing');
    Route::get('top/movies/play/{id}', [HomeController::class, 'topMoviesPlay'])->name('top.movies.play');
    Route::get('item/movies/play/{id}', [HomeController::class, 'itemMoviesPlay'])->name('new.item.movies.play');
    Route::get('comming/soon/movies/play/{id}', [HomeController::class, 'commingSoonMoviesPlay'])->name('comming.soon.movies.play');
    Route::get('video/music/play/{id}', [HomeController::class, 'videoMusicPlay'])->name('video.music.play');



    // -------------------Live tv details comment -----------------
    Route::post('user/live/tv/details', [AdminLiveTvLikeCommentController::class, 'liveTvComment'])->name('live.tv.comment');

    // -------------------Live tv details like -----------------
    Route::post('user/live/tv/details/like', [AdminLiveTvLikeCommentController::class, 'liveTvLike'])->name('live.tv.like');
    // -------------------Live tv details Dislike -----------------
    Route::post('user/live/tv/details/dislike', [AdminLiveTvLikeCommentController::class, 'liveTvDisLike'])->name('live.tv.dislike');

    // -------------------Smile tv show -----------------
    Route::get('user/smile/tv/{id}', [AdminSmileTvLikeCommentController::class, 'smileTvdetails'])->name('smile.tv.details');

    // -------------------Smile tv details comment -----------------
    Route::post('user/smile/tv/details', [AdminSmileTvLikeCommentController::class, 'smileTvComment'])->name('smile.tv.comment');

    // -------------------Smile tv details like -----------------
    Route::post('user/smile/tv/details/like', [AdminSmileTvLikeCommentController::class, 'smileTvLike'])->name('smile.tv.like');

    // -------------------Smile tv details Dislike -----------------
    Route::post('user/smile/tv/details/dislike', [AdminSmileTvLikeCommentController::class, 'smileTvDisLike'])->name('smile.tv.dislike');

    // -------------------news details comment -----------------
    Route::post('user/news/details', [AdminNewsLikeCommentController::class, 'newsComment'])->name('news.comment');

    // -------------------news details like -----------------
    Route::post('user/news/details/like', [AdminNewsLikeCommentController::class, 'newsLike'])->name('news.like');

    // --------------------navbar events list-------------------- 
    Route::get('user/event/{name}', [HomeController::class, 'eventList'])->name('user.event');

    // -------------------- User Email verify by OTP--------------------
    Route::get('otp', [UsersAuthController::class, 'userOtpForm'])->name('otp.form');
    Route::post('otp', [UsersAuthController::class, 'userOtp'])->name('otp');

    // --------------------user login route--------------------
    Route::match(['get', 'post'], 'registration', [UsersAuthController::class, 'userRegistrationForm'])->name('registration');
    Route::get('login', [UsersAuthController::class, 'userLoginForm'])->name('login');
    Route::post('login/action', [UsersAuthController::class, 'loginAction'])->name('login.action');
    Route::get('logout', [UsersAuthController::class, 'logout'])->name('logout');



    // ------------------- user password reset-------------------
    Route::get('password/reset/email/view', [UsersAuthController::class, 'passwordResetEmailView'])->name('password.reset.email.view');
    Route::post('password/reset/email', [UsersAuthController::class, 'passwordResetEmail'])->name('password.reset.email');
    Route::get('password-reset/otp/{id}', [UsersAuthController::class, 'userPasswordResetOtpForm'])->name('password.reset.otp.form');

    Route::post('password/otp/check', [UsersAuthController::class, 'passwordResetOTPCheck'])->name('password.reset.OTP.check');
    Route::get('password/reset/{id}', [UsersAuthController::class, 'passwordResetView'])->name('password.reset.view');
    Route::post('password/reset', [UsersAuthController::class, 'passwordReset'])->name('password.reset');



    //--------------------user deshboard route--------------------
    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'general_user'], function () {
        Route::get('deshboard', [UsersDeshboardController::class, 'index'])->name('deshboard');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');


        // ------------------- user password Change-------------------
        Route::get('password/change', [ProfileController::class, 'passwordChange'])->name('password.change');
        Route::post('password/change/store', [ProfileController::class, 'passwordChangeStore'])->name('password.change.store');
        // Route::post('password/reset/email', [ProfileController::class, 'passwordResetEmail'])->name('password.reset.email');
        // Route::get('password-reset/otp/{id}', [ProfileController::class, 'userPasswordResetOtpForm'])->name('password.reset.otp.form');

        // Route::post('password/otp/check', [ProfileController::class, 'passwordResetOTPCheck'])->name('password.reset.OTP.check');
        // Route::get('password/reset/{id}', [ProfileController::class, 'passwordResetView'])->name('password.reset.view');
        // Route::post('password/reset', [ProfileController::class, 'passwordReset'])->name('password.reset');

        // --------------------event all route--------------------
        Route::get('events', [EventController::class, 'events'])->name('events');
        Route::post('store/events', [EventController::class, 'storeEvents'])->name('store.events');
        Route::get('edit/events/{id}', [EventController::class, 'editEvents'])->name('edit.events');
        Route::post('update/events/{id}', [EventController::class, 'updateEvents'])->name('update.events');
        Route::get('view/events/{id}', [EventController::class, 'viewEvents'])->name('view.events');

        // --------------------book all route--------------------
        Route::get('book', [BookController::class, 'books'])->name('books');
        Route::post('store/books', [BookController::class, 'storeBooks'])->name('store.books');
        Route::get('edit/books/{id}', [BookController::class, 'editBooks'])->name('edit.books');
        Route::post('update/books/{id}', [BookController::class, 'updateBooks'])->name('update.books');
        Route::get('destroy/books/{id}', [BookController::class, 'destroy'])->name('destroy.books');

        // --------------------news all route--------------------
        Route::get('news', [NewsController::class, 'news'])->name('news');
        Route::post('store/news', [NewsController::class, 'storeNews'])->name('store.news');
        Route::post('edit/ststus/news/{id}', [NewsController::class, 'newsStatusEdit'])->name('news.status.edit');
        Route::get('edit/news/{id}', [NewsController::class, 'editNews'])->name('edit.news');
        Route::post('update/news/{id}', [NewsController::class, 'updateNews'])->name('update.news');
        Route::get('destroy/news/{id}', [NewsController::class, 'destroy'])->name('destroy.news');

        // --------------------bying Books all route--------------------
        Route::get('buying/books', [UsersDeshboardController::class, 'buyingBooks'])->name('buying.books.view');
        Route::get('books/pdf/{id}', [UsersDeshboardController::class, 'openPDF'])->name('open.pdf');

        // --------------------bying Event ticket all route--------------------
        Route::get('buying/events/ticket', [UsersDeshboardController::class, 'buyingEventTicket'])->name('buying.event.ticket.view');

        // --------------------bying Plan ticket all route--------------------
        Route::get('buying/plan/ticket', [UsersDeshboardController::class, 'buyingPlanTicket'])->name('buying.plan.ticket.view');


        // --------------------withdraw all route--------------------
        Route::get('withdraw', [UserWithDrawController::class, 'index'])->name('withdraw');
        Route::Post('withdraw/request', [UserWithDrawController::class, 'withdrawRequest'])->name('withdraw.request');
        Route::get('withdraw/history', [UserWithDrawController::class, 'withdraw_history'])->name('withdraw_history');
        Route::get('user/getway/request/view/{id}', [UserWithDrawController::class, 'user_manual_getway_request_view'])->name('manual.getway.request.view');

        // --------------------Buy manual getway Books all route--------------------
        Route::get('buy-manual', [UserBuyManualController::class, 'index'])->name('buy.manual');
        Route::post('buy-book/request', [UserBuyManualController::class, 'buyPricingRequest'])->name('buy.book.pricing.request');
        Route::get('withdraw/history', [UserWithDrawController::class, 'withdraw_history'])->name('withdraw_history');
        Route::get('user/getway/request/view/{id}', [UserWithDrawController::class, 'user_manual_getway_request_view'])->name('manual.getway.request.view');


        Route::post('getway/check', [UsersDeshboardController::class, 'getwayCheck'])->name('getway.check');
    });
    // --------------------if login then access pages--------------------
    Route::group(['middleware' => 'general_user'], function () {
        Route::get('place_order/{id}', [UsersDeshboardController::class, 'placeOrder'])->name('place_order');

        // -----------------------------ticket-type pricing place order----------------------------
        Route::get('ticket-type/pricing/place_order/{id}', [UsersDeshboardController::class, 'ticketTypePricingPlaceOrder'])->name('ticketType.Pricing.place_order');

        //  -------------------------------Event plan Transaction-------------------------------
        Route::get('event/plan/pricing/place-order/{id}', [UsersDeshboardController::class, 'eventPlanTransaction'])->name('event.plan.pricing.place.order');

        // ---------------User Voted---------------
        Route::post('voted/store', [UsersDeshboardController::class, 'UserStoreVoted'])->name('store.voted');
        Route::get('vote-details/{id}', [UsersDeshboardController::class, 'voteDetails'])->name('vote_details');

        // ---------------User coupon---------------
        Route::post('coupon/check', [UsersDeshboardController::class, 'UserCouponCheck'])->name('user.coupon.check');

        // ---------------User Payment---------------
        Route::post('user/payment', [UsersDeshboardController::class, 'userPayment'])->name('user.payment');

       // --------------------- news---------------------
       Route::get('news', [HomeController::class, 'news'])->name('news');
       Route::get('news-details/{id}', [HomeController::class, 'newsDetails'])->name('news_details');


       //------------------------access movies/ music------------------------
       Route::post('user/package/access', [HomeController::class, 'userPackageAccess'])->name('user.package.access');


    });
});

//  --------------------Admin all route--------------------
Route::namespace('Admin')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
        // ---------------admin category controller---------------
        Route::get('category', [AdminCategoryController::class, 'index'])->name('category.index');
        Route::post('category/store', [AdminCategoryController::class, 'storeCategory'])->name('category.store');
        Route::get('category/edit/{id}', [AdminCategoryController::class, 'editCategory'])->name('category.edit');
        Route::post('category/update/{id}', [AdminCategoryController::class, 'updateCategory'])->name('category.update');
        Route::get('category/destroy/{id}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');

        // ---------------admin Ticket Type controller---------------
        Route::get('ticket-type', [AdminTicketTypeController::class, 'index'])->name('ticket.type.index');
        Route::post('ticket-type/store', [AdminTicketTypeController::class, 'storeTicketType'])->name('ticket.type.store');
        Route::get('ticket-type/edit/{id}', [AdminTicketTypeController::class, 'editTicketType'])->name('ticket.type.edit');
        Route::post('ticket-type/update/{id}', [AdminTicketTypeController::class, 'updateTicketType'])->name('ticket.type.update');
        Route::get('ticket-type/destroy/{id}', [AdminTicketTypeController::class, 'destroy'])->name('ticket.type.destroy');

        // ---------------admin access events---------------
        Route::get('event', [AdminEventController::class, 'index'])->name('event.index');
        Route::get('event/view/{id}', [AdminEventController::class, 'editEvent'])->name('event.view');
        Route::post('event/view/{id}', [AdminEventController::class, 'updateEvents'])->name('event.update');
        Route::post('event/status/edit/{id}', [AdminEventController::class, 'editStatusEvent'])->name('event.status.edit');
        Route::get('event/destroy/{id}', [AdminEventController::class, 'destroy'])->name('event.destroy');

        // ---------------admin access price---------------
        Route::get('price', [AdminPriceCurrencyController::class, 'index'])->name('price.index');
        Route::post('price/store', [AdminPriceCurrencyController::class, 'storeCurrency'])->name('price.currency.store');
        Route::get('price/edit/{id}', [AdminPriceCurrencyController::class, 'editCurrency'])->name('price.currency.edit');
        Route::post('price/update/{id}', [AdminPriceCurrencyController::class, 'updateCurrency'])->name('price.currency.update');

        // ---------------admin Vote---------------
        Route::get('vote', [AdminVoteController::class, 'index'])->name('vote.index');
        Route::post('vote/store', [AdminVoteController::class, 'storeVote'])->name('vote.store');
        Route::get('vote/edit/{id}', [AdminVoteController::class, 'editVote'])->name('vote.edit');
        Route::post('vote/update/{id}', [AdminVoteController::class, 'updateVote'])->name('vote.update');
        Route::post('vote/status/edit/{id}', [AdminVoteController::class, 'editStatusVote'])->name('vote.status.edit');
        Route::get('vote/destroy/{id}', [AdminVoteController::class, 'destroy'])->name('vote.destroy');

        // ---------------admin access Books---------------
        Route::get('book', [AdminBookController::class, 'index'])->name('book.index');
        Route::get('all/books', [AdminBookController::class, 'allBooks'])->name('book.all.books');
        Route::post('store/book', [AdminBookController::class, 'storeBook'])->name('store.book');
        Route::get('/edit/book/{id}', [AdminBookController::class, 'editBook'])->name('edit.book');
        Route::get('view/book/{id}', [AdminBookController::class, 'viewBook'])->name('view.book');
        Route::post('update/book/{id}', [AdminBookController::class, 'updateBook'])->name('update.book');
        Route::post('book/status/edit/{id}', [AdminBookController::class, 'editStatusBook'])->name('book.status.edit');
        Route::get('book/destroy/{id}', [AdminBookController::class, 'destroy'])->name('book.destroy');

        // ---------------admin access Coupon code---------------
        Route::get('coupon', [AdminCouponController::class, 'index'])->name('coupon.index');
        Route::post('coupon/store', [AdminCouponController::class, 'storeCoupon'])->name('coupon.store');
        Route::post('coupon/status/edit/{id}', [AdminCouponController::class, 'editStatusCoupon'])->name('coupon.status.edit');
        Route::get('coupon/destroy/{id}', [AdminCouponController::class, 'destroy'])->name('coupon.destroy');

        // ---------------admin access Music---------------
        Route::get('music', [AdminMusicController::class, 'index'])->name('music.index');
        Route::post('store/music', [AdminMusicController::class, 'storeMusic'])->name('store.music');
        Route::get('edit/music/{id}', [AdminMusicController::class, 'editMusic'])->name('edit.music');
        Route::post('update/music/{id}', [AdminMusicController::class, 'updateMusic'])->name('update.music');
        Route::post('music/status/edit/{id}', [AdminMusicController::class, 'editStatusMusic'])->name('status.edit');
        Route::get('music/destroy/{id}', [AdminMusicController::class, 'destroy'])->name('music.destroy');

        // ---------------admin access Music---------------
        Route::get('video/music', [AdminVideoMusicController::class, 'index'])->name('video.music.index');
        Route::post('store/video/music', [AdminVideoMusicController::class, 'storeMusic'])->name('store.video.music');
        Route::get('edit/video/music/{id}', [AdminVideoMusicController::class, 'editMusic'])->name('edit.video.music');
        Route::post('update/video/music/{id}', [AdminVideoMusicController::class, 'updateMusic'])->name('update.video.music');
        Route::post('video/music/status/edit/{id}', [AdminVideoMusicController::class, 'editStatusMusic'])->name('video.musicstatus.edit');
        Route::get('video/music/destroy/{id}', [AdminVideoMusicController::class, 'destroy'])->name('destroy.video.music');

        // ---------------admin access News---------------
        Route::get('news', [AdminNewsController::class, 'index'])->name('news.index');
        Route::get('all/news', [AdminNewsController::class, 'allNews'])->name('all.news');
        Route::post('store/news', [AdminNewsController::class, 'storeNews'])->name('store.news');
        Route::get('edit/news/{id}', [AdminNewsController::class, 'editNews'])->name('edit.news');
        Route::post('update/news/{id}', [AdminNewsController::class, 'updateNews'])->name('update.news');
        Route::get('news/view/{id}', [AdminNewsController::class, 'viewNews'])->name('view.news');
        Route::post('news/status/edit/{id}', [AdminNewsController::class, 'editStatusNews'])->name('news.status.edit');
        Route::get('news/destroy/{id}', [AdminNewsController::class, 'destroy'])->name('news.destroy');

        // ---------------admin Live Now  ---------------
        Route::get('live-tv', [AdminLiveTvController::class, 'index'])->name('live.tv.index');
        Route::post('store/live/tv', [AdminLiveTvController::class, 'storeLiveTv'])->name('store.live.tv');
        Route::get('edit/live/tv/{id}', [AdminLiveTvController::class, 'editLiveTv'])->name('edit.live.tv');
        Route::post('update/live/tv/{id}', [AdminLiveTvController::class, 'updateLiveTv'])->name('update.live.tv');
        Route::post('live/tv/status/edit/{id}', [AdminLiveTvController::class, 'editStatusLiveTv'])->name('live.tv.status.edit');
        Route::get('live/tv/destroy/{id}', [AdminLiveTvController::class, 'destroy'])->name('live.tv.destroy');

        // ---------------admin access site social link---------------
        Route::get('social', [AdminSocialController::class, 'index'])->name('social.index');
        // Route::post('social/store', [AdminSocialController::class, 'storeSocial'])->name('social.store');
        Route::get('social/edit/{id}', [AdminSocialController::class, 'editSocial'])->name('social.edit');
        Route::post('social/update/{id}', [AdminSocialController::class, 'updateSocial'])->name('social.update');


        // ---------------admin smile Tv  ---------------
        Route::get('smile-tv', [AdminSmileTvController::class, 'index'])->name('smile.tv.index');
        Route::post('store/smile/tv', [AdminSmileTvController::class, 'storeSmileTv'])->name('store.smile.tv');
        Route::get('edit/smile/tv/{id}', [AdminSmileTvController::class, 'editSmileTv'])->name('edit.smile.tv');
        Route::post('update/smile/tv/{id}', [AdminSmileTvController::class, 'updateSmileTv'])->name('update.smile.tv');
        Route::post('smile/tv/status/edit/{id}', [AdminSmileTvController::class, 'editStatusSmileTv'])->name('smile.tv.status.edit');
        Route::get('smile/tv/destroy/{id}', [AdminSmileTvController::class, 'destroy'])->name('smile.tv.destroy');

        // ---------------admin Pricing ---------------
        Route::get('pricing', [AdminPricingController::class, 'index'])->name('pricing.index');
        Route::post('store/pricing', [AdminPricingController::class, 'storePricing'])->name('store.pricing');
        Route::get('edit/pricing/{id}', [AdminPricingController::class, 'editPricing'])->name('edit.pricing');
        Route::post('update/pricing/{id}', [AdminPricingController::class, 'updatePricing'])->name('update.pricing');
        Route::post('pricing/status/edit/{id}', [AdminPricingController::class, 'editStatusPricing'])->name('pricing.status.edit');
        Route::get('pricing/destroy/{id}', [AdminPricingController::class, 'destroy'])->name('pricing.destroy');


        // ---------------admin Manage site New Item Movies---------------
        Route::get('home/new-item-season/manage', [AdminMoviesController::class, 'newItemSeason'])->name('home.newItemSeason');
        Route::post('store/home/new-item-season/manage', [AdminMoviesController::class, 'storeNewItemSeason'])->name('store.newItemSeason');
        Route::get('edit/home/new-item-season/manage/{id}', [AdminMoviesController::class, 'editNewItemSeason'])->name('edit.newItemSeasons');
        Route::post('update/home/new-item-season/manage/{id}', [AdminMoviesController::class, 'updateNewItemSeason'])->name('update.newItemSeason');
        Route::post('home/new-item-season/manage/edit/{id}', [AdminMoviesController::class, 'editStatusNewItemSeason'])->name('newItemSeason.status.edit');
        Route::get('home/new-item-season/manage/{id}', [AdminMoviesController::class, 'destroy'])->name('destroy.newItemSeason');

        // ---------------admin Top Movies---------------
        Route::get('home/top/manage', [AdminMoviesController::class, 'topMovies'])->name('home.top.movies');
        Route::post('store/home/top/manage', [AdminMoviesController::class, 'storeTopMovies'])->name('store.top.movies');
        Route::get('edit/home/top/manage/{id}', [AdminMoviesController::class, 'editTopMovies'])->name('edit.top.movies');
        Route::post('update/home/top/manage/{id}', [AdminMoviesController::class, 'updateTopMovies'])->name('update.top.movies');
        Route::post('home/top/manage/edit/{id}', [AdminMoviesController::class, 'editStatusTopMovies'])->name('top.movies.status.edit');
        Route::get('home/top/manage/{id}', [AdminMoviesController::class, 'destroyTopMovies'])->name('destroy.top.movies');

        // ---------------admin Comming-Soon Movies---------------
        Route::get('home/comming-soon/manage', [AdminMoviesController::class, 'commingSoonMovies'])->name('home.comming.soon.movies');
        Route::post('store/home/comming-soon/manage', [AdminMoviesController::class, 'storeCommingSoonMovies'])->name('store.comming.soon.movies');
        Route::get('edit/home/comming-soon/manage/{id}', [AdminMoviesController::class, 'editCommingSoonMovies'])->name('edit.comming.soon.movies');
        Route::post('update/home/comming-soon/manage/{id}', [AdminMoviesController::class, 'updateCommingSoonMovies'])->name('update.comming.soon.movies');
        Route::post('home/comming-soon/manage/edit/{id}', [AdminMoviesController::class, 'editStatusCommingSoonMovies'])->name('comming.soon.movies.status.edit');
        Route::get('home/comming-soon/manage/{id}', [AdminMoviesController::class, 'destroyCommingSoonMovies'])->name('destroy.comming.soon.movies');

        // ---------------admin Manage Site---------------
        Route::get('manage/site', [AdminManageSiteController::class, 'index'])->name('manage.site');
        Route::post('store/manage/site', [AdminManageSiteController::class, 'storeManageSite'])->name('store.manage.site');
        Route::get('edit/manage/site/{id}', [AdminManageSiteController::class, 'editManageSite'])->name('edit.manage.site');
        Route::post('update/manage/site/{id}', [AdminManageSiteController::class, 'updateManageSite'])->name('update.manage.site');
        Route::post('manage/site/edit/{id}', [AdminManageSiteController::class, 'editStatusManageSite'])->name('manage.site.status.edit');
        Route::get('manage/site/{id}', [AdminManageSiteController::class, 'destroyManageSite'])->name('destroy.manage.site');

        // ---------------admin Mail Setup---------------
        Route::get('mail', [AdminMailSeetingController::class, 'index'])->name('mail.view');
        Route::get('mail/template', [AdminMailSeetingController::class, 'mailTemplate'])->name('template.mail');
        Route::post('update/mail/{id}', [AdminMailSeetingController::class, 'mailUpdate'])->name('update.mail');




        Route::get('email-template/global', [EmailTemplateController::class, 'emailTemplate'])->name('email.template.global');
        Route::post('email-template/global', [EmailTemplateController::class, 'emailTemplateUpdate'])->name('email.template.global.update');
        Route::get('email-template/setting',  [EmailTemplateController::class, 'emailSetting'])->name('email.template.setting.');
        Route::post('email-template/setting',  [EmailTemplateController::class, 'emailSettingUpdate'])->name('email.template.setting');
        Route::get('email-template/index',  [EmailTemplateController::class, 'index'])->name('email.template.index');
        Route::get('email-template/{id}/edit',  [EmailTemplateController::class, 'edit'])->name('email.template.edit');
        Route::post('email-template/{id}/update', [EmailTemplateController::class, 'update'])->name('email.template.update');
        Route::post('email-template/send-test-mail', [EmailTemplateController::class, 'sendTestMail'])->name('email.template.test.mail');
        Route::get('email-template/send-all-mail', [EmailTemplateController::class, 'sendMailNotification'])->name('email.template.mail.noticication');



        // ---------------admin paypal Getway Setup---------------
        Route::get('paypal', [AdminPaypalController::class, 'index'])->name('paypal.paymentgetway.view');
        Route::post('paypal/update/{id}', [AdminPaypalController::class, 'UpdatePaypal'])->name('update.paypal.paymentgetway');

        // ---------------admin stripe Getway Setup---------------
        Route::get('stripe', [AdminStripeController::class, 'index'])->name('stripe.paymentgetway.view');
        Route::post('stripe/update/{id}', [AdminStripeController::class, 'UpdateSrtipe'])->name('update.stripe.paymentgetway');



        // admin automatic getway 
        Route::get("automatic/getway",[AdminGetwayController::class, 'index'])->name('automatic.getway');



        // admin manual payment Getway Setup---------------
        Route::get('manual-payment', [ManualPaymentGetwayController::class, 'index'])->name('manual.paymentgetway.view');
        Route::get('manual-payment/add', [ManualPaymentGetwayController::class, 'addPayment'])->name('manual.paymentgetway.addpayment');
        Route::post('manual-payment/store', [ManualPaymentGetwayController::class, 'store'])->name('manual.paymentgetway.store');
        Route::get('manual-payment/edit/{id}', [AdminManageSiteController::class, 'edit'])->name('manual.paymentgetway.edit');
        Route::post('manual-payment/update/{id}', [ManualPaymentGetwayController::class, 'update'])->name('manual.paymentgetway.update');
        Route::post('manual-getway/status/edit/{id}', [ManualPaymentGetwayController::class, 'manualGetwayStatusEdit'])->name('manual.getway.status.edit');
        Route::get('manual-payment/destroy/{id}', [ManualPaymentGetwayController::class, 'destroy'])->name('manual.paymentgetway.destroy');


      

        // admin buy manual payment Getway Setup---------------
        Route::get('buy-manual-getway', [ManualPaymentGetwayController::class, 'buyManualGetway'])->name('buy.manual.getway.view');
        Route::get('buy/manual-getway/add', [ManualPaymentGetwayController::class, 'buyManualAdd'])->name('buy.manual.paymentgetway.addpayment');
        Route::post('buy/manual-getway/store', [ManualPaymentGetwayController::class, 'buyManualStore'])->name('manual.paymentgetway.store');
        Route::get('manual-payment/edit/{id}', [AdminManageSiteController::class, 'edit'])->name('manual.paymentgetway.edit');
        Route::post('manual-payment/update/{id}', [ManualPaymentGetwayController::class, 'update'])->name('manual.paymentgetway.update');
        Route::post('buy/manual-getway/status/edit/{id}', [ManualPaymentGetwayController::class, 'buyManualGetwayStatusEdit'])->name('buy.manual.getway.status.edit');
        Route::get('buy/manual-payment/destroy/{id}', [ManualPaymentGetwayController::class, 'buyGetwayDestroy'])->name('buy.manual.paymentgetway.destroy');




        // Route::post('buy-manual-getway', [ManualPaymentGetwayController::class, 'buyManualGetway'])->name('buy.manual.getway.view');


        // ---------------admin Profile ---------------
        Route::get('profile', [AdminProfileController::class, 'adminProfile'])->name('profile');
        Route::post('store/profile', [AdminProfileController::class, 'storeProfile'])->name('profile.update');
        Route::get('password/change', [AdminProfileController::class, 'passwordChange'])->name('password.change.view');
        Route::post('password/update/{id}', [AdminProfileController::class, 'updatePasssword'])->name('update.password');



        // ---------------admin access withdraw request ---------------
        Route::get('user/manual-getway/request', [UserManualGetwayRequestController::class, 'index'])->name('withdraw.request');
        Route::get('user/withdraw/approved', [UserManualGetwayRequestController::class, 'approvedAllReq'])->name('withdraw.approved');
        Route::get('user/withdraw/pending', [UserManualGetwayRequestController::class, 'pendingAllReq'])->name('withdraw.pending');
        Route::get('user/withdraw/reject', [UserManualGetwayRequestController::class, 'rejectedAllReq'])->name('withdraw.reject');
       
        Route::get('user/withdraw/request/view/{id}', [UserManualGetwayRequestController::class, 'viewRequest'])->name('user.manual.getway.request.view');
        Route::get('user/manual-getway/request/approved/{id}', [UserManualGetwayRequestController::class, 'approved'])->name('manual.getway.request.approved');
        Route::post('user/manual-getway/request/reject/{id}', [UserManualGetwayRequestController::class, 'reject'])->name('manual.getway.request.reject');
        //  Route::post('password/update/{id}', [AdminProfileController::class, 'updatePasssword'])->name('update.password');


        // ------------------------------------- admin manage users ---------------
        Route::get('all-users', [AdminUserManageController::class, 'allUsers'])->name('all.users');
        Route::get('active-users', [AdminUserManageController::class, 'activeUsers'])->name('active.users');
        Route::get('banned-users', [AdminUserManageController::class, 'bannedUsers'])->name('banned.users');
        Route::post('user/status/edit/{id}', [AdminUserManageController::class, 'statusAccess'])->name('user.access.edit');
        Route::get('banned-users', [AdminUserManageController::class, 'bannedUsers'])->name('banned.users');
        Route::get('User-details/{id}', [AdminUserManageController::class, 'userDetails'])->name('view.user');
        Route::get('plan', [AdminUserManageController::class, 'plan'])->name('plan.users');



        // ------------------------------------- admin manage users ---------------
        Route::get('seo/manage', [GeneralSettingController::class, 'seoPage'])->name('seo.page');
    });
});

//  --------------------payments all route--------------------
Route::namespace('payments')->group(function () {

    // --------------Paypal gateway route for books--------------
    route::get('createpaypal', [PaypalController::class, 'createpaypal'])->name('createpaypal');
    route::post('processPaypal', [PaypalController::class, 'processPaypal'])->name('processPaypal');
    route::get('Process/paypal/success/{id}', [PaypalController::class, 'processPaypalSuccess'])->name('processPaypalSuccess');
    route::get('process/paypal/cancel/{id}', [PaypalController::class, 'processPaypalCancel'])->name('processPaypalCancel');

    // --------------Paypal gateway route for Ticket type pricing--------------
    route::post('ticket-type/pricing/processPaypal', [PaypalController::class, 'processPaypalTicketTypePricing'])->name('processPaypal.ticket_type.pricing');
    route::get('ticket-type/pricing/Process/paypal/success/{id}', [PaypalController::class, 'processPaypalSuccessTicketTypePricing'])->name('processPaypalSuccess.ticket_type.pricing');
    route::get('ticket-type/pricing/process/paypal/cancel/{id}', [PaypalController::class, 'processPaypalCancelTicketTypePricing'])->name('processPaypalCancel.ticket_type.pricing');


    // --------------Paypal gateway route for event plan pricing--------------
    route::post('plan/pricing/processPaypal', [PaypalController::class, 'processPaypalPlanPricing'])->name('processPaypal.plan.pricing');
    route::get('plan/Process/paypal/success/{id}', [PaypalController::class, 'processPaypalSuccessPlanPricing'])->name('processPaypalSuccess.plan.pricing');
    route::get('plan/process/paypal/cancel/{id}', [PaypalController::class, 'processPaypalCancelPlanPricing'])->name('processPaypalCancel.plan.pricing');


    // --------------------Stripe getway route for books--------------------
    Route::post('stripe/page', [StripePaymentController::class, 'stripe'])->name('stripe.view');
    // Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
    Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

    // --------------------Stripe getway route for pricing-------------------
    Route::post('pricing/stripe/page', [StripePaymentController::class, 'stripePricing'])->name('stripe.pricing.view');
    Route::post('pricing/stripe', [StripePaymentController::class, 'stripePostPricing'])->name('stripe.pricing.post');

    // --------------------Stripe getway route event plan pricing--------------------
    Route::post('plan/pricing/stripe/page', [StripePaymentController::class, 'stripePlanPricing'])->name('stripe.plan.pricing.view');
    Route::post('plan/pricing/stripe', [StripePaymentController::class, 'stripePostplanPricing'])->name('stripe.plan.pricing.post');
});
