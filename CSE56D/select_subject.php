<!DOCTYPE html>
<html>
<head>
    <title>Select Quiz Subject</title>
    <link href="styles/quiz.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Select a Quiz Subject</h2>
        <form method="POST" action="quiz.php">
            <div class="form-group text-center">
                <select name="subject" required>
                    <option value="">Choose a subject</option>
                    <option value="Java">Java</option>
                    <option value="Python">Python</option>
                    <option value="C">C</option>
                    <option value="PHP">PHP</option>
                </select>
            </div>
            <div class="text-center">
                <input type="submit" class="btn-submit mt-4" value="Start Quiz">
            </div>
        </form>
    </div>
</body>
</html>
