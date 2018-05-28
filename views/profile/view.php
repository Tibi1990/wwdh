<?php
use yii\base\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
    	<div class="col-md-12">
	    	<?php
		    	if(isset($registredUser['picture_name']))
				{
					echo Html::img('@web/uploads/' . $registredUser['picture_name'] , ['alt'=>'Profile image']);
				}
				else
				{
					echo Html::img('@web/uploads/avatar-40x40.jpg', ['alt'=>'Profile image']);
				}
		 	?>
	 	</div>    
	</div>

	<div class="row">
		<div class="col-md-12">
			<?php if($registredUser['id'] == Yii::$app->user->id ): ?>
			<ul>
				<li><?php  echo Html::a('Profile picture upload', ['/profile/upload']); ?></li>
				<?php if(isset($registredUser['picture_name'])): ?>	
					<li><?php  echo Html::a('Profile picture delete', ['profile/picture'], ['class' => 'profile-picture-delete']); ?></li>
				<?php endif; ?>	
				<li><?php  echo Html::a('Profile delete', ['profile/delete'], ['class' => 'user-profile-delete']); ?></li>	
			</ul>
			<?php else: ?>
			<ul>
				<li><?php echo $registredUser['username']; ?></li>
				<li><?php echo $registredUser['email']; ?></li>	
			</ul>	
			<?php endif; ?>
		</div>	
	</div>
	<?= Html::jsFile('@web/assets/2452e5a3/jquery.min.js') ?>
	<?= Html::jsFile('@web/js/main.js') ?>
</div>