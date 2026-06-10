<?php
require_once __DIR__ . '/_bootstrap.php';
json_response(['ok'=>true,'token'=>csrf_token()]);
