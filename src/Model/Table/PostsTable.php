<?php
 
namespace App\Model\Table;
 
use Cake\ORM\Table;
use Cake\Validation\Validator;
 
class PostsTable extends Table
{
  public function initialize(array $config)
  {
    $this->addBehavior('Timestamp');
    // 追加
    $this->hasMany('Comments', ['dependent' => true]);
  }
 
  /**
   * バリデーションの設定
   */
  public function validationDefault(Validator $validator)
  {
    $validator
      ->notEmpty('title')
      ->requirePresence('title')
      ->add('title', [
        'length' => [
          'rule' => ['maxLength', 30],
          'message' => 'タイトルは30文字以内です。'
          ]
        ])
      ->notEmpty('body')
      ->requirePresence('body')->add('body', [
        'length' => [
          'rule' => ['minLength', 10],
          'message' => '本文は10文字以上です。'
        ]
      ]);
    return $validator;
  }
}