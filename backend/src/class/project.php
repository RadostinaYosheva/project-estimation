<?php

class Project {
    public $id;
    public $title;
    public $owner;
    public $deadline;
    public $tasks;
    // TODO: Do we want to have a roadmap here?

    public function __construct($id, $title, $owner = NULL, $deadline = NULL, $tasks = NULL){
        $this->id = $id;
        $this->title = $title;
        $this->owner = $owner;
        $this->deadline = $deadline;
        $this->tasks = $tasks;
    }
}