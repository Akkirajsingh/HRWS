<?php

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
//---------------LOGIN & LOGOUT-----------------------------------
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');

//-----HOME
Route::get('/home', 'HomeController@goToHome')->name('home');

//---------------FORGOT PASSWORD
Route::view('/forgot-password', 'pages.Auth.forgot_password');

Route::post( '/forgot-password', [
    'uses' => 'Auth\ForgotPasswordController@forgotPassword',
    'as'   => 'forgot-password-post'
]);

//---------------RESET PASSWORD
Route::get('/reset-password/{token}', [
    'uses' => 'Auth\ForgotPasswordController@redirectResetPassword',
    'as'   => 'redirect-reset-password'
]);

Route::post('/reset-password', [
    'uses' => 'Auth\ForgotPasswordController@manageResetPassword',
    'as'   => 'manage-reset-password'
]);

//---------------Common utilitity controller APIS
Route::get('api/countries','GenericController@getCountries');
Route::get('admin/api/get-state-list','GenericController@getStateList');
Route::get('admin/api/get-city-list','GenericController@getCityList');

//----------------admin menu--------------------------------------------
Route::get('admin/dashboard','Admin\AdminController@redirectToAdminDashboard')->name('admin.dashboard');


Route::group(['middleware' => ['permission:ADMIN_ALL|ADMIN_USER_ALL']], function() {
    //USERS-ADD
    Route::get('admin/user_add', 'Admin\UserController@addUserPage')->name('admin.user-add');

    Route::post('admin/user_add','Admin\UserController@addUser')->name('admin.user-add');

    //USERS-EDIT
    Route::get ('admin/user_edit', 'Admin\UserController@editUserPage')->name('admin.user-edit');
    Route::post('admin/user_edit', 'Admin\UserController@editUser')->name('admin.user-add');

    //USERS-DELETE
    Route::get ('admin/user_delete', 'Admin\UserController@deleteUser')->name('admin.user-delete');

    //USERS-LIST
    Route::get('admin/user_list', 'Admin\AdminController@redirectToAdminDashboard')->name('admin.user-list');

    //USERS-Serach
    Route::post('admin/user_list', 'Admin\UserController@searchUser')->name('admin.user-search');
});

Route::group(['middleware' => ['permission:ADMIN_ALL|ADMIN_ROLE_ALL|ADMIN_PERMISSION_ALL']], function() {
    //ROLES
    Route::get('admin/role', [
        'uses' => 'Admin\RoleController@getRoleList',
        'as' => 'admin.role-list'
    ]);

    //ROLE ADD
    Route::Post('admin/role_add', 'Admin\RoleController@addRole')->name('admin.role-add');

    //ROLE UPDATE
    Route::Post('admin/role_update', 'Admin\RoleController@updateRole')->name('admin.role-update');

    //ROLES-Search
    Route::post('admin/role', 'Admin\RoleController@searchRole')->name('admin.role-search');

    //Roles-DELETE
    Route::get('admin/role_delete', 'Admin\RoleController@deleteRole')->name('admin.role-delete');

    //ROLES-Toggle
    Route::post('/admin/role-toggle', 'Admin\RoleController@roleToggle')->name('admin.role-toggle');

    //Permissions
    Route::get('admin/permission', [
        'uses' => 'Admin\PermissionController@getPermissionList',
        'as' => 'admin.permission-list'
    ]);

    //Assign permission to roles
    Route::Post('/admin/permission-assign', 'Admin\PermissionController@assignPermission')->name('admin.permission-fetch');


    //Fetch permission to roles
    Route::Post('/admin/permission-fetch', 'Admin\PermissionController@fetchPermission')->name('admin.permission-assign');


    //SERACH PERMISSION
    Route::post('admin/permission', 'Admin\PermissionController@searchPermission')->name('admin.permission-search');
});

