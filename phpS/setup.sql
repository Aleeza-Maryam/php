-- ─────────────────────────────────────────────
--  FILE: setup.sql
--  PURPOSE: Create the database and users table
--           Run this in phpMyAdmin → SQL tab
-- ─────────────────────────────────────────────

-- Create a new database called "session_demo"
-- IF NOT EXISTS prevents an error if it already exists
CREATE DATABASE IF NOT EXISTS session_demo;

-- Switch to using this database
USE session_demo;

-- Create a "users" table to store login credentials
CREATE TABLE IF NOT EXISTS users (
    id       INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each user, auto-increases
    username VARCHAR(50)  NOT NULL,           -- Username (max 50 characters)
    password VARCHAR(255) NOT NULL            -- Password (use hashed passwords in real apps)
);

-- Insert a sample user for testing
-- Username: admin | Password: 1234
-- In real apps, use PHP's password_hash() to store hashed passwords
INSERT INTO users (username, password) VALUES ('admin', '1234');

-- Insert a second test user
-- Username: syed | Password: mypassword
INSERT INTO users (username, password) VALUES ('syed', 'mypassword');
