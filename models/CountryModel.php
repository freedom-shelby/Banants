<?php if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}

/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:29 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class CountryModel extends Eloquent
{
    protected $table = 'countries';

    //todo:После того как наследуемся от Eloquent сделать ф-цию не статической
    /**
     * Возвращает список стран, на которые можно пересылать деньги
     * @return array
     */
    public static function getChargableCountries(){

        return self::with('phoneInfo')->with('topUpServices')->get();
    }

    public static function getCountryWithApiData($id){
        $country = self::where('id','=',(int)$id)->with('topUpServices')->first();
        if(!$country) return null;

        //TODO::В дальнейшем если добавится другой сервис, то нужно изменить логику
        $classmap = $country->topUpServices[0]->classmap;
        $service = new $classmap('topup.me','CFskDfozrn');
        $serviceCountries =  $service->getCountries();
        foreach($serviceCountries as $sc){
            if(strtolower($sc['country']) == strtolower($country->name)){
                $country->api_id = $sc['id'];
                return $country;
            }

        }

        return null;
    }

    /**
     * Информация о телефоных кодах и валидации номеров для страны
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function phoneInfo(){
        return $this->hasOne('CountryPhoneInfoModel','country_id');
    }

    /**
     * TopUp Сервисы обслуживающие пользователей данной страны
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topUpServices(){
        return $this->belongsToMany('TopupServiceModel','topup_services_has_countries','country_id','service_id');
    }
}