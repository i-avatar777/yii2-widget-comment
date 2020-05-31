<?php
namespace avatar\modules\Comment;

use common\models\comment\Comment;
use common\models\comment\Comment2;

class Model extends \iAvatar777\services\FormAjax\Model
{
    public $text;
    public $file;
    public $list_id;

    public function rules()
    {
        return [
            ['list_id', 'required'],
            ['list_id', 'integer'],

            ['text', 'required'],
            ['text', 'string'],

            ['file', 'string'],
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $item = Comment::add([
            'text'       => $this->text,
            'file'       => $this->file,
            'list_id'    => $this->list_id,
            'user_id'    => \Yii::$app->user->id,
            'created_at' => time(),
        ]);

        return [
            'comment' => $item,
            'html'    => $item->getHtml(),
            'html2'   => \Yii::$app->view->renderFile('@avatar/modules/Comment/views/default/item.php', ['row' => $item]),
        ];
    }
}