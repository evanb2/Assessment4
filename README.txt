Shoe Store Database using PSQL

This site uses a database for storing all the Brands and Stores. User can enter
a Brand or a Store, then assign a Brand to a specific Store, or assign a Store
specific Brands. User can also delete specific Stores and update the Name of that
Store.

This database is run using PSQL. To set up the database called 'shoes' and 'shoes_test',
enter into PSQL:

CREATE DATABASE shoes;
\c shoes;
CREATE TABLE stores (id serial PRIMARY KEY, storename varchar);
CREATE TABLE brands (id serial PRIMARY KEY, brandname varchar);
CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id int, brand_id int);
CREATE DATABASE shoes_test WITH TEMPLATE shoes;

Copywrite 2015. Evan Butler.
