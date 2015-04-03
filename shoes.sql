--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: brands; Type: TABLE; Schema: public; Owner: evanbutler; Tablespace: 
--

CREATE TABLE brands (
    id integer NOT NULL,
    brandname character varying
);


ALTER TABLE brands OWNER TO evanbutler;

--
-- Name: brands_id_seq; Type: SEQUENCE; Schema: public; Owner: evanbutler
--

CREATE SEQUENCE brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_id_seq OWNER TO evanbutler;

--
-- Name: brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: evanbutler
--

ALTER SEQUENCE brands_id_seq OWNED BY brands.id;


--
-- Name: brands_stores; Type: TABLE; Schema: public; Owner: evanbutler; Tablespace: 
--

CREATE TABLE brands_stores (
    id integer NOT NULL,
    store_id integer,
    brand_id integer
);


ALTER TABLE brands_stores OWNER TO evanbutler;

--
-- Name: brands_stores_id_seq; Type: SEQUENCE; Schema: public; Owner: evanbutler
--

CREATE SEQUENCE brands_stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_stores_id_seq OWNER TO evanbutler;

--
-- Name: brands_stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: evanbutler
--

ALTER SEQUENCE brands_stores_id_seq OWNED BY brands_stores.id;


--
-- Name: stores; Type: TABLE; Schema: public; Owner: evanbutler; Tablespace: 
--

CREATE TABLE stores (
    id integer NOT NULL,
    storename character varying
);


ALTER TABLE stores OWNER TO evanbutler;

--
-- Name: stores_id_seq; Type: SEQUENCE; Schema: public; Owner: evanbutler
--

CREATE SEQUENCE stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stores_id_seq OWNER TO evanbutler;

--
-- Name: stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: evanbutler
--

ALTER SEQUENCE stores_id_seq OWNED BY stores.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: evanbutler
--

ALTER TABLE ONLY brands ALTER COLUMN id SET DEFAULT nextval('brands_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: evanbutler
--

ALTER TABLE ONLY brands_stores ALTER COLUMN id SET DEFAULT nextval('brands_stores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: evanbutler
--

ALTER TABLE ONLY stores ALTER COLUMN id SET DEFAULT nextval('stores_id_seq'::regclass);


--
-- Data for Name: brands; Type: TABLE DATA; Schema: public; Owner: evanbutler
--

COPY brands (id, brandname) FROM stdin;
233	Danner
234	Nike
235	Addidas
236	Puma
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: evanbutler
--

SELECT pg_catalog.setval('brands_id_seq', 236, true);


--
-- Data for Name: brands_stores; Type: TABLE DATA; Schema: public; Owner: evanbutler
--

COPY brands_stores (id, store_id, brand_id) FROM stdin;
1	344	235
2	344	234
3	344	236
4	344	233
5	346	233
6	346	235
7	347	234
8	347	235
9	347	236
10	349	234
11	349	235
\.


--
-- Name: brands_stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: evanbutler
--

SELECT pg_catalog.setval('brands_stores_id_seq', 11, true);


--
-- Data for Name: stores; Type: TABLE DATA; Schema: public; Owner: evanbutler
--

COPY stores (id, storename) FROM stdin;
348	Finish Line
349	Payless
347	Footlocker
\.


--
-- Name: stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: evanbutler
--

SELECT pg_catalog.setval('stores_id_seq', 349, true);


--
-- Name: brands_pkey; Type: CONSTRAINT; Schema: public; Owner: evanbutler; Tablespace: 
--

ALTER TABLE ONLY brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);


--
-- Name: brands_stores_pkey; Type: CONSTRAINT; Schema: public; Owner: evanbutler; Tablespace: 
--

ALTER TABLE ONLY brands_stores
    ADD CONSTRAINT brands_stores_pkey PRIMARY KEY (id);


--
-- Name: stores_pkey; Type: CONSTRAINT; Schema: public; Owner: evanbutler; Tablespace: 
--

ALTER TABLE ONLY stores
    ADD CONSTRAINT stores_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: evanbutler
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM evanbutler;
GRANT ALL ON SCHEMA public TO evanbutler;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

