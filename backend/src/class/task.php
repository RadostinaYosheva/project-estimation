<?php

class Task {
    public $id;
    public $title;
    public $project;
    public $assignee;
    public $description;
    public $type;
    public $story_points;

    public function __construct($id, $title, $project,  $assignee = NULL, $description = NULL, $type, $story_points = NULL){
        $this->id = $id;
        $this->title = $title;
        $this->project = $project;
        $this->assignee = $assignee;
        $this->description = $description;
        $this->type = $type;
        $this->story_points = $story_points;
    }

    public static function loadFromJson($data){
        if(isset($data->id) && isset($data->title) && isset($data->project) && isset($data->type)) {
            $id = $data->id;
            $title = $data->title;
            $project = $data->project;
            $assignee = $data->assignee ?? NULL;
            $description = $data->description ?? NULL;
            $type = $data->type;
            $story_points = $data->story_points ?? NULL;
        } else {
            throw new Exception('Missing mandatory fields when parsing Task: ' . json_encode($data));
        }

        return new Task($id, $title, $project, $assignee, $description, $type, $story_points);
    }

    public static function loadPartialTaskFromJson($id, $oldTask, $data) {
        $title = $data->title ?? $oldTask->title;
        $project = $data->project ?? $oldTask->project;
        $assignee = $data->assignee ?? $oldTask->assignee;
        $description = $data->description ?? $oldTask->description;
        $type = $data->type ?? $oldTask->type;
        $story_points = $data->story_points ?? $oldTask->story_points;

        return new Task($id, $title, $project, $assignee, $description, $type, $story_points);
    }
}

?>