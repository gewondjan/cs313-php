


CREATE SCHEMA teamActivity;

CREATE TABLE teamActivity.users {
    id SERIAL PRIMARY KEY NOT NULL,
    username varchar(200),
    password varchar(200)
};

