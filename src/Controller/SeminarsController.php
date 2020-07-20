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
    $this->viewBuilder()->Layout('Seminars');
    $this->loadComponent('paginator');
    $this->Flash = $this->loadComponent('Flash');
    $this->Auth = $this->loadComponent('Auth',[
      'authenticate'=> [
        'Form' =>['useModel' => 'Seminars',
        'fields' => ['username'=>'email','password'=>'password'],
        'finder'=>'auth']
      ],
      'loginAction' => [
        'controller' => 'Seminars',
        'action' => 'index'
      ],
      'loginRedirect' => [
          'controller' => 'Seminars',
          'action' => 'index'
      ],
      'logoutRedirect' => [
          'controller' => 'Seminars',
          'action' => 'index',
          'home'
      ],
      'authorize' => ['Controller']
    ]);
  }

  public function index() {
    if ($this->request->is('post')) {
      $user = $this->Auth->identify();
      if ($user) {
        $this->Auth->setUser($user);
        $this->log($this->Auth->user());
        $this->Flash->success(__('ログインが完了しました！'));
        return $this->redirect($this->Auth->redirectUrl());
      } else {
        $this->log('test1');
        $this->Flash->error(__('ユーザ名もしくはパスワードが間違っています'));
      }
    }
    $this->set('entity',$this->Seminars->newEntity());
    $this->set('user',$this->Users->newEntity());
    $seminars = $this->paginate($this->Seminars);
    $this->set('seminars',$seminars);
  }

  public function search() {
    $this->set('entity',$this->Seminars->newEntity());
    $this->set('user',$this->Users->newEntity());
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
    $this->render('index');
  }

}