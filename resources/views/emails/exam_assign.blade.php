<!DOCTYPE html>
<html>
<head>
    <title>Your Exam Assigned</title>
</head>
<body>
    <h1>Exam Assigned</h1>
    <p>Dear {{ $exam->user->name }},</p>
    <p>Your exam has been assigned successfully. Here are the details:</p>
    <ul>
        <li>Exam Name: {{ $exam->paper->name ?? '' }}</li>
        <li>Exam Date: {{ $exam->from_date  }}</li>
    </ul>

    <p>Thank you for participating in the exam.</p>
</body>
</html>
