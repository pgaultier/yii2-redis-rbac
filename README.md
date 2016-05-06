Redis Yii2 RBAC integration
===========================

This extension allow the developper to use REDIS database as the RBAC repository.


[![Latest Stable Version](https://poser.pugx.org/sweelix/yii2-redis-rbac/v/stable)](https://packagist.org/packages/sweelix/yii2-redis-rbac)
[![Build Status](https://api.travis-ci.org/pgaultier/yii2-redis-rbac.svg?branch=master)](https://travis-ci.org/pgaultier/yii2-redis-rbac)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pgaultier/yii2-redis-rbac/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pgaultier/yii2-redis-rbac/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pgaultier/yii2-redis-rbac/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pgaultier/yii2-redis-rbac/?branch=master)
[![License](https://poser.pugx.org/sweelix/yii2-redis-rbac/license)](https://packagist.org/packages/sweelix/yii2-redis-rbac)

[![Latest Development Version](https://img.shields.io/badge/unstable-devel-yellowgreen.svg)](https://packagist.org/packages/sweelix/yii2-redis-rbac)
[![Build Status](https://travis-ci.org/pgaultier/yii2-redis-rbac.svg?branch=devel)](https://travis-ci.org/pgaultier/yii2-redis-rbac)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pgaultier/yii2-redis-rbac/badges/quality-score.png?b=devel)](https://scrutinizer-ci.com/g/pgaultier/yii2-redis-rbac/?branch=devel)
[![Code Coverage](https://scrutinizer-ci.com/g/pgaultier/yii2-redis-rbac/badges/coverage.png?b=devel)](https://scrutinizer-ci.com/g/pgaultier/yii2-redis-rbac/?branch=devel)

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
        'authManager' => [
            'class' => 'sweelix\rbac\redis\Manager',
            'db' => 'redis',
        ],
        // ...
    ],
];
```


For further instructions refer to the [related section in the Yii Definitive Guide](http://www.yiiframework.com/doc-2.0/guide-security-authorization.html)


Running the tests
-----------------

Before running the tests, you should edit the file tests/config/redis.php and change the config to match your environment.

Contributing
------------

All code contributions - including those of people having commit access -
must go through a pull request and approved by a core developer before being
merged. This is to ensure proper review of all the code.

Fork the project, create a [feature branch ](http://nvie.com/posts/a-successful-git-branching-model/), and send us a pull request.
