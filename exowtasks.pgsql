--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cache; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO happiness;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO happiness;

--
-- Name: equipes; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.equipes (
    id bigint NOT NULL,
    name character varying(100) NOT NULL,
    slug character varying(120) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.equipes OWNER TO happiness;

--
-- Name: equipes_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.equipes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.equipes_id_seq OWNER TO happiness;

--
-- Name: equipes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.equipes_id_seq OWNED BY public.equipes.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: happiness
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


ALTER TABLE public.failed_jobs OWNER TO happiness;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO happiness;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: happiness
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


ALTER TABLE public.job_batches OWNER TO happiness;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: happiness
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


ALTER TABLE public.jobs OWNER TO happiness;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO happiness;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: membre_taches; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.membre_taches (
    id bigint NOT NULL,
    task_id bigint NOT NULL,
    member_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.membre_taches OWNER TO happiness;

--
-- Name: membre_taches_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.membre_taches_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.membre_taches_id_seq OWNER TO happiness;

--
-- Name: membre_taches_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.membre_taches_id_seq OWNED BY public.membre_taches.id;


--
-- Name: membres; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.membres (
    id bigint NOT NULL,
    first_name character varying(50) NOT NULL,
    last_name character varying(50) NOT NULL,
    email character varying(255) NOT NULL,
    role character varying(255) NOT NULL,
    team_id bigint NOT NULL,
    joined_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    CONSTRAINT membres_role_check CHECK (((role)::text = ANY ((ARRAY['manager'::character varying, 'developer'::character varying, 'designer'::character varying, 'tester'::character varying])::text[])))
);


ALTER TABLE public.membres OWNER TO happiness;

--
-- Name: membres_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.membres_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.membres_id_seq OWNER TO happiness;

--
-- Name: membres_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.membres_id_seq OWNED BY public.membres.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO happiness;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO happiness;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO happiness;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: happiness
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


ALTER TABLE public.personal_access_tokens OWNER TO happiness;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO happiness;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO happiness;

--
-- Name: taches; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.taches (
    id bigint NOT NULL,
    title character varying(200) NOT NULL,
    description text,
    due_date timestamp(0) without time zone NOT NULL,
    status character varying(255) DEFAULT 'todo'::character varying NOT NULL,
    created_by bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT taches_status_check CHECK (((status)::text = ANY ((ARRAY['todo'::character varying, 'in_progress'::character varying, 'done'::character varying])::text[])))
);


ALTER TABLE public.taches OWNER TO happiness;

--
-- Name: taches_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.taches_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.taches_id_seq OWNER TO happiness;

--
-- Name: taches_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.taches_id_seq OWNED BY public.taches.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: happiness
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO happiness;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: happiness
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO happiness;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: happiness
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: equipes id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.equipes ALTER COLUMN id SET DEFAULT nextval('public.equipes_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: membre_taches id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membre_taches ALTER COLUMN id SET DEFAULT nextval('public.membre_taches_id_seq'::regclass);


--
-- Name: membres id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membres ALTER COLUMN id SET DEFAULT nextval('public.membres_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: taches id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.taches ALTER COLUMN id SET DEFAULT nextval('public.taches_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: equipes; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.equipes (id, name, slug, created_at, updated_at) FROM stdin;
1	Equipe A	equipe-a	2025-07-15 21:42:15	2025-07-15 21:42:15
2	Equipe H	equipe-h	2025-07-15 21:42:15	2025-07-15 21:42:15
4	Mon équipe	mon-equipe	2025-07-16 11:01:09	2025-07-16 11:01:09
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: membre_taches; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.membre_taches (id, task_id, member_id, created_at, updated_at) FROM stdin;
1	1	6	2025-07-15 21:42:19	2025-07-15 21:42:19
2	2	4	2025-07-15 21:42:19	2025-07-15 21:42:19
3	3	5	2025-07-15 21:42:19	2025-07-15 21:42:19
4	4	5	2025-07-15 21:42:19	2025-07-15 21:42:19
5	5	3	2025-07-15 21:42:19	2025-07-15 21:42:19
6	6	5	2025-07-15 21:42:19	2025-07-15 21:42:19
7	7	6	2025-07-15 21:42:19	2025-07-15 21:42:19
8	8	5	2025-07-15 21:42:19	2025-07-15 21:42:19
9	9	3	2025-07-15 21:42:19	2025-07-15 21:42:19
10	9	4	2025-07-15 21:42:19	2025-07-15 21:42:19
11	10	8	2025-07-15 21:42:19	2025-07-15 21:42:19
12	11	7	2025-07-15 21:42:19	2025-07-15 21:42:19
13	12	8	2025-07-15 21:42:19	2025-07-15 21:42:19
14	13	8	2025-07-15 21:42:19	2025-07-15 21:42:19
15	14	7	2025-07-15 21:42:19	2025-07-15 21:42:19
\.


--
-- Data for Name: membres; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.membres (id, first_name, last_name, email, role, team_id, joined_at, created_at, updated_at, email_verified_at, password, remember_token) FROM stdin;
2	Grâce	Tchokponhoué	grace.tchokponhoue@yahoo.fr	manager	2	2025-06-15 18:02:12	2025-07-15 21:42:16	2025-07-15 21:42:16	\N	$2y$12$BEja/1A15hSAmMOEMyK3u./lkTgzhmWs2k8C.fPoGeE0LIe8Qgb7O	\N
3	Ulrich	Sogbossi	ulrich.sogbossi@yahoo.fr	developer	1	2024-10-08 21:15:24	2025-07-15 21:42:17	2025-07-15 21:42:17	\N	$2y$12$EJIa7kwUW9Ls24ji76PD2.3RjJThjy/FojH8NO3ILTgkwzUpas3EC	\N
4	Christelle	Houndété	christelle.houndete@gmail.com	developer	1	2025-02-14 11:13:33	2025-07-15 21:42:17	2025-07-15 21:42:17	\N	$2y$12$MmJeg66nCv3vlC76mOVVfe7qARqhng9JQIgIqNT440gu/dcr.Srg2	\N
5	Landry	Gnonlonfoun	landry.gnonlonfoun@yahoo.fr	designer	1	2025-01-28 15:24:08	2025-07-15 21:42:17	2025-07-15 21:42:17	\N	$2y$12$E9IiLVRTRUR3MczZVqCqs.h3wcNO/RqEfN.AnX12BnoAvoHGU1ABS	\N
6	Prisca	Kpochémè	prisca.kpocheme@gmail.com	developer	1	2025-03-20 18:27:02	2025-07-15 21:42:18	2025-07-15 21:42:18	\N	$2y$12$dNVzANYaMQ6atSHQHaL/H.pY40sO5YWl5U1wa4aLEZWMfx1pdhs.y	\N
7	Germain	Ahissou	germain.ahissou@gmail.com	designer	2	2024-11-25 17:19:12	2025-07-15 21:42:18	2025-07-15 21:42:18	\N	$2y$12$AroS3Wv8YHZxBsV2F3P.0.nSCSeKQ9DJKImiuQHpCrm3OhxmyT4aG	\N
8	Éric	Dossou	eric.dossou@gmail.com	designer	2	2025-01-03 23:28:54	2025-07-15 21:42:18	2025-07-15 21:42:18	\N	$2y$12$QDQ0WQ5rxlamWBsU8Wgno.htuDZDRJkN3l3xnZAS3oVM0.JdaHv6G	\N
1	happiness	Agossou	rodrigue.agossou@gmail.com	manager	1	2025-01-24 09:18:35	2025-07-15 21:42:16	2025-07-16 09:35:43	\N	$2y$12$lvY5tvLoaZEnNbq2sMldoe1S7wYbyP093y9lHvdgO8JzjV6s15aEi	\N
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_07_15_104234_create_equipes_table	1
5	2025_07_15_104307_create_membres_table	1
6	2025_07_15_104322_create_taches_table	1
7	2025_07_15_105432_create_membre_taches_table	1
8	2025_07_15_142043_create_personal_access_tokens_table	1
9	2025_07_15_212035_modify_membres_table	1
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
4	App\\Models\\Membre	1	auth_token	dd77a9c81a225c206c3d487fa88e31c004b58be1d4450cdee3d41e34583f8954	["*"]	2025-07-16 09:40:23	\N	2025-07-16 09:12:29	2025-07-16 09:40:23
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
\.


--
-- Data for Name: taches; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.taches (id, title, description, due_date, status, created_by, created_at, updated_at) FROM stdin;
1	Développer l'interface utilisateur	Dolor unde cupiditate cupiditate nobis laboriosam. Quaerat et modi nemo autem. Eaque vero reprehenderit qui neque adipisci soluta. Autem deserunt consequuntur earum.	2025-09-14 18:57:23	todo	1	2025-07-15 21:42:18	2025-07-15 21:42:18
2	Configurer la base de données	Officia repellat dignissimos veniam aut. Cumque dolore inventore et rerum.	2025-08-08 17:11:30	todo	1	2025-07-15 21:42:19	2025-07-15 21:42:19
3	Créer les tests unitaires	Maiores vitae nemo tempora. Iusto consectetur ducimus doloremque qui neque. Est dolore iste incidunt qui cupiditate consectetur facilis. Aut error eveniet deserunt. Dolorum enim non optio iusto quis.	2025-08-11 07:47:24	in_progress	1	2025-07-15 21:42:19	2025-07-15 21:42:19
4	Optimiser les performances	Est qui sed sed tempore vitae perspiciatis recusandae. Aliquid corporis consequatur quam animi commodi dolorem voluptas. Unde nobis qui temporibus corporis.	2025-07-31 05:39:34	todo	1	2025-07-15 21:42:19	2025-07-15 21:42:19
5	Concevoir les maquettes	Est enim tenetur totam rerum. Vel hic iste numquam nesciunt aut. Ut explicabo ipsa est nemo.	2025-07-22 20:24:50	done	1	2025-07-15 21:42:19	2025-07-15 21:42:19
6	Intégrer l'API REST	Voluptas beatae omnis libero repellendus et. Quis nobis quasi in neque sunt qui qui. Voluptatem ut illo beatae non et.	2025-08-01 06:11:26	in_progress	1	2025-07-15 21:42:19	2025-07-15 21:42:19
7	Documenter le code	Aut neque et vitae repellendus sint ut eaque odio. Atque voluptas et animi nesciunt cumque incidunt. Error aut delectus quos adipisci omnis maiores voluptate. Distinctio perspiciatis fugit rerum iure.	2025-09-13 02:22:36	in_progress	1	2025-07-15 21:42:19	2025-07-15 21:42:19
8	Corriger les bugs critiques	Sed esse dolore ducimus omnis. Sequi qui itaque quisquam possimus ipsum nemo. Pariatur at voluptas et quam adipisci.	2025-08-18 20:58:51	in_progress	1	2025-07-15 21:42:19	2025-07-15 21:42:19
9	Projet collaboratif équipe A	Laborum qui assumenda quisquam fugit optio eos. Voluptatem explicabo quibusdam in. Magni velit quasi magni amet totam aliquid. Voluptates et modi provident eum.	2025-07-21 05:07:10	in_progress	1	2025-07-15 21:42:19	2025-07-15 21:42:19
10	Créer le design system	In aliquid fugiat perspiciatis maiores est. Fuga ipsa dolorum et quae amet. Ipsum eos omnis aliquam. Aut officia sunt similique et quisquam.	2025-08-29 17:27:09	done	2	2025-07-15 21:42:19	2025-07-15 21:42:19
11	Concevoir l'identité visuelle	Facere odit adipisci dolorem adipisci non. Ea nostrum consectetur fugit neque repudiandae voluptatum. Doloribus harum est dolorum sed ut itaque. Ut aliquid tempore aut quos. Dolorem quisquam omnis soluta consequuntur quidem.	2025-08-11 13:05:16	todo	2	2025-07-15 21:42:19	2025-07-15 21:42:19
12	Optimiser l'UX mobile	Aut tempora fugit vel voluptatem repellat asperiores qui. Voluptatem ea voluptatem magni perferendis soluta id et. Repudiandae dignissimos temporibus est voluptate.	2025-07-27 06:38:57	todo	2	2025-07-15 21:42:19	2025-07-15 21:42:19
13	Créer les animations	Facere deserunt ut id animi doloribus ea. Veritatis eos voluptatem ullam velit. Error ullam mollitia iste dolor veniam iusto.	2025-08-11 14:35:29	in_progress	2	2025-07-15 21:42:19	2025-07-15 21:42:19
14	Valider l'accessibilité	Dolor suscipit reprehenderit eligendi reprehenderit non quam vel. Asperiores suscipit officiis similique nihil alias accusamus. Itaque nisi voluptatem dolores illum natus. Molestiae porro sint vel inventore.	2025-08-29 08:51:20	in_progress	2	2025-07-15 21:42:19	2025-07-15 21:42:19
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: happiness
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- Name: equipes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.equipes_id_seq', 4, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: membre_taches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.membre_taches_id_seq', 20, true);


--
-- Name: membres_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.membres_id_seq', 13, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.migrations_id_seq', 9, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 6, true);


--
-- Name: taches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.taches_id_seq', 15, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: happiness
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: equipes equipes_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.equipes
    ADD CONSTRAINT equipes_pkey PRIMARY KEY (id);


--
-- Name: equipes equipes_slug_unique; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.equipes
    ADD CONSTRAINT equipes_slug_unique UNIQUE (slug);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: membre_taches membre_taches_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membre_taches
    ADD CONSTRAINT membre_taches_pkey PRIMARY KEY (id);


--
-- Name: membre_taches membre_taches_task_id_member_id_unique; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membre_taches
    ADD CONSTRAINT membre_taches_task_id_member_id_unique UNIQUE (task_id, member_id);


--
-- Name: membres membres_email_unique; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membres
    ADD CONSTRAINT membres_email_unique UNIQUE (email);


--
-- Name: membres membres_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membres
    ADD CONSTRAINT membres_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: taches taches_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.taches
    ADD CONSTRAINT taches_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: membre_taches_member_id_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX membre_taches_member_id_index ON public.membre_taches USING btree (member_id);


--
-- Name: membre_taches_task_id_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX membre_taches_task_id_index ON public.membre_taches USING btree (task_id);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: taches_created_by_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX taches_created_by_index ON public.taches USING btree (created_by);


--
-- Name: taches_due_date_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX taches_due_date_index ON public.taches USING btree (due_date);


--
-- Name: taches_status_index; Type: INDEX; Schema: public; Owner: happiness
--

CREATE INDEX taches_status_index ON public.taches USING btree (status);


--
-- Name: membre_taches membre_taches_member_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membre_taches
    ADD CONSTRAINT membre_taches_member_id_foreign FOREIGN KEY (member_id) REFERENCES public.membres(id) ON DELETE CASCADE;


--
-- Name: membre_taches membre_taches_task_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membre_taches
    ADD CONSTRAINT membre_taches_task_id_foreign FOREIGN KEY (task_id) REFERENCES public.taches(id) ON DELETE CASCADE;


--
-- Name: membres membres_team_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.membres
    ADD CONSTRAINT membres_team_id_foreign FOREIGN KEY (team_id) REFERENCES public.equipes(id) ON DELETE CASCADE;


--
-- Name: taches taches_created_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: happiness
--

ALTER TABLE ONLY public.taches
    ADD CONSTRAINT taches_created_by_foreign FOREIGN KEY (created_by) REFERENCES public.membres(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

