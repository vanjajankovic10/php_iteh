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
        $query = "UPDATE purpose set name = '$this->name',brand = '$this->brand',
                   user_id = '$this->user_id',skincare_id = '$this->skincare_id'  WHERE id=$this->id";
        return $conn->query($query);
    }

    public function delete(mysqli $conn)
    {
        $query = "DELETE FROM purpose WHERE id='$this->id'";
        return $conn->query($query);
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
}
