-- Adminer 4.8.1 PostgreSQL 14.5 dump

DROP TABLE IF EXISTS "status_tickets";
DROP SEQUENCE IF EXISTS status_tickets_status_ticket_id_seq;
CREATE SEQUENCE status_tickets_status_ticket_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."status_tickets" (
    "status_ticket_id" integer DEFAULT nextval('status_tickets_status_ticket_id_seq') NOT NULL,
    "status_ticket_name" character varying NOT NULL,
    CONSTRAINT "status_tickets_pkey" PRIMARY KEY ("status_ticket_id")
) WITH (oids = false);

INSERT INTO "status_tickets" ("status_ticket_id", "status_ticket_name") VALUES
(3,	'Ожидает'),
(5,	'В работе'),
(1,	'Готов');

DROP TABLE IF EXISTS "tickets";
DROP SEQUENCE IF EXISTS tickets_ticket_id_seq;
CREATE SEQUENCE tickets_ticket_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."tickets" (
    "ticket_id" integer DEFAULT nextval('tickets_ticket_id_seq') NOT NULL,
    "ticket_date_begin" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "ticket_comment" character varying(256),
    "ticket_description" text NOT NULL,
    "topic_ticket_id" integer NOT NULL,
    "status_ticket_id" integer DEFAULT '3' NOT NULL,
    "ticket_client" integer NOT NULL,
    "ticket_staff" integer NOT NULL,
    "ticket_date_end" timestamp,
    CONSTRAINT "tickets_pkey" PRIMARY KEY ("ticket_id")
) WITH (oids = false);

INSERT INTO "tickets" ("ticket_id", "ticket_date_begin", "ticket_comment", "ticket_description", "topic_ticket_id", "status_ticket_id", "ticket_client", "ticket_staff", "ticket_date_end") VALUES
(2,	'2024-03-01 11:01:43.536241',	'testtest',	'teststststst',	1,	3,	1,	2,	NULL),
(3,	'2024-03-01 11:29:58.997531',	NULL,	'tetete',	1,	3,	1,	2,	NULL),
(4,	'2024-03-01 12:21:27.379064',	NULL,	'sdsdsds',	1,	3,	1,	2,	NULL),
(5,	'2024-03-04 05:02:28.11816',	NULL,	'sqwqweqewrewtty',	1,	3,	1,	2,	NULL),
(6,	'2024-03-04 05:29:37.16007',	NULL,	'asas',	1,	3,	1,	2,	NULL),
(8,	'2024-03-04 09:50:49.900787',	NULL,	'Не включается, помогите',	1,	3,	1,	2,	NULL),
(10,	'2024-03-04 10:28:41.327059',	NULL,	'Жует бумагу',	2,	5,	1,	2,	NULL);

DROP TABLE IF EXISTS "topic_tickets";
DROP SEQUENCE IF EXISTS topic_tickets_topic_tichet_id_seq;
CREATE SEQUENCE topic_tickets_topic_tichet_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."topic_tickets" (
    "topic_ticket_id" integer DEFAULT nextval('topic_tickets_topic_tichet_id_seq') NOT NULL,
    "topic_ticket_name" character varying NOT NULL,
    CONSTRAINT "topic_tickets_pkey" PRIMARY KEY ("topic_ticket_id")
) WITH (oids = false);

INSERT INTO "topic_tickets" ("topic_ticket_id", "topic_ticket_name") VALUES
(1,	'Компьютер'),
(2,	'Принтер'),
(3,	'Периферия'),
(4,	'Интернет');

DROP TABLE IF EXISTS "user_t";
DROP SEQUENCE IF EXISTS user_t_user_id_seq;
CREATE SEQUENCE user_t_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."user_t" (
    "user_id" integer DEFAULT nextval('user_t_user_id_seq') NOT NULL,
    "user_name" character varying NOT NULL,
    "user_last_name" character varying NOT NULL,
    "user_middle_name" character varying,
    "user_phone" character varying(12) NOT NULL,
    "user_email" character varying NOT NULL,
    "user_section" character varying NOT NULL,
    "user_cabinet" character varying(10) NOT NULL,
    "user_is_staff" boolean NOT NULL,
    CONSTRAINT "user_t_pkey" PRIMARY KEY ("user_id")
) WITH (oids = false);

INSERT INTO "user_t" ("user_id", "user_name", "user_last_name", "user_middle_name", "user_phone", "user_email", "user_section", "user_cabinet", "user_is_staff") VALUES
(1,	'Данила',	'Арсланов',	'Дмитриевич',	'7999553535',	'sample@mail.com',	'Асу',	'333',	'f'),
(2,	'Иван',	'Иванов',	'Иванович',	'78005553535',	'staffmail@mail.com',	'Асу',	'333',	't');

ALTER TABLE ONLY "public"."tickets" ADD CONSTRAINT "tickets_status_ticket_id_fkey" FOREIGN KEY (status_ticket_id) REFERENCES status_tickets(status_ticket_id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."tickets" ADD CONSTRAINT "tickets_ticket_client_fkey" FOREIGN KEY (ticket_client) REFERENCES user_t(user_id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."tickets" ADD CONSTRAINT "tickets_ticket_staff_fkey" FOREIGN KEY (ticket_staff) REFERENCES user_t(user_id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."tickets" ADD CONSTRAINT "tickets_topic_ticket_id_fkey" FOREIGN KEY (topic_ticket_id) REFERENCES topic_tickets(topic_ticket_id) NOT DEFERRABLE;

-- 2024-03-04 12:25:04.341867+03