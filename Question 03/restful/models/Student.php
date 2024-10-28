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
    }

    public function update() {
    }

    public function delete() {

    }
}
?>