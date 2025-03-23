<?php
session_start();

// Function to establish database connection
function connectToDatabase() {
    // Replace these values with your database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Function to save data from the linked list to the database
function saveDataToDatabase() {
    if (isset($_SESSION['head'])) {
        $conn = connectToDatabase();
        $currentNode = $_SESSION['head'];

        // Prepare SQL statement
        $sql = "INSERT INTO details (bookId, author, bookName, authorName, authorId, street, city, country, website, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $bookId, $author, $bookName, $authorName, $authorId, $street, $city, $country, $website, $gender);

        // Execute the statement for each node in the linked list
        while ($currentNode != null) {
            $bookId = $currentNode->data['bookId'];
            $author = $currentNode->data['author'];
            $bookName = $currentNode->data['bookName'];
            $authorName = $currentNode->data['authorName'];
            $authorId = $currentNode->data['authorId'];
            $street = $currentNode->data['street'];
            $city = $currentNode->data['city'];
            $country = $currentNode->data['country'];
            $website = $currentNode->data['website'];
            $gender = $currentNode->data['gender'];

            $stmt->execute();

            $currentNode = $currentNode->next;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}

// Call the function to save data to the database when the save button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["saveButton"])) {
    saveDataToDatabase();
    echo "Data saved successfully!";
}
?>
