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

function addToLinkedList($data) {
    $newNode = new Node($data);

    if (!isset($_SESSION['head'])) {
        $_SESSION['head'] = $newNode;
    } else {
        $currentNode = $_SESSION['head'];
        while ($currentNode->next != null) {
            $currentNode = $currentNode->next;
        }
        $currentNode->next = $newNode;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming your form fields are sanitized and validated before adding to the linked list
    $bookId = $_POST['bookId'];
    $author = $_POST['author'];
    $bookName = $_POST['bookName'];
    $authorName = $_POST['authorName'];
    $authorId = $_POST['authorId'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $website = $_POST['website'];
    $gender = $_POST['gender'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $data = [
        'bookId' => $bookId,
        'author' => $author,
        'bookName' => $bookName,
        'authorName' => $authorName,
        'authorId' => $authorId,
        'street' => $street,
        'city' => $city,
        'country' => $country,
        'website' => $website,
        'gender' => $gender,
        'day' => $day,
        'month' => $month,
        'year' => $year,
    ];

    addToLinkedList($data);

    // Redirect to the view page
    header('Location: view_data.php');
    exit();
}
?>
