<?php

class User {
    public $id;
    public $first_name;
    public $last_name;
    public $password;
    public $email;

    public function __construct($id, $first_name, $last_name, $password, $email = NULL){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->password = $password;
        $this->email = $email;
    }

    public static function loadFromJson($data) {
        if(isset($data->id) && isset($data->first_name) && isset($data->last_name) && isset($data->password)) {
            $id = $data->id;
            $first_name = $data->first_name;
            $last_name = $data->last_name;
            $password = $data->password;
            $email = $data->email ?? NULL;
        } else {
            throw new Exception('Missing mandatory fields when parsing User: ' . json_encode($data));
        }

        return new User($id, $first_name, $last_name, $password, $email);
    }

    public static function loadPassFromJson($data) {
        if(isset($data->password)) {
            return $data->password;
        } else {
            throw new Exception('Missing mandatory field `password` when parsing User: ' . json_encode($data));
        }
    }

    public static function loadPartialUserFromJson($id, $oldUser, $data) {
        $first_name = $data->first_name ?? $oldUser->first_name;
        $last_name = $data->last_name ?? $oldUser->last_name;
        $password = $data->password ?? $oldUser->password;
        $email = $data->email ?? $oldUser->email;

        return new User($id, $first_name, $last_name, $password, $email);
    }
}

?>