<?php
restrictAccess();

/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 13:15
 */


/**
 * Роуты приветствия
 */
Router::get(['/', 'as' => 'front.home'],'Front\Pages@getHome');
Router::any(['/server/quiz', 'as' => 'front.server'],'Front\Server@anyQuizResponse');
Router::get(['/{page?}','rules' => ['page' => '[a-z0-9_-]+'], 'as' => 'front.page'],'Front\Pages@getPage');


/**
 * Ajax
 */



/**
 * Тесты
 */

Router::get(['/Test', 'as' => 'front.test'],'Front\Pages@getTest');
Router::any(['/TestLang', 'as' => 'test.lang'],'Test\I18nTest@anyLang');
Router::any(['/Tests', 'as' => 'test.index'],'Test\I18nTest@anyIndex');
Router::any(['/TestLangRoute', 'as' => 'test.langroute'],'Test\I18nTest@anyTestLangRoute');
Router::any(['/TestNestedSets', 'as' => 'test.nestedsets'],'Test\NestedSets@anyIndex');
Router::any(['/TestFaker', 'as' => 'test.faker'],'Test\FakerTest@anyIndex');
Router::any(['/TestFaker2', 'as' => 'test.faker2'],'Test\FakerTest@anyIndex2');
Router::any(['/TestWord', 'as' => 'test.word'],'Test\WordTranslate@anyIndex');
Router::any(['/TestWidget', 'as' => 'test.widget'],'Test\Widget@anyIndex');
Router::any(['/TestLangChange','rules' => ['page' => '[a-z0-9_-]+'], 'as' => 'test.lang.change'],'Test\I18nTest@anyChangeLang');
Router::any(['/TestQuiz','rules' => ['id' => '[0-9]+'], 'as' => 'test.quiz.change'],'Test\Quiz\Test@anyIndex');
Router::any(['/TestQuizResult','rules' => ['id' => '[0-9]+'], 'as' => 'test.result'],'Test\Quiz\Test@anyResult');


//Router::get(['/test', 'as' => 'front.getTest'],'Front\Main@getTest');
//Router::any(['/test2', 'as' => 'front.anyTest'],'Front\Main@anyTest2');
//Router::get(['/API/Mobile/JSON/V1/confirmFriendship', 'as' => 'confirmFriendship'],'Api\Mobile\JSON\V1\Greeting@postConfirmFriendship');


Router::any(['/viewTest', 'as' => 'test.viewTests.index'],'Test\ViewTests@anyIndex');
Router::any(['/withLayout', 'as' => 'test.viewTests.WithLayout'],'Test\ViewTests@anyWithLayout');

Router::any(['/users/{id?}','rules' => ['id' => '[0-9]+'], 'as' => 'test.routeTests.users'],'Test\RouteTests@anyContents');
Router::any(['/users/list/{status?}/{page?}','rules' => ['status' => '[a-zа-я]+','page' => '[0-9]+'], 'as' => 'test.routeTests.usersList'],'Test\RouteTests@anyUsersList');