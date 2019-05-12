<?php

namespace App\GmailApi\Mailer;
use Google_Client;
use Google_Service_Gmail;
use Swift_Message;

interface MailerInterface{
    public function createService(Google_Client $client):Google_Service_Gmail;
    public function createMail(string $sender,array $to, string $subject, string $body):Swift_Message;
    public function createMailWithAttachment(string $sender,array $to, string $subject, string $body, array $files):Swift_Message;
    public function  sendMail(Swift_Message $message);
}