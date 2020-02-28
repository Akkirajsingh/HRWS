//-----ADDED ON 12-Nov-19
ALTER TABLE requirement MODIFY need_by_no int(2) NULL DEFAULT NULL;
//-----ADDED ON 06-Nov-19
ALTER TABLE clients add column logo_name varchar(100) DEFAULT NULL;
//-----ADDED ON 01-Nov-19
CREATE TABLE req_comments(
 id int(10) UNSIGNED NOT NULL,
 req_id int(10) UNSIGNED NOT NULL,
 comments varchar(400)  NOT NULL,
 created_at timestamp  NOT NULL,
 created_by varchar(100) NOT NULL,
 created_id int(10) UNSIGNED NOT NULL
);

ALTER TABLE `req_comments` ADD PRIMARY KEY (`id`);
ALTER TABLE `req_comments` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
//-----ADDED ON 31-Oct-19
CREATE TABLE req_recruiter(
 id int(10) UNSIGNED NOT NULL,
 req_id int(10) UNSIGNED NOT NULL,
 recruiter_id int(10) UNSIGNED NOT NULL,
 created_at timestamp  NOT NULL,
 created_by varchar(100) NOT NULL 
);

ALTER TABLE `req_recruiter` ADD PRIMARY KEY (`id`);
ALTER TABLE `req_recruiter` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE req_recruiter_hist(
 id int(10) UNSIGNED NOT NULL,
 req_id int(10) UNSIGNED NOT NULL,
 recruiter_id int(10) UNSIGNED NOT NULL,
 created_at timestamp  NOT NULL,
 created_by varchar(100) NOT NULL 
);

ALTER TABLE `req_recruiter_hist` ADD PRIMARY KEY (`id`);
ALTER TABLE `req_recruiter_hist` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE skills(
 id int(10) UNSIGNED NOT NULL,
 req_id int(10) UNSIGNED NOT NULL,
 skill varchar(300) NOT NULL,
 created_at timestamp  NOT NULL,
 created_by varchar(100) NOT NULL 
);

ALTER TABLE `skills` ADD PRIMARY KEY (`id`);
ALTER TABLE `skills` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE questions(
 id int(10) UNSIGNED NOT NULL,
 req_id int(10) UNSIGNED NOT NULL,
 question varchar(400) NOT NULL,
 created_at timestamp  NOT NULL,
 created_by varchar(100) NOT NULL 
);

ALTER TABLE `questions` ADD PRIMARY KEY (`id`);
ALTER TABLE `questions` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

alter table requirement add column (
lead_submit_date date NULL DEFAULT NULL,
req_submit_date date NULL DEFAULT NULL
);
//-----ADDED ON 24-Oct-19
ALTER TABLE users MODIFY designation varchar(50) DEFAULT NULL;

alter table roles add column editable int(1) UNSIGNED NOT NULL default 1;

insert into roles (name,display_name,description,editable) values ('ACCOUNT_MANAGER','Account Manager','System Created Role',0);
insert into roles (name,display_name,description,editable) values ('HR_LEAD','HR-Lead','System Created Role for HR-Lead',0);
insert into roles (name,display_name,description,editable) values ('SUPER_ADMIN','Super Admin','System Created Role for Super Admin',0);

insert into permissions (name,display_name) values ('AM_CREATE_REQ','Create Requirement');

insert into permission_role (permission_id,role_id) values ((select id from permissions where name='AM_CREATE_REQ'),(select id from roles where name='ACCOUNT_MANAGER'));

CREATE TABLE req_history(
 id int(10) UNSIGNED NOT NULL,
 req_id int(10) UNSIGNED NOT NULL,
 state_change varchar(100) NOT NULL,
 updated_at timestamp  NOT NULL,
 updated_by varchar(100) NOT NULL 
);

