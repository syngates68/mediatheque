<?php

namespace Config;

class Factory{

    public static function create($table){
        $class_name = "Model\\".ucfirst($table);
        return new $class_name();
    }

}