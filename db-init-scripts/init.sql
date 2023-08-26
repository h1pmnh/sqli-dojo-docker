USE sqlidojo;

CREATE TABLE PEOPLE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

INSERT INTO PEOPLE (first_name, last_name, email) VALUES
    ('John', 'Doe', 'john@example.com'),
    ('Jane', 'Smith', 'jane@example.com'),
    ('Michael', 'Johnson', 'michael@example.com');


CREATE TABLE FILTER_SETUP (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    FILTER_CHARACTER VARCHAR(1) NOT NULL
);


CREATE TABLE SECRET_TABLE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    SECRET_VALUE VARCHAR(50) NOT NULL
);

INSERT INTO SECRET_TABLE (SECRET_VALUE) VALUES ("SQL Injection Dojo");


