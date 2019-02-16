CREATE DATABASE scripturesdb;

USE scripturesdb;

CREATE TABLE scripture (
  scripture_id          SERIAL NOT NULL PRIMARY KEY,
  book        varchar(50) NOT NULL,
  chapter     int NOT NULL,
  verse       int NOT NULL,
  content     varchar(1000) NOT NULL
);

CREATE TABLE topic (
  topic_id    SERIAL NOT NULL PRIMARY KEY,
  name  varchar(50) NOT NULL
);

CREATE TABLE scripture_topic (
  scripture_id int,
    FOREIGN KEY (scripture_id) REFERENCES scripture(scripture_id),
  topic_id int,
    FOREIGN KEY (topic_id) REFERENCES topic(topic_id)
);

INSERT INTO topic (name)
  VALUES ('Faith'),
        ('Sacrifice'),
        ('Charity');



INSERT INTO scripture (book, chapter, verse, content)
  VALUES
    ('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.'),
    ('D&C', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.'),
    ('D&C', 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.'),
    ('Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');
