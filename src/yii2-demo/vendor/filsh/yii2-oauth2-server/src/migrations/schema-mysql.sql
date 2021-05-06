/**
 * Database schema required by \yii\rbac\DbManager.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 2.0
 */

drop table if exists `oauth_clients`;
drop table if exists `oauth_access_tokens`;
drop table if exists `oauth_refresh_tokens`;
drop table if exists `oauth_authorization_codes`;
drop table if exists `oauth_scopes`;
drop table if exists `oauth_jwt`;
drop table if exists `oauth_users`;
drop table if exists `oauth_public_keys`;

create table `oauth_clients`
(
    `client_id`                 varchar(32) not null,
    `client_secret`             varchar(32) default null,
    `redirect_uri`              varchar(1000) not null,
    `grant_types`               varchar(100) not null,
    `scope`                     varchar(2000) deault null,
    `user_id`                   integer default null,
primary key (`client_id`)
) engine InnoDB;

create table `oauth_access_tokens`
(
    `access_token`              varchar(40) not null,
    `client_id`                 varchar(32) not null,
    `user_id`                   integer default null,
    `expires`                   timestamp not null,
    `scope`                     varchar(2000) default null,
primary key (`access_token`),
foreign key (`client_id`) references `oauth_clients` (`client_id`) on delete cascade on update cascade
) engine InnoDB;



create table `oauth_refresh_tokens`
(
    `refresh_token`             varchar(40) not null,
    `client_id`                 varchar(32) not null,
    `user_id`                   integer default null,
    `expires`                   timestamp not null,
    `scope`                     varchar(2000) default null,
primary key (`refresh_token`),
foreign key (`client_id`) references `oauth_clients` (`client_id`) on delete cascade on update cascade
) engine InnoDB;


create table `oauth_authorization_codes`
(
    `authorization_code`        varchar(40) not null,
    `client_id`                 varchar(32) not null,
    `user_id`                   integer default null,
    `redirect_uri`              varchar(1000) not null,
    `expires`                   timestamp not null,
    `scope`                     varchar(2000) default null,
primary key (`authorization_code`),
foreign key (`client_id`) references `oauth_clients` (`client_id`) on delete cascade on update cascade
) engine InnoDB;


create table `oauth_scopes`
(
    `scope`                     varchar(2000) default null,
    `is_default`                boolean not null
) engine InnoDB;


create table `oauth_jwt`
(
    `client_id`                 varchar(32) not null,
    `subject`                   varchar(80) default null,
    `public_key`                varchar(2000) default null,
primary key (`client_id`)
) engine InnoDB;


create table `oauth_users`
(
    `username`                  varchar(255) not null,
    `password`                  varchar(2000) default null,
    `first_name`                varchar(255) default null,
    `last_name`                 varchar(255) default null,
primary key (`username`)
) engine InnoDB;

create table `oauth_public_keys`
(

    `client_id`                 varchar(32) not null,
    `public_key`                varchar(2000) default null,
    `private_key`               varchar(2000) default null,
    `encryption_algorithm`      varchar(100) default 'RS256'
) engine InnoDB;

