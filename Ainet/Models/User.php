<?php namespace Ainet\Models;

class User extends AbstractModel
{
    public $id;
    public $email;
    public $password;
    public $fullname;
    public $registeredAt;
    public $type;

    public static $types = array(0 => "Administrator", 1 => "Publisher", 2 => "Client");

    public function __construct($id=null, $email=null, $password=null, $fullname=null, $type=null, $registeredAt=null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->registeredAt = $registeredAt;
        $this->type = $type;
    }

    public static function all()
    {
        $users = [];
        $conn = AbstractModel::dbConnection();
        $query = "SELECT * FROM users";

        $statement = $conn->query($query);
        try{

            while ($user = $statement->fetch_object()){
                $users[$user->id] = $user;
            }
        } catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        }

        AbstractModel::dbClose($conn);

        return $users;
    }

    public static function find($id)
    {
        $users = self::all();
        if (array_key_exists($id, $users)) {
            return $users[$id];
        }
        return null;
    }

    public static function add($user)
    {

        $conn = AbstractModel::dbConnection();
        $query = "INSERT INTO users (fullname, email, password, registeredAt, type) VALUES (?, ?, ?, ?, ?)";
        AbstractModel::dbQuery($conn, $user, $query);

        AbstractModel::dbClose($conn);


    }

    public static function save($user)
    {
        $conn = AbstractModel::dbConnection();

        $checkEdit = true;
        //$email = $conn->real_escape_string($user->email);

        $query = "UPDATE users set fullname = ?, email = ?, type = ? WHERE id=?";
        AbstractModel::dbQuery($conn, $user, $query, $checkEdit);

        AbstractModel::dbClose($conn);
    }

    public static function delete($id)
    {
        var_dump($id);
        die("DELETE STATEMENT HERE");
    }

}
