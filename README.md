# Workforce date calculator

Composer based project, no framework
Language: PHP (v7.2)
Libraries:
```
"require": {
  "php": "^7.2",
  "bramus/router": "~1.4",
  "jenssegers/blade": "^1.2",
  "nette/http": "^3.0",
  "vlucas/phpdotenv": "^5.3",
  "ext-curl": "*",
  "ext-json": "*"
},
"require-dev": {
  "phpunit/phpunit": "^9.3"
},
```

Code owner: Zoltan Nagy <nzolthu@gmail.com> 

### Acceptance Criteria:
- Using the webservice list the products that are available.
- Handle any errors
- For each insurance product returned, get more information and display

 URL: http://localhost:90/

- Can be run in demo container, docker-compose.yml provided. 

### Start:

- user@host$ docker-compose -up [-d]
- user@host$ docker run -ti app-itc bash 
- user@host$ cd /var/www/app/
- user@host$ php composer.phar install
- user@host$ sh startmock.sh (to start mock server for integration testing)
- user@host$ php vendor/bin/phpunit
__________________________________________________________________________________________
root@app-itc:/var/www/app# php vendor/bin/phpunit
PHPUnit 9.5.9 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.4.3
Configuration: /var/www/app/phpunit.xml
Random Seed:   1631523067

OK (19 tests, 36 assertions)
__________________________________________________________________________________________
