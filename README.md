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

1. Install Composer.json
```bash
$ composer install
```
2. Configure `app/config/parameters.yml` file
3. Create database
```bash
$ php app/console doctrine:database:create
```
4. Create database schema
```bash
$ php app/console doctrine:schema:create
```
5. Create and activate a user for login
```bash
$ php app/console fos:user:create
```
(Follow the console for creating user)

Activation
```bash
$ php app/console fos:user:activate <user_name>
```
6. If you want to login as admin
```bash
$ php app/console fos:user:promote <user_name> ROLE_ADMIN
```
7. Load fixtures for test category data
```bash
$ php app/console doctrine:fixtures:load
```

## Screenshots

![alt tag](https://raw.githubusercontent.com/mertoksuz/symfony2-ticket-system/master/web/tickets_screen.png)
![alt tag](https://raw.githubusercontent.com/mertoksuz/symfony2-ticket-system/master/web/ticket_add_screen.png)