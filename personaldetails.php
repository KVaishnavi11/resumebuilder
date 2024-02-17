<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="personalstyle.css"> 
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
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $headline = $_POST["headline"];
                $phonenumber = $_POST["phonenumber"];
                $address = $_POST["address"];
                $city = $_POST["city"];
                $postcode = $_POST["postcode"];
                $linkedin = $_POST["linkedin"];
                $github = $_POST["github"];

                $errors = array();

                // Your validation code here

                if (count($errors) > 0) {
                    foreach ($errors as $errors) {
                        echo "<div class='alert alert-danger'>$errors</div>";
                    }
                } else {
                    // Check if the user already has an entry
                    $checkQuery = "SELECT user_id FROM personal_details WHERE user_id='$userId'";
                    $checkResult = mysqli_query($conn, $checkQuery);

                    if (!$checkResult) {
                        die("Error: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($checkResult) > 0) {
                        // User already has an entry, update the existing record
                        $updateQuery = "UPDATE personal_details SET firstname=?, lastname=?, email=?, headline=?, phonenumber=?, address=?, city=?, postcode=?, linkedin=?, github=? WHERE user_id=?";
                        $updateStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($updateStmt, $updateQuery)) {
                            mysqli_stmt_bind_param($updateStmt, "ssssssssssi", $firstname, $lastname, $email, $headline, $phonenumber, $address, $city, $postcode, $linkedin, $github, $userId);

                            if (mysqli_stmt_execute($updateStmt)) {
                                echo "<div class='alert alert-success'>Your data was updated successfully. Please fill in the next details</div>";
                                header("Location: educationaldetails.php");
                            } else {
                                die("Something went wrong");
                            }
                        } else {
                            die("Something went wrong");
                        }
                    } else {
                        // User does not have an entry, insert a new record
                        $insertQuery = "INSERT INTO personal_details (user_id, firstname, lastname, email, headline, phonenumber, address, city, postcode, linkedin, github) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                        $insertStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($insertStmt, $insertQuery)) {
                            mysqli_stmt_bind_param($insertStmt, "issssssssss", $userId, $firstname, $lastname, $email, $headline, $phonenumber, $address, $city, $postcode, $linkedin, $github);

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
            $query3 = "SELECT firstname, lastname, email, headline, phonenumber, address, city, postcode, linkedin, github FROM personal_details WHERE user_id='$userId'";
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
        
        <form action="personaldetails.php" method="post">
        <div class="logout">
    <div><a href="logout.php"><i class='bx bx-log-out'></i></a></div>
    <h1>Personal Details</h1>
    <div><a href="logout.php">Logout</a></div>
</div>


            
            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">

            <div class="input-box">
                <div class="col-50">
                    <label for="fname">First Name:</label>
                    <input type="text" placeholder="First Name" name="firstname" value="<?php echo isset($userData['firstname']) ? $userData['firstname'] : ''; ?>">
                </div>
                <div class="col-50">
                    <label for="lname">Last Name:</label>
                    <input type="text" placeholder="Last Name" name="lastname" value="<?php echo isset($userData['lastname']) ? $userData['lastname'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <label for="email">Email Address:</label>
                    <input type="text" placeholder="Email Address" name="email" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>">
                </div>
                <div class="col-50">
                    <label for="headline">Headline:</label>
                    <input type="text" placeholder="Headline" name="headline" value="<?php echo isset($userData['headline']) ? $userData['headline'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <label for="phonenumber">Phone Number:</label>
                    <input type="text" placeholder="Phone Number" name="phonenumber" value="<?php echo isset($userData['phonenumber']) ? $userData['phonenumber'] : ''; ?>">
                </div>
                <div class="col-50">
                    <label for="address">Address:</label>
                    <input type="text" placeholder="Address" name="address" value="<?php echo isset($userData['address']) ? $userData['address'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <label for="city">City:</label>
                    <input type="text" placeholder="City" name="city" value="<?php echo isset($userData['city']) ? $userData['city'] : ''; ?>">
                </div>
                <div class="col-50">
                    <label for="postcode">PostCode:</label>
                    <input type="text" placeholder="PostCode" name="postcode" value="<?php echo isset($userData['postcode']) ? $userData['postcode'] : ''; ?>">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <label for="linkedIn">LinkedIn:</label>
                    <input type="text" placeholder="LinkedIn" name="linkedin" value="<?php echo isset($userData['linkedin']) ? $userData['linkedin'] : ''; ?>">
                </div>
                <div class="col-50">
                    <label for="github">GitHub:</label>
                    <input type="text" placeholder="GitHub" name="github" value="<?php echo isset($userData['github']) ? $userData['github'] : ''; ?>">
                </div>
            </div>

                <button class="button" type="Submit" name="submit">Next</button>
                
        </form>
    </div>
</body>
</html>