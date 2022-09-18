
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;

//Role and Permission System Route
Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@getIndex']);
Route::get('admin-users', ['middleware' => 'acl:view_admin_user', 'as' => 'admin-user', 'uses' => 'AdminUserController@getIndex']);
Route::get('admin-user/new', ['middleware' => 'acl:add_admin_user', 'as' => 'admin-user.new', 'uses' => 'AdminUserController@getCreate']);
Route::post('admin-user/store', ['middleware' => 'acl:add_admin_user', 'as' => 'admin-user.store', 'uses' => 'AdminUserController@postStore']);
Route::get('admin-user/{id}/edit', ['middleware' => 'acl:edit_admin_user', 'as' => 'admin-user.edit', 'uses' => 'AdminUserController@getEdit']);
Route::post('admin-user/{id}/update', ['middleware' => 'acl:edit_admin_user', 'as' => 'admin-user.update', 'uses' => 'AdminUserController@putUpdate']);
Route::get('admin-user/{id}/delete', ['middleware' => 'acl:delete_admin_user', 'as' => 'admin-user.delete', 'uses' => 'AdminUserController@getDelete']);
// User-Group
Route::get('user-group', ['middleware' => 'acl:view_user_group', 'as' => 'user-group', 'uses' => 'UserGroupController@getIndex']);
Route::get('user-group/new', ['middleware' => 'acl:new_user_group', 'as' => 'user-group.new', 'uses' => 'UserGroupController@getCreate']);
Route::post('user-group/store', ['middleware' => 'acl:new_user_group', 'as' => 'user-group.store', 'uses' => 'UserGroupController@postStore']);
Route::get('user-group/{id}/edit', ['middleware' => 'acl:edit_user_group', 'as' => 'user-group.edit', 'uses' => 'UserGroupController@getEdit']);
Route::post('user-group/{id}/update', ['middleware' => 'acl:edit_user_group', 'as' => 'user-group.update', 'uses' => 'UserGroupController@putUpdate']);
Route::get('user-group/{id}/delete', ['middleware' => 'acl:delete_user_group', 'as' => 'user-group.delete', 'uses' => 'UserGroupController@getDelete']);
// User-Group
Route::get('assign-access', ['middleware' => 'acl:assign_user_access', 'as' => 'assign-access', 'uses' => 'AssignAccessController@getIndex']);
//Route::post('assign-access', ['middleware' => 'acl:assign_user_access', 'as' => 'assign-access', 'uses' => 'AssignAccessController@postIndex']);
// Role
Route::get('role', ['middleware' => 'acl:view_role', 'as' => 'role', 'uses' => 'RoleController@getIndex']);
Route::get('role/new', ['middleware' => 'acl:add_role', 'as' => 'role.new', 'uses' => 'RoleController@getCreate']);
Route::post('role/store', ['middleware' => 'acl:add_role', 'as' => 'role.store', 'uses' => 'RoleController@postStore']);
Route::get('role/{id?}/edit', ['middleware' => 'acl:edit_role', 'as' => 'role.edit', 'uses' => 'RoleController@getEdit']);
Route::post('role/{id}/update', ['middleware' => 'acl:edit_role', 'as' => 'role.update', 'uses' => 'RoleController@postUpdate']);
Route::get('role/{id}/delete', ['middleware' => 'acl:delete_role', 'as' => 'role.delete', 'uses' => 'RoleController@getDelete']);
// Permission-Group
Route::get('permission-group', ['middleware' => 'acl:view_menu', 'as' => 'permission-group', 'uses' => 'PermissionGroupController@getIndex']);
Route::get('permission-group/new', ['middleware' => 'acl:new_menu', 'as' => 'permission-group.new', 'uses' => 'PermissionGroupController@getCreate']);
Route::post('permission-group/store', ['middleware' => 'acl:new_menu', 'as' => 'permission-group.store', 'uses' => 'PermissionGroupController@postStore']);
Route::get('permission-group/{id}/edit', ['middleware' => 'acl:edit_menu', 'as' => 'permission-group.edit', 'uses' => 'PermissionGroupController@getEdit']);
Route::post('permission-group/{id}/update', ['middleware' => 'acl:edit_menu', 'as' => 'permission-group.update', 'uses' => 'PermissionGroupController@putUpdate']);
Route::get('permission-group/{id}/delete', ['middleware' => 'acl:delete_menu', 'as' => 'permission-group.delete', 'uses' => 'PermissionGroupController@getDelete']);
//Permission
Route::get('permission', ['middleware' => 'acl:view_action', 'as' => 'permission.index', 'uses' => 'PermissionController@getIndex']);
Route::get('permission/new', ['middleware' => 'acl:new_action', 'as' => 'permission.new', 'uses' => 'PermissionController@getCreate']);
Route::post('permission/store', ['middleware' => 'acl:new_action', 'as' => 'permission.store', 'uses' => 'PermissionController@postStore']);
Route::get('permission/{id}/edit', ['middleware' => 'acl:edit_action', 'as' => 'permission.edit', 'uses' => 'PermissionController@getEdit']);
Route::post('permission/{id}/update', ['middleware' => 'acl:edit_action', 'as' => 'permission.update', 'uses' => 'PermissionController@putUpdate']);
//Route::get('permission/{id}/delete', ['middleware' => 'acl:delete_action', 'as' => 'permission.delete', 'uses' => 'PermissionController@getDelete']);
Route::get('permission/{id}/delete', [PermissionController::class, 'getDelete'])->name('permission.delete');
