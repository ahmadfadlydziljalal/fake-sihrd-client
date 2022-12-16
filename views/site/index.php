<?php

/** @var yii\web\View $this */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Contoh Client!</h1>

        <?php

        $cookies = Yii::$app->request->cookies;

        if (!empty($cookies->getValue('id_karyawan'))) {

            echo $cookies->getValue('nama_karyawan');
            echo yii\helpers\Html::img($cookies->getValue('photo_karyawan'));
        }

        ?>

    </div>


</div>