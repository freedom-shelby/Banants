<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Front;
restrictAccess();

use Http\Exception as Exception;
use Intervention\Image\ImageManagerStatic as Image;
use View;
use Setting;
use Helpers\Arr;
use Widgets\WidgetsContainer;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Message;
use Event;


class Pages extends Front
{
    protected $_slug;

    public function __construct(array $requestParams)
    {
        parent::__construct($requestParams);
//        WidgetsContainer::instance();
    }

    /**
     * Главная страница сайта
     */
    public function getHome()
    {
//        $slug = 'home';
//        $this->_page->initFromSlug($slug);

        $this->_page->setTitle('Официальный сайт FC Banants');
//        $this->_page->setContent('Тестовый контент');

//        $model = ArticleModel::where('slug','=','home')->first();
//        WidgetsContainer::instance($model);

        $this->layout = View::make('front/home');
        $this->layout->content = View::make('front/content/pages/home');
    }

    public function anyPage()
    {
        $this->_slug = $this->getRequestParam('page') ?: null;

        // Если есть метод по ури то вызвать эго
        $method = 'any' . ucfirst($this->_slug);
        if(method_exists($this, $method) && is_callable(array($this, $method)))
        {
            call_user_func(array($this, $method));
        }

        $this->_page->initFromSlug($this->_slug);
    }

    public function getTestHome()
    {
//        $slug = 'home';
//        $this->_page->initFromSlug($slug);

        $this->_page->setTitle('Qcard');
//        $this->_page->setContent('Тестовый контент');

//        $model = ArticleModel::where('slug','=','home')->first();
//        WidgetsContainer::instance($model);

        $this->layout = View::make('front/_home');
        $this->layout->content = View::make('front/content/pages/_home');
    }

    public function getTest(){
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');

//        $this->getModelFilling();

        // User Register

        // Create Role
//        $role = Sentinel::getRoleRepository()->createModel()->create([
//            'name' => 'Admin',
//            'slug' => 'admin',
//        ]);

//        $tmpName = trim('Mane');
//        $tmpEmail = trim('mane@fcbanants.am');
//        $pass = 'Mane@banants!';
//        $country = 1;
//
//        $credentials = [
//            'email'    => $tmpEmail,
//            'password' => $pass,
//            'first_name' => $tmpName,
//            'country_id' => $country,
//        ];
//
//        $user = Sentinel::register($credentials);
//
//        $role = Sentinel::findRoleByName('Admin');
//        $role->users()->attach($user);
//
//        var_dump($pass);
        // #User Register

        /**
         * add teams id to EventModel
         */
//        $items = \EventModel::all();
//
//        foreach ($items as $item) {
//            $data = [];
//
//            $data['home_team_id'] = $item->home()->team_id;
//            $data['away_team_id'] = $item->away()->team_id;
//
//            $item->update($data);
//        }
        /**
         * #add teams id to EventModel
         */


//        $img = Image::make('uploads/images/5721fc06d139a.jpg')->resize(300, 300)->greyscale();

//        $img = Image::cache(function($image) {
//            $image->make('uploads/images/5721fc06d139a.jpg')->fit(300)->encode(null, 52);
//        }, 12000, true);
//
//        echo $img->response();


//echo "<pre>";
//print_r(phpinfo());

//var_dump(class_exists('Intervention\Image\ImageManager'));
//ini_set('display_errors', 'Off');
//die;
//        $slug = 'home';
//        $this->_page->initFromSlug($slug);

//        $this->_page->setTitle('Официальный сайт FC Banants');
////        $this->_page->setContent('Тестовый контент');
//
////        $model = ArticleModel::where('slug','=','home')->first();
////        WidgetsContainer::instance($model);
////
//        $this->layout = View::make('test/index');
//        $this->layout->content = View::make('test/Test_1');
    }


    public function getTest2(){
        $this->layout = View::make('test/index');
        $this->layout->content = View::make('test/Test_2');
    }

    public function getTest3(){
        $this->layout = null;

        $img = Image::make('5721fc06d139a.jpg');

//        $img = Image::make('5721fc06d139a.jpg')->resize(300, 300)->greyscale();


//        $img = Image::make('5721fc06d139a.jpg')->crop(300, 300, 200, 600);
//        $img = Image::make('5721fc06d139a.jpg')->fit(400, 200);

        echo $img->resize(300, 300)->response(null, 52);
    }

    public function getModelFilling()
    {
        /**
         * Add teams to tournament
         */

//        $items = \TeamModel::all();
//
//        foreach ($items as $item) {
//            \TeamHasTournamentModel::create([
//                'team_id' => $item->id,
//                'tournament_id' => 4,
//            ]);
//        }

        // #Add teams to tournament
    }
}