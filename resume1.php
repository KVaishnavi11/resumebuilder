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

    // Fetch user data from the database
    // $userDataQuery = "SELECT * FROM personal_details AND extra_details WHERE user_id='$userId'";
    $userDataQuery = "SELECT * FROM personal_details 
                  JOIN extra_details ON personal_details.user_id = extra_details.user_id
                  JOIN exp_details ON personal_details.user_id = exp_details.user_id
                  JOIN educational_details ON personal_details.user_id = educational_details.user_id
                  JOIN project_developed ON personal_details.user_id = project_developed.user_id
                  WHERE personal_details.user_id = '$userId'";

    $userDataResult = mysqli_query($conn, $userDataQuery);

    if (!$userDataResult) {
        die("Error: " . mysqli_error($conn));
    }

    $userData = mysqli_fetch_assoc($userDataResult);

    mysqli_free_result($userDataResult);
} else {
    echo "No records found for the given email.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<!-- <html lang="en"> -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="template.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <script src="html2pdf.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Your Resume</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="full-name">
                <span class="first-name"><?php echo $userData['firstname']; ?></span>
                <span class="last-name"><?php echo $userData['lastname']; ?></span>
            </div>
            <div class="contact-info">
                <span class="email"><?php echo $userData['email']; ?></span>
                <span class="email-val"></span>
                <span class="separator"></span>
                <span class="phone"><?php echo $userData['phonenumber']; ?></span>
                <?php if (!empty($userData['address'])) : ?>
                <br>
                <span class="position">Address:</span>
                <span class="phone"><?php echo $userData['address']; ?> <?php echo ',' ?>
                    <?php echo $userData['city']; ?><?php echo ',' ?> <?php echo $userData['postcode']; ?></span>
                <?php endif; ?>
                <?php if (!empty($userData['linkedin'])) : ?>
                <span class="position">linkedin</span>
                <span class="phone"><?php echo $userData['linkedin']; ?></span>
                <span class="phone-val"></span>
                <?php endif; ?>
                <?php if (!empty($userData['github'])) : ?>
                <span class="position">github</span>
                <span class="phone"><?php echo $userData['github']; ?></span>
                <span class="phone-val"></span>
                <?php endif; ?>
            </div>
            <div class="about">
                <span class="position">Front-End Developer </span>
                <div class="desc" contenteditable="true">
                    <?php echo (!empty($userData['objective'])) ? $userData['objective'] : 'This is a demo text. Edit me!'; ?>
                </div>
            </div>

        </div>
        <?php if (!empty($userData['organisation1'])) : ?>
        <div class="details">
            <div class="section">
                <div class="section__title">Experience</div>
                <div class="section__list">
                    <div class="section__list-item">
                        <div class="left">
                            <div class="name"><?php echo $userData['organisation1']; ?></div>
                            <div class="addr"><?php echo $userData['position1']; ?></div>
                            <div class="duration"><?php echo $userData['duration1']; ?></div>
                        </div>
                        <div class="right">
                            <div class="name"><?php echo $userData['organisation2']; ?></div>
                            <div class="addr"><?php echo $userData['position2']; ?></div>
                            <div class="duration"><?php echo $userData['duration2']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if (!empty($userData['title1']) || !empty($userData['link1'])) : ?>
        <div class="details">
            <div class="section">
                <div class="section__title">Projects</div>
                <div class="section__list">
                    <div class="section__list-item">
                        <div class="name"><?php echo $userData['title1']; ?></div>
                        <div class="text"><?php echo $userData['link1']; ?></div>
                        <div class="text"><?php echo $userData['description1']; ?></div>
                    </div>
                    <?php if (!empty($userData['title2']) || !empty($userData['link2'])) : ?>
                    <div class="section__list-item">
                        <div class="name"><?php echo $userData['title2']; ?></div>
                        <div class="text"><?php echo $userData['link2']; ?></div>
                        <div class="text"><?php echo $userData['description2']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if (!empty($userData['skill1'])) : ?>
        <div class="section">
            <div class="section__title">Skills</div>
            <div class="skills">
                <div class="details">
                    <div class="skills__item">
                        <div class="left">
                            <div class="name">
                                <?php echo $userData['skill1']; ?>
                            </div>
                        </div>
                        <div class="right">
                            <input id="ck1" type="checkbox" checked />
                            <label for="ck1"></label>
                            <input id="ck2" type="checkbox" checked />
                            <label for="ck2"></label>
                            <input id="ck3" type="checkbox" />
                            <label for="ck3"></label>
                            <input id="ck4" type="checkbox" />
                            <label for="ck4"></label>
                            <input id="ck5" type="checkbox" />
                            <label for="ck5"></label>
                        </div>
                    </div>
                </div>
                <?php if (!empty($userData['skill2'])) : ?>
                <div class="details">
                    <div class="skills__item">
                        <div class="left">
                            <div class="name">
                                <?php echo $userData['skill2']; ?>
                            </div>
                        </div>
                        <div class="right">
                            <input id="ck1" type="checkbox" checked />
                            <label for="ck1"></label>
                            <input id="ck2" type="checkbox" checked />
                            <label for="ck2"></label>
                            <input id="ck3" type="checkbox" />
                            <label for="ck3"></label>
                            <input id="ck4" type="checkbox" />
                            <label for="ck4"></label>
                            <input id="ck5" type="checkbox" />
                            <label for="ck5"></label>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($userData['skill3'])) : ?>
                <div class="details">
                    <div class="skills__item">
                        <div class="left">
                            <div class="name">
                                <?php echo $userData['skill3']; ?>
                            </div>
                        </div>
                        <div class="right">
                            <input id="ck1" type="checkbox" checked />
                            <label for="ck1"></label>
                            <input id="ck2" type="checkbox" checked />
                            <label for="ck2"></label>
                            <input id="ck3" type="checkbox" />
                            <label for="ck3"></label>
                            <input id="ck4" type="checkbox" />
                            <label for="ck4"></label>
                            <input id="ck5" type="checkbox" />
                            <label for="ck5"></label>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($userData['skill4'])) : ?>
                <div class="details">
                    <div class="skills__item">
                        <div class="left">
                            <div class="name">
                                <?php echo $userData['skill4']; ?>
                            </div>
                        </div>
                        <div class="right">
                            <input id="ck1" type="checkbox" checked />
                            <label for="ck1"></label>
                            <input id="ck2" type="checkbox" checked />
                            <label for="ck2"></label>
                            <input id="ck3" type="checkbox" />
                            <label for="ck3"></label>
                            <input id="ck4" type="checkbox" />
                            <label for="ck4"></label>
                            <input id="ck5" type="checkbox" />
                            <label for="ck5"></label>
                        </div>
                    </div>
                </div>

                <?php endif; ?>
                <?php if (!empty($userData['skill5'])) : ?>
                <div class="details">

                    <div class="skills__item">
                        <div class="left">
                            <div class="name">
                                <?php echo $userData['skill5']; ?>
                            </div>
                        </div>
                        <div class="right">
                            <input id="ck1" type="checkbox" checked />
                            <label for="ck1"></label>
                            <input id="ck2" type="checkbox" checked />
                            <label for="ck2"></label>
                            <input id="ck3" type="checkbox" />
                            <label for="ck3"></label>
                            <input id="ck4" type="checkbox" />
                            <label for="ck4"></label>
                            <input id="ck5" type="checkbox" />
                            <label for="ck5"></label>
                        </div>
                    </div>
                </div>

                <?php endif; ?>
                <?php if (!empty($userData['skill6'])) : ?>
                <div class="details">
                    <div class="skills__item">
                        <div class="left">
                            <div class="name">
                                <?php echo $userData['skill6']; ?>
                            </div>
                        </div>
                        <div class="right">
                            <input id="ck1" type="checkbox" checked />
                            <label for="ck1"></label>
                            <input id="ck2" type="checkbox" checked />
                            <label for="ck2"></label>
                            <input id="ck3" type="checkbox" />
                            <label for="ck3"></label>
                            <input id="ck4" type="checkbox" />
                            <label for="ck4"></label>
                            <input id="ck5" type="checkbox" />
                            <label for="ck5"></label>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <div class="section">
                <div class="section__title">
                    Interests
                </div>
                <div class="section__list">
                    <div class="section__list-item">
                        Football, programming.
                    </div>
                </div>
            </div>
            <button onclick="downloadPDF()">Download PDF</button>
        </div>
        <script>
        function downloadPDF() {
            const element = document.querySelector('.container');

            html2pdf(element);
        }
        </script>
</body>

</html>