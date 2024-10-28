<?php
class Student {
    private $conn;
    private $table_name = "horizonstudent";

    public $id;
    public $indexNo;
    public $firstName;
    public $lastName;
    public $city;
    public $district;
    public $province;
    public $email;
    public $contact;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM $this->table_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        echo json_encode($$stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function readSingle() {
        $query = "SELECT * FROM $this->table_name WHERE id=:id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC) ?: []);
    }

    public function create() {
        $query = `INSERT INTO 
            $this->table (first_name, last_name, city, district, province, email_address, mobile_number) 
            VALUES (:fname, :lname, :city, :district, :province, :email, :contact)`;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fname', $this->firstName);
        $stmt->bindParam(':lname', $this->lastName);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':district', $this->district);
        $stmt->bindParam(':province', $this->province);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':mobile', $this->contact);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Student created successfully."]);
        } else {
            echo json_encode(["message" => "Student could not be created."]);
        }
    }

    public function update() {
    }

    public function delete() {

    }
}
?>