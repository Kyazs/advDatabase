<?php
require_once __DIR__ . '/../../app/validation/register.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <link rel="stylesheet" href="../../assets/css/register.css">
    <title>ZCJ Visitor Management System</title>
</head>

<body>

    <div class="navbar">
        <div class="navbar-left">
            <img src="../ZCJ-logo.png" alt="ZCJ Logo">
            ZCJ Visitor Management System
        </div>
        <div class="navbar-right">
            <a href="../Landing Page/landingPage.html">Home</a>
            <a href="#">Contact Us</a>
            <a href="#">About Us</a>
        </div>
    </div>

    <h2>Visitor Registration</h2>

    <div class="form-container">
        <h3>Personal Information</h3>
        <form action="" method="POST">

            <label for="firstName">First Name <span class="error">*</span></label>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?= $first_name ?>">
            <?php if (!empty($error_first_name)): ?>
                <span class="error"><?= $error_first_name ?></span><br>
            <?php endif; ?>
            <label for="lastName">Last Name <span class="error">*</span></label>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?= $last_name ?>">
            <?php if (!empty($error_last_name)): ?>
                <span class="error"><?= $error_last_name ?></span><br>
            <?php endif; ?>

            <label for="contactNumber">Contact Number <span class="error">*</span></label>
            <input type="text" id="contactNumber" name="contactNumber" placeholder="Contact Number" value="<?= $contact_number ?>">
            <?php if (!empty($error_contact_number)): ?>
                <span class="error"><?= $error_contact_number ?></span><br>
            <?php endif; ?>

            <label for="birthdate">Birthdate (MM/DD/YY) <span class="error">*</span></label>
            <input type="date" id="birthdate" name="birthdate" value="<?= $birthdate ?>">
            <?php if (!empty($error_birthdate)): ?>
                <span class="error"><?= $error_birthdate ?></span><br>
            <?php endif; ?>

            <label for="email">Email <span class="error">*</span></label>
            <input type="email" id="email" name="email" placeholder="Email" value="<?= $email ?>">
            <?php if (!empty($error_email)): ?>
                <span class="error"><?= $error_email ?></span><br>
            <?php endif; ?>

            <label for="gender">Gender</label>
            <div class="gender-group">
                <input type="radio" id="male" name="gender" value="male" <?= isset($gender) && $gender == 'male' ? 'checked' : '' ?>>
                <label for="male">Male <span class="error">*</span></label>
                <div class="female-group">
                    <input type="radio" id="female" name="gender" value="female" <?= isset($gender) && $gender == 'female' ? 'checked' : '' ?>>
                    <label for="female">Female <span class="error">*</span></label>
                </div>
            </div>
            <?php if (!empty($error_gender)): ?>
                <span class="error"><?= $error_gender ?></span><br>
            <?php endif; ?>

            <h3>Address</h3>
            <label for="country">Country <span class="error">*</span></label>
            <input type="text" id="country" name="country" placeholder="Country" value="<?= $country ?>">
            <?php if (!empty($error_country)): ?>
                <span class="error"><?= $error_country ?></span><br>
            <?php endif; ?>

            <label for="province">Province <span class="error">*</span></label>
            <input type="text" id="province" name="province" placeholder="Province" value="<?= $province ?>">
            <?php if (!empty($error_province)): ?>
                <span class="error"><?= $error_province ?></span><br>
            <?php endif; ?>

            <label for="city">City <span class="error">*</span></label>
            <input type="text" id="city" name="city" placeholder="City" value="<?= $city ?>">
            <?php if (!empty($error_city)): ?>
                <span class="error"><?= $error_city ?></span><br>
            <?php endif; ?>

            <label for="barangay">Barangay <span class="error">*</span></label>
            <input type="text" id="barangay" name="barangay" placeholder="Barangay" value="<?= $barangay ?>">
            <?php if (!empty($error_barangay)): ?>
                <span class="error"><?= $error_barangay ?></span><br>
            <?php endif; ?>

            <label for="bldg">Bldg. No./Village <span class="error">*</span></label>
            <input type="text" id="bldg" name="bldg" placeholder="Bldg. No./Village" value="<?= $street ?>">
            <?php if (!empty($error_bldg)): ?>
                <span class="error"><?= $error_bldg ?></span><br>
            <?php endif; ?>

            <label for="zip">Zip Code <span class="error">*</span></label>
            <input type="text" id="zip" name="zip" placeholder="Zip Code" value="<?= $zip ?>">
            <?php if (!empty($error_zip)): ?>
                <span class="error"><?= $error_zip ?></span><br>
            <?php endif; ?>

            <h3>Account Credentials</h3>

            <label for="username">Username <span class="error">*</span></label>
            <input type="text" id="username" name="username" placeholder="Username" value="<?= $username ?>" required>
            <?php if (!empty($error_username)): ?>
                <span class="error"><?= $error_username ?></span><br>
            <?php endif; ?>

            <label for="password">Password <span class="error">*</span></label>
            <input type="password" id="password" name="password" placeholder="Create a password" value="<?= $password ?>" required>
            <?php if (!empty($error_password)): ?>
                <span class="error"><?= $error_password ?></span><br>
            <?php endif; ?>

            <label for="Password">Confirm Password <span class="error">*</span></label>
            <input type="password" id="conPassword" name="conPassword" placeholder="Confirm password" required>
            <?php if (!empty($error_conPassword)): ?>
                <span class="error"><?= $error_conPassword ?></span><br>
            <?php endif; ?>

            <div class="select-container">
                <select name="id-type" id="id-type">
                    <option value="" disabled selected>Type of ID</option>
                    <option value="passport">Passport</option>
                    <option value="driver-license">Driver's License</option>
                    <option value="national-id">National ID</option>
                </select>
                <?php if (!empty($error_id_type)): ?>
                    <span class="error"><?= $error_id_type ?></span><br>
                <?php endif; ?>
            </div>

            <h3>Visitor Identification</h3>
            <div class="upload-container">
                <label for="valid-id" class="upload-label"><span class="error">*</span>
                    <span>Upload Valid ID</span>
                </label>
                <input type="file" id="valid-id" name="valid-id">
                <?php if (!empty($error_valid_id)): ?>
                    <span class="error"><?= $error_valid_id ?></span><br>
                <?php endif; ?>
            </div>

            <div class="terms">
                <p><strong>Terms and Conditions</strong></p>
                <p>
                    By registering as a visitor in our system, you agree to provide accurate personal
                    information and adhere to all visitation policies, including security protocols and behavior guidelines.
                    Visitors must be at least 18 years old and will receive a unique QR code for identification, which must
                    be presented during the visit.
                    Any misuse of the system or violation of jail rules may result in the
                    revocation of visitation privileges.
                    The jail is not responsible for any personal injury or loss during the visit.
                    Your data will be handled according to our Privacy Policy. We reserve the right to modify these terms at any time.
                </p>
                <label>
                    <input type="checkbox" name="terms">
                    I agree to the Terms and Conditions
                </label>
                <?php if (!empty($error_terms)): ?>
                    <span class="error"><?= $error_terms ?></span><br>
                <?php endif; ?>
            </div>

            <div class="button-group">
                <a href="/public/index.php" class="button">Back</a>
                <button type="submit" class="button">Create</button>
            </div>


        </form>
    </div>

</body>

</html>