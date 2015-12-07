# Symfony2-Ticket-System
======================

## Bundles
1. [TicketBundle]
2. [UserBundle]

## What you can do ?

- User can open a ticket
- User can list only his tickets
- Admin can see all tickets and ticket details
- Admin can solve tickets
- Admin can add comment to any ticket
- Admin can search tickets by created date, priority etc.
- Admin can create or delete category

## Installation

* Install Composer.json
```bash
$ composer install
```
* Configure `app/config/parameters.yml` file
* Create database
```bash
$ php app/console doctrine:database:create
```
* Create database schema
```bash
$ php app/console doctrine:schema:create
```
* Create and activate a user for login
```bash
$ php app/console fos:user:create
```
(Follow the console for creating user)

Activation
```bash
$ php app/console fos:user:activate <user_name>
```
* If you want to login as admin
```bash
$ php app/console fos:user:promote <user_name> ROLE_ADMIN
```
* Load fixtures for test category data
```bash
$ php app/console doctrine:fixtures:load
```

## Screenshots

![alt tag](https://raw.githubusercontent.com/mertoksuz/symfony2-ticket-system/master/web/tickets_screen.png)
![alt tag](https://raw.githubusercontent.com/mertoksuz/symfony2-ticket-system/master/web/ticket_add_screen.png)