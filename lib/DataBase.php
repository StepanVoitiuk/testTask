<?php

namespace lib;
use PDO;

class DataBase {

    protected $db;

    public function __construct() {
        $config = require 'config/db.config.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].'', $config['user'], $config['password']);
    }

    public function query($sql, $params = []) {
        $query = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if($key ==='age'){
                    $val = (int)($val);
                }
                $query->bindValue(':'.$key, $val);
            }
        }
        $query->execute();
        return $query;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }


}