<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aacotroneo\Saml2\Http\Controllers\Saml2Controller;
use Aacotroneo\Saml2\Saml2Auth;

class SamlController extends Saml2Controller
{
    public function login(Saml2Auth $saml2Auth)
    {

        /****/
        trace("In " . __METHOD__);
        trace(session()->all());
        /****/

        $saml2Auth->login(route('home'));
    }
}