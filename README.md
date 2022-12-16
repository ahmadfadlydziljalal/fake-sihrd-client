<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic + Yii2 Auth Client</h1>
    <br>
</p>

Ini adalah contoh <b>Fake Auth client untuk SIHRD<b>  yang meng-implementasi Yii2 OAuth2 server dari repository [Yii2 OAuth2 Server](https://github.com/ahmadfadlydziljalal/yii2-oauth2-server) buatan Saya.
Cara menggunakannya:
1. Clone Project,
2. Running composer update,
3. Buat sebuah database yang akan digunakan untuk repo ini,
4. Rename `config/db-example.php` menjadi `config/db.php`, dan sesuaikan,
5. Rename `config/auth_client_collection-example.php` menjadi `config/auth_client_collection.php`, dan sesuaikan,
6. Running migration,
    1. `php yii migrate-rbac`
    2. `php yii migrate-mdm`
    3. `php yii migrate`
7. Running server dengan mengetikkan perintah `php yii serve localhost:8081`,
8. Untuk OAuth2: client_id dan client_secret sengaja dirahasiakan,
9. Aplikasi siap digunakan 

```php
/**
Untuk local user account:
username : Admin
password : Admin123
 * */
```

```
Untuk memasukkan client_id dan client_secret, file konfigurasinya ada di `config/auth_client_collection.php`
```
Implementasi Oauth2 pada repo ini ada 2, yaitu:

## Grant Type: Authorization Code
`components/MyOAuth2AuthClient.php`
```php
<?php

namespace app\components;
use yii\authclient\OAuth2;

/**
 * Auth Client yang kita buat sendiri
 * */
class MyOAuth2AuthClient extends OAuth2
{

   public ?string $apiUserInfo = null;

   protected function defaultName(): string
   {
      return 'sihrd';
   }

   protected function defaultTitle(): string
   {
      return 'SIHRD';
   }

   protected function initUserAttributes(): array
   {
      return $this->api($this->apiUserInfo, 'GET', [], ['Authorization' => 'Bearer ' . $this->accessToken->params['access_token']]);
   }

}
```

`config/web.php`

```php
'components' => [
  'authClientCollection' => [
     'class' => 'yii\authclient\Collection',
     'clients' => [
        'google' => [
           'class' => 'yii\authclient\clients\Google',
           'clientId' => 'google_client_id',
           'clientSecret' => 'google_client_secret',
        ],
        'sihrd' => [
           'class' => '\app\components\SihrdAuthClient',
           'clientId' => CLIENT_ID,
           'clientSecret' => CLIENT_SECRET,
           'authUrl' => 'https://hrd.rayakreasi.xyz/authorize',
           'tokenUrl' => 'https://hrd.rayakreasi.xyz/oauth2/token',
           'apiBaseUrl' =>  'https://hrd.rayakreasi.xyz/oauth2/v1',
           'apiUserInfo' => 'https://hrd.rayakreasi.xyz/oauth2/user-info',
           'viewOptions' => [
              'icon' => 'https://cdn-icons-png.flaticon.com/512/2376/2376399.png'
           ]
        ],
     ],
  ],
  ... another component here
]
```

`controllers/SiteController.php`

```php
<?php
# Metode OAuth2 Authorization Code
public function actions()
{
    return [
         # ... another action here
        'authorize' => [
            'class' => 'yii\authclient\AuthAction',
            'successCallback' => [$this, 'onAuthSuccess'],
        ],
    ];
}

public function onAuthSuccess($client)
{
    (new AuthHandler($client))->handle();
}
```

`components/AuthHandler.php`
```php
<?php

namespace app\components;

# some import here

class AuthHandler
{

    private ClientInterface $client;
    
    /**
    * @throws Exception
    */
    public static function setUserDataInCookies($attributes){
      $cookies = Yii::$app->response->cookies;
      $cookies->add(new Cookie([
         'name' => 'id_karyawan',
         'value' => ArrayHelper::getValue($attributes, 'karyawan.id'),
      ]));

      $cookies->add(new Cookie([
         'name' => 'nama_karyawan',
         'value' => ArrayHelper::getValue($attributes, 'karyawan.nama'),
      ]));

      $cookies->add(new Cookie([
         'name' => 'photo_karyawan',
         'value' => ArrayHelper::getValue($attributes, 'karyawan.photo'),
      ]));

   }

   public static function removeUserDataInCookies(){
      $cookies = Yii::$app->response->cookies;
      $cookies->remove('id_karyawan');
      $cookies->remove('nama_karyawan');
      $cookies->remove('photo_karyawan');
   }    
    
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

   public function handle()
    {

       Yii::$app->user->returnUrl = Url::to(['index']);

       $attributes = $this->client->getUserAttributes();
       $email = ArrayHelper::getValue($attributes, 'user.email');
       $id = ArrayHelper::getValue($attributes, 'user.id');
       $nickname = ArrayHelper::getValue($attributes, 'user.username');

       /* @var Auth $auth */
       $auth = Auth::find()->where([
          'source' => $this->client->getId(),
          'source_id' => $id,
       ])->one();

       # Handle user-info to database
       # ....
       
    }
    
}
```

## Grant Type: Client Resource Password
`controllers/SiteController.php`
```php
<?php
class SiteController extends \yii\web\Controller{

    # ... a lot of code here
   
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) return $this->goHome();
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {

           /* @var $client MyOAuth2AuthClient */
           $client = Yii::$app->authClientCollection->getClient('sihrd');

           try {
           
              # Metode Resource Owned Password disini
              if($client->authenticateUser($model->username, $model->password)){
                 
                 # Handle data user
                 $model->loginByOauth2ResourceOwnerPassword($client);
                 return $this->goHome();
              }
           } catch (\Exception $e) {
              $model->addError('password', $e->getMessage());
           }
        }

        $model->password = '';
        return $this->render('login', ['model' => $model,]);
    }   
}

```

`models\LoginForm.php`
```php
class LoginForm extends Model{

   # ... a lot of code here
   
  public function loginByOauth2ResourceOwnerPassword(OAuth2 $client)
   {

      $attributes = $client->getUserAttributes();

      $id = ArrayHelper::getValue($attributes, 'user.id');
      $email = ArrayHelper::getValue($attributes, 'user.email');
      $username = ArrayHelper::getValue($attributes, 'user.username');

      /* @var Auth $auth */
      $auth = Auth::find()->where(['source' => $client->getId(), 'source_id' => $id,])->one();

      // Cek kalau user sudah terdaftar dari SIHRD atau another OAuth2 ?
     
   }
}
```
