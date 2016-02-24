<?php if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}
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
Router::get(['/About', 'as' => 'front.about'],'Front\Pages@getAbout');
Router::get(['/News', 'as' => 'front.news'],'Front\Pages@getNews');
Router::get(['/Faq', 'as' => 'front.faq'],'Front\Pages@getFaq');

Router::get(['/Test', 'as' => 'front.test'],'Front\Pages@getTest');
Router::any(['/TestLang', 'as' => 'test.lang'],'Test\I18nTest@anyLang');
Router::any(['/Tests', 'as' => 'test.index'],'Test\I18nTest@anyIndex');
Router::any(['/TestLangRoute', 'as' => 'test.langroute'],'Test\I18n@anyTestLangRoute');
Router::any(['/TestNestedSets', 'as' => 'test.nestedsets'],'Test\NestedSets@anyIndex');
Router::any(['/TestFaker', 'as' => 'test.faker'],'Test\FakerTest@anyIndex');
Router::any(['/TestFaker2', 'as' => 'test.faker2'],'Test\FakerTest@anyIndex2');
Router::any(['/TestWord', 'as' => 'test.word'],'Test\WordTranslate@anyIndex');

//Router::get(['/test', 'as' => 'front.getTest'],'Front\Main@getTest');
//Router::any(['/test2', 'as' => 'front.anyTest'],'Front\Main@anyTest2');
//Router::get(['/API/Mobile/JSON/V1/confirmFriendship', 'as' => 'confirmFriendship'],'Api\Mobile\JSON\V1\Greeting@postConfirmFriendship');

/**
 * Ajax
 */

Router::post(['/charger/DetectNumberOperator', 'as' => 'front.ajax.DetectNumberOperator'],'Front\ChargerAjax@postDetectNumberOperator');
Router::post(['/charger/GetOperatorPackages', 'as' => 'front.ajax.GetOperatorPackages'],'Front\ChargerAjax@postGetOperatorPackages');
Router::post(['/charger/Checkout', 'as' => 'front.ajax.Checkout'],'Front\ChargerAjax@postCheckout');
Router::post(['/charger/PaymentAndConfirmation', 'as' => 'front.ajax.PaymentAndConfirmation'],'Front\ChargerAjax@postPaymentAndConfirmation');
Router::post(['/charger/GetCountryOperators', 'as' => 'front.ajax.GetCountryOperators'],'Front\ChargerAjax@postGetCountryOperators');

/**
 * Тесты
 */

Router::any(['/viewTest', 'as' => 'test.viewTests.index'],'Test\ViewTests@anyIndex');
Router::any(['/withLayout', 'as' => 'test.viewTests.WithLayout'],'Test\ViewTests@anyWithLayout');

Router::any(['/users/{id?}','rules' => ['id' => '[0-9]+'], 'as' => 'test.routeTests.users'],'Test\RouteTests@anyContents');
Router::any(['/users/list/{status?}/{page?}','rules' => ['status' => '[a-zа-я]+','page' => '[0-9]+'], 'as' => 'test.routeTests.usersList'],'Test\RouteTests@anyUsersList');
