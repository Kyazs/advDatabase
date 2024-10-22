<?php
require_once __DIR__ . '/../../database/database.php';

class User
{
    // user registration variables
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $contact_number = '';
    public $date_of_birth = '';
    public $street = '';
    public $city = '';
    public $barangay = '';
    public $province = '';
    public $zip = '';
    public $country = '';
    public $id_document_path = '';
    public $username = '';
    public $gender = '';
    public $password = '';
    public $id_type = '';

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function emailExists($email){
        $sql = "SELECT COUNT(*) FROM visitors WHERE email = :email";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $email_exists = $stmt->fetchcolumn();

        if($email_exists > 0){
            return 'Email Already In Use';
        }
    }

    function numberExists($number){
        $sql = "SELECT COUNT(*) FROM visitors WHERE contact_number = :contact_number";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':contact_number', $number);
        $stmt->execute();
        $number_Exists = $stmt->fetchcolumn();

        if($number_Exists > 0){
            return 'Contact Number Already Exists';
        }
    }

    function usernameExists($user){
        $sql = "SELECT COUNT(*) FROM visitorcredentials where username = :username;";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        $usernameExists = $stmt->fetchcolumn();
        if($usernameExists > 0){
            return 'Username is Already In Use';
        }
    }

    public function register()
    {
        $sql = "INSERT INTO visitors (first_name, last_name, email, contact_number, date_of_birth, address_street, address_city, address_barangay, address_province, address_zip, country, gender_id, id_type) 
            VALUES (:first_name, :last_name, :email, :contact_number, :date_of_birth, :street, :city, :barangay, :province, :zip, :country, :gender, :id_type);";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':contact_number', $this->contact_number);
        $stmt->bindParam(':date_of_birth', $this->date_of_birth);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':barangay', $this->barangay);
        $stmt->bindParam(':province', $this->province);
        $stmt->bindParam(':zip', $this->zip);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':id_type', $this->id_type);

        // Execute the visitor insert query
        if ($stmt->execute()) {
            // Get the last inserted visitor_id
            $visitor_id = $this->db->connect()->lastInsertId();
            // Prepare the second query to insert username and password into VisitorCredentials
            $sql2 = "INSERT INTO VisitorCredentials (visitor_id, username, password_hash) 
                     VALUES (:visitor_id, :username, :password_hash)";
            // Prepare and bind the second query
            $stmt2 = $this->db->connect()->prepare($sql2);
            $stmt2->bindParam(':visitor_id', $visitor_id);  // Use the last inserted ID
            $stmt2->bindParam(':username', $this->username);
            $stmt2->bindParam(':password_hash', $this->password);

            // Execute the credentials insert query
            if ($stmt2->execute()) {
                header('Location: ../../public/login.php');
                exit();
            } else {
                echo "Error creating user credentials: ";
            }
        } else {
            echo "Error creating user: ";
        }
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE visitor_id = :visitor_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':visitor_id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id)
    {
        $sql = "UPDATE visitors SET first_name = :first_name, last_name = :last_name, email = :email, contact_number = :contact_number, date_of_birth = :date_of_birth, street = :street, city = :city, barangay = :barangay, province = :province, zip = :zip, country = :country, id_document_path = :id_document_path, gender_id = :gender WHERE visitor_id = :visitor_id";

        $stmt = $this->db->connect()->prepare($sql);

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':contact_number', $this->contact_number);
        $stmt->bindParam(':date_of_birth', $this->date_of_birth);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':barangay', $this->barangay);
        $stmt->bindParam(':province', $this->province);
        $stmt->bindParam(':zip', $this->zip);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':visitor_id', $id);

        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE visitor_id = :visitor_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':visitor_id', $id);
        return $stmt->execute();
    }

    function login($username, $password)
    {
        $sql = "SELECT * FROM visitorcredentials WHERE username = :username LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam('username', $username);

        if ($query->execute()) {
            $data = $query->fetch();
            if ($data && password_verify($password, $data['password_hash'])) {
                return true;
            }
        }

        return $php_errormsg = 'invalid username/password';
    }

    function fetch($username){
        $sql = "SELECT * FROM visitorcredentials WHERE username = :username LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(':username', $username);

        if ($query->execute()) {
            return $query->fetch();
        }
        return false;
    }

    function fetchGender(){
        $sql = "SELECT * FROM gender;";
        $query = $this->db->connect()->prepare($sql);
        if($query->execute()){
            return $query->fetchAll();
        }
        return false;
    }
}

