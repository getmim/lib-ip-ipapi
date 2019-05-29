<?php

return [
    '__name' => 'lib-ip-ipapi',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/lib-ip-ipapi.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/lib-ip-ipapi' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-ip-locator' => NULL
            ],
            [
                'lib-curl' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'LibIpIpapi\\Library' => [
                'type' => 'file',
                'base' => 'modules/lib-ip-ipapi/library'
            ]
        ],
        'files' => []
    ],
    'libIpIpapi' => [
        'apikey' => ''
    ],
    'libIpLocator' => [
        'finder' => [
            'LibIpIpapi\\Library\\Finder' => 1000
        ]
    ],
    '__inject' => [
        [
            'name' => 'libIpIpapi',
            'children' => [
                [
                    'name' => 'apikey',
                    'question' => 'Please enter your premium ipapi.co APIKEY',
                    'rule' => '!^.+$!'
                ]
            ]
        ]
    ]
];