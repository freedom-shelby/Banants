<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 03.09.2015
 * Time: 0:12
 */

namespace Test;


class RouteTests extends \Controller
{
    public function anyUsers(){
        echo 'action anyUsers:<br> param id is '.($this->getRequestParam('id') ?: 'null') ;
    }

    public function anyUsersList(){
        echo 'action anyUsersList:<br> param status is '.($this->getRequestParam('status') ?: 'null') ;
        echo '<br> param page is '.($this->getRequestParam('page') ?: 'null');
    }

}