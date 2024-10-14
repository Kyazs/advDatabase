<?php
require_once __DIR__ . '/../class/user.class.php';
require_once __DIR__ . '/../helpers.php';
$username = $password = $visitor_id = $first_name = $last_name = $email = $contact_number = $date_of_birth = $province = $barangay = $street = $city = $zip = $id_document_path = $registration_date = $gender = $country = '';

$error_password = $error_username = $error_visitor_id = $error_first_name = $error_last_name = $error_email = $error_contact_number = $error_date_of_birth = $error_address_street = $error_address_city = $error_address_state = $error_address_zip = $error_id_document_path = $error_registration_date = $error_is_verified = $error_gender = $error_country = '';

$obj = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $contact_number = $_POST['contactNumber'];
    $date_of_birth = $_POST['birthdate'];
    $street = $_POST['bldg'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $barangay = $_POST['barangay'];
    $zip = $_POST['zip'];
    $username = $_POST['username'];
    $gender = $_POST['gender'] ?? '';
    $password = $_POST['password'];
    $country = $_POST['country'];
    $id_document_path = $_POST['idDocumentPath'] ?? '';

    // Validate inputs

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

    // If no errors, proceed to register the user
    if (
        empty($error_visitor_id) && empty($error_first_name) && empty($error_last_name) && empty($error_email)
        && empty($error_contact_number) && empty($error_date_of_birth) && empty($error_address_street) && empty($error_address_city)
        && empty($error_address_state) && empty($error_address_zip) && empty($error_registration_date)
        && empty($error_password) && empty($error_username) && empty($error_gender) && empty($error_country)
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
        $obj->password = password_hash($password, PASSWORD_DEFAULT);
        if ($obj->register()) {
            header('Location: ' . __DIR__ . '/asd');
        } else {
            echo "Error registering user";
        }
    }
}
