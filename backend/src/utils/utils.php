<?php

class Utils {
    public static function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }

    public static function loadIdFromJson($data) {
        if(isset($data->id)) {
            return $data->id;
        } else {
            throw new Exception('Missing mandatory field `id` when parsing User: ' . json_encode($data));
        }
    }
}

?>