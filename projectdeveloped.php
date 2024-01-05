<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Developed</title>
    <link rel="stylesheet" href="projectdevelopedstyle.css"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
    <?php
        session_start();
        $host = "localhost";
        $dbuser = "root";
        $bdpassword = "";
        $dbname = "login_register";
        $conn = mysqli_connect($host, $dbuser, $bdpassword, $dbname);

        if (!$conn) {
            die("Something went wrong");
        }

        $email = mysqli_real_escape_string($conn, $_SESSION["email"]);
        $query2 = "SELECT id FROM users WHERE email='$email' ";
        $result = mysqli_query($conn, $query2);

        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        if ($row) {
            $userId = $row['id'];

            if (isset($_POST["submit"])) {
                $title1 = $_POST["title1"];
                $link1 = $_POST["link1"];
                $description1 = $_POST["description1"];
                $title2 = $_POST["title2"];
                $link2 = $_POST["link2"];
                $description2 = $_POST["description2"];
               

                $errors = array();

                // Your validation code here

                if (count($errors) > 0) {
                    foreach ($errors as $errors) {
                        echo "<div class='alert alert-danger'>$errors</div>";
                    }
                } else {
                    // Check if the user already has an entry
                    $checkQuery = "SELECT user_id FROM project_developed WHERE user_id='$userId'";
                    $checkResult = mysqli_query($conn, $checkQuery);

                    if (!$checkResult) {
                        die("Error: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($checkResult) > 0) {
                        // User already has an entry, update the existing record
                        $updateQuery = "UPDATE project-developed SET title1=?, link1=?, description1=?, title2=?, link2=?, description2=?, WHERE user_id=?";
                        $updateStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($updateStmt, $updateQuery)) {
                            mysqli_stmt_bind_param($updateStmt, "ssssssi", $title1, $link1, $description1, $title2, $link2, $description2,  $userId);

                            if (mysqli_stmt_execute($updateStmt)) {
                                echo "<div class='alert alert-success'>Your data was updated successfully. Please fill in the next details</div>";
                            } else {
                                die("Something went wrong");
                            }
                        } else {
                            die("Something went wrong");
                        }
                    } else {
                        // User does not have an entry, insert a new record
                        $insertQuery = "INSERT INTO project_developed (user_id, title1, link1, description1, title2, link2, description2) VALUES (?,?,?,?,?,?,?)";
                        $insertStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($insertStmt, $insertQuery)) {
                            mysqli_stmt_bind_param($insertStmt, "issssss", $userId, $title1, $link1, $description1, $title2, $link2,$description2);

                            if (mysqli_stmt_execute($insertStmt)) {
                                echo "<div class='alert alert-success'>Your data was submitted successfully. Please fill in the next details</div>";
                            } else {
                                die("Something went wrong");
                            }
                        } else {
                            die("Something went wrong");
                        }
                    }
                }
            }

            // Fetch existing user data
            $query3 = "SELECT title1, link1, description1, title2, link2, description2 FROM project_developed WHERE user_id='$userId'";
            $result = mysqli_query($conn, $query3);

            if ($result) {
                $userData = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
            } else {
                die("Error: " . mysqli_error($conn));
            }
        } else {
            echo "No records found for the given email.";
        }

        mysqli_close($conn);
        ?>
        <form action="projectdeveloped.php" method=post>
            <h1>Project Developed</h1>

            <div class="input-box">
                  <h3><i class='bx bxs-badge-check'></i>Project 1</h3>
            </div>
            
            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Title" name="title1" value="<?php echo isset($userData['title1']) ? $userData['title1'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Link" name="link1" value="<?php echo isset($userData['link1']) ? $userData['link1'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Description" name="description1" value="<?php echo isset($userData['description1']) ? $userData['description1'] : ''; ?>">
                </div>
            </div>

           
            <div class="input-box">
                    <h3><i class='bx bxs-badge-check'></i>Project 2</h3>
            </div>
            
            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Title" name="title2" value="<?php echo isset($userData['title2']) ? $userData['title2'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Link" name="link2" value="<?php echo isset($userData['link2']) ? $userData['link2'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Description" name="description2" value="<?php echo isset($userData['description2']) ? $userData['description2'] : ''; ?>">
                </div>
            </div>

           
    
            <div class="btn">

            <button class="button1" type="">Back</button>
            <button class="button2" type="Submit" name="submit">Next</button>
            </div>
            
            
        </form>
    </div>
</body>
</html>