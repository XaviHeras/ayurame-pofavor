-- auto-generated definition
create table note
(
  id      int auto_increment
    primary key,
  starred tinyint(1) default 0                 null,
  message text                                 not null,
  title   varchar(200)                         not null,
  tags    json                                 null,
  tms     timestamp  default CURRENT_TIMESTAMP not null,
  constraint note_title_uindex
    unique (title)
);


