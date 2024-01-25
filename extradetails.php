<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extra Details</title>
    <link rel="stylesheet" href="extradetailsstyle.css"> 
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
                $skill1 = $_POST["skill1"];
                $skill2 = $_POST["skill2"];
                $skill3 = $_POST["skill3"];
                $skill4 = $_POST["skill4"];
                $skill5 = $_POST["skill5"];
                $skill6 = $_POST["skill6"];
                $interest1 = $_POST["interest1"];
                $interest2 = $_POST["interest2"];
                $interest3 = $_POST["interest3"];
                $interest4 = $_POST["interest4"];
                $interest5 = $_POST["interest5"];
                $interest6 = $_POST["interest6"];
                $objective = $_POST["objective"];

                $errors = array();

                // Your validation code here

                if (count($errors) > 0) {
                    foreach ($errors as $errors) {
                        echo "<div class='alert alert-danger'>$errors</div>";
                    }
                } else {
                    // Check if the user already has an entry
                    $checkQuery = "SELECT user_id FROM extra_details WHERE user_id='$userId'";
                    $checkResult = mysqli_query($conn, $checkQuery);

                    if (!$checkResult) {
                        die("Error: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($checkResult) > 0) {
                        // User already has an entry, update the existing record
                        $updateQuery = "UPDATE extra_details SET skill1=?, skill2=?, skill3=?, skill4=?, skill5=?, skill6=?, interest1=?, interest2=?, interest3=?, interest4=?, interest5=?, interest6=?, objective=? WHERE user_id=?";
                        $updateStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($updateStmt, $updateQuery)) {
                            mysqli_stmt_bind_param($updateStmt, "sssssssssssssi", $skill1, $skill2, $skill3, $skill4, $skill5, $skill6, $interest1, $interest2, $interest3, $interest4, $interest5,$interest6,$objective, $userId);

                            if (mysqli_stmt_execute($updateStmt)) {
                                echo "<div class='alert alert-success'>Your data was updated successfully. Please fill in the next details</div>";
                                header("Location: projectdeveloped.php");
                            
                            } else {
                                die("Something went wrong");
                            }
                        } else {
                            die("Something went wrong");
                        }
                    } else {
                        // User does not have an entry, insert a new record
                        $insertQuery = "INSERT INTO extra_details (user_id, skill1, skill2, skill3, skill4, skill5, skill6, interest1, interest2, interest3, interest4, interest5, interest6, objective) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                        $insertStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($insertStmt, $insertQuery)) {
                            mysqli_stmt_bind_param($insertStmt, "isssssssssssss", $userId, $skill1, $skill2, $skill3, $skill4, $skill5, $skill6, $interest1, $interest2, $interest3, $interest4, $interest5, $interest6, $objective);

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
            $query3 = "SELECT skill1, skill2, skill3, skill4, skill5, skill6, interest1, interest2, interest3, interest4, interest5, interest6, objective FROM extra_details WHERE user_id='$userId'";
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
        <form action="extradetails.php" method=post>
        <div class="logout">
              <div><a href="login.php"><i class='bx bx-log-out' ></i><a></div>
              <div><a href="login.php">Logout</a></div>
            </div>
            <h1>Extra Details</h1>

            <div class="input-box">
                  <h3><i class='bx bxs-badge-check'></i>Skills/Languages</h3>
            </div>
            
            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Skill 1" name="skill1" value="<?php echo isset($userData['skill1']) ? $userData['skill1'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Skill 2" name="skill2" value="<?php echo isset($userData['skill2']) ? $userData['skill2'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Skill 3" name="skill3" value="<?php echo isset($userData['skill3']) ? $userData['skill3'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Skill 4" name="skill4" value="<?php echo isset($userData['skill4']) ? $userData['skill4'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Skill 5" name="skill5" value="<?php echo isset($userData['skill5']) ? $userData['skill5'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Skill 6" name="skill6" value="<?php echo isset($userData['skill6']) ? $userData['skill6'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                    <h3><i class='bx bxs-badge-check'></i>Interest</h3>
            </div>
            
            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Interest" name="interest1" value="<?php echo isset($userData['interest1']) ? $userData['interest1'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Interest" name="interest2" value="<?php echo isset($userData['interest2']) ? $userData['interest2'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Interest" name="interest3" value="<?php echo isset($userData['interest3']) ? $userData['interest3'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Interest" name="interest4" value="<?php echo isset($userData['interest4']) ? $userData['interest4'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Interest" name="interest5" value="<?php echo isset($userData['interest5']) ? $userData['interest5'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Interest" name="interest6" value="<?php echo isset($userData['interest6']) ? $userData['interest6'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                    <h3><i class='bx bxs-badge-check'></i>Objectives</h3>
            </div>
            
            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Please describe yourself in shorts word" name="objective" value="<?php echo isset($userData['objective']) ? $userData['objective'] : ''; ?>">
                </div>
            </div>
    
            <div class="btn">

            <button class="button1" type="back" name="back"><a href="educationaldetails.php">Back </a></button>

            <button class="button2" type="Submit" name="submit">Next</button>
            </div>
            
            
        </form>
    </div>
</body>
</html>