#!/usr/bin/env php

<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\SimpleGmailCommand;
use App\GmailApi\Mailer\GmailHandler;
use App\kty;

$gmail=new kty();


$app= new Application("GmailApi CLI");

$app->run();
