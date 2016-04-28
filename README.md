Redis Yii2 RBAC integration
===========================

This extension allow the developper to use REDIS database as the RBAC repository.


[![Latest Stable Version](https://poser.pugx.org/sweelix/yii2-postmark/v/stable)](https://packagist.org/packages/sweelix/yii2-postmark)
[![Build Status](https://api.travis-ci.org/pgaultier/yii2-postmark.svg?branch=master)](https://travis-ci.org/pgaultier/yii2-postmark)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pgaultier/yii2-postmark/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pgaultier/yii2-postmark/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pgaultier/yii2-postmark/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pgaultier/tree/?branch=master)
[![License](https://poser.pugx.org/sweelix/yii2-postmark/license)](https://packagist.org/packages/sweelix/yii2-postmark)

[![Latest Development Version](https://img.shields.io/badge/unstable-devel-yellowgreen.svg)](https://packagist.org/packages/sweelix/yii2-postmark)
[![Build Status](https://travis-ci.org/pgaultier/yii2-postmark.svg?branch=devel)](https://travis-ci.org/pgaultier/yii2-postmark)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pgaultier/yii2-postmark/badges/quality-score.png?b=devel)](https://scrutinizer-ci.com/g/pgaultier/yii2-postmark/?branch=devel)
[![Code Coverage](https://scrutinizer-ci.com/g/pgaultier/yii2-postmark/badges/coverage.png?b=devel)](https://scrutinizer-ci.com/g/pgaultier/tree/?branch=devel)

Installation
------------

If you use Packagist for installing packages, then you can update your composer.json like this :

``` json
{
    "require": {
        "sweelix/yii2-redis-rbac": "*"
    }
}
```

Howto use it
------------

Add extension to your configuration

``` php
return [
    //....
    'components' => [
        'mailer' => [
            'class' => 'sweelix\postmark\Mailer',
            'token' => '<your postmark token>',
        ],
    ],
];
```

You can send email as follow (using postmark templates)

``` php
Yii::$app->mailer->compose('contact/html')
     ->setFrom('from@domain.com')
     ->setTo($form->email)
     ->setSubject($form->subject)
     ->setTemplateId(12345)
     ->setTemplateModel([
         'firstname' => $form->firstname,
         'lastname' => $form->lastname,
     ->send();

```

For further instructions refer to the [related section in the Yii Definitive Guide](http://www.yiiframework.com/doc-2.0/guide-tutorial-mailing.html)


Running the tests
-----------------

Before running the tests, you should edit the file tests/_bootstrap.php and change the defines :

``` php
// ...
define('POSTMARK_FROM', '<sender>');
define('POSTMARK_TOKEN', '<token>');
define('POSTMARK_TO', '<target>');
define('POSTMARK_TEMPLATE', 575741);

define('POSTMARK_TEST_SEND', false);
// ...

```

to match your [PostmarkApp](https://postmarkapp.com) configuration.

Contributing
------------

All code contributions - including those of people having commit access -
must go through a pull request and approved by a core developer before being
merged. This is to ensure proper review of all the code.

Fork the project, create a [feature branch ](http://nvie.com/posts/a-successful-git-branching-model/), and send us a pull request.