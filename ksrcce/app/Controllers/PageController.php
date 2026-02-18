<?php
namespace App\Controllers;
use App\Core\Controller;

class PageController extends Controller {
    public function privacy() {
        $this->view('pages/privacy.php', ['title' => 'Privacy Policy']);
    }

    public function terms() {
        $this->view('pages/terms.php', ['title' => 'Terms of Service']);
    }
}
