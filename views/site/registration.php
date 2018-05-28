<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-registration">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        if(Yii::$app->session->hasFlash('success'))
        {
            Yii::$app->session->getFlash('success');
        }
    ?>
    
    <p>Please fill out the following fields to registration:</p>

    <?php
        $form = ActiveForm::begin([
            'id' => 'registration-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);
    ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Enter Your Username']) ?>
    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Enter Your Email (Valid email address)']) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter Your Password (Min 6 charachter)']) ?>

        
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Registration', ['class' => 'btn btn-primary', 'name' => 'registration-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
