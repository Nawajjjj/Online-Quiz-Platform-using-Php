<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz_platform";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize score and other variables
$score = 0;
$totalQuestions = 0;

// Fetch all questions
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each question to process the user's answers
    while ($row = $result->fetch_assoc()) {
        $questionId = $row['id'];
        $userAnswer = $_POST['answer_' . $questionId]; // User's submitted answer

        // Fetch correct option from the options table
        $optionSql = "SELECT correct_option FROM options WHERE question_id = $questionId";
        $optionResult = $conn->query($optionSql);

        if ($optionResult->num_rows > 0) {
            $optionRow = $optionResult->fetch_assoc();
            $correctOption = $optionRow['correct_option'];  // Correct answer for this question

            // Compare user's answer with the correct answer
            if ($userAnswer == $correctOption) {
                $score++; // Increment score if the answer is correct
            }

            // Increase total questions counter
            $totalQuestions++;
        }
    }

    // Display the result summary
    echo "<div class='result-container'>";
    echo "<h2 class='result-header'>Quiz Results</h2>";
    echo "<p class='score'>Your final score is: <strong>$score</strong> out of <strong>$totalQuestions</strong></p>";

    // Display feedback based on the score
    if ($score == $totalQuestions) {
        echo "<p class='feedback excellent'>Excellent! You got all the answers right!</p>";
    } elseif ($score >= $totalQuestions / 2) {
        echo "<p class='feedback good'>Good job! You passed the quiz.</p>";
    } else {
        echo "<p class='feedback try-again'>Better luck next time! Keep practicing.</p>";
    }

    // Optionally, add a button to allow users to retake the quiz or view a summary
    echo "<a href='quiz.php'><button class='retake-btn'>Retake Quiz</button></a>";
    echo "</div>";

} else {
    echo "No questions found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <style>
        /* Basic Styling for the Results Page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Container for the result content */
        .result-container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        /* Header style for the result page */
        .result-header {
            font-size: 2.5em;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            animation: slideInFromTop 1s ease-out;
        }

        /* Styling for the score */
        .score {
            font-size: 1.5em;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            animation: slideInFromLeft 1s ease-out;
        }

        /* Feedback messages */
        .feedback {
            font-size: 1.2em;
            text-align: center;
            margin-top: 20px;
            opacity: 0;
            animation: fadeIn 1s 0.5s forwards;
        }

        /* Color coding for feedback */
        .excellent {
            color: green;
        }

        .good {
            color: #007BFF;
        }

        .try-again {
            color: #FF5722;
        }

        /* Button for retaking the quiz */
        .retake-btn {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 10px 0;
            background-color: #28a745;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.1em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .retake-btn:hover {
            background-color: #218838;
            transform: scale(1.1);
        }

        .retake-btn:active {
            transform: scale(1);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInFromLeft {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
</body>
</html>
