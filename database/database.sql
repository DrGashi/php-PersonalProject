CREATE DATABASE car_mechanic;
USE car_mechanic;
-- CREATE TABLE (
	
-- );
CREATE TABLE users(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    confirm_password VARCHAR(255),
    is_admin VARCHAR(255)
)