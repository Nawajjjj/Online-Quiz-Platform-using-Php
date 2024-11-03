<?php
include 'includes/db_connect.php';

// Check if the subject is set
if (isset($_POST['subject'])) {
    $subject = $_POST['subject'];

    // Fetch questions from the database based on the selected subject
    $sql = "SELECT * FROM Questions WHERE subject = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $subject);
    $stmt->execute();
    $result = $stmt->get_result();

    $questions = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
    }
} else {
    // Redirect back to subject selection if no subject is chosen
    header("Location: select_subject.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz on <?php echo htmlspecialchars($subject); ?></title>
    <link href="styles/quiz.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Quiz on <?php echo htmlspecialchars($subject); ?>!</h2>
        <form method="POST" action="results.php">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question-container">
                    <p><strong><?php echo ($index + 1) . ". " . $question['question']; ?></strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?php echo $question['id']; ?>" value="option1" required>
                        <label class="form-check-label"><?php echo $question['option1']; ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?php echo $question['id']; ?>" value="option2">
                        <label class="form-check-label"><?php echo $question['option2']; ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?php echo $question['id']; ?>" value="option3">
                        <label class="form-check-label"><?php echo $question['option3']; ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?php echo $question['id']; ?>" value="option4">
                        <label class="form-check-label"><?php echo $question['option4']; ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="text-center">
                <input type="submit" class="btn-submit mt-4" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>

<?php $stmt->close(); $conn->close(); ?>
