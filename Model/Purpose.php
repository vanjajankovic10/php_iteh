<?php

class Purpose
{
    private $id;
    private $name;
    private $brand;
    private $user_id;
    private $skincare_id;



    public function __construct($id = null, $name = null, $brand = null, $user_id = null, $skincare_id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->user_id = $user_id;
        $this->skincare_id = $skincare_id;
    }


    public function add(mysqli $conn)
    {
        $query = "INSERT INTO purpose (name,brand,user_id,skincare_id)
                 VALUES ('$this->name','$this->brand','$this->user_id','$this->skincare_id');";
        return $conn->query($query);
    }

    public function update(mysqli $conn)
    {
        $query = "UPDATE purpose SET name = ?, brand = ?, user_id = ?, skincare_id = ? WHERE id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssiii", $this->name, $this->brand, $this->user_id, $this->skincare_id, $this->id);

        return $stmt->execute();
    }


    public function delete(mysqli $conn)
    {
        $query = "DELETE FROM purpose WHERE id=?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $this->id);
            $result = $stmt->execute();
            $stmt->close();

            return $result;
        }
    }

    public static function getAll(mysqli $conn)
    {
        $upit = "SELECT * FROM purpose";
        return $conn->query($upit);
    }


    public static function getPurpose($id, mysqli $conn)
    {
        $query = "SELECT * FROM purpose WHERE id='$id'";

        $purpose = array();
        if ($obj = $conn->query($query)) {
            while ($array = $obj->fetch_array(1)) {
                $purpose[] = $array;
            }
        }

        return $purpose;
    }

    public static function getPurposesBySkincareID($skincare_id, $conn)
    {
        $query = "SELECT * FROM purpose WHERE skincare_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $skincare_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $elements = array();
        while ($row = $result->fetch_assoc()) {
            $elements[] = $row;
        }

        return $elements;
    }

    public static function getPurposeIdByConditions(mysqli $conn, $skincare_id)
    {
        $query = "SELECT id FROM purpose WHERE  skincare_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $skincare_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ids = array();
        while ($row = $result->fetch_assoc()) {
            $ids[] = $row;
        }
        return $ids;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}
