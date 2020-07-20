<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class OrdersController extends AppController {
  public function initialize() {
    $this->name = 'Orders';
    $this->Seminars = TableRegistry::get('seminars');
    $this->Users = TableRegistry::get('users');
    $this->viewBuilder()->Layout('Seminars');
    $this->loadComponent('paginator');
    $this->Flash = $this->loadComponent('Flash');
    $this->Auth = $this->loadComponent('Auth');
  }

  public function index() {
    $session = $this->request->session();

    $id = $session->read('LoginUser.id');
    $user = $this->Users->find()->where(['id'=>$id]);

    // ログインユーザーの申し込み研修一覧を取得する
    $orders = $this->Orders->find()->where(['user_id'=>$id]);
    $orders = $orders->toArray();
    $array = [];
    foreach ($orders as $order) {
      $array[] = $order->seminar_id;
    }
    
    $orders = [];
    foreach ($array as $item) {
      $orders[] = ($this->Seminars->find()->where(['id'=>$item]))->toArray();
    }
    // ここまで

    $this->set('orders',$orders);
    $this->set('session',$session);
  }

  public function store() {
    $session = $this->request->session();

    $order = $this->Orders->newEntity();
    $order->user_id = $session->read('LoginUser.id');
    $order->seminar_id = $this->request->data('order-id');
    if ($this->Orders->save($order)) {
      $this->Flash->success('研修の申し込みが完了しました。');
    } else {
      $this->Flash->error('研修の申し込みに失敗しました。');
    }
    $this->redirect(['action'=>'index']);
  }
}