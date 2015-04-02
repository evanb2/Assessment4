# Shoe Store Database
### (Assessment 4)
## by Evan Butler
### Date: April 1, 2015
#### Description

This app helps users make a database for shoe stores and the brands they carry.

1. The user can add/edit/delete a Store in the database, and assign specific Brands to
   that Store.
2. The user can add a Brand to the database, and assign specific Stores to that Brand.



#### Setup instructions
1. Clone this git repository
2. Set your localhost root folder to ~/assessment4/web/
3. Ensure PHP server is running.
4. Start Postgres and import shoes.sql database into a new database shoes
5. Do the same for the test database: shoes_test.sql
6. Use Composer to install required dependencies in the composer.json file
7. Start the web app by pointing your browser to the root (http://localhost:8000/)


#### PSQL commands
CREATE DATABASE shoes;
\c shoes;
CREATE TABLE stores (id serial PRIMARY KEY, storename varchar);
CREATE TABLE brands (id serial PRIMARY KEY, brandname varchar);
CREATE TABLE brands_stores (id serial PRIMARY KEY, store_id int, brand_id int);
CREATE DATABASE shoes_test WITH TEMPLATE shoes;

#### Copyright © 2015, Evan Butler, Inc.

#### License: [MIT](https://github.com/twbs/bootstrap/blob/master/LICENSE)  
