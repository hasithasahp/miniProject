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
    }

    public function readSingle() {
    }

    public function create() {
    }

    public function update() {
    }

    public function delete() {

    }
}
?>