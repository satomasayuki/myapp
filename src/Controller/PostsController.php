<?php

namespace App\Controller;

class PostsController extends AppController {
  public function index() {
    // select * from posts order by created asc;  asc 昇順（小さい順、古い順） desc 降順（大きい順、新しい順）
    $posts = $this->Posts->find('all')
    ->order(['created'=>'desc']);
    // $this->set(['posts' => $posts]);
    $this->set(compact('posts'));
  }
  // 詳細画面
  public function view($id = null)
  {
    $post = $this->Posts->get($id, ['contain' => 'Comments']);
    $this->set(compact('post'));
}

  // 登録画面
 public function add()
{
  $post = $this->Posts->newEntity();
  if ($this->request->is('post')) {
    $post = $this->Posts->patchEntity($post, $this->request->data);
    if ($this->Posts->save($post)) {
      $this->Flash->success('登録しました。');    // 追加
      return $this->redirect(['action'=>'index']);
    } else {
      // error
      $this->Flash->error('登録エラー');          // 追加
    }
  }
  $this->set(compact('post'));
}


// 編集画面
public function edit($id = null)
{
  $post = $this->Posts->get($id);
  if ($this->request->is(['post', 'patch', 'put'])) {
    $post = $this->Posts->patchEntity($post, $this->request->data);
    if ($this->Posts->save($post)) {
      $this->Flash->success('編集しました。');
      return $this->redirect(['action'=>'index']);
    } else {
      // error
      $this->Flash->error('編集エラー');
    }
  }
  $this->set(compact('post'));
}

// 削除
public function delete($id = null)
{
  $this->request->allowMethod('post');
  $post = $this->Posts->get($id);
  if ($this->Posts->delete($post)) {
    $this->Flash->success('削除しました。');
  } else {
    $this->Flash->error('削除エラー');
  }
  return $this->redirect(['action'=>'index']);
}
}