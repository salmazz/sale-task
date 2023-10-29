# Restaurant Reservation API

## Table of Contents

- [Introduction](#introduction)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
    - [1. Check Availability](#1-check-availability)
    - [2. Reserve Table](#2-reserve-table)
    - [3. List Menu Items](#3-list-menu-items)
    - [4. Place Order](#4-place-order)
    - [5. Pay](#5-pay)
- [Design Patterns](#design-patterns)
- [Bonus Features](#bonus-features)
- [Testing](#testing)
- [Docker](#docker)
- [Authentication](#authentication)
- [Postman Collection](#postman-collection)

## Introduction

This project provides a set of APIs for managing a mini restaurant reservation system. It includes functionalities for checking table availability, reserving tables, listing menu items, placing orders, and generating invoices for customers.

## Database Schema

### Entities and Attributes

- `meals`: id, price, description, available_quantity, discount
- `tables`: id, capacity
- `customers`: id, name, phone
- `reservations`: id, table_id, customer_id, from_time, to_time
- `orders`: id, table_id, reservation_id, customer_id, user_id (waiter), total, paid, date
- `order_details`: id, order_id, meal_id, amount_to_pay

## API Endpoints

### 1. Check Availability

Endpoint: `/api/check-availability`

Description: Check if a table is available during a certain datetime for a given number of guests.

### 2. Reserve Table

Endpoint: `/api/reserve-table`

Description: Reserve a table for a customer.

### 3. List Menu Items

Endpoint: `/api/list-menu-items`

Description: List all items in the menu. The system will ensure that each meal is served a limited number of times per day.

### 4. Place Order

Endpoint: `/api/place-order`

Description: Place an order for a table, applying all discounts for each meal.

### 5. Pay

Endpoint: `/api/pay`

Description: Checkout and print an invoice for a table. Two ways of handling checkout are available:
1. Add 14% taxes and 20% service charge.
2. Add a 15% service charge only.

## Design Patterns

Using Strategy Pattern to handle the different ways of calculating the checkout total (with taxes and service charges).

## Bonus Features

- **Waiting List**: Extend the schema to handle a waiting list when tables are at maximum capacity.
- **Cron Job AddToWaitingList**: Extend the schema to handle a waiting list when tables are at maximum capacity.
- **Cron Job UpdateMealAvailabilityJob**: To Return the initial available to the meal at the beginning for everyday.
- **Event And Listener**: To decrease the count of the meal when make order .

## Authentication

Make Authentication With Sanctum

## Postman Collection

To facilitate testing and integration, provide a Postman collection that includes sample requests for each API endpoint, along with expected responses. This will help users understand how to interact with your API.

[Link to Postman Collection](#) - Update this link once you create the collection.

## Getting Started

1. Clone this repository.
2. Install the required dependencies.
3. Set up your database and configure the `.env` file.
4. Migrate and seed the database.
5. Run the application.
6. Run The Jobs

## Clone
Clone this repo to your local machine using https://github.com/salmazz/sale-task.git
and run
```
git clone https://github.com/salmazz/sale-task.git
cd sale_task
cp .env.example .env
composer install
composer dumpautoload
```

# Laravel sail
run  ./vendor/bin/sail up -d to setup environment by docker
```
./vendor/bin/sail up -d
```

# Laravel sail
run  ./vendor/bin/sail up -d to setup environment by docker
```
./vendor/bin/sail up -d
```

## Run Migrations
```bash
 ./vendor/bin/sail artisan migrate --seed
 ````
## Testing

```
./vendor/bin/sail artisan test
````
