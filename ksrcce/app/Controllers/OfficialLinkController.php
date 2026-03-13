<?php

namespace App\Controllers;

use App\Models\OfficialLink;
use App\Core\Request;
use App\Core\Controller;

class OfficialLinkController extends Controller {
    protected $officialLink;

    public function __construct() {
        parent::__construct();
        $this->officialLink = new OfficialLink($this->db);
    }

    public function index() {
        // Since we don't have a separate view for just the list in this architecture (it's part of dashboard),
        // we might not use this index method directly for a page load, 
        // but it could be used for an API or partial view.
        // For now, let's just return the links.
        $links = $this->officialLink->getLinks();
        return json_encode($links);
    }

    public function store() {
        $title = $_POST['title'] ?? '';
        $url = $_POST['url'] ?? '';
        $category = $_POST['category'] ?? 'General';

        if (empty($title) || empty($url)) {
            // Handle error - maybe redirect back with error
             header('Location: /admin/dashboard?error=Missing title or URL');
             exit;
        }

        if ($this->officialLink->create(['title' => $title, 'category' => $category, 'url' => $url])) {
             header('Location: /admin/dashboard?success=Link added successfully');
        } else {
             header('Location: /admin/dashboard?error=Failed to add link');
        }
        exit;
    }

    public function destroy($id) {
        if ($this->officialLink->delete($id)) {
            header('Location: /admin/dashboard?success=Link deleted successfully');
        } else {
            header('Location: /admin/dashboard?error=Failed to delete link');
        }
        exit;
    }
    
    // API endpoint for student dashboard if needed, or just helper
    public function getLinks() {
        header('Content-Type: application/json');
        echo json_encode($this->officialLink->getLinks());
        exit;
    }
}
