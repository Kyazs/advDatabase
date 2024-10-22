<?php
ob_start();
require_once __DIR__ . '/../class/user.class.php';
require_once __DIR__ . '/../helpers.php';
$conPassword = $terms = $username = $password = $visitor_id = $first_name = $last_name = $email = $contact_number = $date_of_birth = $province = $barangay = $street = $city = $zip = $id_document_path = $id_type = $registration_date = $gender = $country = '';

$error_terms = $error_password = $error_id_type = $usernameExists = $emailExists = $contactExists = $error_username = $error_visitor_id = $error_first_name = $error_last_name = $error_email = $error_contact_number = $error_date_of_birth = $error_address_street = $error_address_city = $error_address_state = $error_address_zip = $error_id_document_path = $error_registration_date = $error_is_verified = $error_gender = $error_country = '';

$obj = new User();
$gender = $obj->fetchGender();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = clean_input($_POST['firstName'] ?? '');
    $last_name = clean_input($_POST['lastName'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $contact_number = clean_input($_POST['contactNumber'] ?? '');
    $date_of_birth = clean_input($_POST['birthdate'] ?? '');
    $street = clean_input($_POST['bldg'] ?? '');
    $city = clean_input($_POST['city'] ?? '');
    $province = clean_input($_POST['province'] ?? '');
    $barangay = clean_input($_POST['barangay'] ?? '');
    $zip = clean_input($_POST['zip'] ?? '');
    $username = clean_input($_POST['username'] ?? '');
    $gender = clean_input($_POST['gender'] ?? '');
    $password = clean_input($_POST['password'] ?? '');
    $country = clean_input($_POST['country'] ?? '');
    $id_type = clean_input($_POST['id_type'] ?? '');
    $id_document_path = clean_input($_POST['idDocumentPath'] ?? '');
    $terms = clean_input($_POST['terms'] ?? '');
    $conPassword = clean_input($_POST['conPassword']);

    $emailExists = $obj->emailExists($_POST['email']);
    $contactExists = $obj->numberExists($_POST['contactNumber']);
    $usernameExists = $obj->usernameExists($_POST['username']);

    // Validate inputs

    if (empty($terms)) {
        $error_terms = "You must agree to the terms and conditions to continue";
    }
    if (!empty($emailExists)) {
        $error_email = $emailExists;
    }
    if (!empty($contactExists)) {
        $error_contact_number = $contactExists;
    }
    if (!empty($usernameExists)){
        $error_username = $usernameExists;
    }
    if (empty($first_name)) {
        $error_first_name = "First name is required";
    }
    if (empty($last_name)) {
        $error_last_name = "Last name is required";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Valid email is required";
    }
    if (empty($contact_number)) {
        $error_contact_number = "Contact number is required";
    }
    if (!is_numeric($contact_number)) {
        $error_contact_number = "Contact number must be numeric";
    }
    if (empty($date_of_birth)) {
        $error_date_of_birth = "Date of birth is required";
    }
    if (empty($street)) {
        $error_address_street = "Street address is required";
    }
    if (empty($city)) {
        $error_address_city = "City is required";
    }
    if (empty($province)) {
        $error_address_state = "State is required";
    }
    if (empty($zip)) {
        $error_address_zip = "ZIP code is required";
    }
    if (empty($gender)) {
        $error_gender = "Gender is required";
    }
    if (empty($username)) {
        $error_username = "Username is required";
    }
    if (empty($password)) {
        $error_password = "Password is required";
    } elseif (strlen($password) < 6) {
        $error_password = "Password must be at least 6 characters";
    }
    if (empty($country)) {
        $error_country = "Country is required";
    }
    if (empty($id_type)){
        $error_id_type = "Type of ID is required";
    }
    if ($conPassword != $password) {
        $error_password = "Passwords do not match";
    }

    // If no errors, proceed to register the user
    if (
        empty($error_visitor_id) && empty($error_first_name) && empty($error_last_name) && empty($error_email)
        && empty($error_contact_number) && empty($error_date_of_birth) && empty($error_address_street) && empty($error_address_city)
        && empty($error_address_state) && empty($error_address_zip) && empty($error_registration_date) && empty($error_id_type) && empty($error_terms)
        && empty($error_password) && empty($error_username) && empty($error_gender) && empty($error_country) && empty($emailExists) && empty($contactExists)
    ) {
        $obj->first_name = $first_name;
        $obj->last_name = $last_name;
        $obj->email = $email;
        $obj->contact_number = $contact_number;
        $obj->date_of_birth = $date_of_birth;
        $obj->street = $street;
        $obj->city = $city;
        $obj->province = $province;
        $obj->barangay = $barangay;
        $obj->zip = $zip;
        $obj->gender = $gender;
        $obj->country = $country;
        $obj->username = $username;
        $obj->id_type = $id_type;
        $obj->password = password_hash($password, PASSWORD_DEFAULT);
        if ($obj->register()) {
            echo "User Created";
            exit();
        } else {
            echo "Error registering user";
        }
    }
    else {
        echo "<script>console.log('Form not submitted');</script>";
    }
}
ob_end_flush();
