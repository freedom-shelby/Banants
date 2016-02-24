<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:14 PM
 */

namespace Front;

use Http\Exception as HttpException;
use Helpers\Arr;
use Http\Exception;
use \View;

class ChargerAjax extends Front
{
    protected $_charger;

    protected $_clientData;

    public $country;
    public $numberFormatter;
    public $operatorName;
    public $operatorId;
    public $package;
    public $currency;
    public $message;

    public function __construct(){
        parent::__construct();
        $this->_clientData = Arr::extract($this->getPostData(),['countryId','number','operatorId','package','message']);
        //$this->_charger = new \TransferTo\Transferer('topup.me','CFskDfozrn');

    }

    public function setLayout(){
        $this->layout = null;
    }

    protected function getAndValidateCountry(){
        if(!$this->_clientData['countryId']){
            throw new HttpException(500,json_encode(['errorMessage' => 'Incorrect Country']));
        }

        $this->country = \CountryModel::getCountryWithApiData((int)$this->_clientData['countryId']);

        if(!$this->country){
            throw new HttpException(500,json_encode(['errorMessage' => 'Incorrect Country']));
        }
        //todo:При добавлении новых сервисов изменить логику
        $classmap = $this->country->topUpServices[0]->classmap;
        $this->_charger = new $classmap('topup.me','CFskDfozrn');
    }

    protected function getAndValidateClientNumber(){

        if(!$this->_clientData['number']){
            throw new HttpException(500,json_encode(['errorMessage' => 'Invalid Mobile Number']));
        }

        try{
            $this->numberFormatter = new \PhoneNumberFormatter($this->_clientData['number'],$this->country->iso3);
        }catch(Exception $e){
            throw new HttpException(500,json_encode(['errorMessage' => 'Invalid Mobile Number']));
        }

        if( ! $this->numberFormatter->isValidNumber()){
            throw new HttpException(500,json_encode(['errorMessage' => 'Invalid Mobile Number']));
        }
    }

    protected function getAndValidateOperator(){
        $this->operatorId = (int) Arr::get($this->getPostData(),'operatorId');
        if( ! $this->operatorId){
            throw new HttpException(500,json_encode(['errorMessage' => 'Incorrect Operator']));
        }
    }

    protected function getAndValidatePackage(){
        $products = $this->_charger->getProducts($this->operatorId);

        if( empty($products)){
            throw new HttpException(500,json_encode(['errorMessage' => 'Incorrect Package']));
        }

        $this->package = (int) Arr::get($this->getPostData(),'package');
        if( ! $this->package){
            throw new HttpException(500,json_encode(['errorMessage' => 'Incorrect Package']));
        }

        $packageIsset = false;

        foreach($products as $pack){
            if($pack['product'] == $this->package){
                $packageIsset = true;
                break;
            }
        }

        if( ! $packageIsset){
            throw new HttpException(500,json_encode(['errorMessage' => 'Incorrect Package']));
        }

        $this->currency = $products[0]['destination_currency'];
        $this->operatorName = $products[0]['operator'];
    }

    protected function getAndValidateMessage(){
        if(strlen($this->_clientData['message']) > 30){
            throw new HttpException(500,json_encode(['errorMessage' => 'Message Is To Long']));
        }

        $this->message = $this->_clientData['message'];
    }

    /**
     * Определяет оператора связки номера и страны и в зависимости
     * от результата выводит соответствующий вид 2го или 3го шага
     * @throws Exception
     * @throws \Exception
     * @throws HttpException
     */
    public function postDetectNumberOperator(){
        $this->getAndValidateCountry();
        $this->getAndValidateClientNumber();

        $chargerRequest = $this->_charger->getInfo($this->numberFormatter->getInInternationalFormat(true));

        if($chargerRequest->hasErrors()){//Не нашёлся оператор
            $this->layout = json_encode([
                'data' =>  View::make('front/charge-steps/step2')
                    ->with('items',$this->_charger->getOperators($this->country->api_id))
                    ->render()
            ]);

        }else{
            $packages = array_chunk($chargerRequest->getData(),4);
            $currency = $chargerRequest->getFullData()['destination_currency'];

            $this->layout = json_encode([
                'data' => View::make('front/charge-steps/step3')
                    ->with('operator', $chargerRequest->getFullData()['operator'])
                    ->with('operatorId', $chargerRequest->getFullData()['operatorid'])
                    ->with('packages',$packages)
                    ->with('currency',$currency)
                    ->render()
            ]);
        }

    }

    /**
     * Выводит вид продутктов(пакетов) для определённого оператора
     * @throws Exception
     * @throws HttpException
     */
    public function postGetOperatorPackages(){
        $this->getAndValidateCountry();
        $this->getAndValidateClientNumber();
        $this->getAndValidateOperator();

        $chargerRequest = $this->_charger->getProducts($this->operatorId);

        if( $chargerRequest->hasErrors()){

        }else{
            $packages = array_chunk($chargerRequest->getData(),4);
            $currency = $chargerRequest->getFullData()['destination_currency'];

            $this->layout = json_encode([
                'data' => View::make('front/charge-steps/step3')
                    ->with('operator', $chargerRequest->getFullData()['operator'])
                    ->with('operatorId', $chargerRequest->getFullData()['operatorid'])
                    ->with('packages',$packages)
                    ->with('currency',$currency)
                    ->render()
            ]);
        }
    }

    /**
     * Выводит вид для ознакомления с заказом и его подтверждения
     * @throws Exception
     * @throws \Exception
     * @throws HttpException
     */
    public function postCheckout(){
        $this->getAndValidateCountry();
        $this->getAndValidateClientNumber();
        $this->getAndValidateOperator();
        $this->getAndValidatePackage();


        $this->layout = json_encode([
            'data' => View::make('front/charge-steps/step4')
                ->with('number',$this->numberFormatter->getInLocalFormat(false))
                ->with('countryCode',$this->numberFormatter->getCountryCode())
                ->with('operator', $this->operatorName)
                ->with('package',$this->package)
                ->with('currency',$this->currency)
                ->render()
        ]);

    }

    /**
     * Переводит указанную сумму клиенту и выводит соответствующий вид результата (удачного или не удачного)
     * @throws Exception
     * @throws \Exception
     * @throws HttpException
     */
    public function postPaymentAndConfirmation(){
        $this->getAndValidateCountry();
        $this->getAndValidateClientNumber();
        $this->getAndValidateOperator();
        $this->getAndValidatePackage();
        $this->getAndValidateMessage();

        $transaction = $this->_charger->airtimeRecharge('TopUp.me',$this->numberFormatter->getInInternationalFormat(true),$this->package,$this->message,['operatorid' => $this->operatorId]);

        $this->layout = json_encode([
            'data' => View::make('front/charge-steps/step5')
                ->with('number',$this->numberFormatter->getInInternationalFormat(true))
                ->with('operator', $this->operatorName)
                ->with('package',$this->package)
                ->with('currency',$this->currency)
                ->with('txnError',$transaction->hasErrors())
                ->with('errorMessage',$transaction->getErrorText())
                ->render()
        ]);

    }

    /**
     * Виджет операторов для страны
     */
    public function postGetCountryOperators(){
        $this->getAndValidateCountry();
        $this->layout = json_encode([
            'data' => View::make('front/widgets/country-operators')
                ->with('items',$this->_charger->getOperators($this->country->api_id))
                ->render()
        ]);

    }
}