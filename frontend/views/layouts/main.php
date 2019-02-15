<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
   <header>
    <div class="header_wrapper">
        <div class="header_wrapper-logo">
            <?= Html::img('uploads/ppc.png') ?>
            <span>Рейтинг студентів</span>
        </div>
    </div>
   </header>
    <?= $content ?>
</div>

<div class="footer-wrapper">
    <footer>
        <span class="copyright">
            © <?= date('Y')?> IF()<br>
        Команда розробки 3 курсу<br>
        ППК НТУ “ХПІ”<br>

        </span>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
