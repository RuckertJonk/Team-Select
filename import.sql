DROP DATABASE IF EXISTS netland;
CREATE DATABASE netland;
USE netland;

ALTER DATABASE netland CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE fighters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    afkomst VARCHAR(100),
    leaders TEXT,
    famous_members TEXT,
    summary TEXT
);

INSERT INTO teams (image, title, description, afkomst, leaders, famous_members, summary) VALUES
('cobra-kai.jpg',
 'Cobra Kai / Miyagi-Do',
 'Join Cobra Kai or Miyagi Do',
 'Cobra Kai / Karate Kid',
 'Johnny Lawrence, Daniel LaRusso, Chozen Toguchi',
 'Miguel Diaz, Robby Keene, Samantha LaRusso, Hawk',
 'Twee rivaliserende karatescholen met tegengestelde filosofieën: agressie vs. balans.'),

('fight-club.jpg',
 'Fight Club',
 'Join Fight Club and fight with Tyler Durden',
 'Fight Club',
 'Tyler Durden',
 'Angel Face, Project Mayhem leden',
 'Een ondergrondse vechtclub die evolueert tot een anarchistische beweging.'),

('the-boys.jpeg',
 'The Boys / The Seven',
 'Join The Boys and kill the supes or Join The Seven and try to stop the boys',
 'The Boys',
 'Homelander (The Seven), Billy Butcher (The Boys)',
 'Queen Maeve, A-Train, Black Noir, Hughie, Frenchie',
 'Een corrupte superheldengroep tegenover een team dat hen probeert te ontmaskeren.'),

('GOW.webp',
 'Sparta (God of War)',
 'Join Sparta and help The God Of War (Kratos)',
 'God of War',
 'Kratos',
 'Spartan Army, Captain Nikos',
 'De militaire macht van Sparta, geleid door Kratos voordat hij de Ghost of Sparta werd.'),

('peaky-blinderswebp.webp',
 'Peaky Blinders',
 'Join the Shelby Brothers in their business',
 'Peaky Blinders',
 'Thomas Shelby',
 'Arthur Shelby, John Shelby, Polly Gray, Alfie Solomons',
 'Een beruchte criminele familie uit Birmingham die macht en invloed opbouwt na WOI.'),

('one-piece-strawhats.avif',
 'The Strawhat Pirates',
 'Join the Strawhats and find the One Piece',
 'One Piece',
 'Monkey D. Luffy',
 'Zoro, Nami, Sanji, Usopp, Chopper, Robin, Franky, Brook, Jinbe',
 'Een avontuurlijke piratencrew die de wereld rondreist op zoek naar de One Piece.');

CREATE TABLE team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fighter_id INT NOT NULL,
    team_id INT NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fighter_id) REFERENCES fighters(id),
    FOREIGN KEY (team_id) REFERENCES teams(id)
);
