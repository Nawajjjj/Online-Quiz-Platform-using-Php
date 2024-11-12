<?php
include 'includes/db_connect.php';

$score = 0;
$questions = [];

// Fetch questions for scoring
$sql = "SELECT * FROM Questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[$row['id']] = $row;
    }
}

// Calculate score
foreach ($questions as $question) {
    $questionId = $question['id'];

    // Check if the posted answer for the current question exists
    if (isset($_POST["question_$questionId"])) {
        $userAnswer = $_POST["question_$questionId"];
        
        // Log the user's answer for debugging
        error_log("Question ID: $questionId, User Answer: $userAnswer");
        
        // Check if 'correct_answer' exists before accessing it
        if (!array_key_exists('correct_answer', $question)) {
            error_log("Missing correct_answer for question ID $questionId");
            continue; // Skip this question if 'correct_answer' is not set
        }

        // Compare the posted answer with the correct answer in the database
        if ($userAnswer === $question['correct_answer']) {
            $score++;
        }
    }
}


// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link href="styles/quiz.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Quiz Results</h2>
        <?php if (count($questions) > 0): ?>
            <p class="text-center">You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo count($questions); ?></strong></p>
        <?php else: ?>
            <p class="text-center">No questions found.</p>
        <?php endif; ?>
        <div class="text-center">
            <a href="select_subject.php" class="btn-submit mt-4">Take Another Quiz</a>
        </div>
    </div>
</body>
</html>
