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

1. Configure `app/config/parameters.yml` file

2. Create database
```bash
$ php app/console doctrine:database:create
```

3. Create database schema
```bash
$ php app/console doctrine:schema:create
```

4. Create and activate a user for login
```bash
$ php app/console fos:user:create
```
(Follow the console for creating user)

Activation
```bash
$ php app/console fos:user:activate <user_name>
```


5. If you want to login as admin
```bash
$ php app/console fos:user:promote <user_name> ROLE_ADMIN
```

6. Load fixtures for test category data
```bash
$ php app/console doctrine:fixtures:load
```
