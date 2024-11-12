<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'quizz_platform'); // Updated database name

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the questions from the database
$sql = "SELECT * FROM questions"; // Assuming the table name is `questions`
$result = $conn->query($sql);
?>

<form action="results.php" method="POST">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div>
            <p><?php echo $row['question_text']; ?></p>
            <input type="radio" name="question_<?php echo $row['question_id']; ?>" value="1"> <?php echo $row['option1']; ?><br>
            <input type="radio" name="question_<?php echo $row['question_id']; ?>" value="2"> <?php echo $row['option2']; ?><br>
            <input type="radio" name="question_<?php echo $row['question_id']; ?>" value="3"> <?php echo $row['option3']; ?><br>
            <input type="radio" name="question_<?php echo $row['question_id']; ?>" value="4"> <?php echo $row['option4']; ?><br>
        </div>
    <?php } ?>
    <input type="submit" value="Submit">
</form>

<?php
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz on <?php echo htmlspecialchars($subject); ?></title>
    <link href="styles/quiz.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Quiz on <?php echo htmlspecialchars($subject); ?>!</h2>
        <form method="POST" action="results.php">
            <!-- Hidden input to pass the subject to results.php -->
            <input type="hidden" name="subject" value="<?php echo htmlspecialchars($subject); ?>">

            <?php foreach ($questions as $index => $question): ?>
                <div class="question-container">
                    <p><strong><?php echo ($index + 1) . ". " . htmlspecialchars($question['question']); ?></strong></p>

                    <!-- Radio Buttons for Options -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?php echo $question['id']; ?>" value="option1" required>
                        <label class="form-check-label"><?php echo htmlspecialchars($question['option1']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?php echo $question['id']; ?>" value="option2">
                        <label class="form-check-label"><?php echo htmlspecialchars($question['option2']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?php echo $question['id']; ?>" value="option3">
                        <label class="form-check-label"><?php echo htmlspecialchars($question['option3']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?php echo $question['id']; ?>" value="option4">
                        <label class="form-check-label"><?php echo htmlspecialchars($question['option4']); ?></label>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center">
                <input type="submit" class="btn-submit mt-4" value="Submit">
            </div>
        </form>
    </div>

    <?php $conn->close(); // Close the connection after all HTML content ?>
</body>
</html>

