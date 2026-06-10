<?php
require_once __DIR__ . '/includes/crud.php';
$cfg = [
  'table'=>'announcements','title'=>'Announcements','singular'=>'Announcement','order'=>'created_at DESC',
  'search'=>['title','body'],
  'fields'=>[
    ['name'=>'title','label'=>'Title','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'body','label'=>'Body','type'=>'textarea','required'=>true],
    ['name'=>'is_active','label'=>'Active','type'=>'checkbox','list'=>true],
  ],
];
crud_handle($cfg);
$pageTitle='Announcements'; include __DIR__.'/includes/header.php'; crud_render($cfg); include __DIR__.'/includes/footer.php';
