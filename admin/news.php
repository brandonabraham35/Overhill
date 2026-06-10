<?php
require_once __DIR__ . '/includes/crud.php';
$cfg = [
  'table'=>'news','title'=>'News','singular'=>'Article','order'=>'created_at DESC',
  'search'=>['title','excerpt','body'],
  'fields'=>[
    ['name'=>'title','label'=>'Title','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'slug','label'=>'Slug','type'=>'slug','from'=>'title'],
    ['name'=>'excerpt','label'=>'Excerpt','type'=>'text'],
    ['name'=>'body','label'=>'Article Body','type'=>'textarea','required'=>true],
    ['name'=>'image','label'=>'Featured Image','type'=>'image'],
    ['name'=>'published_at','label'=>'Publish Date','type'=>'date'],
    ['name'=>'is_published','label'=>'Published','type'=>'checkbox','list'=>true],
  ],
];
crud_handle($cfg);
$pageTitle='News'; include __DIR__.'/includes/header.php'; crud_render($cfg); include __DIR__.'/includes/footer.php';
