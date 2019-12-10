<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;

class Saml2LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Saml2LoginEvent $event)
    {

        /****/
        trace("In " . __METHOD__);
        /****/

        $messageId = $event->getSaml2Auth()->getLastMessageId();
        // your own code preventing reuse of a $messageId to stop replay attacks
        $user = $event->getSaml2User();
        $userData = [
            'id' => $user->getUserId(),
            'attributes' => $user->getAttributes(),
            'assertion' => $user->getRawSamlAssertion()
        ];

        $mjpUser = User::where('utahuniqueid', array_get($userData, 'attributes.utahuniqueid.0'))->first();//find user by ID or attribute

        //if it does not exist create it and go on  or show an error message
        if ($mjpUser) {
            trace($mjpUser->name);
            trace($mjpUser->email);
            trace($mjpUser->utahuniqueid);
            Auth::login($mjpUser, true);
            trace("logged IN !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
        }
        else {
            session(['saml2_error' => "This user is unknown."]);
        }
    }
}
