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

// Fetch questions from the database
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form id='quizForm' action='results.php' method='post'>";

    // Loop through each question
    while ($row = $result->fetch_assoc()) {
        $questionId = $row['id'];
        $question = $row['question'];

        // Display question
        echo "<h3>$question</h3>";

        // Fetch options for this question
        $optionSql = "SELECT option1, option2, option3, option4 FROM options WHERE question_id = $questionId";
        $optionResult = $conn->query($optionSql);

        if ($optionResult->num_rows > 0) {
            $optionRow = $optionResult->fetch_assoc();

            // Display each option as a radio button
            echo "<input type='radio' name='answer_$questionId' value='option1'> {$optionRow['option1']}<br>";
            echo "<input type='radio' name='answer_$questionId' value='option2'> {$optionRow['option2']}<br>";
            echo "<input type='radio' name='answer_$questionId' value='option3'> {$optionRow['option3']}<br>";
            echo "<input type='radio' name='answer_$questionId' value='option4'> {$optionRow['option4']}<br><br>";
        } else {
            echo "Options not found for question ID $questionId.<br>";
        }
    }

    // Link that triggers the form submission
    echo "<a href='javascript:void(0)' onclick='submitForm()'><input type='button' value='Submit Quiz'></a>";
    echo "</form>";
} else {
    echo "No questions found.";
}

$conn->close();
?>

<script type="text/javascript">
    function submitForm() {
        // Submit the form using JavaScript
        document.getElementById("quizForm").submit();
    }
</script>
