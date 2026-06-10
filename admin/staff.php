<?php
require_once __DIR__ . '/includes/crud.php';
$cfg = [
  'table'=>'staff','title'=>'Staff','singular'=>'Staff Member','order'=>'sort_order ASC, id ASC',
  'search'=>['name','position','department'],
  'fields'=>[
    ['name'=>'name','label'=>'Name','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'position','label'=>'Position','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'department','label'=>'Department','type'=>'text','list'=>true],
    ['name'=>'bio','label'=>'Biography','type'=>'textarea'],
    ['name'=>'photo','label'=>'Photo','type'=>'image','list'=>true],
    ['name'=>'sort_order','label'=>'Sort Order','type'=>'number'],
  ],
];
crud_handle($cfg);
$pageTitle='Staff'; include __DIR__.'/includes/header.php'; crud_render($cfg); include __DIR__.'/includes/footer.php';
