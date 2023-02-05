<?php

class Project {
    public $id;
    public $title;
    public $owner;
    public $deadline;
    public $tasks;
    // TODO: Do we want to have a roadmap here?

    public function __construct($id, $title, $owner = NULL, $deadline = NULL, $tasks = NULL) {
        $this->id = $id;
        $this->title = $title;
        $this->owner = $owner;
        $this->deadline = $deadline;
        $this->tasks = $tasks;
    }

    public function addTasks($tasks) {
        $this->tasks = $tasks;
    }

    public static function loadFromJson($data){
        if(isset($data->id) && isset($data->title)) {
            $id = $data->id;
            $title = $data->title;
            $owner = $data->owner ?? NULL;
            $deadline = $data->deadline ?? NULL;
        } else {
            throw new Exception('Missing mandatory fields when parsing User: ' . json_encode($data));
        }

        return new Project($id, $title, $owner, $deadline);
    }
}
?>