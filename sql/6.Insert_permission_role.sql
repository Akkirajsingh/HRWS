/* ----Permissions */
insert into permissions (name,display_name) values ('ADMIN_ALL','Super Admin');

insert into permissions (name,display_name) values ('ADMIN_USER_ALL','User Operations');
insert into permissions (name,display_name) values ('ADMIN_ROLE_ALL','Role Operations');
insert into permissions (name,display_name) values ('ADMIN_PERMISSION_ALL','Permission Operations');
insert into permissions (name,display_name) values ('ADMIN_CLIENT_ALL','Client Operations');

/*  ----Create SUPER_ADMIN ROLE */
insert into roles (name,display_name,description,editable) values ('SUPER_ADMIN','Super Admin','System Created Role for Super Admin',0);

/* --Assign Permission for SUPER_ADMIN  */
insert into permission_role (permission_id,role_id) values ((select id from permissions where name='ADMIN_ALL'),(select id from roles where name='SUPER_ADMIN'));

/*  ----Create ACCOUNT_MANAGER & HR_LEAD ROLE */
insert into roles (name,display_name,description,editable) values ('ACCOUNT_MANAGER','Account Manager','System Created Role',0);
insert into roles (name,display_name,description,editable) values ('HR_LEAD','HR-Lead','System Created Role for HR-Lead',0);

/* ----Permissions for Requirement*/
insert into permissions (name,display_name) values ('AM_CREATE_REQ','Create Requirement');

/* --Assign Permission for ACCOUNT_MANAGER  */
insert into permission_role (permission_id,role_id) values ((select id from permissions where name='AM_CREATE_REQ'),(select id from roles where name='ACCOUNT_MANAGER'));


/* ----Permissions for HR LEAD*/
insert into permissions (name,display_name) values ('TL_MANAGE_REQ','TL Manage Requirement');

/* --Assign Permission for  HR_LEAD*/
insert into permission_role (permission_id,role_id) values ((select id from permissions where name='TL_MANAGE_REQ'),(select id from roles where name='HR_LEAD'));


/*  ----Create HR_RECRUITER */
insert into roles (name,display_name,description,editable) values ('HR_RECRUITER','HR-Recruiter','System Created Role for HR_RECRUITER',0);

/* ----Permissions for HR_RECRUITER*/
insert into permissions (name,display_name) values ('RECRUITER_MANAGE_REQ','Recruiter Manage Requirement');

/* --Assign Permission for  HR_RECRUITER*/
insert into permission_role (permission_id,role_id) values ((select id from permissions where name='RECRUITER_MANAGE_REQ'),(select id from roles where name='HR_RECRUITER'));
