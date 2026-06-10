<?php
require_once __DIR__ . '/includes/crud.php';
$cfg = [
  'table'=>'leadership','title'=>'Leadership','singular'=>'Leader','order'=>'sort_order ASC, id ASC',
  'search'=>['name','title'],
  'fields'=>[
    ['name'=>'name','label'=>'Name','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'title','label'=>'Title','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'message','label'=>'Message','type'=>'textarea'],
    ['name'=>'photo','label'=>'Photo','type'=>'image','list'=>true],
    ['name'=>'sort_order','label'=>'Sort Order','type'=>'number'],
  ],
];
crud_handle($cfg);
$pageTitle='Leadership'; include __DIR__.'/includes/header.php'; crud_render($cfg); include __DIR__.'/includes/footer.php';
