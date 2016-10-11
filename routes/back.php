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
Router::any(['/Admin/Photos/Add', 'as' => 'back.photos.add'],'Back\Photos@anyAdd');
Router::any(['/Admin/PhotoGallery/Add', 'as' => 'back.photo.gallery.add'],'Back\PhotoGalleries@anyAdd');
Router::get(['/Admin/PhotoGallery/List', 'as' => 'back.photo.gallery.list'],'Back\PhotoGalleries@getList');
Router::any(['/Admin/PhotoGallery/Edit/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.photo.gallery.edit'],'Back\PhotoGalleries@anyEdit');
Router::get(['/Admin/PhotoGallery/Delete/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.photo.gallery.delete'],'Back\PhotoGalleries@getDelete');
Router::any(['/Admin/Videos/Add', 'as' => 'back.video.add'],'Back\Videos@anyAdd');
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
Router::any(['/Admin/Quiz/Add', 'as' => 'back.quiz.add'],'Back\Quiz@anyAdd');
Router::any(['/Admin/Quiz/Edit/{id?}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.quiz.edit'],'Back\Quiz@anyEdit');
Router::get(['/Admin/Quiz/Response/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.quiz.response'],'Back\Quiz@getResponse');
Router::get(['/Admin/Quiz/List', 'as' => 'back.quiz.list'],'Back\Quiz@getList');
Router::get(['/Admin/Quiz/Current', 'as' => 'back.quiz.current'],'Back\Quiz@getCurrent');
Router::get(['/Admin/Quiz/Delete/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.quiz.delete'],'Back\Quiz@getDelete');
Router::any(['/Admin/Quiz/Answer/Add/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.quiz.answer.add'],'Back\Quiz@anyAnswerAdd');
Router::any(['/Admin/Quiz/Answer/Edit/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.quiz.answer.edit'],'Back\Quiz@anyAnswerEdit');
Router::get(['/Admin/Quiz/Answer/Delete/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.quiz.answer.delete'],'Back\Quiz@getAnswerDelete');
Router::any(['/Admin/Team/Add', 'as' => 'back.team.add'],'Back\Teams@anyAdd');
Router::any(['/Admin/Team/Edit/{id?}','rules' => ['id' => '[0-9]+'], 'as' => 'back.team.edit'],'Back\Teams@anyEdit');
Router::get(['/Admin/Team/ListAll', 'as' => 'back.team.list.all'],'Back\Teams@getListAll');
Router::get(['/Admin/Team/List/{id?}','rules' => ['id' => '[0-9]+'], 'as' => 'back.team.list'],'Back\Teams@getList');
Router::get(['/Admin/Team/Delete/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.team.delete'],'Back\Teams@getDelete');
Router::any(['/Admin/Player/Add/{id?}','rules' => ['id' => '[0-9]+'], 'as' => 'back.player.add'],'Back\Players@anyAdd');
Router::any(['/Admin/Player/Edit/{id?}','rules' => ['id' => '[0-9]+'], 'as' => 'back.player.edit'],'Back\Players@anyEdit');
Router::any(['/Admin/League/Add', 'as' => 'back.league.add'],'Back\Leagues@anyAdd');
Router::any(['/Admin/League/Edit/{id?}','rules' => ['id' => '[0-9]+'], 'as' => 'back.league.edit'],'Back\Leagues@anyEdit');
Router::get(['/Admin/League/List', 'as' => 'back.league.list'],'Back\Leagues@getList');
Router::any(['/Admin/Tournament/Add', 'as' => 'back.tournament.add'],'Back\Tournaments@anyAdd');
Router::any(['/Admin/Tournament/Edit/Table/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.tournament.edit.table'],'Back\Tournaments@anyEditTable');
Router::any(['/Admin/Tournament/Edit/Team/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.tournament.edit.team'],'Back\Tournaments@anyEditTeam');
Router::any(['/Admin/Tournament/Edit/Round/{id}/{number}', 'rules' => ['id' => '[0-9]+', 'number' => '[0-9]+'], 'as' => 'back.tournament.edit.round'],'Back\Tournaments@anyEditRound');
Router::get(['/Admin/Tournament/List/Rounds/{id}', 'rules' => ['id' => '[0-9]+'], 'as' => 'back.tournament.list.rounds'],'Back\Tournaments@getListRounds');
Router::get(['/Admin/Tournament/List', 'as' => 'back.tournament.list'],'Back\Tournaments@getList');

/**
 * Ajax
 */
Router::get(['/Admin/Server/getPhotos', 'as' => 'back.server.photo'],'Back\Server@getPhotos');
Router::get(['/Admin/Server/getPhotosForGallery', 'as' => 'back.server.photo.gallery'],'Back\Server@getPhotosForGallery');

/**
 * Тесты
 */
