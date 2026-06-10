<?php
require_once __DIR__ . '/includes/crud.php';
$cfg = [
  'table'=>'hero_slides','title'=>'Hero Slides','singular'=>'Slide','order'=>'sort_order ASC, id ASC',
  'search'=>['heading'],
  'fields'=>[
    ['name'=>'image','label'=>'Slide Image','type'=>'image','required'=>true,'list'=>true],
    ['name'=>'heading','label'=>'Heading','type'=>'text','list'=>true],
    ['name'=>'subheading','label'=>'Subheading','type'=>'text'],
    ['name'=>'button_text','label'=>'Button Text','type'=>'text'],
    ['name'=>'button_link','label'=>'Button Link','type'=>'text'],
    ['name'=>'sort_order','label'=>'Sort Order','type'=>'number'],
    ['name'=>'is_active','label'=>'Active','type'=>'checkbox','list'=>true],
  ],
];
crud_handle($cfg);
$pageTitle='Hero Slides'; include __DIR__.'/includes/header.php'; crud_render($cfg); include __DIR__.'/includes/footer.php';
