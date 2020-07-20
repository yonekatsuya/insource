<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ConsiderationsController extends AppController {
  public function initialize() {
    $this->name = 'Considerations';
    $this->Auth = $this->loadComponent('Auth');
    $this->Seminars = TableRegistry::get('seminars');
    $this->Users = TableRegistry::get('users');
    $this->Orders = TableRegistry::get('orders');

    $this->set('order',$this->Orders->newEntity());

    $this->viewBuilder()->Layout('Seminars');

    $this->loadComponent('paginator');
    $this->Flash = $this->loadComponent('Flash');
    $this->Auth = $this->loadComponent('Auth');
  }

  public function index() {
    $session = $this->request->session();

    $id = $session->read('LoginUser.id');
    $user = $this->Users->find()->where(['id'=>$id]);

    // ログインユーザーの検討リスト一覧を取得する
    $considerations = $this->Considerations->find()->where(['user_id'=>$id])->order(['created_at'=>'desc']);
    $considerations = $considerations->toArray();
    $array = [];
    foreach ($considerations as $consideration) {
      $array[] = $consideration->seminar_id;
    }
    
    $considerations = [];
    foreach ($array as $item) {
      $considerations[] = ($this->Seminars->find()->where(['id'=>$item]))->toArray();
    }
    // ここまで

    $this->set('considerations',$considerations);
    $this->set('session',$session);
    $this->set('login_id',$id);
  }

  public function store() {
    $this->autoRender = false;
    if ($this->request->is('post')) {
      $consideration = $this->Considerations->newEntity();
      $consideration->user_id = $this->request->data('user_id');
      $consideration->seminar_id = $this->request->data('seminar_id');
      
      if ($this->Considerations->save($consideration)) {
        echo 'OK';
      } else {
        echo 'NG';
      }
    }
  }

  public function delete() {
    $session = $this->request->session();

    $user_id = $session->read('LoginUser.id');
    $seminar_id = $this->request->data('consideration-cancel');

    $consideration = $this->Considerations->find()->where(['user_id'=>$user_id])->andWhere(['seminar_id'=>$seminar_id]);
    $result = $this->Considerations->deleteAll(['id' => $consideration->toArray()[0]->id]);

    if ($result) {
      $this->Flash->success('検討リストから削除しました。');
    } else {
      $this->Flash->error('検討リストから削除出来ませんでした。');
    }

    $this->redirect(['action'=>'index']);
  }
}