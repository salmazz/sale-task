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
- `invoices` : id,user_id , order_id , customer_id , total
- `waiting_list`: id,customer_id, capacity,to_time, from_time

## API Endpoints

## Path Table

| Method | Path                     | Description        |
|--------|--------------------------|--------------------|
| POST   | /api/check-availability  | Check Availability |
| POST   | /api/reserve-table/      | Reserve Table      |
| GET    | /api/list-menu-items/    | List Menu Item     |
| POST   | /api/place-order/        | Place Order        |
| POST   | /api/pay/                | Pay                |


### 1. Check Availability

Endpoint: `/api/check-availability`

Description: Check if a table is available during a certain datetime for a given number of guests.

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

**Request Body:**
```json
{
  "from_time": "2023-10-02 00:00:00",
  "to_time" : "2023-11-01 00:00:00",
  "capacity" : 2,
  "waiting_list": true,
  "customer_id" :1
}
```

### 2. Reserve Table

Endpoint: `/api/reserve-table`

Description: Reserve a table for a customer.


**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

**Request Body:**
```json
{
  "table_id": 2,
  "customer_id": 2,
  "from_time": "2023-10-02 00:00:00",
  "to_time": "2023-11-01 00:00:00"
}
```

### 3. List Menu Items

Endpoint: `/api/list-menu-items`

Description: List all items in the menu. The system will ensure that each meal is served a limited number of times per day.


**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

### 4. Place Order

Endpoint: `/api/place-order`

Description: Place an order for a table, applying all discounts for each meal.

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

**Request Body:**
```json
{
  "table_id": 1,
  "customer_id": 2,
  "user_id": 1,
  "reservation_id": 4,
  "order_items": [
    {
      "meal_id": 20,
      "quantity": 2
    },
    {
      "meal_id": 19,
      "quantity": 1
    }
  ]
}
```

### 5. Pay

Endpoint: `/api/pay`

Description: Checkout and print an invoice for a table. Two ways of handling checkout are available:
1. Add 14% taxes and 20% service charge.
2. Add a 15% service charge only.

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

**Request Body:**
```json
{
  "order_id" : 26,
  "checkout_option":2
}
```
## Design Patterns

Using Strategy Pattern to handle the different ways of calculating the checkout total (with taxes and service charges).

## Bonus Features

- **Waiting List**: Extend the schema to handle a waiting list when tables are at maximum capacity.
- **Cron Job AddToWaitingList**: Extend the schema to handle a waiting list when tables are at maximum capacity.
- **Cron Job UpdateMealAvailabilityJob**: To Return the initial available to the meal at the beginning for everyday.
- **Event And Listener**: To decrease the count of the meal when make order .

## Authentication

Authentication With Sanctum

## Postman Collection

To facilitate testing and integration, provide a Postman collection that includes sample requests for each API endpoint, along with expected responses. This will help users understand how to interact with your API.

[Link to Postman Collection](https://elements.getpostman.com/redirect?entityId=6208228-a1f8d459-d304-4e5a-a680-5b390f73b97f&entityType=collection) - Update this link once you create the collection.

Please Add in Sale Env

- app_url: with your app link 
- token :when make login
- In Every Api Body have example about request


# Requirements
- PHP 8.2
- MySQL

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

## Run Migrations
```bash
 ./vendor/bin/sail artisan migrate --seed
 ````

