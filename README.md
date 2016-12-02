Jadwal Kuliah P2K Jurusan Elektro
============================

Pembuatan jadwal kuliah untuk jurusan elektro FT UMJ

DIRECTORY STRUCTURE
-------------------

	assets/             	contains assets cache
	app/
		assets/             contains assets definition
		commands/           contains console commands (controllers)
		config/             contains application configurations
		controllers/        contains Web controller classes
		mail/               contains view files for e-mails
		models/             contains model classes
		runtime/            contains files generated during runtime
		views/              contains view files for the Web application
		web/                contains the entry script and Web resources
	environments/
		dev/				contains config for develop
		prod/				contains config for production
	tests/		            contains various tests for the basic application
	public/
		images/				contains file images to access public
		uploads/			contains uploads file
	vendor/             	contains dependent 3rd-party packages 
	  
REQUIREMENTS
------------

1. The minimum requirement by this project template that your Web server supports PHP 5.4.0.
2. Download and install composer ```https://getcomposer.org/```


INSTALLATION
------------

Don't forget to setup, follow these instruction:
1. Open your root *jadwal-kuliah-elektro* with CMD / CLI
2. run ``` php init ```

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/jadwal-kuliah-elektro
~~~


CONFIGURATION
-------------

### Composer
1. Open your CMD / CLI and cd to root *yii2-basic-template*
2. run ``` composer install ```

### Database

Edit the file `app/config/db.php` for server database.

Edit the file `app/config/web-local.php` for your local database.

For example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=jadwal-kuliah-elektro',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

### Mailer

Edit the file `app/config/web.php` for server mail.

Edit the file `app/config/web-local.php` for your mail.
```
'mailer' => [
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '@app/mail',
    'useFileTransport' => false, // false agar bisa kirim lewat online
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com',
        'username' => '',
        'password' => '', // setting sesuai kebutuhan
        'port' => '587',
        'encryption' => 'tls',
    ],
],
```

### Migration

For migrate databse with CMD / CLI.
1. Open your CMD / CLI
2. cd to your root *jadwal-kuliah-elektro*
3. run ``` yii migrate ```