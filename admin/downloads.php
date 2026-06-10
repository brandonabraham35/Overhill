<?php
require_once __DIR__ . '/includes/crud.php';
$cfg = [
  'table'=>'downloads','title'=>'Downloads','singular'=>'File','order'=>'created_at DESC',
  'search'=>['title','category'],
  'fields'=>[
    ['name'=>'title','label'=>'Title','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'category','label'=>'Category','type'=>'text','list'=>true],
    ['name'=>'file','label'=>'File (PDF/DOCX)','type'=>'document','required'=>true,'list'=>true],
  ],
];
crud_handle($cfg);
$pageTitle='Downloads'; include __DIR__.'/includes/header.php'; crud_render($cfg); include __DIR__.'/includes/footer.php';
