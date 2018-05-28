<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;

$this->title = 'Twiter mikroblog';
?>

<?php
    if(Yii::$app->session->hasFlash('success'))
    {
        Yii::$app->session->getFlash('success');
    }
?>

<div class="site-index">
    <div class="body-content">  
        <?php foreach($tweets as $tweet): ?>
            <div class="row">
                <div class="col-md">
                    <div class="well">
                        <div>
                            <?php
                            if(isset($tweet['registration']['picture_name']))
                            {
                                echo Html::img('@web/uploads/' . $tweet['registration']['picture_name'] , ['alt'=>'Profile image']);
                            }
                            else
                            {
                                echo Html::img('@web/uploads/avatar-40x40.jpg', ['alt'=>'Profile image']);
                            }
                            ?>
                        </div>
                        <?php echo $tweet->tweet; ?>
                        <div>
                            <?php echo Html::a($tweet['registration']['username'], ['profile/view', 'id' => $tweet['registration']['id']],['class' => 'profile-link']); ?>
                        </div>
                        <div>
                            <?php echo 'Created: ' . $tweet->created; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php
            echo LinkPager::widget([
                'pagination' => $pagination,
            ]);
        ?>
    </div>
</div>
