<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
//            'controllerMap' => [
//                'assignment' => [
//                    'class' => 'mdm\admin\controllers\AssignmentController',
//                    'userClassName' => 'app\models\User',
//                    'idField' => 'user_id'
//                ],
//                'route' => [
//                    'class' => 'mdm\admin\controllers\RouteController',
//                ],
//                'default' => [
//                    'class' => 'mdm\admin\controllers\DefaultController',
//                ],
//                'item' => [
//                    'class' => 'mdm\admin\controllers\ItemController',
//                ],
//                'menu' => [
//                    'class' => 'mdm\admin\controllers\MenuController',
//                ],
//                'rule' => [
//                    'class' => 'mdm\admin\controllers\RuleController',
//                ],
//
//            ],
            // 'menus' => [
            //     'assignment' => [
            //         'label' => 'Grand Access' // change label
            //     ],
            //     'route' => null, // disable menu route
            // ]
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'defaultRoles' => 'guest'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [//ignore all access control
            'site/index',
            'site/login',
            'site/logout',
            // 'site/hello'
            // 'admin/*',// allow all users access admin and child
        ]
    ],
    'params' => $params,
];
