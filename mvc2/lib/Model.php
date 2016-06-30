<?php
/**
 * Project: mvc.com
 * Author: Ilia Ovchinnikov
 * Date: 24-Sep-14
 * Time: 20:53
 */

class Model {
    const DB_ADAPTER = 'mysql';
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'mvc-test';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';

    /** @var  $db PDO */
    protected $db;

    public function __construct() {
        $this->db = new PDO(Model::DB_ADAPTER . ':host=' . Model::DB_HOST . ';dbname=' . Model::DB_NAME, Model::DB_USERNAME, Model::DB_PASSWORD);
        $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
}