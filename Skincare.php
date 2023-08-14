<?php

class Skincare
{

    private $id;
    private $name;
    private $skin_type;
    private $comment;

    public function __construct($id = null, $name = null, $skin_type = null, $comment = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->skin_type = $skin_type;
        $this->comment = $comment;
    }

    public function add(mysqli $conn)
    {
        $query = "INSERT INTO skincare (name,skin_type,comment) 
                 VALUES ('$this->name','$this->skin_type','$this->comment');";
        return $conn->query($query);
    }

    public function update(mysqli $conn)
    {
        $query = "UPDATE skincare set name = '$this->name',skin_type = '$this->skin_type',
                comment = '$this->comment'  WHERE id='$this->id'";
        return $conn->query($query);
    }

    public function delete(mysqli $conn)
    {
        $query = "DELETE FROM skincare WHERE id='$this->id'";
        return $conn->query($query);
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM skincare";
        return $conn->query($query);
    }


    public static function getSkincare($id, mysqli $conn)
    {
        $query = "SELECT * FROM skincare WHERE id='$id'";

        $skincare = array();
        if ($obj = $conn->query($query)) {
            while ($array = $obj->fetch_array(1)) {
                $skincare[] = $array;
            }
        }

        return $skincare;
    }
}
