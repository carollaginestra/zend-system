# Demand-side system

This project was created for my Graduate studies of Development of applications for web and mobile devices.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

* PHP 7
* Node 8.10.0
* NPM 6.2.0
* Postgree 9.6

### Installing

Clone the project and enter into the project folder:

```sh
$ git clone https://github.com/carollaginestra/zend-system.git
$ cd zend-system
```

Install composer

```sh
$ composer install
$ composer update
```

and start the project

```sh
$ php -S localhost:8000 -t public/
```

or

```sh
$ docker-compose up -d
```

## Create modules

always after you have created all the files in a new module, run the command

```sh
$ composer dump-autoload
```

## Built With

* [Zend](https://framework.zend.com/) - The web Framework PHP used