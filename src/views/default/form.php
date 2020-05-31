<?php

/** @var int $list_id */
/** @var array $options */


$school = null;
if (isset($options['school_id'])) {
    $school = \common\models\school\School::findOne($options['school_id']);
    $c = $school->getCloud();
    if (is_null($c)) {
        $url = Yii::$app->AvatarCloud->url;
    } else {
        $url = $c->url;
    }
} else {
    $url = Yii::$app->AvatarCloud->url;
}
?>
<div id="comments" style="margin-top: 50px;">
    <div class="media">
        <div class="media-left">
            <a href="#">
                <img class="img-circle"
                     src="<?= Yii::$app->user->identity->getAvatar() ?>"
                     data-holder-rendered="true"
                     style="width: 64px; height: 64px;">
            </a>
        </div>
        <div class="media-body">
            <?php $model = new \avatar\modules\Comment\Model(['list_id' => $list_id]); ?>
            <?php $form = \iAvatar777\services\FormAjax\ActiveForm::begin([
                'model' => $model,
                'formUrl' => '/comments/add-ajax',
                'success' => <<<JS
function (ret) {
    var selectorComments = '#comments';
    $(selectorComments).append(ret.html2);
    $(selectorComments + ' [name="Model[text]').val('');
    $(selectorComments + ' [name="Model[file]').val('');
    $(selectorComments + ' .field-model-file').find('.fileUploadedUrl').hide(); 
    console.log(ret);
}
JS

            ]) ?>
            <?= \yii\helpers\Html::activeHiddenInput($model, 'list_id') ?>
            <?= $form->field($model, 'text')
                ->textarea(['rows' => 5])
                ->label('text', ['class' => 'hide'])
            ?>
            <?= $form->field($model, 'file')
                ->widget('\iAvatar777\widgets\FileUpload8\FileUpload', [
                    'update'   => [
                        [
                            'function' => 'crop',
                            'index'    => 'crop',
                            'options'  => [
                                'width'  => '300',
                                'height' => '300',
                                'mode'   => 'MODE_THUMBNAIL_CUT',
                            ],
                        ],
                    ],
                    'settings' => [
                        'maxSize'         => 20 * 1000,
                        'server'          => $url,
                        'functionSuccess' => \yii\helpers\ArrayHelper::getValue($options, 'functionSuccess', null),
                    ],
                ])
                ->label('file', ['class' => 'hide'])
            ?>
            <?php \iAvatar777\services\FormAjax\ActiveForm::end(['label' => 'Добавить']) ?>

        </div>
    </div>
</div>
