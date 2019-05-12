<?php

namespace App\GmailApi\Authentication;
use Google_Client;

class OauthAuthentication implements AuthenticationInterface
{

    public function createClient(): Google_Client
    {
        $client=new Google_Client();
        return $client;
    }
}