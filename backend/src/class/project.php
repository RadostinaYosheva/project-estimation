<?php

class Project {
    public $id;
    public $title;
    public $status;
    public $owner;
    public $deadline;
    public $tasks;

    public function __construct($id, $title, $status, $owner = NULL, $deadline = NULL, $tasks = NULL) {
        $this->id = $id;
        $this->title = $title;
        $this->status = $status;
        $this->owner = $owner;
        $this->deadline = $deadline;
        $this->tasks = $tasks;
    }

    public function addTasks($tasks) {
        $this->tasks = $tasks;
    }

    public static function loadFromJson($data){
        if(isset($data->title)) {
            $id = $data->id;
            $title = $data->title;
            $status = $data->status ?? 'New';
            $owner = $data->owner ?? NULL;
            $deadline = $data->deadline ?? NULL;
        } else {
            throw new Exception('Missing mandatory fields when parsing User: ' . json_encode($data));
        }

        return new Project($id, $title, $status, $owner, $deadline);
    }

    public static function loadPartialProjectFromJson($id, $oldProject, $data) {
        $title = $data->title ?? $oldProject->title;
        $status = $data->status ?? $oldProject->status;
        $owner = $data->owner ?? $oldProject->owner;
        $deadline = $data->deadline ?? $oldProject->deadline;

        return new Project($id, $title, $status, $owner, $deadline);
    }
}
?>