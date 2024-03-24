<?php
// Include the database connection file
include "db.php";

// Check if the POST data named 'text' is set
if (isset($_POST['text'])) {
    // Get the value of 'text' from the POST data
    $value = trim($_POST['text']); // Trim to remove extra spaces

    // Check if the value is 'plot'
    if ($value === 'plot') {
        // Respond with introductory messages in text boxes
        echo '<div class="text-box">Definitely, we can help you with it. 😊</div>';
        echo '<div class="text-box">We understand that buying a plot is one of the biggest financial commitments and hassle tasks. 🏘</div>';
        
        // JavaScript to add typing indicator and bot replies
        echo '<script>
                var typingIndicator1 = \'<div class="typing-indicator">Typing...</div>\';
                $(".form").append(typingIndicator1);

                // Bot replies with acknowledgment and inquiry about location
                var reply1 = \'<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><p>Definitely, we can help you with it. 😊</p></div></div>\';
                $(".form").append(reply1);
                $(".form").scrollTop($(".form")[0].scrollHeight);

                // Remove typing indicator after message is appended
                setTimeout(function() {
                    $(".typing-indicator").remove();

                    // Bot replies with acknowledgment about the financial commitment
                    var typingIndicator2 = \'<div class="typing-indicator">Typing...</div>\';
                    $(".form").append(typingIndicator2);

                    var reply2 = \'<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><p>We understand that buying a plot is one of the biggest financial commitments and hassle tasks. 🏘</p></div></div>\';

                    // Add delay before appending the second message
                    setTimeout(function() {
                        $(".typing-indicator").remove();
                        $(".form").append(reply2);
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }, 2000); // Adjust delay as needed
                }, 2000); // Adjust delay as needed
            </script>';
    } else {
        // Fetch details of the plot based on the user input
        $sql = "SELECT * FROM project_setting WHERE plot_name = '$value'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch and display each row
            while ($row = mysqli_fetch_assoc($result)) {
                $imagePath = $row['img_path'];
                if (!empty($imagePath)) {
                    // Construct the full web URL for the image
                    $imageUrl = "http://localhost/php/images/" . basename($imagePath);
                    echo '<img src="' . $imageUrl . '" alt="Plot Image" height="160px" width="168px">';
                } else {
                    echo "Image not available";
                }

                echo "The available Plot Numbers are : " . $row['plot_number'] . "<br>";
                echo "The area of the Plot is : " . $row['plot_area'] . "<br>";
                echo "Rate per Square Feet is : " . $row['square_feet'] . "<br>";
                echo "Facing of this plot is : " . $row['facing'] . "<br>";
                echo "<br>";
                echo "<div style='margin-bottom: 5px;'></div>";
                // Display the "Would you like to buy?" message with yes/no buttons
                echo '<p id="buy-message" style="display: none;">Are you interested in buying this plot? <br><button class="buy-btn" id="yes-btn">Yes</button> <button class="buy-btn" id="no-btn">No</button></p>';
            }
            // JavaScript to display the message after a delay and handle "Yes" button click
            echo '<script>
                    setTimeout(function() { 
                        document.getElementById("buy-message").style.display = "block"; 
                    }, 1000);
                    // Event listener for "Yes" button
                    document.getElementById("yes-btn").addEventListener("click", function() {
                        // Check if plot number is entered
                        var plotNumber = document.getElementById("plot_number").value.trim();
                        if (plotNumber !== "") {
                            // Call showContactForm function
                            showContactForm();
                        } else {
                            alert("Please enter the plot number before proceeding.");
                        }
                    });

                    function showContactForm() {
                        // Create contact form HTML
                        var formHtml = \'<div id="contact-form-message"><br><p>Leave Your Contact Details</p><p>Great! Which plot number are you interested in buying?</p></div><div id="contact-form-box" style="display:none;"><br><form id="contact-details-form"><label for="name">Name:</label><br><input type="text" id="name" name="name"><br><label for="email">Email:</label><br><input type="email" id="email" name="email"><br><label for="mobile">Mobile Number:</label><br><input type="text" id="mobile" name="mobile"><br><br><button type="submit">Submit</button></form></div>\';
                        // Append form HTML inside the new text box
                        document.getElementById("buy-message").insertAdjacentHTML("afterend", formHtml);
                        // Show the contact form
                        document.getElementById("contact-form-box").style.display = "block";
                    }

                    function closeContactForm() {
                        // Hide the contact form and the message box
                        document.getElementById("contact-form-box").style.display = "none";
                        document.getElementById("contact-form-message").style.display = "none";
                    }
                </script>';
        } else {
            echo "No details found for the given input.";
        }
    }
} else {
    if (mysqli_error($conn)) {
        echo "Error executing query: " . mysqli_error($conn);
    } else {
        echo "No input received.";
    }
}
?>
