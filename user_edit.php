<?php
include "layout/header.php";
// include "connections/connection.php";
// include "libraries/functions.php";
$sql_genders = "SELECT * FROM `genders`";
$genders = mysqli_query($conn, $sql_genders);
$sql_cities = "SELECT * FROM `cities`";
$cities = mysqli_query($conn, $sql_cities);
$sql_states = "SELECT * FROM `states`";
$states = mysqli_query($conn, $sql_states);
$sql_countries = "SELECT * FROM `countries`";
$countries = mysqli_query($conn, $sql_countries);
$sql_roles = "SELECT * FROM `roles`";
$roles = mysqli_query($conn, $sql_roles);

// define variables and set to empty values
$nameErr = $emailErr = $genderIDErr = $usernameErr = $passwordErr = "";
$name = $email = $genderID = $dob = $street = $cityID = $stateID = $countryID = $roleID = $username = $password = "";
$uploadErr = [];
$uploads_dir = './assets/images/';
$userID = '';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userID = test_input($_GET['id']);
}

$sql_users = "SELECT * FROM `users` AS u 
LEFT JOIN `logins` AS l ON u.UserID = l.UserID 
WHERE u.UserID = $userID";
$users = mysqli_query($conn, $sql_users);
// pr($users);
$user = mysqli_fetch_assoc($users);
// prx($user);

