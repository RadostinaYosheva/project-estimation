<?php

class Task {
    public $id;
    public $title;
    public $project;
    public $assignee;
    public $description;
    public $type;
    public $story_points;

    public function __construct($id, $title, $project, $description = NULL, $type = NULL, $assignee = NULL, $story_points = NULL){
        $this->id = $id;
        $this->title = $title;
        $this->project = $project;
        $this->description = $description;
        $this->type = $type;
        $this->assignee = $assignee;
        $this->story_points = $story_points;
    }

    public static function loadFromJson($data){
        if(isset($data->id) && isset($data->title) && isset($data->project)) {
            $id = $data->id;
            $title = $data->title;
            $project = $data->project;
            $description = $data->description ?? NULL;
            $type = $data->type ?? NULL;
            $assignee = $data->assignee ?? NULL;
            $story_points = $data->story_points ?? NULL;
        } else {
            throw new Exception('Missing mandatory fields when parsing Task: ' . json_encode($data));
        }

        return new Task($id, $title, $project, $description, $type, $assignee, $story_points);
    }
}

?>