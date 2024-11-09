<?php

try {
    // Database connection parameters
    $host = "localhost"; // Database host, typically "localhost" for local development.
    $dbname = "short-urls"; // The name of the database you're connecting to.
    $user = "root"; // The username for the MySQL database.
    $pass = ""; // The password for the MySQL database. Here it's left empty (default for local development).

    // Creating a new PDO instance to connect to the MySQL database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Setting the error mode for the PDO instance
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there is an error, catch the exception and display the error message
    echo "Connection failed: " . $e->getMessage();
}

