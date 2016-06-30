<?php
/**
 * Project: mvc.com
 * Author: Ilia Ovchinnikov
 * Date: 24-Sep-14
 * Time: 20:35
 */

class View {
    public $data;
    private $path;

    public function __construct($path) {
        $path = APPLICATION_PATH . '/view/' . $path . '.html';

        if (!is_file($path))
            throw new InvalidArgumentException("Np view " . $path);

        $this->path = $path;
        $this->data = new ArrayObject();
    }

    public function render() {
        include $this->path;
    }
} 