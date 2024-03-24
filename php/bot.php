<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Chatbot</title> 
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        
        #plot-btn, #marketer-btn {
            background-color: #d7cfd3;
    color: black;
    padding: 1px 15px;
    border: none; /* Remove border */
    border-radius: 20px; /* Set border-radius to create oval shape */
    transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition for background color and text color changes */
    cursor: pointer;
    display: inline-block;
    margin-bottom: 10px;
    width: 150px;
    height: 50px;
    line-height: 20px; /* Center text vertically */
    text-align: center; /* Center text horizontally */
    text-decoration: none; /* Remove underline from links */
    font-weight: bold;

        }

        #marketer-btn{
            margin-top: 10px;
        }

        #plot-btn:hover, #marketer-btn:hover {
            background-color: #ea007b; 
            color: whitesmoke; 
        }
        #plot-btn,
#marketer-btn {
    border: 2px solid transparent; /* Ensure a consistent border width even when not hovered */
    transition: border-color 0.3s ease; /* Smooth transition for the border color change */
}

/* Example additional styling for the buttons */
#plot-btn {
    /* Your existing styles for the plot button */
}

#marketer-btn {
    /* Your existing styles for the apartment button */
}


        #yes-btn, #no-btn {
            background-color: #d7cfd3;
    color: black;
    padding: 1px 15px;
    border: none; /* Remove border */
    border-radius: 20px; /* Set border-radius to create oval shape */
    transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition for background color and text color changes */
    cursor: pointer;
    display: inline-block;
    margin-bottom: 10px;
    width: 150px;
    height: 50px;
    line-height: 20px; /* Center text vertically */
    text-align: center; /* Center text horizontally */
    text-decoration: none; /* Remove underline from links */
    font-weight: bold;

        }

        #no-btn {
            margin-left: 10px; /* Add margin-left instead of margin-top */
        }

        #yes-btn:hover, #no-btn:hover {
            background-color: #ea007b; 
            color: whitesmoke; 
        }
        

        .button:active {
    background-color: #ffbf00;
}

        .form .inbox .msg-header p{
    color: #fff;
    background: #ea007b;
    border-radius: 10px;
    padding: 8px 5px;

    font-size: 14px;
    word-break:auto-phrase;
}

        /* Your existing CSS styles */

        /* Style for the button */
        #start-conversation-btn {
            background-color: #ea007b;
            color: #fff;
            padding: 8px 10px;
            border: none;
            border-radius: 120px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 2px;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        #start-conversation-btn:hover {
            background-color: #d7cfd3;
            color: black; 
        }
        .typing-indicator {
    color: black;
    font-size: 15px;
    font-weight: bold;
    font-family: 'Roboto', sans-serif;
    display: inline-block;
}

.dot {
    display: inline-block;
    width: 6px;
    height: 6px;
    margin-right: 2px; /* Adjust as needed for spacing */
    background-color: black;
    border-radius: 50%;
    animation: dotBlink 1.5s infinite;
}

.dot:nth-child(2) {
    animation-delay: 0.2s;
}

.dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes dotBlink {
    0%, 20%, 80%, 100% {
        opacity: 0;
    }
    40% {
        opacity: 1;
    }
}


    .form .inbox .msg-header p{
    color: black;
    background: #efefef;
    border-radius: 5px;
    padding: 8px 5px;

    font-size: 14px;
    word-break:auto-phrase;
    animation: slideIn 0.5s ease forwards;
    box-shadow: 2px 5px 5px slategrey;
}
@keyframes slideIn {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.form .user-inbox .msg-header p{
    color: white;
    background: #ea007b;
}

.location-btn {
    background-color: #d7cfd3;
    color: black;
    padding: 1px 15px;
    border: none; /* Remove border */
    border-radius: 20px; /* Set border-radius to create oval shape */
    transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition for background color and text color changes */
    cursor: pointer;
    display: inline-block;
    margin-bottom: 10px;
    width: 150px;
    height: 50px;
    line-height: 20px; /* Center text vertically */
    text-align: center; /* Center text horizontally */
    text-decoration: none; /* Remove underline from links */
    font-weight: bold;
}

.location-btn:hover {
    background-color: #ea007b;
}



        
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="title">
            <h4 class="text-sans-serif mb-0" style="color: var(--white); font-weight: bold;">AI Assistant</h4>
        </div>
        
        <div class="form">
            <div class="bot-inbox inbox">
                <!-- <div class="icon">
                    <i class="fas fa-robot"></i>
                </div> -->
                <div class="msg-header">
                    <!-- Initial message -->
                    
                </div>
            </div>
        </div>
        <div id="buyMessage"></div>
        <div class="typing-field" id="start-conversation-container">
            <!-- Start new conversation button -->
            <button id="start-conversation-btn">Start New Conversation</button>
        </div>
    </div>

    <script>
function sendMessage() {
    var value = $("#plot-btn").val();
    
    var msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ value +'</p></div></div>';
    $(".form").append(msg);
    $("#plot-btn").val();
    
    // Simulate AI thinking before replying
    setTimeout(function() {
        // Add typing indicator after delay
        var typingIndicator = '<div class="typing-indicator">\
    <span class="dot"></span>\
    <span class="dot"></span>\
    <span class="dot"></span>\
</div>';

        $(".form").append(typingIndicator);

        // Simulate AI typing
        setTimeout(function() {
            // Remove typing indicator
            $(".typing-indicator").remove();

            // AJAX call to get AI's response
            $.ajax({
                url: 'allplot.php',
                type: 'POST',
                data: { text: value },
                success: function(result) {
                    (value);
                    /*var replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                    $(".form").append(replay);
                    $(".form").scrollTop($(".form")[0].scrollHeight);*/

                    // If user is interested in buying a plot
                    if (value.toLowerCase() === 'buy a plot') {
                        // Bot replies with acknowledgment and inquiry about location
                        // Bot replies with acknowledgment and inquiry about location


// Add delay before appending the first message
// Add delay before appending the first message
setTimeout(function() {
    // Add typing indicator after delay
    var typingIndicator = '<div class="typing-indicator">\
    <span class="dot"></span>\
    <span class="dot"></span>\
    <span class="dot"></span>\
</div>';
$(".form").append(typingIndicator);

// Bot replies with acknowledgment and inquiry about location
var reply1 = '<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><p>Definitely, we can help you with it. 😊</p></div></div>';
$(".form").append(reply1);
$(".form").scrollTop($(".form")[0].scrollHeight);


    // Remove typing indicator after message is appended
   setTimeout(function() {
    $(".typing-indicator").remove();

    // Bot replies with acknowledgment about the financial commitment
    var typingIndicator = '<div class="typing-indicator">\
        <span class="dot"></span>\
        <span class="dot"></span>\
        <span class="dot"></span>\
    </div>';
    $(".form").append(typingIndicator);

    var reply2 = '<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><p>We understand that buying a plot is one of the biggest financial commitments and hassle tasks. 🏘</p></div></div>';

    // Add delay before appending the second message
    setTimeout(function() {
        $(".typing-indicator").remove();
        $(".form").append(reply2);
        $(".form").scrollTop($(".form")[0].scrollHeight);

            // Bot asks for the location
            var typingIndicator = '<div class="typing-indicator">\
    <span class="dot"></span>\
    <span class="dot"></span>\
    <span class="dot"></span>\
</div>';
            $(".form").append(typingIndicator3);

            //var reply3 = '<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><br><p>would you like to see our plots?<button id="yes-btn" class="yes-btn">Yes</button><button id="no-btn" class="no-btn">No</button></p></div></div>';
            var reply3 = '<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><br><p>What would you like to see our plots? <br><button id="yes-btn" class="yes">yes</button><button id="no-btn"class="no-btn">no</button></p></div></div>';



            // Add delay before appending the third message
            setTimeout(function() {
                $(".typing-indicator").remove();
                $(".form").append(reply3);
                $(".form").scrollTop($(".form")[0].scrollHeight);
            }, 5000); // Adjust the delay as needed for the third message
        }, 1000); // Adjust the delay as needed for the second message
    },500); // Adjust the delay as needed for the first message
}, 0); // Adjust the delay as needed for the initial typing indicator


                        $(".form").append(reply1);
                        $(".form").append(reply2);
                        $(".form").append(reply3);
                        $(".form").scrollTop($(".form")[0].scrollHeight);

                        // Bind event for location buttons
                        $("#pondy-btn").on("click", function(){
                            sendMessageWithLocation('Pondy');
                        });
                        $("#ecr-btn").on("click", function(){
                            sendMessageWithLocation('ECR');
                        });
                        $("#adayar-btn").on("click", function(){
                            sendMessageWithLocation('Adayar');
                        });
                        $("#kanchipuram-btn").on("click", function(){
                            sendMessageWithLocation('Kanchipuram');
                        });
                        $("#chengalpattu-btn").on("click", function(){
                            sendMessageWithLocation('Chengalpattu');
                        });
                    }
                }
            });
        }, 2000); // 5-second delay before AI types
    }, 1000); // 1-second delay after user's message
}

function fetchLocationsFromDatabase() {
    // Implement this function to fetch locations from your database
}

function generateLocationButtons(locations) {
    var buttonsHTML = '<div class="options">';
    locations.forEach(location => {
        buttonsHTML += `<button class="btn location-btn">${location}</button>`;
    });
    buttonsHTML += '</div>';
    return buttonsHTML;
}

function sendMessageWithLocation(location) {
    // Bot confirms selected location
    var reply = '<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><p>You have selected ' + location + '.</p></div></div>';
    $(".form").append(reply);
    $(".form").scrollTop($(".form")[0].scrollHeight);
    // You can proceed with further actions based on the selected location
}

function startConversation() {
    // Remove the start conversation button
    $("#start-conversation-btn").remove();

    // Simulate AI thinking before replying
    setTimeout(function() {
        // Add typing indicator after delay
      var typingIndicator = '<div class="typing-indicator">\
    <span class="dot"></span>\
    <span class="dot"></span>\
    <span class="dot"></span>\
</div>';
        $(".form").append(typingIndicator);

        // Simulate AI typing
        setTimeout(function() {
            // Remove typing indicator
            $(".typing-indicator").remove();

            // Add AI's message
            var aiMessage = '<div class="bot-inbox inbox"><div class="icon"><i class="fa-solid fa-robot"></i></div><div class="msg-header"><p>Hello! Welcome to <strong>Brindhavanam Estate operations</strong>👋.</p><br><p>What would you like to do? <br><button id="plot-btn" value="Buy a Plot">Buy a Plot</button><button id="marketer-btn">Know about marketers</button></p></div></div>';


            $(".form").append(aiMessage);
            $(".form").scrollTop($(".form")[0].scrollHeight);

            // Bind event for the plot button
            $("#plot-btn").on("click", function(){
                // Log the value of the input field
                console.log($("#plot-btn").val());

                // Set the value of the input field to 'buy a plot'
                $("#plot-btn").val();

                // Trigger sendMessage()
                sendMessage();
            });

            // Bind event for the marketer button
            $("#marketer-btn").on("click", function(){
                // Set the value of the input field to 'marketer'
                $("#data").val('marketer');

                // Trigger sendMessage()
                sendMessage();
            });

            // Bring back the typing field
            var typingField = '<div class="input-data"><input id="data" type="text" name="text" placeholder="Type something here..." required><button id="send-btn"><i class="fas fa-paper-plane"></i></button></div>';
            $(".typing-field").html(typingField);

            // Bind events for sending message
            $("#send-btn").on("click", function(){
                sendMessage();
            });

            $("#data").keypress(function(event) {
                if (event.which === 13) {
                    sendMessage();
                }
            });
        }, 2000); // 5-second delay before AI types
    }, 700);
}

$(document).ready(function(){
    $("#send-btn").on("click", function(){
        sendMessage();
    });

    $("#data").keypress(function(event) {
        if (event.which === 13) {
            sendMessage();
        }
    });

    $("#start-conversation-btn").on("click", function(){
        startConversation();
    });
});


</script>
</body>
</html>