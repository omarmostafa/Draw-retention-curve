# Upcase Retention Curve

Simple app to calculate users data and draw a graph using laravel and vue js

## Requirement 
docker , docker-compose

## Technologies 
Laravel , vue js


## Installation

- clone project

```bash
git clone https://github.com/omarmostafa/temper-test.git
```
- build docker as administrator

```bash
docker-compose build
```

- Serve Project

```bash
docker-compose up
```

```bash
docker exec temper_php_fpm_container composer install
```

```bash
docker exec temper_php_fpm_container php artisan migrate
```

```bash
docker exec temper_php_fpm_container npm install -f
```

```bash
docker exec temper_php_fpm_container chmod 777 storage -R
```

- Copy .env.example to .env

```bash
cp .env.example .env
```

- Open project on [localhost:7070](localhost:7070)

- Run unit testing 
```bash
docker exec temper_php_fpm_container ./vendor/bin/phpunit
```

## API Documentation

- to see API documentation and try it,  open [localhost:7070/api/documentation](localhost:7070/api/documentation)

![swagger](https://user-images.githubusercontent.com/13676657/61584484-b7bb2100-ab48-11e9-9d12-80f4f8d00c84.png)

## Sample result 
![curve](https://user-images.githubusercontent.com/13676657/61584485-c6a1d380-ab48-11e9-9521-8045f2c1cd4b.png)


This app is for writing clean code in laravel framework and following design patterns and SOLID principle 

