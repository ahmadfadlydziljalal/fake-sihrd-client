<?php

return [
   'class' => 'yii\authclient\Collection',
   'clients' => [
      'sihrd' => [
         'class' => '\app\components\SihrdAuthClient',
         'clientId' => '',       # Masukkan CLIENT_ID disini
         'clientSecret' => '',   # Masukkan CLIENT_SECRET disini
         'authUrl' => 'https://hrd.rayakreasi.xyz/authorize',
         'tokenUrl' => 'https://hrd.rayakreasi.xyz/oauth2/token',
         'apiBaseUrl' =>  'https://hrd.rayakreasi.xyz/oauth2/v1',
         'apiUserInfo' => 'https://hrd.rayakreasi.xyz/oauth2/user-info',
         'viewOptions' => [
            'icon' => 'https://cdn-icons-png.flaticon.com/512/2376/2376399.png'
         ]
      ],
   ],
];