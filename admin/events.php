<?php
require_once __DIR__ . '/includes/crud.php';
$cfg = [
  'table'=>'events','title'=>'Events','singular'=>'Event','order'=>'event_date DESC',
  'search'=>['title','location'],
  'fields'=>[
    ['name'=>'title','label'=>'Title','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'event_date','label'=>'Date','type'=>'date','required'=>true,'list'=>true],
    ['name'=>'event_time','label'=>'Time','type'=>'time'],
    ['name'=>'location','label'=>'Location','type'=>'text','list'=>true],
    ['name'=>'description','label'=>'Description','type'=>'textarea'],
    ['name'=>'image','label'=>'Image','type'=>'image'],
  ],
];
crud_handle($cfg);
$pageTitle='Events'; include __DIR__.'/includes/header.php'; crud_render($cfg); include __DIR__.'/includes/footer.php';
