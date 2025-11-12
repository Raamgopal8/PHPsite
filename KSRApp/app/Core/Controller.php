<?php
namespace App\Core;

class Controller {
    protected $db;
    public function __construct() {
        $app = new App();
        $this->db = $app->db;
    }

    protected function view($path, $data = []) {
        extract($data);
        require __DIR__ . '/../../views/layout.php';
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}
