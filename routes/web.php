<?php
use App\Events\MessagePosted;
use Illuminate\Support\Facades\Log;
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

Auth::routes();

Route::get('/users/logout','Auth\LoginController@userLogout')->name('user.logout');


/*backend section*/


/*Administration section start*/
    /*role section start*/
    Route::resource('/role', 'Backend\RoleController');
    /*role section end*/

    /*permission section start*/
    Route::resource('/permission', 'Backend\PermissionController');
    /*permission section end*/

    /*Role Wise Permission section start*/
    Route::resource('role-wise-permission', 'Backend\RoleWisePermissionController');
    /*Role Wise Permission section end*/


    /* User Admin section start*/
    Route::resource('user-admin', 'Backend\UserAdminController');

    Route::get('user-admin-change-password/{id}', 'Backend\UserAdminController@changePasswordView');
    Route::post('user-admin-change-password/{id}', 'Backend\UserAdminController@changePasswordUpdate');
    //change status
    Route::get('user-admin-status/{id}', 'Backend\UserAdminController@status');
    //delete admin
    Route::get('user-admin-delete/{id}', 'Backend\UserAdminController@destroy');
    /* User Admin section end*/
    /*check access controller start*/
    Route::post('check_access/{adminId}/{type}', 'Backend\CheckAccessController@checkAccess');
    /*check access controller end*/
