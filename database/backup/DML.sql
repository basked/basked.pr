create table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    connection text                                not null,
    queue      text                                not null,
    payload    longtext                            not null,
    exception  longtext                            not null,
    failed_at  timestamp default CURRENT_TIMESTAMP not null
);

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
);

create table password_resets
(
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp    null
);

create index password_resets_email_index
    on password_resets (email);

create table permissions
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

create table roles
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

create table roles_permissions
(
    role_id       bigint unsigned not null,
    permission_id bigint unsigned not null,
    primary key (role_id, permission_id),
    constraint roles_permissions_permission_id_foreign
        foreign key (permission_id) references permissions (id)
            on delete cascade,
    constraint roles_permissions_role_id_foreign
        foreign key (role_id) references roles (id)
            on delete cascade
);

create table sk_developers
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) null,
    descr      varchar(255) null,
    created_at timestamp    null,
    updated_at timestamp    null
);

create table sk_roadmaps
(
    id           bigint unsigned auto_increment
        primary key,
    developer_id bigint unsigned null,
    name         varchar(255)    not null,
    slug         varchar(255)    not null,
    descr        varchar(255)    null,
    constraint sk_roadmaps_developer_id_foreign
        foreign key (developer_id) references sk_developers (id)
            on delete cascade
);

create table sk_types
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) null,
    descr      varchar(255) null,
    created_at timestamp    null,
    updated_at timestamp    null
);

create table sk_technologies
(
    id            bigint unsigned auto_increment
        primary key,
    name          varchar(255)    not null,
    slug          varchar(255)    not null,
    descr         varchar(255)    null,
    created_at    timestamp       null,
    updated_at    timestamp       null,
    type_id       bigint unsigned null,
    technology_id int             null,
    constraint sk_technologies_type_id_foreign
        foreign key (type_id) references sk_types (id)
);

create table sk_technology_roadmap
(
    id            bigint unsigned auto_increment
        primary key,
    technology_id bigint unsigned null,
    roadmap_id    bigint unsigned null,
    constraint sk_technology_roadmap_roadmap_id_foreign
        foreign key (roadmap_id) references sk_roadmaps (id)
            on delete cascade,
    constraint sk_technology_roadmap_technology_id_foreign
        foreign key (technology_id) references sk_technologies (id)
            on delete cascade
);

create table sk_technology_type
(
    id            bigint unsigned auto_increment
        primary key,
    technology_id bigint unsigned not null,
    type_id       bigint unsigned not null,
    created_at    timestamp       null,
    updated_at    timestamp       null,
    constraint sk_technology_type_technology_id_foreign
        foreign key (technology_id) references sk_technologies (id),
    constraint sk_technology_type_type_id_foreign
        foreign key (type_id) references sk_types (id)
);

create table spr_autors
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

create table spr_books
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

create table spr_autor_book
(
    id         bigint unsigned auto_increment
        primary key,
    autor_id   bigint unsigned not null,
    book_id    bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    count      int             not null,
    constraint spr_autor_book_autor_id_foreign
        foreign key (autor_id) references spr_autors (id),
    constraint spr_autor_book_book_id_foreign
        foreign key (book_id) references spr_books (id)
);

create table spr_continents
(
    id    bigint unsigned auto_increment
        primary key,
    name  varchar(255) not null,
    slug  varchar(255) not null,
    descr varchar(255) not null,
    url   varchar(255) not null
);

create table spr_continents_attr
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) not null,
    type       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    `group`    varchar(255) not null
);

create table spr_continents_attr_val
(
    id                bigint unsigned auto_increment
        primary key,
    continent_id      bigint unsigned not null,
    continent_attr_id bigint unsigned not null,
    val               varchar(255)    null,
    created_at        timestamp       null,
    updated_at        timestamp       null,
    constraint spr_continents_attr_val_continent_attr_id_foreign
        foreign key (continent_attr_id) references spr_continents_attr (id),
    constraint spr_continents_attr_val_continent_id_foreign
        foreign key (continent_id) references spr_continents (id)
);

create table spr_continents_details
(
    id           bigint unsigned auto_increment
        primary key,
    continent_id bigint unsigned not null,
    name         varchar(255)    null,
    created_at   timestamp       null,
    updated_at   timestamp       null,
    constraint spr_continents_details_continent_id_foreign
        foreign key (continent_id) references spr_continents (id)
);

create table spr_countries
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

create table spr_countries_attr
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) not null,
    type       varchar(255) not null,
    `group`    varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    `key`      varchar(255) null
);

create table spr_countries_attr_val
(
    id              bigint unsigned auto_increment
        primary key,
    country_id      bigint unsigned not null,
    country_attr_id bigint unsigned not null,
    val             text            null,
    created_at      timestamp       null,
    updated_at      timestamp       null,
    constraint spr_countries_attr_val_country_attr_id_foreign
        foreign key (country_attr_id) references spr_countries_attr (id)
            on delete cascade,
    constraint spr_countries_attr_val_country_id_foreign
        foreign key (country_id) references spr_countries (id)
            on delete cascade
);

create table spr_countries_details
(
    id         bigint unsigned auto_increment
        primary key,
    country_id bigint unsigned not null,
    name       varchar(255)    null,
    descr      text            null,
    created_at timestamp       null,
    updated_at timestamp       null,
    url        varchar(255)    null,
    img_flag   varchar(255)    null,
    img_gerb   varchar(255)    null,
    constraint spr_countries_details_country_id_foreign
        foreign key (country_id) references spr_countries (id)
            on delete cascade
);

create table spr_units
(
    id              bigint unsigned auto_increment
        primary key,
    code            int          not null,
    name            varchar(255) not null,
    slug            varchar(255) not null,
    symbol_national varchar(255) null,
    symbol_intern   varchar(255) null,
    code_national   varchar(255) null,
    code_intern     varchar(255) null,
    section         varchar(255) not null,
    unit_group      varchar(255) not null,
    descr           varchar(255) null,
    created_at      timestamp    null,
    updated_at      timestamp    null
);

create table tl_relationships
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    descr      varchar(255) not null
);

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255) not null,
    email             varchar(255) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    remember_token    varchar(100) null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    constraint users_email_unique
        unique (email)
);

create table users_permissions
(
    user_id       bigint unsigned not null,
    permission_id bigint unsigned not null,
    primary key (user_id, permission_id),
    constraint users_permissions_permission_id_foreign
        foreign key (permission_id) references permissions (id)
            on delete cascade,
    constraint users_permissions_user_id_foreign
        foreign key (user_id) references users (id)
            on delete cascade
);

create table users_roles
(
    user_id bigint unsigned not null,
    role_id bigint unsigned not null,
    primary key (user_id, role_id),
    constraint users_roles_role_id_foreign
        foreign key (role_id) references roles (id)
            on delete cascade,
    constraint users_roles_user_id_foreign
        foreign key (user_id) references users (id)
            on delete cascade
);

