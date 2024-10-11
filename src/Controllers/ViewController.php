<?php
class ViewController {
    public function render($view, $data = []) {
        extract($data);
        include_once __DIR__ . '/../Views/' . $view . '.php';
    }
}
?>
