--
-- PostgreSQL database dump
--

\restrict dTEWuAoJ5kKYpeY8KDQU1IciSsZn3Yqbp101tir9xef4hAw8tcElzjMU0vIwr1g

-- Dumped from database version 18.4 (Debian 18.4-1.pgdg12+1)
-- Dumped by pg_dump version 18.3

-- Started on 2026-06-22 14:40:18

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 5 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: food_delivery_db_g46a_user
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO food_delivery_db_g46a_user;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 251 (class 1259 OID 16743)
-- Name: addresses; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.addresses (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    title character varying(255) NOT NULL,
    address character varying(255) NOT NULL,
    latitude numeric(10,8),
    longitude numeric(11,8),
    is_default boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.addresses OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 250 (class 1259 OID 16742)
-- Name: addresses_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.addresses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.addresses_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3615 (class 0 OID 0)
-- Dependencies: 250
-- Name: addresses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.addresses_id_seq OWNED BY public.addresses.id;


--
-- TOC entry 225 (class 1259 OID 16444)
-- Name: cache; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 226 (class 1259 OID 16455)
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 249 (class 1259 OID 16717)
-- Name: carts; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.carts (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    food_item_id bigint NOT NULL,
    quantity integer DEFAULT 1 NOT NULL,
    price numeric(10,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.carts OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 248 (class 1259 OID 16716)
-- Name: carts_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.carts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.carts_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3616 (class 0 OID 0)
-- Dependencies: 248
-- Name: carts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.carts_id_seq OWNED BY public.carts.id;


--
-- TOC entry 239 (class 1259 OID 16573)
-- Name: categories; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    restaurant_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    image character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.categories OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 238 (class 1259 OID 16572)
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3617 (class 0 OID 0)
-- Dependencies: 238
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- TOC entry 231 (class 1259 OID 16497)
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 230 (class 1259 OID 16496)
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3618 (class 0 OID 0)
-- Dependencies: 230
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- TOC entry 241 (class 1259 OID 16590)
-- Name: food_items; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.food_items (
    id bigint NOT NULL,
    restaurant_id bigint NOT NULL,
    category_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    price numeric(10,2) NOT NULL,
    discount_price numeric(10,2),
    image character varying(255),
    is_available boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.food_items OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 240 (class 1259 OID 16589)
-- Name: food_items_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.food_items_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.food_items_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3619 (class 0 OID 0)
-- Dependencies: 240
-- Name: food_items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.food_items_id_seq OWNED BY public.food_items.id;


--
-- TOC entry 229 (class 1259 OID 16482)
-- Name: job_batches; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 228 (class 1259 OID 16467)
-- Name: jobs; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 227 (class 1259 OID 16466)
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3620 (class 0 OID 0)
-- Dependencies: 227
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- TOC entry 220 (class 1259 OID 16399)
-- Name: migrations; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 219 (class 1259 OID 16398)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3621 (class 0 OID 0)
-- Dependencies: 219
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 245 (class 1259 OID 16666)
-- Name: order_items; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.order_items (
    id bigint NOT NULL,
    order_id bigint NOT NULL,
    food_item_id bigint NOT NULL,
    quantity integer NOT NULL,
    price numeric(10,2) NOT NULL,
    total numeric(10,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.order_items OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 244 (class 1259 OID 16665)
-- Name: order_items_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.order_items_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.order_items_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3622 (class 0 OID 0)
-- Dependencies: 244
-- Name: order_items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.order_items_id_seq OWNED BY public.order_items.id;


--
-- TOC entry 243 (class 1259 OID 16616)
-- Name: orders; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.orders (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    restaurant_id bigint NOT NULL,
    rider_id bigint,
    order_no character varying(255) NOT NULL,
    subtotal numeric(10,2) DEFAULT '0'::numeric NOT NULL,
    delivery_fee numeric(10,2) DEFAULT '0'::numeric NOT NULL,
    discount numeric(10,2) DEFAULT '0'::numeric NOT NULL,
    tax numeric(10,2) DEFAULT '0'::numeric NOT NULL,
    total_amount numeric(10,2) DEFAULT '0'::numeric NOT NULL,
    payment_method character varying(255) DEFAULT 'cash'::character varying NOT NULL,
    payment_status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    order_status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    delivery_address character varying(255) NOT NULL,
    latitude numeric(10,8),
    longitude numeric(11,8),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    rider_status character varying(50),
    CONSTRAINT orders_order_status_check CHECK (((order_status)::text = ANY ((ARRAY['pending'::character varying, 'accepted'::character varying, 'preparing'::character varying, 'ready'::character varying, 'picked_up'::character varying, 'delivered'::character varying, 'cancelled'::character varying])::text[]))),
    CONSTRAINT orders_payment_method_check CHECK (((payment_method)::text = ANY ((ARRAY['cash'::character varying, 'card'::character varying, 'wallet'::character varying])::text[]))),
    CONSTRAINT orders_payment_status_check CHECK (((payment_status)::text = ANY ((ARRAY['pending'::character varying, 'paid'::character varying, 'failed'::character varying])::text[])))
);


ALTER TABLE public.orders OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 242 (class 1259 OID 16615)
-- Name: orders_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.orders_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3623 (class 0 OID 0)
-- Dependencies: 242
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.orders_id_seq OWNED BY public.orders.id;


--
-- TOC entry 223 (class 1259 OID 16423)
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 233 (class 1259 OID 16516)
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name text NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 232 (class 1259 OID 16515)
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3624 (class 0 OID 0)
-- Dependencies: 232
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- TOC entry 237 (class 1259 OID 16552)
-- Name: restaurants; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.restaurants (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    logo character varying(255),
    cover_image character varying(255),
    phone character varying(255) NOT NULL,
    address character varying(255) NOT NULL,
    latitude numeric(10,8),
    longitude numeric(11,8),
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.restaurants OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 236 (class 1259 OID 16551)
-- Name: restaurants_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.restaurants_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.restaurants_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3625 (class 0 OID 0)
-- Dependencies: 236
-- Name: restaurants_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.restaurants_id_seq OWNED BY public.restaurants.id;


--
-- TOC entry 247 (class 1259 OID 16689)
-- Name: reviews; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.reviews (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    restaurant_id bigint NOT NULL,
    order_id bigint,
    rating smallint NOT NULL,
    comment text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.reviews OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 246 (class 1259 OID 16688)
-- Name: reviews_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.reviews_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.reviews_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3626 (class 0 OID 0)
-- Dependencies: 246
-- Name: reviews_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.reviews_id_seq OWNED BY public.reviews.id;


--
-- TOC entry 253 (class 1259 OID 16765)
-- Name: rider_order_declines; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.rider_order_declines (
    id bigint NOT NULL,
    order_id bigint NOT NULL,
    rider_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.rider_order_declines OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 252 (class 1259 OID 16764)
-- Name: rider_order_declines_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.rider_order_declines_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rider_order_declines_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3627 (class 0 OID 0)
-- Dependencies: 252
-- Name: rider_order_declines_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.rider_order_declines_id_seq OWNED BY public.rider_order_declines.id;


--
-- TOC entry 235 (class 1259 OID 16534)
-- Name: riders; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.riders (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    vehicle_type character varying(255),
    plate_number character varying(255),
    license_no character varying(255),
    current_latitude numeric(10,8),
    current_longitude numeric(11,8),
    is_available boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    fcm_token text
);


ALTER TABLE public.riders OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 234 (class 1259 OID 16533)
-- Name: riders_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.riders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.riders_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3628 (class 0 OID 0)
-- Dependencies: 234
-- Name: riders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.riders_id_seq OWNED BY public.riders.id;


--
-- TOC entry 224 (class 1259 OID 16432)
-- Name: sessions; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 222 (class 1259 OID 16409)
-- Name: users; Type: TABLE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    phone character varying(255),
    role character varying(255) DEFAULT 'customer'::character varying NOT NULL,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['customer'::character varying, 'restaurant'::character varying, 'rider'::character varying, 'admin'::character varying])::text[])))
);


ALTER TABLE public.users OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 221 (class 1259 OID 16408)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO food_delivery_db_g46a_user;

--
-- TOC entry 3629 (class 0 OID 0)
-- Dependencies: 221
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 3346 (class 2604 OID 16746)
-- Name: addresses id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.addresses ALTER COLUMN id SET DEFAULT nextval('public.addresses_id_seq'::regclass);


--
-- TOC entry 3344 (class 2604 OID 16720)
-- Name: carts id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.carts ALTER COLUMN id SET DEFAULT nextval('public.carts_id_seq'::regclass);


--
-- TOC entry 3330 (class 2604 OID 16576)
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- TOC entry 3323 (class 2604 OID 16500)
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- TOC entry 3331 (class 2604 OID 16593)
-- Name: food_items id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.food_items ALTER COLUMN id SET DEFAULT nextval('public.food_items_id_seq'::regclass);


--
-- TOC entry 3322 (class 2604 OID 16470)
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- TOC entry 3319 (class 2604 OID 16402)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 3342 (class 2604 OID 16669)
-- Name: order_items id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.order_items ALTER COLUMN id SET DEFAULT nextval('public.order_items_id_seq'::regclass);


--
-- TOC entry 3333 (class 2604 OID 16619)
-- Name: orders id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.orders ALTER COLUMN id SET DEFAULT nextval('public.orders_id_seq'::regclass);


--
-- TOC entry 3325 (class 2604 OID 16519)
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- TOC entry 3328 (class 2604 OID 16555)
-- Name: restaurants id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.restaurants ALTER COLUMN id SET DEFAULT nextval('public.restaurants_id_seq'::regclass);


--
-- TOC entry 3343 (class 2604 OID 16692)
-- Name: reviews id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.reviews ALTER COLUMN id SET DEFAULT nextval('public.reviews_id_seq'::regclass);


--
-- TOC entry 3348 (class 2604 OID 16768)
-- Name: rider_order_declines id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.rider_order_declines ALTER COLUMN id SET DEFAULT nextval('public.rider_order_declines_id_seq'::regclass);


--
-- TOC entry 3326 (class 2604 OID 16537)
-- Name: riders id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.riders ALTER COLUMN id SET DEFAULT nextval('public.riders_id_seq'::regclass);


--
-- TOC entry 3320 (class 2604 OID 16412)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3607 (class 0 OID 16743)
-- Dependencies: 251
-- Data for Name: addresses; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.addresses (id, user_id, title, address, latitude, longitude, is_default, created_at, updated_at) FROM stdin;
2	3	Home	ENAA7235، 7235 شارع المـلك فيصـل الغـربـي، 3223، حي المرقاب، Al Jubayl 35514, حي المرقاب, Al Jubayl, Eastern Province, Saudi Arabia	27.00103780	49.64473090	f	2026-06-14 17:01:24	2026-06-14 17:01:24
3	17	work	2G7H+Q9R, Industrial Area, Al Jubail, Eastern Province, Saudi Arabia	27.01430150	49.52826540	f	2026-06-15 11:17:34	2026-06-15 11:17:34
4	3	unicoil	2G7H+Q9R, Industrial Area, Al Jubail, Eastern Province, Saudi Arabia	27.01429370	49.52829090	f	2026-06-16 05:08:30	2026-06-16 05:08:30
\.


--
-- TOC entry 3581 (class 0 OID 16444)
-- Dependencies: 225
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- TOC entry 3582 (class 0 OID 16455)
-- Dependencies: 226
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- TOC entry 3605 (class 0 OID 16717)
-- Dependencies: 249
-- Data for Name: carts; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.carts (id, user_id, food_item_id, quantity, price, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3595 (class 0 OID 16573)
-- Dependencies: 239
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.categories (id, restaurant_id, name, image, created_at, updated_at) FROM stdin;
1	1	FOOD	\N	2026-06-14 06:11:36	2026-06-14 06:11:36
2	1	Desert	\N	2026-06-14 06:11:44	2026-06-14 06:11:44
3	1	Drinks	\N	2026-06-14 06:11:54	2026-06-14 06:11:54
4	2	Foods	\N	2026-06-14 12:38:01	2026-06-14 12:38:01
5	2	Desserts	\N	2026-06-14 12:38:13	2026-06-14 12:38:13
6	2	Drinks	\N	2026-06-14 12:38:22	2026-06-14 12:38:22
\.


--
-- TOC entry 3587 (class 0 OID 16497)
-- Dependencies: 231
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- TOC entry 3597 (class 0 OID 16590)
-- Dependencies: 241
-- Data for Name: food_items; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.food_items (id, restaurant_id, category_id, name, description, price, discount_price, image, is_available, created_at, updated_at) FROM stdin;
6	1	2	Chocolate	Quench your thirst with our refreshing drinks selection. Click here to view all available drinks.	52.00	28.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781434631/food_delivery/foods/doorcfuuarcrewrbgm7p.jpg	t	2026-06-14 06:19:32	2026-06-14 10:57:11
3	1	1	Mash Potato	Quench your thirst with our refreshing drinks selection. Click here to view all available drinks.	38.00	32.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781436158/food_delivery/foods/ns0kokwyrlmlt4mm8qug.jpg	t	2026-06-14 06:16:25	2026-06-14 11:22:39
2	1	1	Chicken Bucket	Quench your thirst with our refreshing drinks selection. Click here to view all available drinks.	42.00	35.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781436306/food_delivery/foods/kku6o0vxqh1ztmblfm5c.jpg	t	2026-06-14 06:14:39	2026-06-14 11:25:06
1	1	1	Family Combo	Quench your thirst with our refreshing drinks selection. Click here to view all available drinks.	55.00	48.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781436322/food_delivery/foods/hs1dgosmyjcabhl7lyc7.jpg	t	2026-06-14 06:13:17	2026-06-14 11:25:23
8	2	4	Big Mac	McDonald's offers a wide variety of drinks, including fountain sodas, freshly brewed McCafé coffees, and specialty beverages. Available items vary by location, but the global menu generally features these popular options:	54.00	46.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781441954/food_delivery/foods/ipllvzoc2csb01vx3ts1.jpg	t	2026-06-14 12:39:13	2026-06-14 12:59:15
14	2	6	Sprite	Follow the Android Studio key generation steps. · Run the following command at the command line: On macOS or Linux, use the following command	21.00	16.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781500813/food_delivery/foods/jduu6lyc9mdkehyjavq2.jpg	t	2026-06-15 05:17:43	2026-06-16 05:32:47
4	1	1	Crunches	Quench your thirst with our refreshing drinks selection. Click here to view all available drinks.	52.00	48.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781436140/food_delivery/foods/eiuztliity7xd63jsaet.jpg	t	2026-06-14 06:17:22	2026-06-16 05:34:05
5	1	2	Ice-cream	Quench your thirst with our refreshing drinks selection. Click here to view all available drinks.	38.00	31.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781436034/food_delivery/foods/yaa0d0vmgll1gn2cpy2p.jpg	t	2026-06-14 06:18:18	2026-06-16 05:34:26
11	2	6	Syrup Juice	McDonald's offers a wide variety of drinks, including fountain sodas, freshly brewed McCafé coffees, and specialty beverages. Available items vary by location, but the global menu generally features these popular options:	19.00	11.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781500413/food_delivery/foods/eofkzhjorhrkbptvpzgc.jpg	t	2026-06-14 12:42:07	2026-06-15 05:13:33
7	1	3	Pepsi	Quench your thirst with our refreshing drinks selection. Click here to view all available drinks.	12.00	10.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781437005/food_delivery/foods/lliajmp6irq1yvalp2z1.jpg	t	2026-06-14 11:36:46	2026-06-16 05:34:43
9	2	4	Family Combo	McDonald's offers a wide variety of drinks, including fountain sodas, freshly brewed McCafé coffees, and specialty beverages. Available items vary by location, but the global menu generally features these popular options:	74.00	54.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781500360/food_delivery/foods/rm75j4jkxajmkojewpgj.jpg	t	2026-06-14 12:40:03	2026-06-16 05:31:28
10	2	4	Salad Burger	McDonald's offers a wide variety of drinks, including fountain sodas, freshly brewed McCafé coffees, and specialty beverages. Available items vary by location, but the global menu generally features these popular options:	84.00	56.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781500376/food_delivery/foods/faytlbpdz0vbvz1i8d2u.jpg	t	2026-06-14 12:40:47	2026-06-16 05:31:51
13	2	5	Ice-cream	McDonald's offers a wide variety of drinks, including fountain sodas, freshly brewed McCafé coffees, and specialty beverages. Available items vary by location, but the global menu generally features these popular options:	22.00	18.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781500394/food_delivery/foods/ft7z6v52qv5xvccwqktc.jpg	t	2026-06-14 12:45:05	2026-06-16 05:32:07
15	2	5	Mcflurry	Follow the Android Studio key generation steps. · Run the following command at the command line: On macOS or Linux, use the following command	12.00	8.00	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781500919/food_delivery/foods/crwdp9pm4zlrsjprlcmx.jpg	t	2026-06-15 05:22:00	2026-06-16 05:32:23
\.


--
-- TOC entry 3585 (class 0 OID 16482)
-- Dependencies: 229
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- TOC entry 3584 (class 0 OID 16467)
-- Dependencies: 228
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- TOC entry 3576 (class 0 OID 16399)
-- Dependencies: 220
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2026_06_08_060420_create_personal_access_tokens_table	1
5	2026_06_08_060637_create_riders_table	1
6	2026_06_08_060638_create_restaurants_table	1
7	2026_06_08_060639_create_categories_table	1
8	2026_06_08_060640_create_food_items_table	1
9	2026_06_08_060641_create_orders_table	1
10	2026_06_08_060642_create_order_items_table	1
11	2026_06_08_060643_create_reviews_table	1
12	2026_06_08_060700_create_carts_table	1
13	2026_06_08_060711_add_role_to_users_table	1
14	2026_06_08_104401_add_rider_id_to_orders_table	1
15	2026_06_09_065116_create_addresses_table	1
16	2026_06_15_075636_create_rider_order_declines_table	2
17	2026_06_15_081641_add_fcm_token_to_riders_table	3
\.


--
-- TOC entry 3601 (class 0 OID 16666)
-- Dependencies: 245
-- Data for Name: order_items; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.order_items (id, order_id, food_item_id, quantity, price, total, created_at, updated_at) FROM stdin;
59	18	7	4	10.00	40.00	2026-06-16 07:45:14	2026-06-16 07:45:36
60	19	4	4	48.00	192.00	2026-06-16 07:47:11	2026-06-16 07:47:11
61	20	5	2	31.00	62.00	2026-06-16 08:27:04	2026-06-16 08:27:04
62	21	4	3	48.00	144.00	2026-06-16 08:42:00	2026-06-16 08:42:00
63	22	6	4	28.00	112.00	2026-06-16 12:10:25	2026-06-16 12:10:25
64	23	7	3	10.00	30.00	2026-06-16 12:12:33	2026-06-16 12:12:33
65	24	15	3	8.00	24.00	2026-06-16 13:00:27	2026-06-16 13:00:27
\.


--
-- TOC entry 3599 (class 0 OID 16616)
-- Dependencies: 243
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.orders (id, user_id, restaurant_id, rider_id, order_no, subtotal, delivery_fee, discount, tax, total_amount, payment_method, payment_status, order_status, delivery_address, latitude, longitude, created_at, updated_at, rider_status) FROM stdin;
18	3	1	1	ORD-1781595914-3	40.00	5.00	0.00	0.00	45.00	cash	paid	delivered	ENAA7235، 7235 شارع المـلك فيصـل الغـربـي، 3223، حي المرقاب، Al Jubayl 35514, حي المرقاب, Al Jubayl, Eastern Province, Saudi Arabia	27.00103780	49.64473090	2026-06-16 07:45:14	2026-06-16 12:12:53	delivered
20	3	1	2	ORD-1781598424-3	62.00	5.00	0.00	0.00	67.00	cash	paid	delivered	ENAA7235، 7235 شارع المـلك فيصـل الغـربـي، 3223، حي المرقاب، Al Jubayl 35514, حي المرقاب, Al Jubayl, Eastern Province, Saudi Arabia	27.00103780	49.64473090	2026-06-16 08:27:04	2026-06-16 08:38:46	delivered
19	3	1	2	ORD-1781596031-3	192.00	5.00	0.00	0.00	197.00	cash	paid	delivered	1600 Amphitheatre Pkwy, Mountain View, California, United States	37.42199830	-122.08400000	2026-06-16 07:47:11	2026-06-16 08:39:44	delivered
22	3	1	1	ORD-1781611825-3	112.00	5.00	0.00	0.00	117.00	cash	paid	delivered	ENAA7235، 7235 شارع المـلك فيصـل الغـربـي، 3223، حي المرقاب، Al Jubayl 35514, حي المرقاب, Al Jubayl, Eastern Province, Saudi Arabia	27.00103780	49.64473090	2026-06-16 12:10:25	2026-06-16 12:14:15	delivered
23	3	1	1	ORD-1781611953-3	30.00	5.00	0.00	0.00	35.00	cash	paid	delivered	ENAA7235، 7235 شارع المـلك فيصـل الغـربـي، 3223، حي المرقاب، Al Jubayl 35514, حي المرقاب, Al Jubayl, Eastern Province, Saudi Arabia	27.00103780	49.64473090	2026-06-16 12:12:33	2026-06-16 12:14:39	delivered
21	3	1	2	ORD-1781599320-3	144.00	5.00	0.00	0.00	149.00	cash	paid	delivered	ENAA7235، 7235 شارع المـلك فيصـل الغـربـي، 3223، حي المرقاب، Al Jubayl 35514, حي المرقاب, Al Jubayl, Eastern Province, Saudi Arabia	27.00103780	49.64473090	2026-06-16 08:42:00	2026-06-16 08:44:12	delivered
24	3	2	3	ORD-1781614827-3	24.00	5.00	0.00	0.00	29.00	cash	pending	picked_up	2G7H+Q9R, Industrial Area, Al Jubail, Eastern Province, Saudi Arabia	27.01429370	49.52829090	2026-06-16 13:00:27	2026-06-16 13:03:08	on_the_way
\.


--
-- TOC entry 3579 (class 0 OID 16423)
-- Dependencies: 223
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- TOC entry 3589 (class 0 OID 16516)
-- Dependencies: 233
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
1	App\\Models\\User	2	mobile-app-token	5168126bd75a683d09c36d586553808e690f07e87298ad5a7c672f35f56f9a8b	["*"]	\N	\N	2026-06-11 12:44:08	2026-06-11 12:44:08
2	App\\Models\\User	3	mobile-app-token	12e7e6f234b500db9067ce469a7139188125ff69d832de5a445a179b835a7eaf	["*"]	\N	\N	2026-06-11 12:45:12	2026-06-11 12:45:12
3	App\\Models\\User	3	mobile-app-token	782b8b00f6ab1ab05d944b3c72e59b95f069c89658b680a2cfce0eaeb0fbdf76	["*"]	\N	\N	2026-06-11 12:48:37	2026-06-11 12:48:37
7	App\\Models\\User	3	mobile-app-token	e6d973d7b8b36e95d62fc71cb5dfddf0dc190e6d3b8a2e8fff0131fd4d59714a	["*"]	2026-06-15 10:47:52	\N	2026-06-14 13:37:41	2026-06-15 10:47:52
21	App\\Models\\User	14	rider-token	9a2377ff828ca2ed694edea952936724fe04a7c91d9230c0beca58ad871835ba	["*"]	2026-06-15 10:19:29	\N	2026-06-15 10:06:25	2026-06-15 10:19:29
25	App\\Models\\User	13	rider-token	e288fe50d2d01ba41ce7e13d587e42034823cc02945bd4d4c16ae0c33cb625aa	["*"]	2026-06-15 10:50:33	\N	2026-06-15 10:50:31	2026-06-15 10:50:33
36	App\\Models\\User	13	rider-token	1b88ed97b6f541e795d8039e2e1d8231bd1b02705d80fa8a92aac3257de059b7	["*"]	2026-06-15 12:31:52	\N	2026-06-15 12:09:47	2026-06-15 12:31:52
20	App\\Models\\User	13	rider-token	044fa9290803a4c1988424f436bfe3fad8c00f4cf8f9427635561767a8f37dec	["*"]	2026-06-15 10:05:53	\N	2026-06-15 10:05:17	2026-06-15 10:05:53
8	App\\Models\\User	3	mobile-app-token	50bc9c477215c193ad3fd8cf7211e5f6e21623060eed6605b7d1ab6fa66eecbf	["*"]	2026-06-15 03:32:17	\N	2026-06-14 14:50:12	2026-06-15 03:32:17
29	App\\Models\\User	14	rider-token	672bf11c27b8bc97d1b1a074ec2d2d29df234c8aee7df373b9b430f926e73796	["*"]	2026-06-15 11:08:05	\N	2026-06-15 11:07:22	2026-06-15 11:08:05
23	App\\Models\\User	14	rider-token	7ce38126fdb02bf7d9af7769486ce0a64b3a780e866c2f29936e4a51eca9fdc3	["*"]	2026-06-15 10:49:25	\N	2026-06-15 10:21:46	2026-06-15 10:49:25
16	App\\Models\\User	16	rider-token	2c1bb40605249a4edb9ce3b100d9ee20693435334415bdc6c3a6bd2b1bc8d92b	["*"]	2026-06-15 08:50:03	\N	2026-06-15 08:46:13	2026-06-15 08:50:03
12	App\\Models\\User	15	rider-token	11d5f10e3288285a62474d844f36fd50510017d3bb4347ad56711d88074b79cb	["*"]	2026-06-15 07:22:23	\N	2026-06-15 07:14:17	2026-06-15 07:22:23
11	App\\Models\\User	14	rider-token	9689659da1ee973902bbcc75d318f3c1ba7f1a0c144a846676d1c7e54d6e512c	["*"]	2026-06-15 07:11:20	\N	2026-06-15 06:28:34	2026-06-15 07:11:20
28	App\\Models\\User	15	rider-token	830fc25b3250199f2ae8fe9b72a63cac05d6a7581140e4455aaea79d64e5ba8f	["*"]	2026-06-15 11:07:00	\N	2026-06-15 11:06:41	2026-06-15 11:07:00
4	App\\Models\\User	3	mobile-app-token	7fce2b2e017757eb34dd6ee282452506b948c616de1da7b28bcc633312e9f008	["*"]	2026-06-14 11:41:11	\N	2026-06-11 12:50:50	2026-06-14 11:41:11
5	App\\Models\\User	4	mobile-app-token	da9560e4fe41e64f5af712c8496e875395bce6ddd686725d5a43861cd59605dc	["*"]	\N	\N	2026-06-14 11:47:23	2026-06-14 11:47:23
6	App\\Models\\User	3	mobile-app-token	38b471999ca01df7070a50fdd51b67e845e5cd3a79a293ba29cc231f8cfa7332	["*"]	2026-06-14 12:27:06	\N	2026-06-14 12:25:47	2026-06-14 12:27:06
22	App\\Models\\User	15	rider-token	e82d1458be91f900cc6ae1b1217453260f1be8dc8f143786612890e70e0dfdc0	["*"]	2026-06-15 10:21:23	\N	2026-06-15 10:19:57	2026-06-15 10:21:23
9	App\\Models\\User	13	rider-token	2f359be2837358e64ce6e7eff1a00b57bd87c1fe9c11480143b025a6df5dfcdb	["*"]	\N	\N	2026-06-15 06:04:38	2026-06-15 06:04:38
17	App\\Models\\User	16	rider-token	13487da29c3aa7b11db4ccf7f75936955c3d59e0bf6b68cc8bd804a0bfa7a350	["*"]	2026-06-15 09:07:18	\N	2026-06-15 09:07:02	2026-06-15 09:07:18
13	App\\Models\\User	14	rider-token	c80d0b9eebf86882a0b2bff0ea5ed8175d96a21c6a7b7064c4a54d863cca5166	["*"]	2026-06-15 07:42:38	\N	2026-06-15 07:22:45	2026-06-15 07:42:38
32	App\\Models\\User	17	mobile-app-token	4c3eb5615ebcc1dedd561663ca7b0d64cbe74d978dd8cfee0806848f9a8a09c8	["*"]	2026-06-15 12:14:54	\N	2026-06-15 11:17:04	2026-06-15 12:14:54
18	App\\Models\\User	14	rider-token	d5d82fea984019234dfc67fc54b1a5c41d91ee112c82add099d19388ef658a26	["*"]	2026-06-15 09:59:45	\N	2026-06-15 09:59:19	2026-06-15 09:59:45
10	App\\Models\\User	14	rider-token	722a99b59b85a2ae7c0acd28a5eab295c2875fb08d9a314465c374584487c84a	["*"]	2026-06-15 06:16:42	\N	2026-06-15 06:07:30	2026-06-15 06:16:42
14	App\\Models\\User	14	rider-token	f572c936c7b5e3ac67b964d088758d38aaa36cf802f276196b08fe28286a4c01	["*"]	2026-06-15 07:43:18	\N	2026-06-15 07:43:02	2026-06-15 07:43:18
26	App\\Models\\User	14	rider-token	9a2db7ada77afe2facbc413769f06cce65504a19d942e99026346db0c585ac5c	["*"]	2026-06-15 11:05:37	\N	2026-06-15 10:51:19	2026-06-15 11:05:37
15	App\\Models\\User	14	rider-token	cd9bdd98a6ea0c8985826d5f3440c5463f7f686423b98984ba53e4ae0a82bab7	["*"]	2026-06-15 08:44:17	\N	2026-06-15 08:44:15	2026-06-15 08:44:17
19	App\\Models\\User	13	rider-token	bd7b82371f03777adf5e42f7fb404632823f3bac37088778293452becb940fd7	["*"]	2026-06-15 10:02:08	\N	2026-06-15 10:02:05	2026-06-15 10:02:08
27	App\\Models\\User	14	rider-token	5e5167a60ce677246fad0d5bf871c2d832cd953be70d3e6229f3ad91fed454b8	["*"]	2026-06-15 11:06:00	\N	2026-06-15 11:05:58	2026-06-15 11:06:00
24	App\\Models\\User	15	rider-token	9f49b7207ed5ba5b6c4cbf1eca0e6296c752a64a09ad98866d023f5271387899	["*"]	2026-06-15 10:50:12	\N	2026-06-15 10:49:44	2026-06-15 10:50:12
34	App\\Models\\User	15	rider-token	ba77dbb474fd22a25d0a1fb7123906ab95ad42dcb0a745b20e18dbf23e4005e8	["*"]	2026-06-15 11:53:32	\N	2026-06-15 11:52:59	2026-06-15 11:53:32
31	App\\Models\\User	17	mobile-app-token	fe65fbb59e815904b5e62d27908e7dbc2c43afeb54309a042eabed860c392dd7	["*"]	\N	\N	2026-06-15 11:16:54	2026-06-15 11:16:54
44	App\\Models\\User	16	rider-token	0cdc5a946d37e61a66ab8f73b4624655932ccce1261b9a978422a4afe7102407	["*"]	2026-06-16 06:39:21	\N	2026-06-16 06:33:27	2026-06-16 06:39:21
30	App\\Models\\User	15	rider-token	fd8c7b6287325cf81c1eaf39603c10ac20c1bebd6d26b69c7c5fe9513c9e2e6a	["*"]	2026-06-15 11:18:09	\N	2026-06-15 11:08:23	2026-06-15 11:18:09
41	App\\Models\\User	19	mobile-app-token	7cff67d4f08fed7d96be13520857be44587c6754cc06834f84fe0b012bb1610c	["*"]	2026-06-16 05:40:47	\N	2026-06-16 05:40:27	2026-06-16 05:40:47
33	App\\Models\\User	14	rider-token	6c8a90f4108611ea88a40af4ea3583f08b95071e7c1ce3a3e6aa05a71bd01c70	["*"]	2026-06-15 11:19:39	\N	2026-06-15 11:19:21	2026-06-15 11:19:39
35	App\\Models\\User	15	rider-token	a2d414a99297817ee10e508008c2119241f4b957dff14272c81c548463a468c4	["*"]	2026-06-15 12:06:14	\N	2026-06-15 12:03:19	2026-06-15 12:06:14
42	App\\Models\\User	16	rider-token	8ace791bba5522042de555209dca0157dd50b43b55a5bf024182cdddec0ee786	["*"]	2026-06-16 06:22:48	\N	2026-06-16 06:22:45	2026-06-16 06:22:48
38	App\\Models\\User	3	mobile-app-token	f3dfca4eecbd754e340cb59b8396f39ca76fc0ba7e6f6dcedf0e41a3beb147ec	["*"]	\N	\N	2026-06-16 05:37:33	2026-06-16 05:37:33
39	App\\Models\\User	18	mobile-app-token	da56bb2b4a1a571a8d309372ee74d6c71b4d491b52bc168d8f378d4839eaa4e1	["*"]	\N	\N	2026-06-16 05:38:41	2026-06-16 05:38:41
40	App\\Models\\User	19	mobile-app-token	ab54dad7152610882626ca6faf1f973621c7d095d575f6af4611f1534e8584d3	["*"]	\N	\N	2026-06-16 05:40:09	2026-06-16 05:40:09
43	App\\Models\\User	16	rider-token	f9c2af9cb0c7de17b57a2aedc6fd2fa16df57f52a9ec6b30002b8201b73e97ec	["*"]	2026-06-16 06:27:44	\N	2026-06-16 06:24:08	2026-06-16 06:27:44
45	App\\Models\\User	16	rider-token	a911914c06742e3ae4731c9496786969e7d627d79ab8cefc1567bf155ebf5ac1	["*"]	2026-06-16 06:40:06	\N	2026-06-16 06:39:51	2026-06-16 06:40:06
56	App\\Models\\User	13	rider-token	f6ef48ce352081a85da27e744fadd8a7cfc0c18e058a4e1b2cbd7d8f1af55ad4	["*"]	2026-06-16 13:02:01	\N	2026-06-16 13:01:37	2026-06-16 13:02:01
50	App\\Models\\User	15	rider-token	0d6853a82dcd3fb5f30b3ef601e1d428e8310f0b0e8e52e0486652c280fd9baa	["*"]	2026-06-16 07:45:55	\N	2026-06-16 07:43:57	2026-06-16 07:45:55
52	App\\Models\\User	13	rider-token	13a6c04b7f98346bd199842554054bd75001f830373bce9eb4926aca4037df74	["*"]	2026-06-16 08:00:19	\N	2026-06-16 07:46:47	2026-06-16 08:00:19
46	App\\Models\\User	15	rider-token	6092a9e7052ba59607b422a65e80242e2c9433dab76826d98ad12fa26c5d25d5	["*"]	2026-06-16 06:40:57	\N	2026-06-16 06:40:31	2026-06-16 06:40:57
51	App\\Models\\User	14	rider-token	03c23bab1109749c809bdf8084ad0bb15e89bd4565484f4f09fe4ea57b1734dc	["*"]	2026-06-16 07:46:26	\N	2026-06-16 07:46:14	2026-06-16 07:46:26
47	App\\Models\\User	14	rider-token	7bb302f775b6685cf36ae798e2901e731c0c56073c5e84235895d0b97736cd7b	["*"]	2026-06-16 06:41:22	\N	2026-06-16 06:41:20	2026-06-16 06:41:22
48	App\\Models\\User	16	rider-token	8a4d99c19ecc72528695082befa9ec4de759aa7a396cf38b3a390fb4444c1686	["*"]	2026-06-16 07:05:42	\N	2026-06-16 06:41:59	2026-06-16 07:05:42
49	App\\Models\\User	13	rider-token	3e976042bbe6c7e71fd00843e70d02da20c964bfe029be809f59f4aa15bc2cc2	["*"]	2026-06-16 07:33:45	\N	2026-06-16 07:33:43	2026-06-16 07:33:45
58	App\\Models\\User	15	rider-token	30e935ca44495c973944bffd3af5a84197a2a696ca459c9b3e8e4555ec1538b1	["*"]	2026-06-16 13:03:38	\N	2026-06-16 13:02:48	2026-06-16 13:03:38
53	App\\Models\\User	13	rider-token	9ed31091ace3831e9ccef69b161ce9461b87dbe35b282d7eeafa634a36c0815b	["*"]	2026-06-16 08:44:31	\N	2026-06-16 08:11:14	2026-06-16 08:44:31
57	App\\Models\\User	14	rider-token	deb64f08b9eaa15e6d9fd1818d35cd8b48dc0de6d737c6050cf7cc2be8672d97	["*"]	2026-06-16 13:02:33	\N	2026-06-16 13:02:16	2026-06-16 13:02:33
54	App\\Models\\User	13	rider-token	aa0ddb3e24c73f35e9d676cf2a58e5b47bc2df90945122414a982a7a325ba569	["*"]	2026-06-16 12:08:43	\N	2026-06-16 12:08:32	2026-06-16 12:08:43
55	App\\Models\\User	14	rider-token	3a002d6ea5bc1a4acb39a42a0a1cdaa38cf6e373963340f13dacf3f30a8f5208	["*"]	2026-06-16 12:15:06	\N	2026-06-16 12:09:13	2026-06-16 12:15:06
37	App\\Models\\User	3	mobile-app-token	057a68733e8d1b6d62cd2e5fb1f607e59852cf4a14bc91cfb730449ad8f6eb06	["*"]	2026-06-16 13:00:27	\N	2026-06-15 12:16:18	2026-06-16 13:00:27
\.


--
-- TOC entry 3593 (class 0 OID 16552)
-- Dependencies: 237
-- Data for Name: restaurants; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.restaurants (id, user_id, name, description, logo, cover_image, phone, address, latitude, longitude, is_active, created_at, updated_at) FROM stdin;
2	5	McDonalds	Cloudinary Onboarding Prompt\r\n\r\nHere are my Cloudinary credentials:\r\nCloud Name: dgwlw0cnh\r\nAPI Key: 745452531365543\r\nAPI Secret: ID3NOzXfhCG-8xEZZM4JRhtorG0\r\n\r\nYou are helping a first-time Cloudinary user who already has an account set up their integration from scratch. Follow these rules:\r\n\r\n1. Start by asking: "What programming language are you using?" Wait for the answer before proceeding.\r\n\r\n2. Follow the steps below in order - complete each step fully before moving to the next.\r\n\r\n3. Wait for user responses - When you ask a question, stop and wait for their answer. Do not proceed until you get a response.\r\n\r\n4. Execute commands - When there is a command to run, show it and run it immediately after showing it.\r\n\r\n5. Recover first, then stop if needed (strict) - On command failure: retry once, then try one corrected variant once. If still failing, STOP and wait for user confirmation. Do not continue and do not assume success.\r\n\r\n6. Manual-run handoff (strict) - If you cannot run a command, ask the user to run exactly one command, then STOP and wait for confirmation. Full output is optional.\r\n\r\n7. No progress without confirmation - After a failure or manual-run handoff, do not proceed until the user provides explicit confirmation.\r\n\r\n8. One question at a time - If you need to ask something, ask only one question and wait.\r\n\r\n9. Step-by-step explanation - Do not explain the whole plan upfront. Explain each step briefly as you work through it, without meta disclaimers.\r\n\r\n10. Actual results only (strict) - Never provide expected, sample, or hypothetical command output when a step requires execution results. Only report real output produced by commands that were actually run (by the agent or by the user during manual handoff). If real output is unavailable and the user confirms to continue, continue without fabricating output.\r\n\r\n11. Instruction priority and compliance check (strict) - The rules in this first section are mandatory for every later step. Priority order is: user message > step-specific rule > global rule. Before writing any analysis, verify you followed execution instructions and have real command output when required. If not, go back, execute, and collect output first.\r\n\r\n12. Do not open transformed URLs (strict) - The transformed image URL is for the user to open manually. Never open or navigate to it.\r\n\r\nSTEP 1 — Install the Cloudinary SDK\r\n\r\nShow the exact install command for the user's language and run it. Do not explain the package manager in detail. Mention the command and execute it. If install fails, STOP and wait for user confirmation before doing anything else.\r\n\r\nSTEP 2 — Credentials\r\n\r\nThe user will need three values from Cloudinary:\r\n- Cloud name\r\n- API key\r\n- API secret\r\n\r\nTell the user to get these from: https://console.cloudinary.com/app/settings/api-keys\r\n\r\nAsk the user to provide these three values and store them for use in the script. Do not move to the next step until you have collected all three credential values from the user.\r\n\r\nSTEP 3 — Write the script\r\n\r\nCreate a single script file in the user's chosen language that does all of the following in sequence:\r\n\r\n1. Configure Cloudinary — Use an inline configuration block (no separate .env file). For this onboarding flow, inline credentials in the script are required. Use the real credential values collected in Step 2 by default. Use placeholder values only if the user does not want to provide credentials:\r\n   - Cloud name: YOUR_CLOUD_NAME\r\n   - API key: YOUR_API_KEY\r\n   - API secret: YOUR_API_SECRET\r\n\r\n2. Upload an image — Upload a sample image URL from Cloudinary's demo domains (use images from res.cloudinary.com/demo/). Print the secure URL and public ID of the uploaded image to the console.\r\n\r\n3. Get image details — After uploading, fetch and print the following metadata about the uploaded image: width, height, format, and file size in bytes.\r\n\r\n4. Transform the image — Generate a transformed version of the image URL using both f_auto (automatic format selection) and q_auto (automatic quality). Briefly explain in a code comment what each transformation does. Print a final success message to the console, e.g. "Done! Click link below to see optimized version of the image. Check the size and the format." Print the transformed URL for the user to open.\r\n\r\nSTEP 4 — Make the script executable\r\n\r\nShow the chmod command to make the script executable and run it. Then run the script itself. If either command fails or cannot be run by the agent, ask the user to run that one command and STOP and wait for user confirmation before continuing.\r\n\r\nSTEP 5 — Review the results\r\n\r\nAfter the script runs, show the complete actual output and provide commentary on what happened. Explain what each part of that real output means and confirm that the Cloudinary integration is working correctly. Point out the key information like the uploaded image URL, the metadata, and the transformed image link. Ask the user to check transformed-image size/format by opening the transformed URL.\r\n\r\nIf the script was not executed successfully, do not provide a "what you can expect" section and do not fabricate output. Briefly state what is missing and strongly suggest the user paste the script output for a detailed explanation.\r\n\r\nFor this step, follow this exact gate:\r\n1. Verify whether script output is available in this session.\r\n2. If output is available, explain results and tie the explanation to the actual output shown.\r\n3. If output is unavailable, finish Step 5 without blocking and strongly suggest the user paste output for detailed explanation.\r\n4. The transformed-image size/format check is a user follow-up after opening the transformed URL.\r\n\r\nFORMATTING RULES FOR THE SCRIPT:\r\n\r\n- The entire flow must be in one file.\r\n- If placeholders are used, clearly mark the three placeholder values (YOUR_CLOUD_NAME, YOUR_API_KEY, YOUR_API_SECRET) with a comment like "← replace this" so the user can find them instantly.\r\n- The script must work by running it directly — no extra setup steps required beyond installing the SDK and filling in the credentials.\r\n- Do not use a separate .env file or any environment variable exports outside the script.	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781440377/food_delivery/restaurants/itcrypdk8qa2mow2x2wa.png	\N	0572630756	Industrial Area, Al Jubayl, Al Jubayl Governorate, Eastern Province, 31961, Saudi Arabia	27.01432978	49.52849786	t	2026-06-14 11:54:15	2026-06-15 05:25:44
1	1	KFC	Follow the Android Studio key generation steps. · Run the following command at the command line: On macOS or Linux, use the following command	https://res.cloudinary.com/dgwlw0cnh/image/upload/v1781434599/food_delivery/restaurants/jcvmrgj5wjvwk7rmvmf3.png	\N	123456	Industrial Area, Al Jubayl, Al Jubayl Governorate, Eastern Province, 31961, Saudi Arabia	27.01430285	49.52850796	t	2026-06-11 12:41:41	2026-06-16 08:37:08
\.


--
-- TOC entry 3603 (class 0 OID 16689)
-- Dependencies: 247
-- Data for Name: reviews; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.reviews (id, user_id, restaurant_id, order_id, rating, comment, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3609 (class 0 OID 16765)
-- Dependencies: 253
-- Data for Name: rider_order_declines; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.rider_order_declines (id, order_id, rider_id, created_at, updated_at) FROM stdin;
18	24	2	2026-06-16 13:02:00	2026-06-16 13:02:00
19	24	1	2026-06-16 13:02:28	2026-06-16 13:02:28
\.


--
-- TOC entry 3591 (class 0 OID 16534)
-- Dependencies: 235
-- Data for Name: riders; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.riders (id, user_id, vehicle_type, plate_number, license_no, current_latitude, current_longitude, is_available, created_at, updated_at, fcm_token) FROM stdin;
4	16	Car	DRR3187	sa2345	\N	\N	t	\N	2026-06-16 06:24:09	dYFbBTenR0m0OByIRbQXmZ:APA91bHzAznem9zKMJ9ZUs7BZUViFqbENey3J6uSL7h0aZJLhJ56JLHzxXwF6YG45BTLOdpSrFSlI1kQNB59R61nYVk5RdVVSz0u28RG4ZX-8ZFHSyYDSjA
2	13	Car	ESR4198	sa12345	\N	\N	t	\N	2026-06-16 12:08:36	dyHdSRspST2HLWGFbaMfPB:APA91bGDMBjO_E5ZPsNAQn-DzruRMo2DQw6LxRdF5ZloQQY3Em6630Ac8L57g8Q7dFOOio6L7HvUITi3StDDRuX3fTnDRoQgB1GHpxUr7WtJlqJPg059s3M
1	14	Car	EVJ3549	sar45354	\N	\N	t	\N	2026-06-16 12:09:14	dyHdSRspST2HLWGFbaMfPB:APA91bGDMBjO_E5ZPsNAQn-DzruRMo2DQw6LxRdF5ZloQQY3Em6630Ac8L57g8Q7dFOOio6L7HvUITi3StDDRuX3fTnDRoQgB1GHpxUr7WtJlqJPg059s3M
3	15	Car	DDR3370	sa2345678	\N	\N	t	\N	2026-06-16 13:02:49	dyHdSRspST2HLWGFbaMfPB:APA91bGDMBjO_E5ZPsNAQn-DzruRMo2DQw6LxRdF5ZloQQY3Em6630Ac8L57g8Q7dFOOio6L7HvUITi3StDDRuX3fTnDRoQgB1GHpxUr7WtJlqJPg059s3M
\.


--
-- TOC entry 3580 (class 0 OID 16432)
-- Dependencies: 224
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
\.


--
-- TOC entry 3578 (class 0 OID 16409)
-- Dependencies: 222
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: food_delivery_db_g46a_user
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, phone, role) FROM stdin;
3	Rakib	rakib@test.com	\N	$2y$12$nTozEMJW1LvkYSdeC1LDEuF8S5vIJ5P4Rgc5OITzgLGReEJpRTgPq	\N	2026-06-11 12:45:12	2026-06-11 12:45:12	\N	customer
1	KFC	kfc@test.com	\N	$2y$12$YB9UuoZnZUg3xWzG4oAeZuPaoZ6zFjAQfI0uwXz/QHI3NA.7au5Si	\N	2026-06-11 12:41:41	2026-06-11 12:41:41	123456	restaurant
4	admin	admin@test.com	\N	$2y$12$DfIMSRS9LkAwYYF9dx9BiupGa2F.5TgQoHTFmhIKvp1JZF8ir63Zm	\N	2026-06-14 11:47:23	2026-06-14 11:47:23	123456	admin
5	McDonalds	McD@test.com	\N	$2y$12$k5DMkBu15rQt7Vm8HhRkL.hTzgzyJqps2cgHO.Z5rfj5Ji9ltKurC	\N	2026-06-14 11:54:15	2026-06-14 11:54:15	0572630756	restaurant
13	Test Rider	rider@test.com	\N	$2y$12$sEsvU2CKDyYCt7251/V6FemkKZwfS27Sa7L1MNRe6kxJYkzxXlHgi	\N	2026-06-15 06:04:38	2026-06-15 06:04:38	0500000000	rider
14	Aminur	amin@test.com	\N	$2y$12$UV.I.aXjG5usAdZm46MV1uSS4VkpLgZtAn33Ctlu5H2n9fWxeKy2C	\N	2026-06-15 06:07:30	2026-06-15 06:07:30	123456	rider
15	Remon	remon@test.com	\N	$2y$12$t39szJUPgxCIWN3XoMwTrurmZwbvawAa85VpFmuhorG./6hwvT606	\N	2026-06-15 07:14:17	2026-06-15 07:14:17	123456	rider
16	Torikul	torik@test.com	\N	$2y$12$WiZnEegSDixGeumJwXln9edzKmtPr8CTRWVbWNUc.Eh60dv8LqeJG	\N	2026-06-15 08:46:13	2026-06-15 08:46:13	123456	rider
17	Maram	maram@test.com	\N	$2y$12$sU09O8tqAwwT0Ckp1nw26.CvKsJoBfS8BjXZI8koDOWyFmlHcHzXW	\N	2026-06-15 11:16:54	2026-06-15 11:16:54	123456789	customer
19	abdul	nayem@test.com	\N	$2y$12$54zgQMAoPor6HuIWXYa6lekgMnjop0KEby/M.Vq5GRrXdy2kmjiVG	\N	2026-06-16 05:40:09	2026-06-16 06:47:17	\N	customer
18	abdul	an@test.com	\N	$2y$12$I2wXq9d.vt6DRMPFURr4HeQL6han6nfKKn9YmoiBUYXqQIgxDvE7G	\N	2026-06-16 05:38:41	2026-06-16 06:47:36	\N	customer
\.


--
-- TOC entry 3630 (class 0 OID 0)
-- Dependencies: 250
-- Name: addresses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.addresses_id_seq', 4, true);


--
-- TOC entry 3631 (class 0 OID 0)
-- Dependencies: 248
-- Name: carts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.carts_id_seq', 66, true);


--
-- TOC entry 3632 (class 0 OID 0)
-- Dependencies: 238
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.categories_id_seq', 6, true);


--
-- TOC entry 3633 (class 0 OID 0)
-- Dependencies: 230
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- TOC entry 3634 (class 0 OID 0)
-- Dependencies: 240
-- Name: food_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.food_items_id_seq', 15, true);


--
-- TOC entry 3635 (class 0 OID 0)
-- Dependencies: 227
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- TOC entry 3636 (class 0 OID 0)
-- Dependencies: 219
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.migrations_id_seq', 17, true);


--
-- TOC entry 3637 (class 0 OID 0)
-- Dependencies: 244
-- Name: order_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.order_items_id_seq', 65, true);


--
-- TOC entry 3638 (class 0 OID 0)
-- Dependencies: 242
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.orders_id_seq', 24, true);


--
-- TOC entry 3639 (class 0 OID 0)
-- Dependencies: 232
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 58, true);


--
-- TOC entry 3640 (class 0 OID 0)
-- Dependencies: 236
-- Name: restaurants_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.restaurants_id_seq', 2, true);


--
-- TOC entry 3641 (class 0 OID 0)
-- Dependencies: 246
-- Name: reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.reviews_id_seq', 1, false);


--
-- TOC entry 3642 (class 0 OID 0)
-- Dependencies: 252
-- Name: rider_order_declines_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.rider_order_declines_id_seq', 19, true);


--
-- TOC entry 3643 (class 0 OID 0)
-- Dependencies: 234
-- Name: riders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.riders_id_seq', 1, true);


--
-- TOC entry 3644 (class 0 OID 0)
-- Dependencies: 221
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: food_delivery_db_g46a_user
--

SELECT pg_catalog.setval('public.users_id_seq', 19, true);


--
-- TOC entry 3405 (class 2606 OID 16756)
-- Name: addresses addresses_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.addresses
    ADD CONSTRAINT addresses_pkey PRIMARY KEY (id);


--
-- TOC entry 3370 (class 2606 OID 16464)
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- TOC entry 3367 (class 2606 OID 16453)
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- TOC entry 3403 (class 2606 OID 16728)
-- Name: carts carts_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.carts
    ADD CONSTRAINT carts_pkey PRIMARY KEY (id);


--
-- TOC entry 3391 (class 2606 OID 16583)
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- TOC entry 3377 (class 2606 OID 16512)
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3379 (class 2606 OID 16514)
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- TOC entry 3393 (class 2606 OID 16604)
-- Name: food_items food_items_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.food_items
    ADD CONSTRAINT food_items_pkey PRIMARY KEY (id);


--
-- TOC entry 3375 (class 2606 OID 16495)
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- TOC entry 3372 (class 2606 OID 16480)
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3354 (class 2606 OID 16407)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 3399 (class 2606 OID 16677)
-- Name: order_items order_items_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_pkey PRIMARY KEY (id);


--
-- TOC entry 3395 (class 2606 OID 16664)
-- Name: orders orders_order_no_unique; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_order_no_unique UNIQUE (order_no);


--
-- TOC entry 3397 (class 2606 OID 16647)
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- TOC entry 3360 (class 2606 OID 16431)
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- TOC entry 3382 (class 2606 OID 16528)
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- TOC entry 3384 (class 2606 OID 16531)
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- TOC entry 3389 (class 2606 OID 16566)
-- Name: restaurants restaurants_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.restaurants
    ADD CONSTRAINT restaurants_pkey PRIMARY KEY (id);


--
-- TOC entry 3401 (class 2606 OID 16700)
-- Name: reviews reviews_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_pkey PRIMARY KEY (id);


--
-- TOC entry 3407 (class 2606 OID 16785)
-- Name: rider_order_declines rider_order_declines_order_id_rider_id_unique; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.rider_order_declines
    ADD CONSTRAINT rider_order_declines_order_id_rider_id_unique UNIQUE (order_id, rider_id);


--
-- TOC entry 3409 (class 2606 OID 16773)
-- Name: rider_order_declines rider_order_declines_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.rider_order_declines
    ADD CONSTRAINT rider_order_declines_pkey PRIMARY KEY (id);


--
-- TOC entry 3387 (class 2606 OID 16545)
-- Name: riders riders_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.riders
    ADD CONSTRAINT riders_pkey PRIMARY KEY (id);


--
-- TOC entry 3363 (class 2606 OID 16441)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 3356 (class 2606 OID 16422)
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- TOC entry 3358 (class 2606 OID 16420)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3365 (class 1259 OID 16454)
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- TOC entry 3368 (class 1259 OID 16465)
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- TOC entry 3373 (class 1259 OID 16481)
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- TOC entry 3380 (class 1259 OID 16532)
-- Name: personal_access_tokens_expires_at_index; Type: INDEX; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE INDEX personal_access_tokens_expires_at_index ON public.personal_access_tokens USING btree (expires_at);


--
-- TOC entry 3385 (class 1259 OID 16529)
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- TOC entry 3361 (class 1259 OID 16443)
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- TOC entry 3364 (class 1259 OID 16442)
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: food_delivery_db_g46a_user
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- TOC entry 3425 (class 2606 OID 16757)
-- Name: addresses addresses_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.addresses
    ADD CONSTRAINT addresses_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3423 (class 2606 OID 16734)
-- Name: carts carts_food_item_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.carts
    ADD CONSTRAINT carts_food_item_id_foreign FOREIGN KEY (food_item_id) REFERENCES public.food_items(id) ON DELETE CASCADE;


--
-- TOC entry 3424 (class 2606 OID 16729)
-- Name: carts carts_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.carts
    ADD CONSTRAINT carts_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3412 (class 2606 OID 16584)
-- Name: categories categories_restaurant_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_restaurant_id_foreign FOREIGN KEY (restaurant_id) REFERENCES public.restaurants(id) ON DELETE CASCADE;


--
-- TOC entry 3413 (class 2606 OID 16610)
-- Name: food_items food_items_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.food_items
    ADD CONSTRAINT food_items_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- TOC entry 3414 (class 2606 OID 16605)
-- Name: food_items food_items_restaurant_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.food_items
    ADD CONSTRAINT food_items_restaurant_id_foreign FOREIGN KEY (restaurant_id) REFERENCES public.restaurants(id) ON DELETE CASCADE;


--
-- TOC entry 3418 (class 2606 OID 16683)
-- Name: order_items order_items_food_item_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_food_item_id_foreign FOREIGN KEY (food_item_id) REFERENCES public.food_items(id) ON DELETE CASCADE;


--
-- TOC entry 3419 (class 2606 OID 16678)
-- Name: order_items order_items_order_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_order_id_foreign FOREIGN KEY (order_id) REFERENCES public.orders(id) ON DELETE CASCADE;


--
-- TOC entry 3415 (class 2606 OID 16653)
-- Name: orders orders_restaurant_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_restaurant_id_foreign FOREIGN KEY (restaurant_id) REFERENCES public.restaurants(id) ON DELETE CASCADE;


--
-- TOC entry 3416 (class 2606 OID 16658)
-- Name: orders orders_rider_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_rider_id_foreign FOREIGN KEY (rider_id) REFERENCES public.riders(id) ON DELETE SET NULL;


--
-- TOC entry 3417 (class 2606 OID 16648)
-- Name: orders orders_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3411 (class 2606 OID 16567)
-- Name: restaurants restaurants_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.restaurants
    ADD CONSTRAINT restaurants_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3420 (class 2606 OID 16711)
-- Name: reviews reviews_order_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_order_id_foreign FOREIGN KEY (order_id) REFERENCES public.orders(id) ON DELETE SET NULL;


--
-- TOC entry 3421 (class 2606 OID 16706)
-- Name: reviews reviews_restaurant_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_restaurant_id_foreign FOREIGN KEY (restaurant_id) REFERENCES public.restaurants(id) ON DELETE CASCADE;


--
-- TOC entry 3422 (class 2606 OID 16701)
-- Name: reviews reviews_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3426 (class 2606 OID 16774)
-- Name: rider_order_declines rider_order_declines_order_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.rider_order_declines
    ADD CONSTRAINT rider_order_declines_order_id_foreign FOREIGN KEY (order_id) REFERENCES public.orders(id) ON DELETE CASCADE;


--
-- TOC entry 3427 (class 2606 OID 16779)
-- Name: rider_order_declines rider_order_declines_rider_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.rider_order_declines
    ADD CONSTRAINT rider_order_declines_rider_id_foreign FOREIGN KEY (rider_id) REFERENCES public.riders(id) ON DELETE CASCADE;


--
-- TOC entry 3410 (class 2606 OID 16546)
-- Name: riders riders_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: food_delivery_db_g46a_user
--

ALTER TABLE ONLY public.riders
    ADD CONSTRAINT riders_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 2143 (class 826 OID 16391)
-- Name: DEFAULT PRIVILEGES FOR SEQUENCES; Type: DEFAULT ACL; Schema: -; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON SEQUENCES TO food_delivery_db_g46a_user;


--
-- TOC entry 2145 (class 826 OID 16393)
-- Name: DEFAULT PRIVILEGES FOR TYPES; Type: DEFAULT ACL; Schema: -; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON TYPES TO food_delivery_db_g46a_user;


--
-- TOC entry 2144 (class 826 OID 16392)
-- Name: DEFAULT PRIVILEGES FOR FUNCTIONS; Type: DEFAULT ACL; Schema: -; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON FUNCTIONS TO food_delivery_db_g46a_user;


--
-- TOC entry 2142 (class 826 OID 16390)
-- Name: DEFAULT PRIVILEGES FOR TABLES; Type: DEFAULT ACL; Schema: -; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON TABLES TO food_delivery_db_g46a_user;


-- Completed on 2026-06-22 14:40:46

--
-- PostgreSQL database dump complete
--

\unrestrict dTEWuAoJ5kKYpeY8KDQU1IciSsZn3Yqbp101tir9xef4hAw8tcElzjMU0vIwr1g

