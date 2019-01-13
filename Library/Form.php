<?php

namespace Library;

/**
 * Class : Form
 * Namespace : FrameWork\Library
 * Author : Florian GOMES
 * Last modification : 06/07/2017
 * Description :
 *     The Form library provide usefull method to check form values.
**/
class Form {
    
    /**
     * Check the presence the variable give in parameter.
     * use $_POST variable.
     * @param array $var : ($key) the list
     * @return bool : true if all values are present.
    **/
    public function check_post_raw_values(Array $var) {
        foreach ($var as $v) {
            if (!isset($_POST[$v])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check the presence and escape all the variable give in parameter.
     * use $_POST variable.
     * @param array $var : ($key) the list
     * @return bool : true if all values are present.
    **/
    public function check_post_values(Array $var) {
        foreach ($var as $v) {
            if (!isset($_POST[$v])) {
                return false;
            }/* else {
                $_POST[$v] = htmlspecialchars($_POST[$v]);
            }*/
        }
        return true;
    }

    /**
     * Escape all the variable give in parameter.
     * use $_POST variable.
     * @param array $var : ($key) the list
     * @return bool : true.
    **/
    public function check_post_values_op(Array $var) {
        /*foreach ($var as $v) {
            if (isset($_POST[$v]))
                $_POST[$v] = htmlspecialchars($_POST[$v]);
        }*/
        return true;
    }

    /**
     * Check the content and escape all the variable give in parameter.
     * use $_POST variable.
     * @param array $var : ($key) the list
     * @return bool : true if all values are present.
    **/
    public function check_post_values_not_empty(Array $var) {
        foreach ($var as $v) {
            if (!isset($_POST[$v]) || empty($_POST[$v])) {
                return false;
            } /*else {
                $_POST[$v] = htmlspecialchars($_POST[$v]);
            }*/
        }
        return true;
    }

    /**
     * Check the content the variable give in parameter.
     * use $_POST variable.
     * @param array $var : ($key) the list
     * @return bool : true if all values are present.
    **/
    public function check_post_raw_values_not_empty(Array $var) {
        foreach ($var as $v) {
            if (!isset($_POST[$v]) || empty($_POST[$v])) {
                return false;
            } /*else {
                $_POST[$v] = htmlspecialchars($_POST[$v]);
            }*/
        }
        return true;
    }
}