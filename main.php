<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .dashboard-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-10px);
        }

        .dashboard-card h3 {
            color: #007BFF;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .dashboard-card p {
            color: #555;
            font-size: 16px;
        }

        .card-button {
            display: block;
            text-align: center;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .card-button:hover {
            background-color: #218838;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
            margin-top: 50px;
        }

        .footer a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>

<body>

    <header>
        <h1>Attendance System Dashboard</h1>
    </header>

    <div class="container">
        <h2>Welcome to the Attendance Management System</h2>

        <div class="grid-container">

            <!-- View Timetable -->
            <div class="dashboard-card">
                <h3>View Timetable</h3>
                <p>Check your class schedule for the upcoming week. Stay organized and plan ahead!</p>
                <a href="#" class="card-button">View Timetable</a>
            </div>

            <!-- Class Information -->
            <div class="dashboard-card">
                <h3>Class Information</h3>
                <p>View details about your classes, including timings, instructors, and more.</p>
                <a href="#" class="card-button">View Class Info</a>
            </div>

            <!-- Course Information -->
            <div class="dashboard-card">
                <h3>Course Information</h3>
                <p>Access course materials, assignments, and your progress in each course.</p>
                <a href="#" class="card-button">View Courses</a>
            </div>
            
            <!-- Student Information -->
            <div class="dashboard-card">
                <h3>Student Information</h3>
                <p>View personal information, academic records, and progress in your studies.</p>
                <a href="#" class="card-button">View Student Info</a>
            </div>

            <!-- Attendance Report -->
            <div class="dashboard-card">
                <h3>Attendance Report</h3>
                <p>View and generate reports for attendance history in each class and session.</p>
                <a href="#" class="card-button">View Attendance</a>
            </div>

            <!-- Restore Attendance -->
            <div class="dashboard-card">
                <h3>Restore Attendance</h3>
                <p>Restore missed attendance records for any session, if required.</p>
                <a href="#" class="card-button">Restore Attendance</a>
            </div>

        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Attendance Management System. <a href="#">Contact Us</a></p>
    </div>

</body>

</html>
