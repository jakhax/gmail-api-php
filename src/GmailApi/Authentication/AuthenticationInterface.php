<?php

namespace App\GmailApi\Authentication;
use Google_Client;

interface AuthenticationInterface{
    public function  createClient():Google_Client;

}