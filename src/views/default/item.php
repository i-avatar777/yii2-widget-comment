<?php
/** @var \common\models\comment\Comment $row */

\common\assets\iLightBox\Asset::register($this);


?>
<div class="media" data-id="<?= $row->id ?>">
    <div class="media-left">
        <a href="#">
            <img class="img-circle"
                 src="<?= $row->getUser()->getAvatar() ?>"
                 data-holder-rendered="true"
                 data-toggle="tooltip"
                 title="<?= \yii\helpers\Html::encode($row->getUser()->getName2()) ?>"
                 style="width: 64px; height: 64px;">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">
            <small><?= \yii\helpers\Html::tag('abbr', \cs\services\DatePeriod::back($row->created_at, ['isShort' => true]), ['data' => ['toggle' => 'tooltip'], 'title' => Yii::$app->formatter->asDatetime($row->created_at)]) ?></small>
        </h4>
        <?= $row->getHtml() ?>
        <?php if (!\cs\Application::isEmpty($row->file)) { ?>
        <p>
            <a href="<?= $row->file ?>" target="_blank">
                <?php $o = pathinfo($row->file); ?>
                <?php if (in_array($o['extension'], ['jpg', 'jpeg', 'png'])) { ?>
                    <a href="<?= $row->file ?>" class="ilightbox">
                        <img src="<?= \iAvatar777\widgets\FileUpload7\FileUpload::getFile($row->file, 'crop') ?>" width="100" class="thumbnail" style="margin-bottom: 0px;">
                    </a>
                <?php } else { ?>
                    <code><?= $row->file ?></code>
                <?php } ?>
            </a>
        </p>
        <?php } ?>
        <?php if ($row->user_id == Yii::$app->user->id) { ?>
            <p>
                <button class="btn btn-default btn-xs buttonDelete" data-id="<?= $row->id ?>"
                    style="margin-top: 10px;">Удалить
                </button>
            </p>
        <?php } ?>
    </div>
</div>
