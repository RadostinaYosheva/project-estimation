<?php

class User {
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    // TODO: Do we want to have an array/list of task or projects or both?

    public function __construct($id, $first_name, $second_name, $email = NULL){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
    }

    public static function loadFromJson($data){
        if(isset($data->id) && isset($data->first_name) && isset($data->last_name)) {
            $id = $data->id;
            $first_name = $data->first_name;
            $last_name = $data->last_name;
            $email = $data->email ?? NULL;
        } else {
            throw new Exception('Missing mandatory fields when parsing User: ' . json_encode($data));
        }

        return new User($id, $first_name, $last_name, $email);
    }
}

?>