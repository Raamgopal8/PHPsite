<?php
namespace App\Core;

class View {
    public static function render($file, $data = []) {
        extract($data);
        require $file;
    }
}
