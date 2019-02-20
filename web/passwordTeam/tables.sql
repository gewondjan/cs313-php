


CREATE SCHEMA teamActivity;

CREATE TABLE teamActivity.users 
(
    id SERIAL PRIMARY KEY NOT NULL,
    username varchar(200) UNIQUE NOT NULL,
    password varchar(200) NOT NULL
);

