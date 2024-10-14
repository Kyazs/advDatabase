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

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    public function register()
    {
        // Check if email already exists
        $checkEmailSql = "SELECT COUNT(*) FROM visitors WHERE email = :email";
        $checkEmailStmt = $this->db->connect()->prepare($checkEmailSql);
        $checkEmailStmt->bindParam(':email', $this->email);
        $checkEmailStmt->execute();
        $emailExists = $checkEmailStmt->fetchColumn();

        if ($emailExists > 0) {
            echo "Error: Email already exists.";
            return header('Location: ' . __DIR__ . '/../../resources/visitor/register.php');
        }

        $sql = "INSERT INTO visitors (first_name, last_name, email, contact_number, date_of_birth, street, city, barangay, province, zip, country, gender) 
            VALUES (:first_name, :last_name, :email, :contact_number, :date_of_birth, :street, :city, :barangay, :province, :zip, :country, :gender);";
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
                echo "User created successfully.";
                header('Location: ' . __DIR__ . '/../../public/index.php');
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
        $sql = "UPDATE visitors SET first_name = :first_name, last_name = :last_name, email = :email, contact_number = :contact_number, date_of_birth = :date_of_birth, street = :street, city = :city, barangay = :barangay, province = :province, zip = :zip, country = :country, id_document_path = :id_document_path, gender = :gender WHERE visitor_id = :visitor_id";

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
}
