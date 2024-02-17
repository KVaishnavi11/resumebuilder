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
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <title>Your Resume</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="full-name">
                <span class="first-name"><?php echo $userData['firstname']; ?></span>
                <span class="first-name"><?php echo $userData['lastname']; ?></span>
            </div>
            <div class="contact-info">
                <span class="email"><?php echo $userData['email']; ?></span>
                <span class="separator"></span>
                <span class="phone"><?php echo $userData['phonenumber']; ?></span>
                <?php if (!empty($userData['address'])) : ?>
                <br>
                <span class="position">Address:</span>
                <?php echo $userData['address']; ?> <?php echo ',' ?>
                    <?php echo $userData['city']; ?><?php echo ',' ?> <?php echo $userData['postcode']; ?>
                <?php endif; ?>
                <?php if (!empty($userData['linkedin'])) : ?>
                    <br>
                <span class="position">linkedin</span>
                <span class="phone"><?php echo $userData['linkedin']; ?></span>
                <span class="phone-val"></span>
                <?php endif; ?>
                <?php if (!empty($userData['github'])) : ?>
                    <br>
                <span class="position">github</span>
                <span class="phone"><?php echo $userData['github']; ?></span>
                <span class="phone-val"></span>
                <?php endif; ?>
            </div>
            <div class="about">
            <!-- <div class="section__title"><b><u>Objective</u></b></div> -->
                <span class="position">Objective</span>
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
        <?php endif; ?>
        <?php if (!empty($userData['title1']) || !empty($userData['link1'])) : ?>
        <div class="details">
            <div class="section">
                <div class="section__title">Projects</div>
                <div class="section__list">
                    <div class="section__list-item">
                    <div class="left">
                        <div class="name"><?php echo $userData['title1']; ?></div>
                        <div class="text"><?php echo $userData['link1']; ?></div>
                        <div class="text"><?php echo $userData['description1']; ?></div>
                    </div>
                    <?php if (!empty($userData['title2']) || !empty($userData['link2'])) : ?>
                    <!-- <div class="section__list-item"> -->
                    <div class="right">
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
                            <input id="ck6" type="checkbox" checked />
                            <label for="c61"></label>
                            <input id="ck7" type="checkbox" checked />
                            <label for="ck7"></label>
                            <input id="ck8" type="checkbox" />
                            <label for="ck8"></label>
                            <input id="ck9" type="checkbox" />
                            <label for="ck9"></label>
                            <input id="ck10" type="checkbox" />
                            <label for="ck10"></label>
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
                            <input id="ck11" type="checkbox" checked />
                            <label for="ck11"></label>
                            <input id="ck12" type="checkbox" checked />
                            <label for="ck12"></label>
                            <input id="ck13" type="checkbox" />
                            <label for="ck13"></label>
                            <input id="ck14" type="checkbox" />
                            <label for="ck14"></label>
                            <input id="ck15" type="checkbox" />
                            <label for="ck15"></label>
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
                            <input id="ck16" type="checkbox" checked />
                            <label for="ck16"></label>
                            <input id="ck17" type="checkbox" checked />
                            <label for="ck17"></label>
                            <input id="ck18" type="checkbox" />
                            <label for="ck18"></label>
                            <input id="ck19" type="checkbox" />
                            <label for="ck19"></label>
                            <input id="ck20" type="checkbox" />
                            <label for="ck20"></label>
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
                            <input id="ck21" type="checkbox" checked />
                            <label for="ck21"></label>
                            <input id="ck22" type="checkbox" checked />
                            <label for="ck22"></label>
                            <input id="ck23" type="checkbox" />
                            <label for="ck23"></label>
                            <input id="ck24" type="checkbox" />
                            <label for="ck24"></label>
                            <input id="ck25" type="checkbox" />
                            <label for="ck25"></label>
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
                            <input id="ck26" type="checkbox" checked />
                            <label for="ck26"></label>
                            <input id="ck27" type="checkbox" checked />
                            <label for="ck27"></label>
                            <input id="ck28" type="checkbox" />
                            <label for="ck28"></label>
                            <input id="ck29" type="checkbox" />
                            <label for="ck29"></label>
                            <input id="ck30" type="checkbox" />
                            <label for="ck30"></label>
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
                    <?php if (!empty($userData['interest1'])) :echo $userData['interest1']; endif;?> <br>
                    <?php if (!empty($userData['interest2'])) :echo $userData['interest2']; endif;?> <br>
                    <?php if (!empty($userData['interest3'])) :echo $userData['interest3']; endif;?><br>
                    <?php if (!empty($userData['interest4'])) :echo $userData['interest4']; endif;?><br>
                    <?php if (!empty($userData['interest5'])) :echo $userData['interest5']; endif;?><br>
                    <?php if (!empty($userData['interest6'])) :echo $userData['interest6']; endif;?><br>
                   

                    </div>
                </div>
            </div>
        </div>
        <button onclick="downloadPDF()">Download PDF</button>

       
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
function downloadPDF() {
    // Hide the button before capturing the HTML content
    const button = document.querySelector('button');
    button.style.display = 'none';

    const element = document.querySelector('.container');

    // Use html2canvas to capture the HTML content as an image
    html2canvas(element).then(canvas => {
        // Convert the canvas to a data URL
        const imgData = canvas.toDataURL('image/png');

        // Create a new jsPDF instance
        const pdf = new jsPDF({ unit: 'px', format: 'a4' });

        // Add the image to the PDF
        pdf.addImage(imgData, 'PNG', 0, 0, pdf.internal.pageSize.width, pdf.internal.pageSize.height);

        // Show the button again after capturing the HTML content
        button.style.display = 'block';

        // Save the PDF
        pdf.save('resume.pdf');
    });
}
</script>




