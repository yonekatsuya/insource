<?php
namespace App\Controller;

class SeminarsController extends AppController {
  public function initialize() {
    $this->name = 'Seminars';
    $this->viewBuilder()->Layout('Seminars');
  }

  public function index() {
    
  }
}