<?php
require_once __DIR__ . '/includes/crud.php';
$cfg = [
  'table'=>'faqs','title'=>'FAQs','singular'=>'FAQ','order'=>'sort_order ASC, id ASC',
  'search'=>['question','answer'],
  'fields'=>[
    ['name'=>'question','label'=>'Question','type'=>'text','required'=>true,'list'=>true],
    ['name'=>'answer','label'=>'Answer','type'=>'textarea','required'=>true],
    ['name'=>'sort_order','label'=>'Sort Order','type'=>'number'],
  ],
];
crud_handle($cfg);
$pageTitle='FAQs'; include __DIR__.'/includes/header.php'; crud_render($cfg); include __DIR__.'/includes/footer.php';
