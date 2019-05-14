<?php
namespace App;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;


$containerBuilder=new ContainerBuilder();
//
//$containerBuilder->register('gmail.handler','\App\GmailApi\Mailer\GmailHandler');
//
//$containerBuilder->register('simple.gmail.command','\App\Command\SimpleGmailCommand')
//        ->addArgument(new Reference('gmail.handler'));
//
$loader = new YamlFileLoader($containerBuilder, new FileLocator(DOCUMENT_ROOT.'config'));
$loader->load('services.yaml');

return $containerBuilder;