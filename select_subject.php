<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Quiz Subject</title>
    <link href="styles/select_subject.css" rel="stylesheet">
</head>
<body>
    <div class="container animate-fade-in">
        <h2 class="title">Select a Quiz Subject</h2>
        <form method="POST" action="quiz.php">
            <div class="form-group animate-slide-up">
                <select name="subject" required>
                    <option value="" disabled selected>Choose a subject</option>
                    <option value="Java">Java</option>
                    <option value="Python">Python</option>
                    <option value="C">C</option>
                    <option value="PHP">PHP</option>
                </select>
            </div>
            <div class="form-actions animate-slide-up">
                <input type="submit" class="btn-submit" value="Start Quiz">
            </div>
        </form>
    </div>
</body>
</html>
