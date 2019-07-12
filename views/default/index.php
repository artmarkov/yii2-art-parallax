<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use artsoft\grid\GridView;
use artsoft\grid\GridQuickLinks;
use artsoft\parallax\models\Parallax;
use artsoft\helpers\Html;
use artsoft\grid\GridPageSize;

/* @var $this yii\web\View */
/* @var $searchModel artsoft\parallax\models\search\ParallaxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->title = Yii::t('art/parallax', 'Parallaxes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parallax-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('art', 'Add New'), ['/parallax/default/create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                     echo GridQuickLinks::widget([
                        'model' => Parallax::className(),
                        'searchModel' => $searchModel,
                    ])
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'parallax-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'parallax-grid-pjax',
            ])
            ?>

            <?= 
            GridView::widget([
                'id' => 'parallax-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'parallax-grid',
                   // 'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'artsoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    ['class' => 'yii\grid\SerialColumn', 'options' => ['style' => 'width:20px']],
                    [
                        'class' => 'artsoft\grid\columns\TitleActionColumn',
                        'options' => ['style' => 'width:350px'],
                        'attribute' => 'name',
                        'controller' => '/parallax/default',
                        'title' => function(Parallax $model) {
                            return Html::encode($model->name);
                        },
                        'buttonsTemplate' => '{update} {delete}',
                    ],            
                    'slug',
                    'parallax_class',
                    [
                        'class' => 'artsoft\grid\columns\StatusColumn',
                        'attribute' => 'status',
                        'optionsArray' => [
                            [Parallax::STATUS_ACTIVE, Yii::t('art', 'Active'), 'primary'],
                            [Parallax::STATUS_INACTIVE, Yii::t('art', 'Inactive'), 'info'],
                        ],
                        'options' => ['style' => 'width:250px']
                    ],
                    [
                        'attribute' => 'bg_image',
                        'options' => ['style' => 'width:250px'],
                        'value' => function(Parallax $model) {
                            return Html::img($model->bg_image, ['class'=> 'dw-media-image']);
                        },
                        'format' => 'html',
                    ],                                
                    [
                        'attribute' => 'content_image',
                        'options' => ['style' => 'width:250px'],
                        'value' => function(Parallax $model) {
                                 !empty($model->content_image) ? $img = $model->content_image : $img = '/images/noimg.png';
                                return Html::img($img, ['class'=> 'dw-media-image']);
                        },
                        'format' => 'html',
                    ],

                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