/*Administration section end*/




    
/**/
Route::group(['middleware' => ['auth:admin']], function () {
    /* user list */
    Route::resource('all_user','Backend\UserListController');
    Route::get('user-view','Backend\UserListController@userView');
    Route::post('user_access/{userId}/{type}','Backend\UserAccessController@UserAccess');
    Route::get('user-status/{id}','Backend\UserListController@status');
    Route::get('user-delete/{id}','Backend\UserListController@destroy');

    /* user post list in admin panel*/


    Route::resource('user-post-admin','Backend\UserPostController');
    Route::get('post-verification-request/{post}','Backend\UserPostController@postVerification');
    Route::get('active-post','Backend\UserPostController@active');
    Route::get('in-active-post','Backend\UserPostController@inactive');
    Route::get('verification-request-post','Backend\UserPostController@request');
    Route::get('verified-post','Backend\UserPostController@verification');
    Route::get('post-view/{value}','Backend\UserPostController@postView');
    Route::post('user-post-access/{postId}/{type}','Backend\UserPostAccessController@UserPostAccess');
    Route::get('post-status/{id}','Backend\UserPostController@status');
    Route::get('post-delete/{id}','Backend\UserPostController@destroy');

    /* user list */

        

/*settings section start*/
    /*current city section start*/
    Route::resource('current-city', 'Backend\CurrentCityController');
    /*current city  section end*/
    /*web settings section start*/
    Route::resource('web-settings', 'Backend\WebSettingsController');
    /*web settings section end*/

    /*send-system-config section start*/
    Route::resource('send-system-config', 'Backend\SendSystemConfigController');
    /*send-system-config section end*/

    /*password reset email section start*/
    Route::resource('password-reset-email', 'Backend\PasswordResetEmailController');
    /*password reset email section end*/
    /*account apperoval email section start*/
    Route::resource('account-approval-email', 'Backend\AccountApprovalEmailController');
    /*account apperoval email section end*/
    /*account opening email section start*/
    Route::resource('account-opening-email', 'Backend\AccountOpeningEmailController');
    /*account opening email section end*/

    /*smtp settings section start*/
    Route::resource('smtp-settings', 'Backend\SmtpSettingsController');
    /*smtp settings section end*/

    /*page settings section start*/
    Route::resource('page-settings', 'Backend\PageSettingsController');
    /*page settings section end*/
/*settings section end*/

/*message section start*/
    /*news letter secion start*/
    Route::resource('newsletter', 'Backend\NewsletterController');
    /*news letter secion end*/
    /*contact secion start*/
    Route::resource('contact-message', 'Backend\ContactMessageController');
    /*contact secion end*/
/*message section end*/

/*admin announcement section start*/


    Route::resource('admin-announcement','Backend\AnnouncementController');
    Route::post('admin_announcement_access/{postId}/{type}','Backend\AnnouncementAccessController@AnnouncementAccess');
    Route::get('announcement-status/{id}','Backend\AnnouncementController@status');
    Route::get('admin-announcement-delete/{id}','Backend\AnnouncementController@destroy');
/*admin announcement section end*/


    Route::get('/user-account-report', 'Backend\ReportsController@userReport');
    Route::get('/user-account-report-review', 'Backend\ReportsController@userReportReview');
    Route::get('/user-account-report-block', 'Backend\ReportsController@userReportBlock');
    Route::get('/user-view-report/{status}', 'Backend\ReportsController@userReportView');
    Route::get('/user-single-report-details/{rId}', 'Backend\ReportsController@userSingleReport');

    Route::post('/confirm-review/{id}', 'Backend\ReportsController@confirmReview');

    Route::get('/user-post-report', 'Backend\ReportsController@postReport');
    Route::get('/user-post-report-review', 'Backend\ReportsController@postReportReview');
    Route::get('/user-post-report-block', 'Backend\ReportsController@postReportBlock');
    Route::get('/post-view-report/{status}', 'Backend\ReportsController@postReportView');
    Route::get('/post-single-report-details/{rId}', 'Backend\ReportsController@postSingleReport');

    /*host traveler section*/
    Route::resource('host-accumulator','Backend\HostTravellerController');

    Route::get('accumulator-room-details/{value}','Backend\HostTravellerController@loadDetails');
    Route::post('accumulator-image-upload/{value}','Backend\HostTravellerController@imageUpload');
    Route::post('accumulator-image-remove/{value}','Backend\HostTravellerController@imageRemove');

    Route::get('reserve-accumulator','Backend\HostTravellerController@reserve');
    Route::get('reserve-request-confirm/{id}','Backend\HostTravellerController@reserveRequestConfirm');
    Route::get('reserve-request-reject/{id}','Backend\HostTravellerController@reserveRequestReject');
    Route::get('reserve-request-arrive/{id}','Backend\HostTravellerController@reserveRequestArrive');
    Route::get('reserve-request-postpone/{id}','Backend\HostTravellerController@reserveRequestPostpone');


    /*agencies section*/
    Route::resource('agencies-post-package', 'Backend\AgenciesPostPackageController');
    Route::get('agencies-create/{type}', 'Backend\AgenciesPostPackageController@create');
    Route::get('agencies-view/{type}', 'Backend\AgenciesPostPackageController@index');
    Route::post('agency-post-package-image-upload', 'Backend\AgenciesPostPackageController@imageUpload');
    Route::post('agency-post-package-image-remove', 'Backend\AgenciesPostPackageController@imageRemove');

    Route::resource('agency-services', 'Backend\AgencyServicesController');

    Route::resource('agencies-gallery', 'Backend\AgencyGalleryController');
    Route::post('agency-gallery-image-upload', 'Backend\AgencyGalleryController@imageUpload');
    Route::post('agency-gallery-video-upload', 'Backend\AgencyGalleryController@videoUpload');
    Route::post('agency-gallery-file-delete', 'Backend\AgencyGalleryController@removeFile');

    Route::resource('agencies-about', 'Backend\AgencyAboutController');
    
});

/* admin report section */



Route::prefix('admin')->group(function(){

	Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
	// Password reset routes
	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


});



//
/*backend section*/

//login
    Route::get('/login-page', function () {
        return view('backend.login');
    });



    Route::get('/', function () {
        return redirect('/login');
    });


/*password reset section start*/
    Route::get('check-users/{value}', 'Frontend\UserVerificationController@checkUser');
    Route::get('login-identify', 'Frontend\PasswordResetController@userIdentify');

    Route::get('password-recover/{id}', 'Frontend\PasswordResetController@recover');
    Route::get('recover-method', 'Frontend\PasswordResetController@recoverMethod');

    Route::get('recover-method-code', 'Frontend\PasswordResetController@recoverMethodCode');

    //Route::get('recover-code-method', 'Frontend\PasswordResetController@index');
    Route::get('set-password', 'Frontend\PasswordResetController@setPassword');
    Route::get('confirm-password', 'Frontend\PasswordResetController@confirmPassword');
