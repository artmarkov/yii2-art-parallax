<?php

use artsoft\widgets\ActiveForm;
use artsoft\parallax\models\Parallax;
use artsoft\helpers\Html;
use kartik\color\ColorInput;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model artsoft\parallax\models\Parallax */
/* @var $form artsoft\widgets\ActiveForm */
?>

    <div class="parallax-form">

        <?php
        $form = ActiveForm::begin([
            'id' => 'parallax-form',
            'validateOnBlur' => false,
        ])
        ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">

                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'parallax_class')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'background_ratio')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'content')->widget(trntv\aceeditor\AceEditor::class,
                                [
                                    'mode' => 'html',
                                    'theme' => 'sqlserver', //chrome,clouds,clouds_midnight,cobalt,crimson_editor,dawn,dracula,dreamweaver,eclipse,iplastic
                                    //merbivore,merbivore_soft,sqlserver,terminal,tomorrow_night,twilight,xcode
                                ]) ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'countdown')->widget(SwitchInput::classname(), [
                                'pluginOptions' => [
                                    'size' => 'small',
                                ],
                            ]); ?>
                        </div>
                        <div class="col-md-8">
                            <?= $form->field($model, 'start_time')->widget(kartik\datetime\DateTimePicker::classname())->widget(\yii\widgets\MaskedInput::className(), ['mask' => Yii::$app->settings->get('reading.date_time_mask')])->textInput(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'countdown_prompt')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'btn_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'btn_icon')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'btn_class')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <?= $form->field($model->loadDefaultValues(), 'status')->dropDownList(Parallax::getStatusList()) ?>

                    <?= $form->field($model, 'bg_color')->widget(ColorInput::classname(), [
                        'options' => ['placeholder' => 'Select color ...'],
                        'pluginOptions' => ['preferredFormat' => 'rgb']
                    ]);
                    ?>
                    <?= $form->field($model, 'bg_image')->widget(\artsoft\media\widgets\FileInput::className(), [
                        'name' => 'image',
                        'buttonTag' => 'button',
                        'buttonName' => Yii::t('art', 'Browse'),
                        'buttonOptions' => ['class' => 'btn btn-primary btn-file-input'],
                        'options' => ['class' => 'form-control'],
                        'template' => '<div class="parallax-bg_image thumbnail"></div><div class="input-group"><span class="input-group-btn">{button}</span>{input}</div>',
                        'thumb' => 'original',
                        'imageContainer' => '.parallax-bg_image',
                        'pasteData' => \artsoft\media\widgets\FileInput::DATA_URL,
                        'callbackBeforeInsert' => 'function(e, data) {
                                $(".bg_image-thumbnail").show();
                            }',
                    ])
                    ?>
                    <?= $form->field($model, 'content_image')->widget(\artsoft\media\widgets\FileInput::className(), [
                        'name' => 'image',
                        'buttonTag' => 'button',
                        'buttonName' => Yii::t('art', 'Browse'),
                        'buttonOptions' => ['class' => 'btn btn-primary btn-file-input'],
                        'options' => ['class' => 'form-control'],
                        'template' => '<div class="parallax-content_image thumbnail"></div><div class="input-group"><span class="input-group-btn">{button}</span>{input}</div>',
                        'thumb' => 'original',
                        'imageContainer' => '.parallax-content_image',
                        'pasteData' => \artsoft\media\widgets\FileInput::DATA_URL,
                        'callbackBeforeInsert' => 'function(e, data) {
                                $(".content_image-thumbnail").show();
                            }',
                    ])
                    ?>

                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <?= Html::a(Yii::t('art', 'Go to list'), ['/parallax/default/index'], ['class' => 'btn btn-default']) ?>
                    <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
                    <?php if (!$model->isNewRecord): ?>
                        <?= Html::a(Yii::t('art', 'Delete'), ['/parallax/default/delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ])
                        ?>
                    <?php endif; ?>
                </div>
                <?= \artsoft\widgets\InfoModel::widget(['model' => $model]); ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$js = <<<JS
    var bg_image = $("#parallax-bg_image").val();
    if(bg_image.length == 0){
        $('.parallax-bg_image').hide();
    } else {
        $('.parallax-bg_image').html('<img src="' + bg_image + '" />');
    }
        
    var content_image = $("#parallax-content_image").val();
    if(bg_image.length == 0){
        $('.parallax-content_image').hide();
    } else {
        $('.parallax-content_image').html('<img src="' + content_image + '" />');
    }
JS;

$this->registerJs($js, yii\web\View::POS_READY);
?>