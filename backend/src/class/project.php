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

    public static function loadIdFromJson($data) {
        if(isset($data->id)) {
            return $data->id;
        } else {
            throw new Exception('Missing mandatory field `id` when parsing User: ' . json_encode($data));
        }
    }

    public static function loadPartialProjectFromJson($id, $oldProject, $data) {
        $title = $data->title ?? $oldProject->title;
        $owner = $data->owner ?? $oldProject->owner;
        $deadline = $data->deadline ?? $oldProject->deadline;

        return new Project($id, $title, $owner, $deadline);
    }
}
?>