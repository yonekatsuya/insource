<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class OrdersController extends AppController {
  public function initialize() {
    $this->name = 'Orders';
    $this->Seminars = TableRegistry::get('seminars');
    $this->viewBuilder()->Layout('Seminars');
    $this->loadComponent('paginator');
    $this->Flash = $this->loadComponent('Flash');
    $this->Auth = $this->loadComponent('Auth');
  }

  public function index() {

  }

  public function store() {
    $order = $this->Orders->newEntity();
    $this->log($this->Auth->user('id'));
    $this->log($this->request->data('order-id'));
    $order->user_id = $this->Auth->user('id');
    $order->seminar_id = $this->request->data('order-id');
    if ($this->Orders->save($order)) {
      $this->Flash->success('研修の申し込みが完了しました。');
    } else {
      $this->Flash->error('研修の申し込みに失敗しました。');
    }
    $this->render('index');
  }
}