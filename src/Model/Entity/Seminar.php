<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Seminar extends Entity {
  protected $_accessible = [
    '*' => true,
    'id' => false
  ];
}