<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 25.07.2015
 * Time: 1:24
 */
namespace Front;


class Front extends \Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function setLayout(){
        $this->layout = \View::make('front/index');
    }

//    public function anyIndex(){
//
//        $this->layout = \View::make('site/index');
////        $view->withGlobal('test','test Global Var');
//
//
//       // $charge = \Charge::instance();
//
//
//
//    }

//    public function getTest(){
//        $view = \View::make('index');
////        $view->withGlobal('test','test Global Var');
//        $view->layout = \View::make('test/layout');
//        $view->layout->a = 'local var A';
//        $view->layout
//            ->with('b','local var b')
//            ->with('c','local var c')
//            ->d = 'local var d';
//        echo $view;
//
////        echo "<form method='POST' action=''><input type='submit' value='Do POST'></form>";
//    }
//
//    public function anyTest2(){
//        echo 'Main Page';
//        $transferTo = new \TransferTo\Transferer('topup.me','CFskDfozrn');
//        print('<pre>');
////        var_dump($transferTo->getPricelist());
////      var_dump($transferTo->getInfo('+37495855565'));
////       var_dump($transferTo->getBalance());
////        print_r($transferTo->getCountries()->getData()['compared']);
//        var_dump($transferTo->getOperators(868));
////        var_dump($transferTo->getProducts(1925)->getData());
////        var_dump($transferTo->ping());
//
////         var_dump($transferTo->reserveTxnId());
//        //var_dump($transferTo->airtimeRecharge('Suro','+37455269787',1000,'Narineic nver!!!')->getData());
//        // var_dump($transferTo->getTransactions('2015-08-01','2015-08-04','+37495757005',0));
//        // var_dump($transferTo->getTransactionInfo('404793148'));
//        // var_dump($transferTo->airtimeRecharge('SURO','+37495757005','Test Message',100));
//        //var_dump($transferTo->simulation('SURO','+37495757005','Test Message',200));
//
////        var_dump($transferTo->simulation('Test','+37455064667',200,'Test Message'));
////        var_dump($transferTo->simulation('Test','+37455064667',200,'Test Message'));
//
////          var_dump($transferTo->airtimeRecharge('Test','+37455064667',50,'Test Message!!!'));
//
//
//        // preg_match('#^/test/(?P<id>[a-z0-9]+)$#',$url,$matches);
//        // var_dump($matches);
//    }
//
//    public function postTest(){
//        echo "postTest";
//    }
}