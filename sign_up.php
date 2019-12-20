<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="register.php" method = "POST">
            <p>username:<input type="text" name="username" required></p>
            <p>password:<input type="password" name = "password" required></p>
            <p>confirm password:<input type="password" name="cpassword" required></p>
            <p>fullname:<input type="text" name="fullname" required></p>
            <p>role:<input type="radio" name = "role" value="student" required>Student
            <input type="radio" name = "role" value="staff" required>Staff</p>
            <button type = "submit">Sign Up</button>
        </form>
    </div>
</body>
</html>