/*password reset section end*/

    
    Route::resource('users', 'Frontend\UsersController');
    Route::get('/users/account-verification/{id}', 'Frontend\UserVerificationController@view');
    Route::post('users.check-code', 'Frontend\UserVerificationController@checkCode');
    Route::get('user/{id}', 'Frontend\UsersController@userInfo');
    Route::post('update-profile-picture', 'Frontend\UsersController@updateProfilePicture');
    Route::get('update-profile-picture', 'Frontend\UsersController@updateProfilePicture');
    Route::post('update-cover-picture', 'Frontend\UsersController@updateCoverPicture');


Route::group(['middleware' =>'auth'], function(){
    
    Route::post('users/re-generate-code', 'Frontend\UsersController@reGenerateCode');

    Route::get('/', 'Frontend\HomePageController@index');
    
    Route::get('/plans', 'Frontend\HomePageController@index');
    Route::get('/suggestions', 'Frontend\HomePageController@index');
    Route::get('/questions', 'Frontend\HomePageController@index');
    
    Route::get('/check-place/{latitude}/{longitude}', 'Frontend\HomePageController@checkPlace');
    Route::get('/place/{place_id}/plans', 'Frontend\HomePageController@placeWisePostShow');
    Route::get('/place/{place_id}', 'Frontend\HomePageController@placeWisePostShow');
    Route::get('/place/{place_id}/suggestions', 'Frontend\HomePageController@placeWisePostShow');
    Route::get('/place/{place_id}/questions', 'Frontend\HomePageController@placeWisePostShow');

    Route::get('/place-wise-post/{place_id}', 'Frontend\HomePageController@placeWisePost');

    Route::get('/public-wise-markers/{place_id}', 'Frontend\HomePageController@publicMarker');

    Route::get('/place-wise-marker/{place_id}', 'Frontend\HomePageController@placeMarker');

    Route::get('/map', 'Frontend\HomePageController@friendMap');
    Route::get('/map/plans', 'Frontend\HomePageController@friendMap');
    Route::get('/map/suggestions', 'Frontend\HomePageController@friendMap');
    Route::get('/map/questions', 'Frontend\HomePageController@friendMap');
    
    /*user post start*/
    Route::resource('user-post','Frontend\UserPostController');
    Route::get('/user-wise-post/{userId}', 'Frontend\UserPostController@userWisePost');
    Route::get('/user-wise-type-post/{userId}/{type}', 'Frontend\UserPostController@userWiseTypePost');
    Route::post('/post-like','Frontend\UserPostController@postLike');

    //Route::get('post-like-count','Frontend\UserPostController@create');

    //post comment section
    Route::resource('post-comment','Frontend\PostCommentController');
    Route::post('/comment-like','Frontend\PostCommentController@commentLike');

    //post image like section
    Route::resource('post-image','Frontend\PostImageController');
    Route::get('post-image-like', 'Frontend\PostImageController@index');
    Route::post('post-image-like', 'Frontend\PostImageController@imageLike');
    Route::post('post-image-comment', 'Frontend\PostImageController@imageComment');
    Route::post('image-comment-like', 'Frontend\PostImageController@imgCommentLike');

    
    Route::get('/all-comment/{id}','Frontend\PostCommentController@allComment');

    /*post subcomment section*/
    Route::resource('post-sub-comment','Frontend\PostSubCommentController');
    //Route::post('post-sub-comment/{id}','Frontend\PostSubCommentController@destroy');
    /*user post end*/

    /* personal information */

    /*feed notification*/
    Route::resource('feed-notification', 'Frontend\FeedNotificationController');


    /* User Profile Section*/


    Route::get('/auth-info','Frontend\UserProfileController@authInfo');
    Route::get('/view_profile/{u_id}','Frontend\UserProfileController@gotoUserProfile');
    Route::get('user-about-section', 'Frontend\UserProfileController@about');
    Route::get('user-friends-section', 'Frontend\UserProfileController@allfriend');
    Route::get('user-wise-friends/{id}', 'Frontend\UserProfileController@userfriend');
    Route::get('user-wise-markers/{id}/{place}', 'Frontend\UserProfileController@userMarker');
    Route::get('/user-photos-section', 'Frontend\UserProfileController@userAllPhotos');                                                                                          
    Route::get('/user-wise-post-image/{id}', 'Frontend\UserProfileController@userPostPhotos');                                                                                          
    Route::get('/edit-profile','Frontend\UserProfileController@getUserProfileInfo');

    Route::get('/check-relationship/{id}','Frontend\UserProfileController@checkRelation');


    // Route::get('/all_search_list_people','Frontend\AllSearchListController@AllSearchListPeople');
    Route::get('/addFriend/{id}','Frontend\AllSearchListController@sendRequest');
    Route::get('/unfriend/{id}','Frontend\FriendRequestController@removeFriend');
    Route::get('/unfriend2/{id}','Frontend\FriendRequestController@removeFriend2');
    Route::post('search', 'Frontend\AllSearchListController@search');
    Route::get('search/{result}', 'Frontend\AllSearchListController@searchResult');
    /* User Relationship section */
    Route::post('send_request','Frontend\AllSearchListController@send_user_request');

    Route::get('send-request/{id}','Frontend\FriendRequestController@sendRequest');

    Route::post('relationship-remove/{id}','Frontend\UserRelationshipController@removeFriend');


    /* cover image controller*/

    Route::resource('coverimage','Frontend\CoverImageController');

    /*user featured photo section*/

    Route::resource('featured-photo', 'Frontend\UserFeaturedPhotoController');

    /* all friend requests */
    Route::get('/friend_request','Frontend\FriendRequestController@allRequests');
    Route::get('/accepterequest/{id}','Frontend\FriendRequestController@accepterequest');
    Route::get('/accepte-request/{id}','Frontend\UserRelationshipController@accepterequest');

    Route::get('/user-friends/{id}','Frontend\UserRelationshipController@friends');

    /* Notifications */
    Route::get('/all_notifications','Frontend\NotificationController@index');
    Route::get('/view_profile/{s_id}/{n_id}','Frontend\NotificationController@userProfile');


    /* Activity */
    Route::get('/all_activity','Frontend\NotificationController@userAllActivity');


    /* Connection */
    Route::get('/connection','Frontend\ConnectionController@index');
    Route::get('/connection/plans','Frontend\ConnectionController@index');
    Route::get('/connection/suggestions','Frontend\ConnectionController@index');
    Route::get('/connection/questions','Frontend\ConnectionController@index');

    Route::get('/popular-post/{type}','Frontend\ConnectionController@popularPost');

    /*user settings section*/
    Route::get('/settings','Frontend\SettingsController@index');
    Route::post('/check-password','Frontend\SettingsController@checkPassword');
    Route::post('/updated-user-info','Frontend\SettingsController@updateInfo');
    Route::post('/change-user-info','Frontend\SettingsController@changeInfo');
    Route::post('/updated-user-password','Frontend\SettingsController@updatePassword');
    Route::get('/settings/security','Frontend\SettingsController@index');



    // Route::get('/all_messages', function () {

    //     return view('frontend.profile_settings.all_messages');
    // });



    // Route::get('/change_password', function () {

    //     return view('frontend.profile_settings.change_password');
    // });

    // Route::get('/fav_agencies', function () {

    //     return view('frontend.profile_settings.fav_agencies');
    // });


    // Route::get('/account_settings', function () {

    //     return view('frontend.profile_settings.account_settings');
    // });

    // Route::get('/single_post', function () {

    //     return view('frontend.profile_settings.single_post');
    // });

    /**/
    /*reports section start*/
    Route::post('/reports', 'Backend\ReportsController@createReport');
    /*reports section end*/


    /* Host travell section */
    //Route::get('/host_travel', 'Frontend\HostsController@index');
    //Route::get('/host_a_plan','Frontend\HostsController@hostPlan');
    Route::get('/stay-with-locals','Frontend\HostsController@index');
    Route::get('/stay-with-locals/{city}','Frontend\HostsController@cityWise');
    Route::get('/booking-accumulator/{id}','Frontend\HostsController@booking');
    Route::post('/booking-accumulator','Frontend\HostsController@bookingRoom');
    Route::get('/booking-confirmation/{id}','Frontend\HostsController@bookingConfirm');
    Route::get('/stay-with-locals/{city}/{place}','Frontend\HostsController@placeDetails');
    Route::post('/accumulator-search', 'Frontend\HostsController@accuSearch');
    Route::get('/myreservations', 'Frontend\HostsController@myReservation');
    //Route::resource('/host_info','Frontend\HostInfoController');
    //Route::post('/host_search','Frontend\HostSearchController@search')->name('host_search');
    // booking notification
    Route::get('/booking-notification', 'Frontend\NotificationController@booking');
    Route::get('/booking-notification-isread/{id}', 'Frontend\NotificationController@isReadBN');
    Route::post('/booking-cancel', 'Frontend\HostsController@bookingCancel');
    /* Agency Section */

    Route::get('agencies','Frontend\AgencyController@index');
    /*Route::get('agencies/show','Frontend\AgencyController@show');*/

    /*service end*/
    


    // Route::get('/company', function () {

    //     return view('frontend.company.company');
    // });


    // Route::get('/user-photos-section', function () {

    //     return view('frontend.user.user_photos');
    // });

    // Route::get('/user-videos-section', function () {

    //     return view('frontend.user.user_videos');
    // });

    // Route::get('/error404', function () {

    //     return view('frontend.error404');
    // });


    /*vue js*/
    Route::get('/user-friends-list','Frontend\UserProfileController@userFriends');
    Route::get('/online-friends/{id}','Frontend\UserProfileController@userOnline');
    Route::get('/offline-friends/{id}','Frontend\UserProfileController@userOffline');
    Route::get('/friends-wise-post','Frontend\UserProfileController@friendsPost');
    Route::get('/friends-wise-post/{number}','Frontend\UserProfileController@friendsPost');
    Route::get('/public-post/{number}','Frontend\UserProfileController@publicPost');
    Route::get('/friend-wise-markers/{type}','Frontend\UserProfileController@friendMarker');

    Route::resource('/personal_information','Frontend\PersonalInformationController');


    // get stored messages
    Route::get('/messages/{userId}', 'Frontend\MessageController@getMessage');


    // post new messages
    Route::post('/messages/{userId}', 'Frontend\MessageController@sendMessage');
    Route::post('/fileUpload/{userId}', 'Frontend\MessageController@sendFile');
    //search my friend
    Route::get('/search-friend', 'Frontend\UserProfileController@searchFriend');
    Route::get('/chat-notification-count', 'Frontend\MessageController@notificationCount');
    Route::get('/chat-notification-count/{id}', 'Frontend\MessageController@notificationCountSend');
    Route::get('/chat-notification', 'Frontend\MessageController@notification');
    Route::get('/update-notification-count/{id}', 'Frontend\MessageController@notificationCountUpdate');


    //Route::get('/test', 'Frontend\UserProfileController@spa');

    Route::get('/{username}&timeline=plans','Frontend\UserProfileController@index');
    Route::get('/{username}&timeline=suggestions','Frontend\UserProfileController@index');
    Route::get('/{username}&timeline=questions','Frontend\UserProfileController@index');

    Route::get('/{username}','Frontend\UserProfileController@index');


    Route::get('/{username}/about&section=personal-information','Frontend\UserProfileController@index');
    Route::get('/{username}/about&section=bio','Frontend\UserProfileController@index');
    Route::get('/{username}/about&section=places-visited','Frontend\UserProfileController@index');
    Route::get('/{username}/about','Frontend\UserProfileController@index');
    Route::get('/{username}/friends','Frontend\UserProfileController@index');
    Route::get('/{username}/photos','Frontend\UserProfileController@index');
    Route::get('/{username}/videos','Frontend\UserProfileController@index');

    Route::get('/{userName}/posts/{postId}', 'Frontend\UserPostController@singlePost');

});



/*frontend section end*/










