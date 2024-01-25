<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experience Details</title>
    <link rel="stylesheet" href="experiencedetailsstyle.css"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
    <?php
        session_start();
        if (!isset($_SESSION["email"])) {
            // Redirect to the login page
            header("Location: login.php");
            exit();
        }
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
                $organisation1 = $_POST["organisation1"];
                $position1 = $_POST["position1"];
                $duration1 = $_POST["duration1"];
                $description1 = $_POST["description1"];
                $organisation2 = $_POST["organisation2"];
                $position2 = $_POST["position2"];
                $duration2 = $_POST["duration2"];
                $description2 = $_POST["description2"];
                
               

                $errors = array();

                // Your validation code here

                if (count($errors) > 0) {
                    foreach ($errors as $errors) {
                        echo "<div class='alert alert-danger'>$errors</div>";
                    }
                } else {
                    // Check if the user already has an entry
                    $checkQuery = "SELECT user_id FROM exp_details WHERE user_id='$userId'";
                    $checkResult = mysqli_query($conn, $checkQuery);

                    if (!$checkResult) {
                        die("Error: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($checkResult) > 0) {
                        // User already has an entry, update the existing record
                        $updateQuery = "UPDATE exp_details SET organisation1=?, position1=?, duration1=?, description1=?, organisation2=?, position2=?, duration2=?, description2=? WHERE user_id=?";
                        $updateStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($updateStmt, $updateQuery)) {
                            mysqli_stmt_bind_param($updateStmt, "ssssssssi", $organisation1, $position1, $duration1, $description1, $organisation2, $position2, $duration2, $description2, $userId);

                            if (mysqli_stmt_execute($updateStmt)) {
                                echo "<div class='alert alert-success'>Your data was updated successfully. Please fill in the next details</div>";
                                header("Location: resume1.php");
                            } else {
                                die("Something went wrong");
                            }
                        } else {
                            die("Something went wrong");
                        }
                    } else {
                        // User does not have an entry, insert a new record
                        $insertQuery = "INSERT INTO exp_details (user_id, organisation1, position1, duration1, description1, organisation2, position2, duration2, description2) VALUES (?,?,?,?,?,?,?,?,?)";
                        $insertStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($insertStmt, $insertQuery)) {
                            mysqli_stmt_bind_param($insertStmt, "issssssss", $userId, $organisation1, $position1, $duration1, $description1, $organisation2, $position2, $duration2, $description2);

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
            $query3 = "SELECT organisation1, position1, duration1, description1, organisation2, position2, duration2, description2 FROM exp_details WHERE user_id='$userId'";
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
        <form action="experiencedetails.php" method=post>
        <div class="logout">
    <div><a href="logout.php"><i class='bx bx-log-out'></i></a></div>
    <div><a href="logout.php">Logout</a></div>
</div>
            
            <h1>Experience Details</h1>

            <div class="input-box">
                  <h3><i class='bx bxs-badge-check'></i>Experience 1</h3>
            </div>
            
            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Institute/Organisation" name="organisation1" value="<?php echo isset($userData['organisation1']) ? $userData['organisation1'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Position" name="position1" value="<?php echo isset($userData['position1']) ? $userData['position1'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Duration" name="duration1" value="<?php echo isset($userData['duration1']) ? $userData['duration1'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Desciption" name="description1" value="<?php echo isset($userData['description1']) ? $userData['description1'] : ''; ?>">
                </div>
               
            </div>

            <div class="input-box">
                    <h3><i class='bx bxs-badge-check'></i>Experience 2</h3>
            </div>
            
            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Institute/Organisation" name="organisation2" value="<?php echo isset($userData['organisation2']) ? $userData['organisation2'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Position" name="position2" value="<?php echo isset($userData['position2']) ? $userData['position2'] : ''; ?>">
                </div>
                <div class="col-50">
                    <input type="text" placeholder="Duration" name="duration2" value="<?php echo isset($userData['duration2']) ? $userData['duration2'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <input type="text" placeholder="Description" name="description2" value="<?php echo isset($userData['description2']) ? $userData['description2'] : ''; ?>">
                </div>
                
            </div>
    
            <div class="btn">

            <button class="button1" type="back" name="back"><a href="projectdeveloped.php">Back </a></button>
            <button class="button2" type="Submit" name="submit">Next</button>
            </div>
            
            
        </form>
    </div>
</body>
</html>