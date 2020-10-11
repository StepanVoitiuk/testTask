<?php

namespace core;

use lib\DataBase;

abstract class Model {

    public $db;
    /**
     * Model constructor.
     */
    public function __construct() {
        $this->db = new DataBase();
    }

}