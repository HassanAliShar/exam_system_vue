<!DOCTYPE html>
<html>
<head>
    <title>Your Exam Result</title>
</head>
<body>
    <h1>Exam Result</h1>
    <p>Dear {{ $result->user->name }},</p>
    <p>Your exam has been submitted successfully. Here are your results:</p>
    <ul>
        <li>Exam Name: {{ $result->paper->name }}</li>
        <li>Total Marks: {{ $result->paper->total_marks }}</li>
        <li>Obtained Marks: {{ $result->obtained_marks }}</li>
        <li>Correct Answers: {{ $result->correct_answer }}</li>
        <li>Wrong Answers: {{ $result->wrong_answer }}</li>
        <li>Percentage: {{ $result->percentage }}%</li>
        <li>Result: {{ $result->status }}</li>
    </ul>
    <p>Thank you for participating in the exam.</p>
</body>
</html>