Route::group(['middleware' => ['permission:ADMIN_ALL|ADMIN_CLIENT_ALL|ADMIN_CLIENT_ADD']], function() {
    //CLEINT OPERATIONS
    Route::get('admin/client', 'Admin\ClientController@getClientList')->name('admin.client-list')->middleware(['permission:ADMIN_CLIENT_ALL|ADMIN_ALL']);

    Route::view('admin/client_add', 'pages.admin.client.client_add')->middleware('auth');

    Route::post('admin/client_add', 'Admin\ClientController@addClient')->name('admin.client-add');

    Route::post('admin/client', 'Admin\ClientController@searchClient')->name('admin.client-search');

    Route::post('admin/client_delete', 'Admin\ClientController@deleteClient')->name('admin.client-delete');
    Route::post('admin/delete_client_logo', 'Admin\ClientController@deleteLogo')->name('admin.delete-client-logo');

    Route::get('admin/client_edit', 'Admin\ClientController@editClientPage')->name('admin.client-edit');
    Route::post('admin/client_edit', 'Admin\ClientController@editClient')->name('admin.client-edit');

    //CLIENT CONTACT
    Route::get('admin/clientContact', 'Admin\ClientContactController@getClientContactList')->name('admin.clientContact-list');
    Route::post('admin/clientContact', 'Admin\ClientContactController@searchClientContactList')->name('admin.clientContact-list');

    Route::post('admin/searchclientContact', 'Admin\ClientContactController@searchClientContact')->name('admin.clientContact-search');

    Route::post('admin/contact_delete', 'Admin\ClientContactController@deleteContact')->name('admin.contact-delete');

    Route::get('admin/contact_edit', 'Admin\ClientContactController@editContactPage')->name('admin.contact-edit');
    Route::post('admin/contact_edit', 'Admin\ClientContactController@editContact')->name('admin.contact-edit');

    Route::get('admin/contact_add', 'Admin\ClientContactController@addContactPage')->name('admin.contact-add');
    Route::post('admin/contact_add', 'Admin\ClientContactController@addContact')->name('admin.contact-add');

    Route::get('admin/client_contact', 'Admin\ClientContactController@getClientContact')->name('admin.client-contact');

    Route::post('admin/set_account_manager', 'Admin\ClientContactController@setAccountManager')->name('admin.contact-set-account-manager');
});

Route::group(['middleware' => ['role:ACCOUNT_MANAGER']], function() {
    //Requirement
    Route::get('add_requirement/{clientId}/{contactId}','RequirementController@addRequirementPage')->name('admin.add-requirement');
    Route::post('add_requirement', 'RequirementController@addRequirement')->name('admin.add-requirement');
    Route::get('edit_requirement/{id}','RequirementController@editRequirementPage')->name('admin.edit-requirement');
    Route::post('edit_requirement','RequirementController@editdRequirement')->name('admin.edit-requirement');
    Route::get('delete_requirement/{id}','RequirementController@deleteRequirement')->name('admin.delete-requirement');
    Route::post('search_requirement','RequirementController@searchRequirement')->name('admin.search-requirement');
});

Route::group(['middleware' => ['role:ACCOUNT_MANAGER|HR_LEAD|HR_RECRUITER']], function() {
    Route::post('status_requirement','RequirementController@changeStatus')->name('admin.status-requirement');
    Route::post('requirement/comment','RequirementController@postComment')->name('admin.requirement-comment');
});


Route::group(['middleware' => ['role:HR_LEAD']], function() {
    //Add Skill
    Route::post('add_skill','RequirementController@addSkill')->name('add-skill');
    Route::post('delete_skill','RequirementController@deleteSkill')->name('delete-skill');

    //Add Question
    Route::post('add_question','RequirementController@addQuestion')->name('add-question');
    Route::post('delete_question','RequirementController@deleteQuestion')->name('delete-question');

    //Assign Recruiter
    Route::post('assign_recruiter','RequirementController@assignRecruiter')->name('assign-recruiter');

    //Search Requirements
    Route::post('lead/search_requirement','RequirementController@searchLeadRequirement')->name('lead.search-requirement');
});

Route::post('/hr/search_requirement','RequirementController@searchRecruiterRequirement')->name('hr.search-requirement');
