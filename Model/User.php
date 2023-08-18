<?php

class User
{
    public $id;
    public $name;
    public $surname;
    public $birthday;
    public $gender;
    public $username;
    public $password;

    public function __construct($id = null, $name = null, $surname = null, $birthday = null, $gender = null, $username = null, $password = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->username = $username;
        $this->password = $password;
    }

    public function add(mysqli $conn)
    {
        $query = "INSERT INTO users(username,password,name,surname,gender,birthday)
         VALUES('$this->username','$this->password','$this->name','$this->surname','$this->gender','$this->birthday');";
        return $conn->query($query);
    }

    public function update(mysqli $conn)
    {
        $query = "UPDATE users set username='$this->username', password='$this->password', name='$this->name',
             surname='$this->surname', gender='$this->gender', birthday='$this->birthday' WHERE id=$this->id;";
        return $conn->query($query);
    }

    public function delete(mysqli $conn)
    {
        $querry = "DELETE FROM users WHERE id='$this->id'";
        return $conn->query($querry);
    }

    public static function getAll(mysqli $conn)
    {
        $querry = "SELECT * FROM users";
        return $conn->query($querry);
    }

    public static function getUser($id, mysqli $conn)
    {
        $query = "SELECT * FROM users WHERE id='$id'";

        $user = array();
        if ($obj = $conn->query($query)) {
            while ($array = $obj->fetch_array(1)) {
                $user[] = $array;
            }
        }

        return $user;
    }

    public static function getUserUsername($username, mysqli $conn)
    {
        $querry = "SELECT * FROM users WHERE username='$username'";

        $user = array();
        if ($obj = $conn->query($querry)) {
            while ($array = $obj->fetch_array(1)) {
                $user[] = $array;
            }
        }

        return $user;
    }

    public static function getUserID($username, mysqli $conn)
    {
        $password = $_POST['password'];
        $sql = "SELECT id FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $user_id = $user['id'];
        }
    }
}
