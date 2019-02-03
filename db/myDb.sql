
BEGIN;
/* Code I would have used to Create and Connect to the Database

create database project;  

\c project

*/
-- Instead I will create a schema
CREATE SCHEMA project;

/* Create Tables */

CREATE TABLE project.users (
    id       SERIAL  PRIMARY KEY,
    name        varchar(50) NOT NULL,
    email       varchar(50) NOT NULL UNIQUE,
    password    varchar(50) NOT NULL
);

CREATE TABLE project.abcPriority (
    priority varchar(1) UNIQUE
);

CREATE TABLE project.bucketlist (
    id       SERIAL PRIMARY KEY,
    itemDescription varchar(300) NOT NULL,
    primaryPriority varchar(1) REFERENCES project.abcPriority(priority),
    secondaryPriority int --Will add the check to make sure this is between 1 and 10 in the code, at least I think so.
);

CREATE TABLE project.accomplishments (
    id       SERIAL   PRIMARY KEY,
    itemDescription varchar(300) NOT NULL,
    completedDate DATE    
);

CREATE TABLE project.todos (
    id   SERIAL PRIMARY KEY,
    bucketListId int,
    CONSTRAINT fk_bucketlist FOREIGN KEY (bucketListId) REFERENCES project.bucketlist(id),
    description varchar(300) NOT NULL,
    completedDate DATE
);

CREATE TABLE project.deadlines (
    id   SERIAL PRIMARY KEY,
    todoId int,
    CONSTRAINT fk_todos FOREIGN KEY (todoId) REFERENCES project.todos(id),
    day int NOT NULL,
    month int NOT NULL,
    year int NOT NULL
);

/*The deadline is the goal time the todo will be completed, the completedDate attribute in the todos table is the actual date the todo is completed.) */

/* INSERT STATEMENTS FOR SAMPLE DATA */

INSERT INTO project.users (name, email, password) 
VALUES ('ryan', 'ryan@test.com', 'ryanPassword'), 
('bob', 'bob@test.com', 'bobPassword');

INSERT INTO project.abcPriority (priority) VALUES ('A'), ('B'), ('C'), ('');

INSERT INTO project.bucketlist (itemDescription, primaryPriority, secondaryPriority) 
VALUES ('Climb Mount Everest', 'A', 3),
('Run a Marathon', 'B', 1),
('Make 100 Friends', 'C', 8),
('Jump 5 feet', 'A', 2),
('Eat at innout', 'C', 1),
('Make a burrito', 'B', 2);

INSERT INTO project.accomplishments (itemDescription, completedDate)
VALUES ('Run a half marathon', current_date),
('Go cliff jumping', current_date);

INSERT INTO project.todos (bucketListId, description, completedDate)
VALUES ((SELECT id from project.bucketlist WHERE itemDescription = 'Run a Marathon'), 'train for 100 hours', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Run a Marathon'), 'do cross fit', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Run a Marathon'), 'train for 100 hours', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Make 100 Friends'), 'make a new friend', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Make 100 Friends'), 'smile at 5 people', current_date),
((SELECT id from project.bucketlist WHERE itemDescription = 'Jump 5 feet'), 'go to gym', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Jump 5 feet'), 'jump 4 feet', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Eat at innout'), 'drive to utah', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Eat at innout'), 'buy 2 double doubles', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Make a burrito'), 'buy tortillas', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Make a burrito'), 'buy cheese', null),
((SELECT id from project.bucketlist WHERE itemDescription = 'Make a burrito'), 'buy sour cream', null);



COMMIT;