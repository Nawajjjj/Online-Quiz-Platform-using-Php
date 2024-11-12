<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz_platform";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';

    // Prepare the SQL query to fetch questions based on the subject
    $query = "SELECT * FROM questions WHERE subject = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $subject); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Initialize $questions array to store questions
        $questions = [];
        
        // Fetch the questions
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row; 
        }
        
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="styles/results.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>Quiz Results for <?php echo htmlspecialchars($subject); ?></h1>
            <p>Here's how you performed in your quiz!</p>
        </header>

        <?php if (isset($questions) && count($questions) > 0): ?>
            <?php 
                $score = 0; // Initialize score
                // Loop through questions and check answers
                foreach ($questions as $question):
                    $selected_answer = isset($_POST['question_' . $question['id']]) ? $_POST['question_' . $question['id']] : '';
                    $correct_answer = $question['correct_option'];
                    if ($selected_answer === $correct_answer) {
                        $score++;
                    }
                endforeach;
            ?>
            
            <div class="results-summary">
                <h2>Your Total Score:</h2>
                <p><?php echo $score . ' / ' . count($questions); ?></p>
                <p class="message">Great job! Keep up the good work!</p>
            </div>

            <div class="buttons">
                <a href="retry_quiz.php" class="button retry">Retry Quiz</a>
                <a href="index.php" class="button home">Go to Homepage</a>
            </div>
        <?php else: ?>
            <p>No questions found for this subject.</p>
        <?php endif; ?>
    </div>

</body>
</html>

<?php
$conn->close(); // Close the connection at the end
?>
