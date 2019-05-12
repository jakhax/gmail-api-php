<?php

namespace App\GmailApi\Authentication;
use Google_Client;
use Google_Service_Gmail;

class OauthAuthentication implements AuthenticationInterface
{
    public function __construct()
    {
        $this->credentialsFile=DOCUMENT_ROOT."/config/credentials.json";
        $this->tokenFile=DOCUMENT_ROOT."/config/token.json";
    }

    public function createClient(): Google_Client
    {
        $client=new Google_Client();
        $client->setApplicationName("PHP gmail api");
        $client->setScopes([Google_Service_Gmail::GMAIL_SEND]);
        $client->setAuthConfig($this->credentialsFile);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        if (file_exists($this->tokenFile)) {
            $accessToken = json_decode(file_get_contents($this->tokenFile), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($this->tokenFile))) {
                mkdir(dirname($this->tokenFile), 0700, true);
            }
            file_put_contents($this->tokenFile, json_encode($client->getAccessToken()));
        }
        return $client;
    }
}
