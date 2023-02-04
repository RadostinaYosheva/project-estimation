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
        $this->second_name = $second_name;
        $this->email = $email;
    }
}