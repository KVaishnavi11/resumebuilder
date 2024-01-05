<!-- template_selection.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Selection</title>
    <link rel="stylesheet" href="template_selection_style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Choose a Template</h1>
        <form action="resume_template.php" method="post">
            <input type="radio" name="template" value="template1"> Template 1
            <input type="radio" name="template" value="template2"> Template 2
            <input type="submit" name="submit" value="Select Template">
        </form>
    </div>
</body>
</html>
