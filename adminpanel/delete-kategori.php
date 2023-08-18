<?php

    require "../connection.php";
    require "../session.php";


// Check if the item ID is provided via the query parameter 'p'
if (isset($_GET['p'])) {
    $itemId = $_GET['p'];

    // Perform the deletion query here using the $itemId
    $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id = $itemId");

    if ($queryDelete) {
        // Deletion successful
        echo "Item deleted successfully.";
    } else {
        // Deletion failed
        echo "Failed to delete item: " . mysqli_error($conn);
    }
} else {
    // Invalid or no item ID provided
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
