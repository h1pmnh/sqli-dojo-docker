USE sqlidojo;

CREATE TABLE PEOPLE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

INSERT INTO PEOPLE (first_name, last_name, email) VALUES
    ('Sofia','Ivanova','sofia.ivanova@example.com'),
    ('Alejandro','Santos','alejandro.santos@example.com'),
    ('Li','Wei','li.wei@example.com'),
    ('Isabella','Rossi','isabella.rossi@example.com'),
    ('Hassan','Al-Mansoori','hassan.al-mansoori@example.com'),
    ('Lars','Andersen','lars.andersen@example.com'),
    ('Fatima','Khan','fatima.khan@example.com'),
    ('Andre','Silva','andre.silva@example.com'),
    ('Aisha','Patel','aisha.patel@example.com'),
    ('Hugo','Dubois','hugo.dubois@example.com'),
    ('Mia','Jansson','mia.jansson@example.com'),
    ('Amir','Hamidi','amir.hamidi@example.com'),
    ('Natalia','Petrovich','natalia.petrovich@example.com'),
    ('Diego','Ramirez','diego.ramirez@example.com'),
    ('Katarina','Sokolov','katarina.sokolov@example.com'),
    ('Javier','Morales','javier.morales@example.com'),
    ('Leila','Rahman','leila.rahman@example.com'),
    ('Viktoriya','Yermakov','viktoriya.yermakov@example.com'),
    ('Lucas','Costa','lucas.costa@example.com'),
    ('Yuki','Tanaka','yuki.tanaka@example.com');

-- Used for character filtering such as <> etc
CREATE TABLE FILTER_SETUP (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    FILTER_CHARACTER VARCHAR(1) NOT NULL
);

-- Used for phrase filtering such as SELECT etc
CREATE TABLE FILTER_PHRASE_SETUP (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    FILTER_PHRASE VARCHAR(100) NOT NULL
);

CREATE TABLE SECRET_TABLE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    SECRET_VALUE VARCHAR(50) NOT NULL
);

INSERT INTO SECRET_TABLE (SECRET_VALUE) VALUES ("SQL Injection Dojo");


