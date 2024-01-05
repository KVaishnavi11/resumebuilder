<!-- resume_template.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Template</title>
    <?php
    $selectedTemplate = isset($_POST['template']) ? $_POST['template'] : '';
    $templateFile = $selectedTemplate . '_template.html';

    if (file_exists($templateFile)) {
        $templateContent = file_get_contents($templateFile);
        echo $templateContent;
    } else {
        echo 'Selected template not found.';
    }
    ?>
</head>
<body>
    <div class="wrapper">
        <?php
        // Load user data from the database
        // ...

        // Replace placeholders in the template with user data
        // ...
        ?>
    </div>
</body>
</html>