$name = $user['FullName'];
$email = $user['Email'];
$dob = $user['BirthDate'];
$genderID = $user['GenderID'];
$street = $user['Street'];
$cityID = $user['CityID'];
$stateID = $user['StateID'];
$countryID = $user['CountryID'];
$roleID = $user['RoleID'];
$username = $user['Username'];
$password = $user['Password'];
$password = $user['Password'];
$to = $user['Photo'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_FILES)) {
        $to = $uploads_dir . basename($_FILES['imageUrl']['name']);
        $from = $_FILES['imageUrl']['tmp_name'];
        $size = $_FILES['imageUrl']['size'];
        $filetype = strtolower(pathinfo($to, PATHINFO_EXTENSION));
        // Check if file already exists
        if (file_exists($to)) {
            array_push($uploadErr, "Sorry, file already exists.");
        }

        // limit file size 2MB
        if ($size > 2097152) {
            array_push($uploadErr, "file size must be under 2MB");
        }

        // limit file type    
        if (!($filetype == 'png' || $filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'bmp' || $filetype == 'svg' || $filetype == 'webp' || $filetype == 'gif')) {
            array_push($uploadErr, "Sorry, only JPG, JPEG, PNG, BMP, WEBP, SVG & GIF files are allowed.");
        }
    }else {
        $to = test_input($_POST['to']);
    }
    if (empty($_POST["fullName"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["fullName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if ($_POST["genderID"] == 0 || empty($_POST["genderID"])) {
        $genderIDErr = "Gender is required";
    } else {
        $genderID = test_input($_POST["genderID"]);
    }

    if (empty($_POST["dob"])) {
        $dob = "";
    } else {
        $dob = test_input($_POST["dob"]);
    }

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["street"])) {
        $street = "";
    } else {
        $street = test_input($_POST["street"]);
    }

    if (empty($_POST["cityID"])) {
        $cityID = "";
    } else {
        $cityID = test_input($_POST["cityID"]);
    }

    if (empty($_POST["stateID"])) {
        $stateID = "";
    } else {
        $stateID = test_input($_POST["stateID"]);
    }

    if (empty($_POST["countryID"])) {
        $countryID = "";
    } else {
        $countryID = test_input($_POST["countryID"]);
    }

    if (empty($_POST["roleID"])) {
        $roleID = "";
    } else {
        $roleID = test_input($_POST["roleID"]);
    }

    if (empty($_POST["userID"])) {
        $userID = "";
    } else {
        $userID = test_input($_POST["userID"]);
    }
    

    if (empty($nameErr) && empty($emailErr) && empty($genderIDErr) && empty($uploadErr)) {
        $isUploaded = true;
        if(!empty($_FILES)) {
            if(move_uploaded_file($from, $to)) {
                echo ("file uploaded successfully");
            }else{
                $isUploaded = false;
            }
        }
        if ($isUploaded) {
            $sql_update_user = "UPDATE `users` 
            SET `FullName` = '$name',
            SET `Email` = '$email',
            SET `BirthDate` = '$dob',
            SET `GenderID` = '$genderID',
            SET `Photo` = '$to',
            SET `Street` = '$street',
            SET `CityID` = '$cityID',
            SET `StateID` = '$stateID',
            SET `CountryID` = '$countryID',
            SET `RoleID` = '$roleID'
            WHERE `users`.`UserID` = $userID";

            if (mysqli_query($conn, $sql_insert_user)) {
                $sql_update_login = "UPDATE `logins`
                SET `Username` = $username,
                SET `Password` = $password
                WHERE `logins`.`UserID` = $userID";
                if (mysqli_query($conn, $sql_insert_login)) {
                    header("Location: users.php");
                    exit();
                }
            }
        }
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="users.php">All Users</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Existing User</h5>
                        <?php
                        // pr(mysqli_fetch_assoc($genders)); 
                        // pr(mysqli_fetch_assoc($countries)); 
                        // pr(mysqli_fetch_assoc($states)); 
                        // pr(mysqli_fetch_assoc($cities)); 
                        //pr($_REQUEST);
                        ?>
                        <p><span class="text-danger">* required field</span></p>
                        <!-- Multi Columns Form -->
                        <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="invisible">
                            <input type="text" name="to" value="<?php echo $to?>">
                        </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="col-md-12">
                                        <label for="imageUrl" class="form-label">Image</label>
                                        <input class="form-control" type="file" id="imageUrl" name="imageUrl">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="fullName" class="form-label">Your Name <span class="text-danger">*<?php echo $nameErr; ?></span></label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $name; ?>">

                                    </div>
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email <span class="text-danger">*<?php echo $emailErr; ?></span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                        <label for="userID" class="form-label">User ID</label>
                                        <input type="text" class="form-control" id="userID" name="userID" value="<?php echo $userID; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="<?php echo $to ?>" class="rounded img-fluid img-thumbnail mx-auto d-block" alt="<?php echo $userID . "-" . $name ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="genderID" class="form-label">Gender <span class="text-danger">*<?php echo $genderIDErr; ?></span></label>
                                <select id="genderID" class="form-select" name="genderID">
                                    <option value="0" <?php if (empty($genderID) || $genderID == "0") echo "selected"; ?>>Select Gender</option>
                                    <?php while ($gender = mysqli_fetch_assoc($genders)) { ?>
                                        <option value="<?php echo $gender['GenderID'] ?>" <?php if (isset($genderID) && $genderID == $gender['GenderID']) echo "selected"; ?>><?php echo $gender['Gender'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                            </div>
                            <div class="col-12">
                                <label for="street" class="form-label">Street</label>
                                <input type="text" class="form-control" id="street" name="street" value="<?php echo $street; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="cityID" class="form-label">City</label>
                                <select id="cityID" class="form-select" name="cityID">
                                    <option value="0" <?php if (empty($cityID) || $cityID == "0") echo "selected"; ?>>Choose City</option>
                                    <?php while ($city = mysqli_fetch_assoc($cities)) { ?>
                                        <option value="<?php echo $city['CityID'] ?>" <?php if (isset($cityID) && $cityID == $city['CityID']) echo "selected"; ?>><?php echo $city['City'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="stateID" class="form-label">State</label>
                                <select id="stateID" class="form-select" name="stateID">
                                    <option value="0" <?php if (empty($stateID) || $stateID == "0") echo "selected"; ?>>Choose State</option>
                                    <?php while ($state = mysqli_fetch_assoc($states)) { ?>
                                        <option value="<?php echo $state['StateID'] ?>" <?php if (isset($stateID) && $stateID == $state['StateID']) echo "selected"; ?>><?php echo $state['State'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="countryID" class="form-label">Country</label>
                                <select id="countryID" class="form-select" name="countryID">
                                    <option value="0" <?php if (empty($countryID) || $countryID == "0") echo "selected"; ?>>Choose Country</option>
                                    <?php while ($country = mysqli_fetch_assoc($countries)) { ?>
                                        <option value="<?php echo $country['CountryID'] ?>" <?php if (isset($countryID) && $countryID == $country['CountryID']) echo "selected"; ?>><?php echo $country['Country'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="roleID" class="form-label">Role</label>
                                <select id="roleID" class="form-select" name="roleID">
                                    <option value="0" <?php if (empty($roleID) || $roleID == "0") echo "selected"; ?>>Choose role</option>
                                    <?php while ($role = mysqli_fetch_assoc($roles)) { ?>
                                        <option value="<?php echo $role['RoleID'] ?>" <?php if (isset($roleID) && $roleID == $role['RoleID']) echo "selected"; ?>><?php echo $role['Role'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php
include('layout/footer.php');
?>