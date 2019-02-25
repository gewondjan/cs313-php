
BEGIN;
/* Code I would have used to Create and Connect to the Database

create database project;

\c project

*/

--Drop everything before we begin
DROP TABLE project.deadlines;
DROP TABLE project.todos;
DROP TABLE project.accomplishments;
DROP TABLE project.bucketlist;
DROP TABLE project.abcPriority;
DROP TABLE project.users;

DROP SCHEMA project;




-- Creating the Schema
CREATE SCHEMA project;

/* Create Tables */

CREATE TABLE project.users (
    id       SERIAL  PRIMARY KEY,
    name        varchar(200) NOT NULL,
    email       varchar(200) NOT NULL UNIQUE,
    password    varchar(200) NOT NULL
);

CREATE TABLE project.abcPriority (
    priority varchar(1) UNIQUE
);

CREATE TABLE project.bucketlist (
    id       SERIAL PRIMARY KEY,
    user_id int NOT NULL REFERENCES project.users(id),
    itemDescription varchar(300) NOT NULL,
    primaryPriority varchar(1) REFERENCES project.abcPriority(priority),
    secondaryPriority int --Will add the check to make sure this is between 1 and 10 in the code, at least I think so.
);

CREATE TABLE project.accomplishments (
    id       SERIAL   PRIMARY KEY,
    user_id int NOT NULL REFERENCES project.users(id),
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
VALUES ('ryan', 'ryan@test.com', '$2y$10$.uESqzS/YBR7w9yWnxPUmOOoThAuya2lcNM95BROs9EJQath5P0qe'),
('bob', 'bob@test.com', 'bobPassword');

INSERT INTO project.abcPriority (priority) VALUES ('A'), ('B'), ('C'), ('');

INSERT INTO project.bucketlist (user_id, itemDescription, primaryPriority, secondaryPriority)
VALUES (1, 'Climb Mount Everest', 'A', 3),
(1, 'Run a Marathon', 'B', 1),
(1, 'Make 100 Friends', 'C', 8),
(1, 'Jump 5 feet', 'A', 2),
(1, 'unassigned', '', 3),
(2, 'Eat at innout', 'C', 1),
(2, 'Make a burrito', 'B', 2);

INSERT INTO project.accomplishments (user_id, itemDescription, completedDate)
VALUES (1, 'Run a half marathon', current_date),
(2, 'Go cliff jumping', current_date);

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