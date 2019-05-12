<?php


namespace App\GmailApi\Mailer;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use Swift_Message;
use Swift_Mime_ContentEncoder_Base64ContentEncoder;

class GmailHandler implements MailerInterface
{
    public function createService(Google_Client $client): Google_Service_Gmail
    {
        $service=new Google_Service_Gmail($client);
        $this->mailer=$service->users_messages;
        return $service;

    }

    public function createMail(string $sender, array $to, string $subject, string $body): Swift_Message
    {
        $message= new Swift_Message();
        $message
            ->setTo($to)
            ->setFrom($sender)
            ->setSubject($subject)
            ->setCharset('utf-8')
            ->setBody($body);
        return $message;
    }

    public function createMailWithAttachment(string $sender, array $to, string $subject, string $body,array $files): Swift_Message
    {
        // TODO: Implement createMailWithAttachment() method.
    }

    public function sendMail(Swift_Message $message)
    {
        $messageBase64=(new Swift_Mime_ContentEncoder_Base64ContentEncoder())
            ->encodeString($message->toString());
        $gmailMessage= new Google_Service_Gmail_Message();
        $gmailMessage->setRaw($messageBase64);
        echo $this->mailer.send("me",$gmailMessage);
    }
}