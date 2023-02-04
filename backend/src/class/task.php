<?php

class Task {
    public $id;
    public $title;
    public $project;
    public $description;
    public $type;
    public $assignee;
    public $story_points;
    // TODO: Do we want to have an array/list of task or projects or both?

    public function __construct($id, $title, $project, $description = NULL, $type = NULL, $assignee = NULL, $story_points = NULL){
        $this->id = $id;
        $this->title = $title;
        $this->project = $project;
        $this->description = $description;
        $this->type = $type;
        $this->assignee = $assignee;
        $this->story_points = $story_points;
    }
}