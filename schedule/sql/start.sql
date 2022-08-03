drop table if exists user;

create table user(
    id int auto_increment primary key,
    name char(40) not null,
    pass char(40) not null
);

drop table if exists schedule;

create table schedule(
    year int not null,
    month int not null,
    day int not null,
    author char(40) not null,
    text varchar(200) not null
);
