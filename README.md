## Giant Monkey Robot Php Challenge with Symfony 4
- [Demo](https://gmr-php-challenge.herokuapp.com) - Heroku link
- [Documentation](https://documenter.getpostman.com/view/897993/SzYaVxqE?version=latest) - Postman Documentation
- [Github](https://github.com/robzuar/gmr-challenge-api.git) - GIT Project
  
## Deployment
### Run 
```bash
$ git clone https://github.com/robzuar/gmr-challenge-api.git
```
```bash
$ composer install
```
```bash
$ php bin/console doctrine:database:create
```
```bash
$ php bin/console doctrine:database:update
```
```bash
$ symfony server:start
```

---
 - you will need to manually restore the database from file gmr-php-challenge.sql .
 - set user and password into .env file. 
 