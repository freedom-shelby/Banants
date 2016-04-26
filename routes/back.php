<?php
restrictAccess();

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
//Router::any(['/Admin/Categories/Add', 'as' => 'back.categories.add'],'Back\Categories@anyAdd');
Router::any(['/Admin/Categories/Save', 'as' => 'back.categories.save'],'Back\Categories@anySaveSorting');
Router::any(['/Admin/Categories/Edit/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.categories.edit'],'Back\Categories@anyEdit');
Router::get(['/Admin/Entities', 'as' => 'back.entities.list'],'Back\Entities@getList');
Router::any(['/Admin/Entities/Add', 'as' => 'back.entities.add'],'Back\Entities@anyAdd');
Router::any(['/Admin/Entities/Edit/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.entities.edit'],'Back\Entities@anyEdit');
Router::get(['/Admin/Entities/Delete/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.entities.delete'],'Back\Entities@getDelete');
Router::get(['/Admin/Languages', 'as' => 'back.languages.list'],'Back\Languages@getList');
Router::any(['/Admin/Languages/Add', 'as' => 'back.languages.add'],'Back\Languages@anyAdd');
Router::any(['/Admin/Languages/Edit/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.languages.edit'],'Back\Languages@anyEdit');
Router::get(['/Admin/Languages/Delete/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.languages.delete'],'Back\Languages@getDelete');
Router::post(['/Admin/Languages/Image/Delete', 'as' => 'back.languages.image.delete'],'Back\Languages@postImageDelete');
Router::get(['/Admin/Settings', 'as' => 'back.settings'],'Back\Settings@getGroups');
Router::get(['/Admin/Settings/{alias?}','rules' => ['status' => '[a-zA-Z]+'],  'as' => 'back.settings.list'],'Back\Settings@getList');
Router::any(['/Admin/Settings/Edit/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.settings.edit'],'Back\Settings@anyEdit');
Router::get(['/Admin/Menus/List/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.menus.list'],'Back\Menus@getList');
Router::any(['/Admin/Menus/Save', 'as' => 'back.menus.save'],'Back\Menus@anySaveSorting');
Router::any(['/Admin/Menus/Add/{id?}', 'as' => 'back.menus.add'],'Back\Menus@anyAdd');
Router::any(['/Admin/Menus/Edit/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.menus.edit'],'Back\Menus@anyEdit');
Router::get(['/Admin/Menus/Delete/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.menus.delete'],'Back\Menus@getDelete');
Router::post(['/Admin/Menus/Image/Delete', 'as' => 'back.menus.image.delete'],'Back\Menus@postImageDelete');
Router::any(['/Admin/Quiz', 'as' => 'back.quiz'],'Back\Quiz@anyIndex');
Router::get(['/Admin/Team/List/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.teams.list'],'Back\Teams@getList');
Router::any(['/Admin/Player/Add/{id?}','rules' => ['id' => '[0-9]+'],  'as' => 'back.player.add'],'Back\Players@anyAdd');

/**
 * Тесты
 */
