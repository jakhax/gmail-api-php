# GMAIL API PHP
## Description
- This a php cli app that uses gmail api to send mails.

## Installation
```bash
git clone 
composer install
```

## setup
### Gmail API creds
- If you do not have the credentials file, head over to the [docs section](https://developers.google.com/gmail/api/quickstart/php)
- On step 1 select `enable the gmail api` then `download client configuration`
- Save the file `credentials.json` in the `config` dir, dont commit it. 
## usage
### List available commands
```bash
./php-gmail list
```

### simple mailer
```bash
./php-gmail-api simplegmail\
 --sender=me@mail.com --to=you@mail.com\
 --subject=Hello --body=Hello World!
```

## next steps 
- implement dependency injection using symfony service containers,[symfony dependency injection](https://symfony.com/doc/current/components/dependency_injection.html).
- Add support for batch email.
- Add gmail service account support.
- Command for getting recipients and mail from a files(e.g csv file).
