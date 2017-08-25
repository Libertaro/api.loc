<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.08.2017
 * Time: 19:31
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'API';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?php Pjax::begin([
        'id' => 'pjaxContent'
    ]); ?>

    <div class="form-group">
        <?php foreach ($users as $user): ?>
            <div class="col-lg-2">
                <?= $user['id'].'. '.$user['name']; ?>
                <button type="button" class="close" onclick="deleteUser(<?= $user['id'] ?>)">×</button>
            </div>
        <?php endforeach; ?>
    </div>

    <?php Pjax::end(); ?>

    <div class="form-group">
        <div class="row-lg-3">
            <?= Html::label('Name') ?>
        </div>
        <div class="row-lg-3">
            <?= Html::textInput(null, null, ['id' => 'name-field']) ?>
            <?= Html::button('Create', ['class' => 'btn btn-primary', 'id' => 'create-button', 'style' => ['width' => '75px']])?>
        </div>
    </div>

    <div class="form-group">
        <div class="row-lg-3">
            <?= Html::label('User ID') ?>
        </div>
        <div class="row-lg-3">
            <?= Html::textInput(null, null, ['id' => 'id-find']) ?>
            <?= Html::button('Find', ['class' => 'btn btn-primary', 'id' => 'find-button', 'style' => ['width' => '75px']])?>
        </div>
    </div>

    <div class="form-group">
        <div class="row-lg-3">
            <?= Html::label('User ID') ?>
        </div>
        <div class="row-lg-3">
            <?= Html::textInput(null, null, ['id' => 'edit-id']) ?>
        </div>
        <div class="row-lg-3">
            <?= Html::label('New name') ?>
        </div>
        <div class="row-lg-3">
            <?= Html::textInput(null, null, ['id' => 'edit-name']) ?>
            <?= Html::button('Edit', ['class' => 'btn btn-primary', 'id' => 'edit-button', 'style' => ['width' => '75px']])?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php $this->registerJs(<<<JS
    $('#create-button').on('click', function(e) {
         $.ajax({
            url: 'http://api.loc/request/create',
            type: 'GET',
            data: { 'name' : $("#name-field").val() },
            success: function() {
                $.pjax.reload({container: '#pjaxContent'});
                alert('User has been successfully created');
            },
            error: function(){
                alert('Something went wrong. User hasn\'t been created')
            }
        });
    });

    $('#find-button').on('click', function(e) {
         $.ajax({
            url: 'http://api.loc/request/find',
            type: 'GET',
            data: { 'id' : $("#id-find").val() },
            success: function(data) {
                alert(data);
            },
            error: function(){
                alert('User doesn\'t exist')
            }
        });
    });
    
    $('#edit-button').on('click', function(e) {
         $.ajax({
            url: 'http://api.loc/request/edit',
            type: 'GET',
            data: { 'id' : $("#edit-id").val(), 'name' : $("#edit-name").val() },
            success: function() {
                $.pjax.reload({container: '#pjaxContent'});
                alert('User has been successfully edited');
            },
            error: function(){
                alert('User doesn\'t exist')
            }
        });
    });

    function deleteUser(id) {
         $.ajax({
            url: 'http://api.loc/request/delete',
            type: 'GET',
            data: { 'id' : id },
            success: function() {
                $.pjax.reload({container: '#pjaxContent'});
                alert('User has been successfully deleted');
            },
            error: function(){
                alert('User doesn\'t exist')
            }
        });
    }

JS
    ,\yii\web\View::POS_END);?>