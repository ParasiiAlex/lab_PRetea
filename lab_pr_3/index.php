<html>
<head lang="en">
    <title>Lab 3 PR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container h4">
    <form action="http://localhost/lab_pr_3/index-action.php/" method="post">
        <input type="hidden" name="method" value="get">
        <input type="submit" class="btn btn-lg btn-primary" value="GET authentication">
    </form>
    <form action="http://localhost/lab_pr_3/index-action.php/" method="post">
        <input type="hidden" name="method" value="post">
        <input type="submit" class="btn btn-lg btn-warning" value="POST authentication">
    </form>
</div>
</body>
</html>