<?php

$vendorDir = dirname(__DIR__);

return array (
  'yiisoft/yii2-bootstrap' => 
  array (
    'name' => 'yiisoft/yii2-bootstrap',
    'version' => '2.0.10.0',
    'alias' => 
    array (
      '@yii/bootstrap' => $vendorDir . '/yiisoft/yii2-bootstrap/src',
    ),
  ),
  'yiisoft/yii2-debug' => 
  array (
    'name' => 'yiisoft/yii2-debug',
    'version' => '2.1.16.0',
    'alias' => 
    array (
      '@yii/debug' => $vendorDir . '/yiisoft/yii2-debug/src',
    ),
  ),
  'yiisoft/yii2-faker' => 
  array (
    'name' => 'yiisoft/yii2-faker',
    'version' => '2.0.5.0',
    'alias' => 
    array (
      '@yii/faker' => $vendorDir . '/yiisoft/yii2-faker/src',
    ),
  ),
  'yiisoft/yii2-gii' => 
  array (
    'name' => 'yiisoft/yii2-gii',
    'version' => '2.1.4.0',
    'alias' => 
    array (
      '@yii/gii' => $vendorDir . '/yiisoft/yii2-gii/src',
    ),
  ),
  'yiisoft/yii2-swiftmailer' => 
  array (
    'name' => 'yiisoft/yii2-swiftmailer',
    'version' => '2.1.2.0',
    'alias' => 
    array (
      '@yii/swiftmailer' => $vendorDir . '/yiisoft/yii2-swiftmailer/src',
    ),
  ),
  'filsh/yii2-oauth2-server' => 
  array (
    'name' => 'filsh/yii2-oauth2-server',
    'version' => '2.1.1.0',
    'alias' => 
    array (
      '@filsh/yii2/oauth2server' => $vendorDir . '/filsh/yii2-oauth2-server/src',
    ),
    'bootstrap' => 'filsh\\yii2\\oauth2server\\Bootstrap',
  ),
  'windhoney/yii2-rest-rbac' => 
  array (
    'name' => 'windhoney/yii2-rest-rbac',
    'version' => '1.0.9.0',
    'alias' => 
    array (
      '@wind/rest' => $vendorDir . '/windhoney/yii2-rest-rbac',
    ),
  ),
);
