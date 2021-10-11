<?php
$this->start('ignitionScript');
echo $this->element('semantic-ui/dropdown');
$this->end();
?>
<?php echo $this->Form->create($userEntity, [
    'type' => 'post',
    'class' => 'ui form',
    'url' => ['action' => $action]
]); ?>
<?php //echo $this->Form->hidden('id', [
//    'value' => $userEntity['id']
//]); ?>
<h3 class="ui dividing header">
    サインアップ
</h3>
<?php echo $this->Flash->render(); ?>
<div class="field">
    <label>メールアドレス</label>
    <?php echo $this->Form->text('email', [
        'id' => 'email',
        'placeholder' => 'ログインの際のメールアドレス'
    ]); ?>
</div>
<div class="field">
    <label>パスワード</label>
    <?php echo $this->Form->control('password', [
        'id' => 'password',
        'name' => 'password',
        'label' => false,
        'placeholder' => '半角英数記号で入力',
        'error' => false,
        'value' => '',
    ]); ?>
</div>
<div class="field">
    <label>氏名</label>
    <?php echo $this->Form->text('name', [
        'id' => 'name',
        'placeholder' => '表示名を入力'
    ]); ?>
</div>
<div class="field">
    <label for="is_admin">管理者に設定</label>
        <?php echo $this->Form->checkbox('is_admin', [
            'id' => 'is_admin',
            'class' => 'ui checkbox blue',
        ]); ?>
</div>
<br>
<div class="ui centered grid">
    <div class ="three wide column">
        <button type='submit' class='ui primary button'>
            登録
        </button>
    </div>
    <div class ="three wide column">
        <button type='button' class='ui gray button' onClick="location.href='/users/login'">
            戻る
        </button>
    </div>
</div>
<?php echo $this->Form->end(); ?>

