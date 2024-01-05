<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Details</title>
    <link rel="stylesheet" href="educationaldetailstyle.css"> 
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
                $collegename = $_POST["collegename"];
                $date1 = $_POST["date1"];
                $date2 = $_POST["date2"];
                $postgraduation = $_POST["postgraduation"];
                $description = $_POST["description"];
                $collegename1 = $_POST["collegename1"];
                $date3 = $_POST["date3"];
                $date4 = $_POST["date4"];
                $graduation = $_POST["graduation"];
                $description1 = $_POST["description1"];
                $schoolname = $_POST["schoolname"];
                $date5 = $_POST["date5"];
                $date6 = $_POST["date6"];
                $hsc = $_POST["hsc"];
                $description2 = $_POST["description2"];
                $schoolname1 = $_POST["schoolname1"];
                $date7 = $_POST["date7"];
                $date8 = $_POST["date8"];
                $ssc = $_POST["ssc"];
                $description3 = $_POST["description3"];


                $errors = array();

                // Your validation code here

                if (count($errors) > 0) {
                    foreach ($errors as $errors) {
                        echo "<div class='alert alert-danger'>$errors</div>";
                    }
                } else {
                    // Check if the user already has an entry
                    $checkQuery = "SELECT user_id FROM educational_details WHERE user_id='$userId'";
                    $checkResult = mysqli_query($conn, $checkQuery);

                    if (!$checkResult) {
                        die("Error: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($checkResult) > 0) {
                        // User already has an entry, update the existing record
                        $updateQuery = "UPDATE educational_details SET collegename=?, date1=?, date2=?, postgraduation=?, description=?, collegename1=?, date3=?, date4=?, graduation=?, description1=?, schoolname=?, date5=?, date6=?, hsc=?, description2=?, schoolname1=?, date7=?, date8=?, ssc=?, description3=? WHERE user_id=?";
                        $updateStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($updateStmt, $updateQuery)) {
                            mysqli_stmt_bind_param($updateStmt, "ssssssssssssssssssssi", $collegename, $date1, $date2, $postgraduation, $description, $collegename1, $date3, $date4, $graduation, $description1, $schoolname, $date5, $date6, $hsc, $description2, $schoolname1, $date7, $date8, $ssc, $description3, $userId);

                            if (mysqli_stmt_execute($updateStmt)) {
                                echo "<div class='alert alert-success'>Your data was updated successfully. Please fill in the next details</div>";
                                header("Location: extradetails.php");
                            } else {
                                die("Something went wrong");
                            }
                        } else {
                            die("Something went wrong");
                        }
                    } else {
                        // User does not have an entry, insert a new record
                        $insertQuery = "INSERT INTO educational_details (user_id, collegename, date1, date2, postgraduation, description, collegename1, date3, date4, graduation, description1, schoolname, date5, date6, hsc, description2, schoolname1, date7, date8, ssc, description3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                        $insertStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($insertStmt, $insertQuery)) {
                            mysqli_stmt_bind_param($insertStmt, "issssssssssssssssssss", $userId, $collegename, $date1, $date2, $postgraduation, $description, $collegename1, $date3, $date4, $graduation, $description1, $schoolname, $date5, $date6, $hsc, $description2, $schoolname1, $date7, $date8, $ssc, $description3);

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
            $query3 = "SELECT collegename, date1, date2, postgraduation, description, collegename1, date3, date4, graduation, description1, schoolname, date5, date6, hsc, description2, schoolname1, date7, date8, ssc, description3 FROM educational_details WHERE user_id='$userId'";
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
        <form action="educationaldetails.php " method=post>
            <h1>Educational Details</h1>
            
            <div class="input-box">
                <div class="col-55">
                    
                    <input type="text" placeholder="College/University" name="collegename" value="<?php echo isset($userData['collegename']) ? $userData['collegename'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="dd-mm-yyyy" name="date1" value="<?php echo isset($userData['date1']) ? $userData['date1'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="dd-mm-yyyy" name="date2" value="<?php echo isset($userData['date2']) ? $userData['date2'] : ''; ?>">
                </div>
                
            </div>  
            <div class="input-box">
                <div class="col-30">
                    
                    <input type="text" placeholder="Qualification(Post-Graduation)" name="postgraduation" value="<?php echo isset($userData['postgraduation']) ? $userData['postgraduation'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="Description" rname="description" value="<?php echo isset($userData['description']) ? $userData['description'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-55">
                    
                    <input type="text" placeholder="College/University" name="collegename1" value="<?php echo isset($userData['collegename1']) ? $userData['collegename1'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="dd-mm-yyyy" name="date3" value="<?php echo isset($userData['date3']) ? $userData['date3'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="dd-mm-yyyy" name="date4" value="<?php echo isset($userData['date4']) ? $userData['date4'] : ''; ?>">
                </div>
                
            </div>  
            <div class="input-box">
                <div class="col-30">
                    
                    <input type="text" placeholder="Qualification(Graduation)" name="graduation" value="<?php echo isset($userData['graduation']) ? $userData['graduation'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="Description" name="desription1" value="<?php echo isset($userData['description1']) ? $userData['desription1'] : ''; ?>">
                </div>
            </div>
            

            <div class="input-box">
                <div class="col-55">
                    
                    <input type="text" placeholder="School" name="schoolname" value="<?php echo isset($userData['schoolname']) ? $userData['schoolname'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="dd-mm-yyyy" name="date5" value="<?php echo isset($userData['date5']) ? $userData['date5'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="dd-mm-yyyy" name="date6" value="<?php echo isset($userData['date6']) ? $userData['date6'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-55">
                    
                    <input type="text" placeholder="Qualification(HSC)" name="hsc" value="<?php echo isset($userData['hsc']) ? $userData['hsc'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="Description" name="description" value="<?php echo isset($userData['description']) ? $userData['description'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-55">
                    
                    <input type="text" placeholder="School" name="schoolname1" value="<?php echo isset($userData['schoolname1']) ? $userData['schoolname1'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="dd-mm-yyyy" name="date7" value="<?php echo isset($userData['date7']) ? $userData['date7'] : ''; ?>">
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="dd-mm-yyyy" name="date8" value="<?php echo isset($userData['date8']) ? $userData['date8'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-55">
                    
                    <input type="text" placeholder="Qualification(SSC)" name="ssc" value="<?php echo isset($userData['ssc']) ? $userData['ssc'] : ''; ?>"d>
                </div>
                <div class="col-50">
                    
                    <input type="text" placeholder="Description" name="desription3" value="<?php echo isset($userData['description3']) ? $userData['desription3'] : ''; ?>">
                </div>
            </div>
            <div>
            <button class="button1" type="" >Back</button>
            <button class="button2" type="Submit" name="submit">Next</button>
            </div>
            
        </form>
    </div>
</body>
</html>