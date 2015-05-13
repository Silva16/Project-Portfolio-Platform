<?php namespace Ainet\Models;

class User extends AbstractModel
{
    public $id;
    public $email;
    public $password;
    public $name;
    public $registeredAt;
    public $role;

    public static $roles = array(0 => "Administrator", 1 => "Editor", 2 => "Author");

    public function __construct(
        $id = null,
        $email = null,
        $password = null,
        $name = null,
        $role = null,
        $registeredAt = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->registeredAt = $registeredAt;
        $this->role = $role;
    }

    public static function all()
    {
        $users = [];
        $conn = AbstractModel::dbConnection();
        $query = "SELECT * FROM users";

        $statement = $conn->query($query);
        try {

            while ($user = $statement->fetch_object()) {
                $users[$user->id] = $user;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
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
        $query = "INSERT INTO users (name, email, password, registeredAt, role) VALUES (?, ?, ?, ?, ?)";
        AbstractModel::dbQuery($conn, $user, $query);

        AbstractModel::dbClose($conn);


    }

    public static function save($user)
    {
        $conn = AbstractModel::dbConnection();

        $checkEdit = true;
        //$email = $conn->real_escape_string($user->email);

        $query = "UPDATE users set name = ?, email = ?, role = ? WHERE id=?";
        AbstractModel::dbQuery($conn, $user, $query, $checkEdit);

        AbstractModel::dbClose($conn);
    }

    public static function delete($id)
    {
        var_dump($id);
        die("DELETE STATEMENT HERE");
    }

}
