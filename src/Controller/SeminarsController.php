<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class SeminarsController extends AppController {
  public $paginate = [
    'limit' => 20,
    'order' => [
      'id' => 'DESC'
    ]
  ];

  public function initialize() {
    $this->name = 'Seminars';

    $this->Users = TableRegistry::get('users');
    $this->Orders = TableRegistry::get('orders');
    $this->Considerations = TableRegistry::get('considerations');

    $this->viewBuilder()->Layout('Seminars');

    $this->loadComponent('paginator');
    $this->Flash = $this->loadComponent('Flash');

    $this->set('order',$this->Orders->newEntity());
    $session = $this->request->session();
    $login_id = $session->read('LoginUser.id');
    $this->set('login_id',$login_id);
  }

  public function index() {
    $this->set('entity',$this->Seminars->newEntity());
    $this->set('user',$this->Users->newEntity());
    $this->set('order',$this->Orders->newEntity());
    $seminars = $this->paginate($this->Seminars);
    $this->set('seminars',$seminars);

    // 検討リストに追加済みかどうか判定するために、検討リスト一覧を取得
    $session = $this->request->session();
    $id = $session->read('LoginUser.id');
    $login_seminars = ($this->Considerations->find()->where(['user_id'=>$id]))->toArray();

    $array = [];
    foreach ($login_seminars as $item) {
      $array[] = $item->seminar_id;
    }
    $this->set('login_seminars',$array);

    // 申し込み済みかどうか判定するために、申し込み一覧を取得
    $order_seminars = ($this->Orders->find()->where(['user_id'=>$id]))->toArray();

    $array2 = [];
    foreach ($order_seminars as $item) {
      $array2[] = $item->seminar_id;
    }
    $this->set('order_seminars',$array2);

  }

  public function search() {
    $this->set('entity',$this->Seminars->newEntity());
    $this->set('user',$this->Users->newEntity());
    $this->set('order',$this->Orders->newEntity());
    if ($this->request->is('get')) {
      $name = $this->request->query['name'];
      $place = $this->request->query['place'];

    if ($this->request->query['from_date'] === '' && $this->request->query['to_date'] === '') {
      $from_date = '0000-00-00';
      $to_date = '9999-00-00';
    } else if ($this->request->query['from_date'] !== '' && $this->request->query['to_date'] === '') {
      $to_date = '9999-00-00';
    } else if ($this->request->query['from_date'] === '' && $this->request->query['to_date'] !== '') {
      $from_date = '0000-00-00';
    } else {
      $from_date = $this->request->query['from_date'];
      $from_date = str_replace("/","-",$from_date);
      $from_date = explode("-",$from_date);
      $from_date = $from_date[2] . '-' . $from_date[0] . '-' . $from_date[1];
      $to_date = $this->request->query['to_date'];
      $to_date = str_replace("/","-",$to_date);
      $to_date = explode("-",$to_date);
      $to_date = $to_date[2] . '-' . $to_date[0] . '-' . $to_date[1];
    }

      $this->paginate = [
        'limit' => 20,
        'order' => [
          'id' => 'DESC'
        ],
        'conditions' => ['name like'=>"%{$name}%",
                          'place like'=>"%{$place}%",
                          'date >='=>$from_date,
                          'date <='=>$to_date
                        ]
      ];

      $seminars = $this->paginate($this->Seminars);
      $this->set('seminars',$seminars);
    }

    // 検討リストに追加済みかどうか判定するために、検討リスト一覧を取得
    $session = $this->request->session();
    $id = $session->read('LoginUser.id');
    $login_seminars = ($this->Considerations->find()->where(['user_id'=>$id]))->toArray();

    $array = [];
    foreach ($login_seminars as $item) {
      $array[] = $item->seminar_id;
    }
    $this->set('login_seminars',$array);

    // 申し込み済みかどうか判定するために、申し込み一覧を取得
    $order_seminars = ($this->Orders->find()->where(['user_id'=>$id]))->toArray();

    $array2 = [];
    foreach ($order_seminars as $item) {
      $array2[] = $item->seminar_id;
    }
    $this->set('order_seminars',$array2);

    $this->render('index');
  }

}