ALTER TABLE `req_history` ADD PRIMARY KEY (`id`);
ALTER TABLE `req_history` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
//-----ADDED ON 23-Oct-19
CREATE TABLE requirement (
  id int(10) UNSIGNED NOT NULL,
  req_no  varchar(50) NOT NULL,
  company_id int(10) UNSIGNED NOT NULL,
  client_id int(10) UNSIGNED NOT NULL,
  contact_id int(10) UNSIGNED NOT NULL,

  priority 	varchar(100) NULL DEFAULT NULL,  
  submission_date timestamp NULL DEFAULT NULL,
  title  varchar(100) NOT NULL,
  description  varchar(10000) NOT NULL,
  location  varchar(100) NULL DEFAULT NULL,
  sal_from  varchar(100) NULL DEFAULT NULL,
  sal_to  varchar(100) NULL DEFAULT NULL,
  vacancy_no int(2) UNSIGNED NOT NULL,
  need_by_no int(2) UNSIGNED NOT NULL,
  need_by_type   varchar(50) NULL DEFAULT NULL,
  duration  varchar(30) NULL DEFAULT NULL,
  extendable  varchar(30) NULL DEFAULT NULL,
  experience varchar(30) NULL DEFAULT NULL,
  start_date date NULL DEFAULT NULL,
  reporting_name  varchar(100) NULL DEFAULT NULL,
  reporting_desg  varchar(100) NULL DEFAULT NULL,
  reporting_email  varchar(200) NULL DEFAULT NULL,
  reporting_contact   varchar(100) NULL DEFAULT NULL,
  interview_mode   varchar(100) NULL DEFAULT NULL,
  travelling	  varchar(10) NULL DEFAULT NULL,
  local_driving_license   varchar(10) NULL DEFAULT NULL,
  placement_time date NULL DEFAULT NULL,
  local_exp	  varchar(10) NULL DEFAULT NULL,
  local_availability   varchar(10) NULL DEFAULT NULL,
  notice_period  varchar(30) NULL DEFAULT NULL,
  
  leave_sal   varchar(10) NULL DEFAULT NULL,
  
  
  assigned_to int(10) UNSIGNED  NULL DEFAULT NULL,
  status varchar(100) NULL DEFAULT NULL,  
  no_of_cv int(10) UNSIGNED NULL DEFAULT NULL,
  
  deleted  int(1) UNSIGNED NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  created_by int(10) UNSIGNED NOT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  updated_by int(10) UNSIGNED NULL DEFAULT NULL
);

ALTER TABLE `requirement` ADD PRIMARY KEY (`id`);
ALTER TABLE `requirement` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

//-----ADDED ON 21-Oct-19
ALTER TABLE client_contact add column google_place varchar(200) default null;
//-----ADDED ON 17-Oct-19
ALTER TABLE client_contact add column isd_code varchar(10) default null;
ALTER TABLE client_contact add column state varchar(50) default null;
//-----ADDED ON 16-Oct-19
ALTER TABLE `client_contact` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE clients add column state varchar(50) default null;
//-----OLD
ALTER TABLE `client_contact` add column email varchar(200);
ALTER TABLE `client_contact` add column deleted int(1) not null default 0;

CREATE TABLE `client_contact` (
  id int(10) UNSIGNED NOT NULL,
  client_id int(10) UNSIGNED NOT NULL,  
  contact_person varchar(255) NOT NULL,
  designation varchar(255) NULL DEFAULT NULL,
  department varchar(255) NULL DEFAULT NULL,  
  board varchar(255) NOT NULL,
  phone varchar(255) NOT NULL,
  mobile varchar(255) NOT NULL,
  fax varchar(255) NOT NULL,
  address1 varchar(255) NOT NULL,
  address2  varchar(255) NOT NULL,
  city  varchar(255) NOT NULL,
  country  varchar(255) NOT NULL,
  place_id   varchar(255) NOT NULL,
  assigned_to int(10) UNSIGNED  NULL DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);

ALTER TABLE `client_contact` ADD PRIMARY KEY (`id`);
ALTER TABLE client_contact ADD FOREIGN KEY (client_id) REFERENCES clients(id);
---Alter clients
alter table clients add column (
 address1	varchar(255) NOT NULL,
 address2	varchar(255) NOT NULL,
 country	varchar(255) NOT NULL,
 place_id   varchar(255) NOT NULL
);

---CREATE USER
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` int(10) UNSIGNED NOT NULL,
  `user_payment_status` int(11) DEFAULT 0,
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_change_request` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;


alter table users add column `company_id` int(10) UNSIGNED NOT NULL;
--------Client table
CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_name_unique` (`name`);

ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

alter table clients add column `client_status` int(10) UNSIGNED NOT NULL;

ALTER TABLE `clients` ADD UNIQUE KEY `clients_name_city_unique` (name,city);

alter table clients add column `company_id` int(10) UNSIGNED NOT NULL;


-----role_user
alter table role_user add column `updated_at` timestamp NULL DEFAULT NULL;
alter table role_user add column `created_at` timestamp NULL DEFAULT NULL;

-----------USER_TOKEN
CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `user_token` ADD PRIMARY KEY (`id`);

ALTER TABLE `user_token` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-----role
alter table roles add column `active` int(1) UNSIGNED NOT NULL default 1;

--Permisssion_role
alter table permission_role add column `updated_at` timestamp NULL DEFAULT NULL;
alter table permission_role add column `created_at` timestamp NULL DEFAULT NULL;