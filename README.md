![img](https://raw.githubusercontent.com/berkalpyakici/mun_mms/master/panel/uploads/logo/default.png)

[![GitHub license](https://img.shields.io/badge/license-AGPL-blue.svg)](https://raw.githubusercontent.com/berkalpyakici/mun_mms/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/berkalpyakici/mun_mms.svg)](https://github.com/berkalpyakici/mun_mms/issues)

# MUN Member Management System
Model United Nations, also known as Model UN or MUN, is an educational simulation and/or academic competition in which students can learn about diplomacy, international relations, and the United Nations. MMS designed exclusively for K12 schools that offer MUN as an extracurricular activity.

## Requirements
* Web Host (Linux OS)
* MySQL Database

Note: cPanel (WHM) is recommended.

## Copyleft
This project uses [MeekroDB](https://github.com/SergeyTsalkov/meekrodb) under GPL-3.0 license.  
This project uses [PHPMailer](https://github.com/PHPMailer/PHPMailer) under LGPL-2.1 license.

## Installation
Create a config.php file under private/page/ with these variables:
```php
$config['db']['user'] = '';
$config['db']['pass'] = '';
$config['db']['database'] = '';
$config['db']['host'] = '';

$config['smtp']['user'] = '';
$config['smtp']['pass'] = '';
$config['smtp']['host'] = '';
$config['smtp']['port'] = 25;
$config['smtp']['encryption'] = 'tls';
$config['smtp']['from'] = '';
$config['smtp']['from_name'] = '';
```
