<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details</title>
    <link rel="stylesheet" href="personalstyle.css"> 
</head>
<body>
    <div class="wrapper">
        <?php
        if(isset($_POST["submit"])){
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $headline = $_POST["headline"];
            $phonenumber= $_POST["phonenumber"]; 
            $address = $_POST["address"];
            $city = $_POST["city"];
            $postcode = $_POST["postcode"];
            $linkedin = $_POST["linkedin"];
            $github = $_POST["github"];

            $errors = array();

            if (empty($firstname) OR empty($lastname) OR empty($email) OR empty($phonenumber) OR empty($address) OR empty($city) OR empty($postcode)) {
                array_push($errors, "All fields are required");
            }

            $host="localhost";
            $dbuser="root";
            $bdpassword="";
            $dbname="login_register";
            $conn=mysqli_connect($host, $dbuser, $bdpassword, $dbname);

            if(!$conn){
                die("Something went wrong");
             }

             $query = "SELECT * FROM users WHERE email='$email' ";
             $result = mysqli_query($conn, $query);
             $data = mysqli_num_rows($result);

             if($data > 0){
                array_push($errors, "Email are already exist");
             }

             if(count($errors)>0){
                foreach ($errors as $errors) {
                    echo "<div class='alert alert-danger'>$errors</div>";
                }
            }else{
                $query = "INSERT INTO personal_details (firstname,lastname,email,headline,phonenumber,address,city,postcode,linkedin,github) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $end = mysqli_stmt_init($conn);
                $res = mysqli_stmt_prepare($end, $query);

                if($res){
                    mysqli_stmt_bind_param($end, "ssssssssss",$firstname, $lastname, $email, $headline, $phonenumber, $address, $city, $postcode, $linkedin, $github);
                    mysqli_stmt_execute($end);
                    echo "<div class='alert alert-success'>You are data was Submitted successfully. Please fill next details</div>";
                    }else{
                          die("Something went wrong");
                   }
                }
            }

          
        ?>
        <form action="personaldetails.php" method="post">
            <h1>Personal Details</h1>
            
            <div class="input-box">
                <div class="col-50">
                    <label for="fname">First Name:</label>
                    <input type="text" placeholder="First Name" name="firstname">
                </div>
                <div class="col-50">
                    <label for="lname">Last Name:</label>
                    <input type="text" placeholder="Last Name" name="lastname">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <label for="email">Email Address:</label>
                    <input type="text" placeholder="Email Address" name="email">
                </div>
                <div class="col-50">
                    <label for="headline">Headline:</label>
                    <input type="text" placeholder="Headline" name="headline">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <label for="phonenumber">Phone Number:</label>
                    <input type="text" placeholder="Phone Number" name="phonenumber">
                </div>
                <div class="col-50">
                    <label for="address">Address:</label>
                    <input type="text" placeholder="Address" name="address">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <label for="city">City:</label>
                    <input type="text" placeholder="City" name="city">
                </div>
                <div class="col-50">
                    <label for="postcode">PostCode:</label>
                    <input type="text" placeholder="PostCode" name="postcode">
                </div>
            </div>

            <div class="input-box">
                <div class="col-50">
                    <label for="linkedIn">LinkedIn:</label>
                    <input type="text" placeholder="LinkedIn" name="linkedin">
                </div>
                <div class="col-50">
                    <label for="github">GitHub:</label>
                    <input type="text" placeholder="GitHub" name="github" >
                </div>
            </div>

            <button class="button" type="Submit" name="submit">Next</button>
        </form>
    </div>
</body>
</html>