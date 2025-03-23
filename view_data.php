<?php
session_start();

class Node {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

function displayData() {
    if (isset($_SESSION['head'])) {
        $currentNode = $_SESSION['head'];
        ?>
        <table id="data-table" border="1">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Author</th>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Author ID</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Website</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($currentNode != null) {
                    ?>
                    <tr>
                        <td><?php echo $currentNode->data['bookId']; ?></td>
                        <td><?php echo $currentNode->data['author']; ?></td>
                        <td><?php echo $currentNode->data['bookName']; ?></td>
                        <td><?php echo $currentNode->data['authorName']; ?></td>
                        <td><?php echo $currentNode->data['authorId']; ?></td>
                        <td><?php echo $currentNode->data['street']; ?></td>
                        <td><?php echo $currentNode->data['city']; ?></td>
                        <td><?php echo $currentNode->data['country']; ?></td>
                        <td><?php echo $currentNode->data['website']; ?></td>
                        <td><?php echo $currentNode->data['gender']; ?></td>
                        <td><button class="delete-button" onclick="handleDelete('<?php echo $currentNode->data['bookId']; ?>')">Delete</button></td>
                    </tr>
                    <?php
                    $currentNode = $currentNode->next;
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        echo '<p>No data available</p>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - View Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
        .delete-button {
            padding: 5px 10px;
            background-color: #ff0000;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #cc0000;
        }

        #saveButton {
            padding: 10px 20px;
            background-color: #8ebf42;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 20px;
        }

        #saveButton:hover {
            background-color: #82b534;
        }
    </style>
</head>
<body>
    <h1>Library Management System - View Data <button id="saveButton" type="submit">Save</button></h1>
    <?php displayData(); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add event listener to the save button
            document.getElementById('saveButton').addEventListener('click', function() {
                // Fetch data from the session and send it to the server to save in the database
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'save_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        alert(xhr.responseText); // Display a message after saving data
                    }
                };

                // Send a request to the server
                xhr.send();
            });
        });
    </script>
</body>
</html>
