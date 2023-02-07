<?php

class Task {
    public $id;
    public $title;
    public $project;
    public $type;
    public $assignee;
    public $description;
    public $story_points;

    public function __construct($id, $title, $project, $type, $assignee = NULL, $description = NULL, $story_points = NULL){
        $this->id = $id;
        $this->title = $title;
        $this->project = $project;
        $this->type = $type;
        $this->assignee = $assignee;
        $this->description = $description;
        $this->story_points = $story_points;
    }

    public static function loadFromJson($data){
        if(isset($data->id) && isset($data->title) && isset($data->project) && isset($data->type)) {
            $id = $data->id;
            $title = $data->title;
            $project = $data->project;
            $type = $data->type;
            $assignee = $data->assignee ?? NULL;
            $description = $data->description ?? NULL;
            $story_points = $data->story_points ?? NULL;
        } else {
            throw new Exception('Missing mandatory fields when parsing Task: ' . json_encode($data));
        }

        return new Task($id, $title, $project, $type,  $assignee, $description, $story_points);
    }

    public static function loadPartialTaskFromJson($id, $oldTask, $data) {
        $title = $data->title ?? $oldTask->title;
        $project = $data->project ?? $oldTask->project;
        $type = $data->type ?? $oldTask->type;
        $assignee = $data->assignee ?? $oldTask->assignee;
        $description = $data->description ?? $oldTask->description;
        $story_points = $data->story_points ?? $oldTask->story_points;

        return new Task($id, $title, $project, $type, $assignee, $description, $story_points);
    }
}

?>