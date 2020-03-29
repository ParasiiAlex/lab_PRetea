<html>
<head lang="en">
    <title>Lab 3 PR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container h4 mt-5">
    <hr class="mt-5" style="border-top: 1px solid #a4aca9">
    <form action="http://localhost/lab_pr_3/server-script.php/" method="post">
        <label for="username">Username:</label>
        <input type="text" class="form-control col-4" id="username" name="username" required>
        <label for="password" class="mt-4">Password:</label>
        <input type="text" class="form-control col-4" id="password" name="password" required>
        <input type="submit" class="btn btn-warning form-control col-4 mt-4">
    </form>
    <hr class="mt-5" style="border-top: 1px solid #a4aca9">
</div>
</body>
</html>