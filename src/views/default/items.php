<?php
/**
 * Created by PhpStorm.
 * User: Ra-m-ha
 * Date: 02.01.2019
 * Time: 6:46
 */

/** @var \common\models\comment\Comment[] $rows */
/** @var int $list_id */
/** @var array $options */


$this->registerJs(<<<JS
$('.buttonSend').click(function(e) {
    if ($('#field-content').val() =='') {
        alert('Надо ввести комментарий');
        return;
    }
    ajaxJson({
        url: '/comments/add',
        data: {
            parent_id: null,
            text: $('#field-content').val(),
            list_id: {$list_id}
        },
        success: function (e) {
            window.location.reload(); 
        }
    });
});
$('.buttonDelete').click(function(e) {
    if (confirm('Подтвердите удаление')) {
        ajaxJson({
            url: '/comments/delete',
            data: {
                id: $(this).data('id')
            },
            success: function (e) {
                window.location.reload(); 
            }
        });
    }
})
JS
);


?>

<div class="bs-example" id="comments">
    <?php /** @var \common\models\comment\Comment $row */ ?>
    <?php foreach ($rows as $row) { ?>
        <?= $this->render('item', ['row' => $row]); ?>
    <?php } ?>
</div>
<hr>

<?php if (Yii::$app->user->isGuest) { ?>
    <?= $this->render('login', [
        'list_id' => $list_id,
        'options' => $options,
    ]); ?>
<?php } else { ?>
    <?= $this->render('form', [
        'list_id' => $list_id,
        'options' => $options,
    ]); ?>
<?php } ?>
