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

// Retrieve bookId to delete
$bookIdToDelete = $_POST['bookId'];

// Traverse the linked list and delete the node with matching bookId
if (isset($_SESSION['head'])) {
    $prevNode = null;
    $currentNode = $_SESSION['head'];

    // If the head node is to be deleted
    if ($currentNode !== null && $currentNode->data['bookId'] === $bookIdToDelete) {
        $_SESSION['head'] = $currentNode->next; // Changed head
        unset($currentNode); // Free the memory
    } else {
        // Find the previous node of the node to be deleted
        while ($currentNode !== null && $currentNode->data['bookId'] !== $bookIdToDelete) {
            $prevNode = $currentNode;
            $currentNode = $currentNode->next;
        }

        // If the node with bookIdToDelete was not found
        if ($currentNode === null) {
            echo "Book ID not found.";
            exit;
        }

        // Unlink the node from the linked list
        $prevNode->next = $currentNode->next;

        // Free the memory
        unset($currentNode);
    }
}
?>
