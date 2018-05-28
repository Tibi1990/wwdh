<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->title = 'Saját tweetjeim';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">  	
	   <?php foreach ($tweets as $tweet):  ?>
			<div class="col-md-12">
				<div class="well">   
					<?php echo 'Tweet: ' . $tweet->tweet; ?>
					<div>
                        <?php echo 'Created: ' . $tweet->created; ?>
                    </div>
                    <div>
                        <?php echo 'Hits: ' . $tweet->hits; ?>
                    </div>
					<div>
						<?php echo Html::a('Delete tweet', ['/profile/delete','id' => $tweet->id]); ?>
					</div>
				</div>		
			</div>
	    <?php endforeach;  ?>
	</div>

	<?php
	   echo LinkPager::widget([
			'pagination' => $pagination,
	    ]);  
   ?>
</div>
