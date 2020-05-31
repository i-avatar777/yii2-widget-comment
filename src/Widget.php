<?php

namespace avatar\modules\Comment;

use common\models\comment\CommentList;

/**
 * Created by PhpStorm.
 * User: Ra-m-ha
 * Date: 02.01.2019
 * Time: 6:44
 */

class Widget extends \yii\base\Widget
{
    public static function getComments($list_id)
    {
        return \Yii::$app->view->renderFile('@avatar/modules/Comment/views/default/items', [
            'list_id' => $list_id,
            'rows'    => \common\models\comment\Comment::find()->where(['list_id' => $list_id])->all(),
        ]);
    }

    /**
     * @param int $type_id
     * @param int $object_id
     * @param array $options
     * - school_id - int - не обязательный, передается во все шаблоны чтобы указать в какой школе будет сохраняться файл
     * - functionSuccess - функция JS для события загрузки файла
     *
     * @return string
     */
    public static function getComments2($type_id, $object_id, $options = [])
    {
        $list = \common\models\comment\CommentList::get($type_id, $object_id);

        \common\assets\iLightBox\Asset::register(\Yii::$app->view);
        \Yii::$app->view->registerJs(<<<JS
$('.ilightbox').iLightBox();
JS
        );
        return \Yii::$app->view->renderFile('@avatar/modules/Comment/views/default/items.php', [
            'list_id' => $list->id,
            'rows'    => \common\models\comment\Comment::find()->where(['list_id' => $list->id])->all(),
            'options' => $options,
        ]);
    }
}