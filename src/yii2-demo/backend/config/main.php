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
        'rbac' => [
            'class' => 'wind\rest\Modules'
        ],
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            //'class' => 'wind\oauth2\Module',相对filsh\yii2\oauth2server做了一点优化，增加了可修改oauth2表的db name
            'tokenParamName' => 'access_token',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'common\models\User',//可自定义
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'client_credentials' => [
                    'class' => 'OAuth2\GrantType\ClientCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true
                ],
                'authorization_code' => [
                    'class' => 'OAuth2\GrantType\AuthorizationCode'
                ],
            ],
            //选填，oauth2组件版本问题可能导致错误时可添加
             'components' => [
                 'request' => function () {
                     return \filsh\yii2\oauth2server\Request::createFromGlobals();
                 },
                 'response' => [
                     'class' => \filsh\yii2\oauth2server\Response::class,
                 ],
             ],
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            //'cookieValidationKey' => 'xxxxxxxx',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/json' => 'yii\web\JsonParser',
            ],
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
            'class' => 'wind\rest\components\DbManager', //配置文件
            'defaultRoles' => ['普通员工'], //选填，默认角色（默认角色下->公共权限（登陆，oauth2，首页等公共页面））
            'groupTable' => 'auth_groups',  //选填，分组表(已默认，可根据自己表名修改)
            'groupChildTable' => 'auth_groups_child',//选填，分组子表(已默认，可根据自己表名修改)
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //权限
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rbac/permission'],
                    'extraPatterns' => [
                        'GET view' => 'view',
                        'DELETE delete' => 'delete',
                        'POST update' => 'update',
                        'POST assign' => 'assign',
                        'POST remove' => 'remove',
                        'GET assign-list' => 'assign-list',
                    ]
                ],
                //菜单
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rbac/menu'],
                    'extraPatterns' => [
                        'GET parent' => 'parent',
                        'POST create' => 'create',
                        'POST update' => 'update',
                        'GET user' => 'user-menu'
                    ]
                ],
                //路由
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rbac/route'],
                    'extraPatterns' => [
                        'POST remove' => 'remove',
                        'GET  all' => 'all',
                        'GET  parent' => 'parent',
                    ]
                ],
                //角色
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rbac/role'],
                    'extraPatterns' => [
                        'GET view' => 'view',
                        'DELETE delete' => 'delete',
                        'POST update' => 'update',
                        'POST assign' => 'assign',
                        'GET assign-list' => 'assign-list',
                        'POST remove' => 'remove',
                    ]
                ],
                //分配
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rbac/assignment'],
                    'extraPatterns' => [
                        'GET view' => 'view',
                        'POST assign' => 'assign',
                        'POST revoke' => 'revoke',
                        'GET assign-list' => 'assign-list',
                        'POST remove' => 'remove',
                        'POST assign-batch' => 'assign-batch',
                        'POST assign-remove' => 'remove-users',
                        'GET assign-users' => 'assign-users',
                    ]
                ],
                //用户
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rbac/user'],
                    'extraPatterns' => [
                        'GET view' => 'view',
                        'POST activate' => 'activate',
                    ]
                ],
                //规则
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rbac/rule'],
                    'extraPatterns' => [
                        'GET index' => 'get-rules',
                        'POST create' => 'create',
                        'POST delete' => 'delete',
                        'POST update' => 'update',
                    ]
                ],
                //分组
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rbac/groups'],
                    'extraPatterns' => [
                        'POST assign' => 'assign',
                        'POST revoke' => 'revoke',
                        'GET assign-user' => 'assign-user',
                        'POST status' => 'status',
                    ]
                ]
            ],
        ],

    ],
    'params' => $params,
    'as access' => [
        'class' => 'wind\rest\components\AccessControl',
        'allowActions' => [
//            'site/*',//允许访问的节点，可自行添加
//            'rbac/menu/user-menu',//可将路由配置到“普通员工”（默认角色）下
//            'oauth2/*',//可将路由配置到“普通员工”（默认角色）下
              '*'
        ]
    ]
];
