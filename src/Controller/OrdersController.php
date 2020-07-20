<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class OrdersController extends AppController {
  public function initialize() {
    $this->name = 'Orders';

    $this->set('order',$this->Orders->newEntity());
    
    $this->Seminars = TableRegistry::get('seminars');
    $this->Users = TableRegistry::get('users');
    $this->Considerations = TableRegistry::get('considerations');

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
    $orders = $this->Orders->find()->where(['user_id'=>$id])->order(['created_at'=>'desc']);
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
    $this->set('login_id',$id);
  }

  public function store() {
    $session = $this->request->session();

    $order = $this->Orders->newEntity();
    $order->user_id = $session->read('LoginUser.id');

    if ($this->request->data('consideration-flag')) {
      $order->seminar_id = $this->request->data('consideration-order-id');
    } else {
      $order->seminar_id = $this->request->data('order-id');
    }

    $confirm_order = $this->Orders->find()->where(['user_id'=>$order->user_id])->andWhere(['seminar_id'=>$order->seminar_id]);

    $result = empty($confirm_order->toArray());

    // 既に申し込み済であるかどうかを判定し、まだ申し込んでない場合申し込み処理を行う
    if ($result) {
      if ($this->Orders->save($order)) {
        // 検討リストからの申し込みの時、申し込み研修を検討リストから削除する
        if ($this->request->data('consideration-flag')) {
          $consideration = $this->Considerations->find()->where(['user_id'=>$order->user_id])->andWhere(['seminar_id'=>$order->seminar_id]);
          $this->Considerations->deleteAll(['id'=>$consideration->toArray()[0]->id]);
        } else {
          // 研修一覧ページからの申し込みで、その研修が検討リスト一覧にあれば、検討リストから削除する
          $consideration = $this->Considerations->find()->where(['user_id'=>$order->user_id])->andWhere(['seminar_id'=>$order->seminar_id]);
          $result2 = empty($consideration->toArray());
          if (!$result2) {
            $this->Considerations->deleteAll(['id'=>$consideration->toArray()[0]->id]);
          }
        }

        $this->Flash->success('研修の申し込みが完了しました。');
      } else {
        $this->Flash->error('研修の申し込みに失敗しました。');
      }
    } else {
      $this->Flash->error('既に申し込み済みです。');
      $this->redirect(['controller'=>'Seminars','action'=>'index']);
    }

    $this->redirect(['action'=>'index']);
  }
  
  public function cancel() {
    $session = $this->request->session();

    $user_id = $session->read('LoginUser.id');
    $seminar_id = $this->request->data('seminar-cancel');

    $order = $this->Orders->find()->where(['user_id'=>$user_id])->andWhere(['seminar_id'=>$seminar_id]);
    $result = $this->Orders->deleteAll(['id' => $order->toArray()[0]->id]);

    if ($result) {
      $this->Flash->success('申し込み研修をキャンセルしました。');
    } else {
      $this->Flash->error('申し込み研修のキャンセルに失敗しました。');
    }

    $this->redirect(['action'=>'index']);
  }
}