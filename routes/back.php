<?php if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 13:15
 */


/**
 * Роуты
 */
Router::get(['/Admin', 'as' => 'back.home'],'Back\Pages@getHome');
Router::get(['/Admin/Articles', 'as' => 'back.articles.list'],'Back\Articles@getList');
Router::any(['/Admin/Articles/Add', 'as' => 'back.articles.add'],'Back\Articles@anyAdd');
Router::any(['/Admin/Articles/Edit/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.articles.edit'],'Back\Articles@anyEdit');
Router::get(['/Admin/Articles/Delete/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.articles.delete'],'Back\Articles@getDelete');
Router::get(['/Admin/Categories', 'as' => 'back.categories.list'],'Back\Categories@getList');
Router::any(['/Admin/Categories/Add', 'as' => 'back.categories.add'],'Back\Categories@anyAdd');
Router::any(['/Admin/Categories/Save', 'as' => 'back.categories.save'],'Back\Categories@anySaveSorting');
Router::any(['/Admin/Categories/Edit/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.categories.edit'],'Back\Categories@anyEdit');
Router::get(['/Admin/Entities', 'as' => 'back.entities.list'],'Back\Entities@getList');
Router::any(['/Admin/Entities/Add', 'as' => 'back.entities.add'],'Back\Entities@anyAdd');
Router::any(['/Admin/Entities/Edit/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.entities.edit'],'Back\Entities@anyEdit');
Router::get(['/Admin/Entities/Delete/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.entities.delete'],'Back\Entities@getDelete');
Router::get(['/Admin/Settings', 'as' => 'back.settings'],'Back\Settings@getGroups');
Router::get(['/Admin/Settings/{alias?}','rules' => ['status' => '[a-zA-Z]+'],  'as' => 'back.settings.list'],'Back\Settings@getList');
Router::any(['/Admin/Settings/Edit/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.settings.edit'],'Back\Settings@anyEdit');
Router::get(['/Admin/Menus/List/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.menus.edit'],'Back\Menus@getList');


/**
 * Тесты
 */

Router::any(['/viewTest', 'as' => 'test.viewTests.index'],'Test\ViewTests@anyIndex');
Router::any(['/withLayout', 'as' => 'test.viewTests.WithLayout'],'Test\ViewTests@anyWithLayout');

Router::any(['/users/{id?}','rules' => ['id' => '[0-9]+'], 'as' => 'test.routeTests.users'],'Test\RouteTests@anyUsers');
Router::any(['/users/list/{status?}/{page?}','rules' => ['status' => '[a-zа-я]+','page' => '[0-9]+'], 'as' => 'test.routeTests.usersList'],'Test\RouteTests@anyUsersList');
