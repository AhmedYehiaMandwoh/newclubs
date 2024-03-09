<?php

namespace App\Exceptions;

use App\Classes\BaseAction;
use Exception;

class NotAuthorizedException extends Exception
{
    protected $route;

    public function redirectBack() {
        (new BaseAction())->makeErrorSessionMessage(__('message.cant_access'));
//        $this->route= url()->previous();
        $url= url()->previous();
        $url.=(str_contains($url,'?')?'&':'?').'cantaccess=true';
        $this->route= $url;
        return $this;
    }

    /*public function redirectToHome($route='/') {
        (new BaseAction())->makeErrorSessionMessage(__('message.cant_access'));
        $this->route = $route;

        return $this;
    }*/

    public function route() {
        return $this->route;
    }
}
