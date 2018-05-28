<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Creating new tweet';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="creating-new-tweet">
    <h1> <?= Html::encode($this->title) ?> </h1>

    <?= Yii::$app->session->getFlash('success'); ?>
    
    <?php
        $form = ActiveForm::begin([
            'id' => 'tweet-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);
    ?>

    <?= $form->field($model, 'tweet')->textarea(['rows' => '3', 'cols' => '50', 'placeholder' => "Min 10 / Max 160 character allowed."]) ?>
         
    <div class="form-group">
        <div class="col-lg-6">
            <?= Html::submitButton('Tweet', ['class' => 'btn btn-primary', 'name' => 'tweet-button']) ?>
        </div>   
    </div>

    <?php ActiveForm::end(); ?>
</div>
