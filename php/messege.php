<?php
// Include the database connection
include "db.php";
// Assuming $conn is your database connection
$user_message = '%' . trim($_POST['text']) . '%';

// Prepare and execute the SQL query with a prepared statement
$sql = "SELECT * FROM project_setting WHERE location LIKE ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $user_message);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and process each row
        while ($row = mysqli_fetch_assoc($result)) {
            // Process each row as needed
            // For example, you can access $row['location'] to get the location
            // You can uncomment the line below to print the location
             echo "we have a plot in " . $row['plot_name'] . "<br>";
        }
    } else {
        echo "No results found.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error in preparing SQL statement: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
