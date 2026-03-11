<?php
require_once __DIR__ . '/../vendor/autoload.php';

try {
    $reflection = new ReflectionClass('App\Models\Question');
    echo "Methods in Question:\n";
    foreach ($reflection->getMethods() as $method) {
        echo "- " . $method->getName() . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
