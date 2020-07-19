<?php
namespace App\Controller;

class SeminarsController extends AppController {
  public $paginate = [
    'limit' => 20,
    'order' => [
      'id' => 'DESC'
    ]
  ];

  public function initialize() {
    $this->name = 'Seminars';
    $this->viewBuilder()->Layout('Seminars');
    $this->loadComponent('paginator');
  }

  public function index() {
    $seminars = $this->paginate($this->Seminars);
    $this->set('seminars',$seminars);
  }
}