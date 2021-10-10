<?php
/** @var TYPE_NAME $recordEntity */
/** @var TYPE_NAME $action */
?>
<?php
$this->start('ignitionScript');
echo $this->element('semantic-ui/dropdown');
$this->end();
?>
<?php echo $this->Form->create($recordEntity, [
    'type' => 'post',
    'class' => 'ui form',
    'url' => ['action' => $action]
]); ?>
<?php echo $this->Form->hidden('id', [
    'value' => $recordEntity['id']
]); ?>
<h3 class="ui dividing header">
    記録情報登録
</h3>
<?php echo $this->Flash->render(); ?>
<div class="field">
    <label>山</label>
    <?php echo $this->Form->select('mountain_id',
        $mountainList,
        [
            'id' => 'mountain_id',
            'class' => 'ui fluid dropdown search selection',
        ]
            ); ?>
</div>
<div class="field">
    <label>登山日</label>
    <?php echo $this->Form->date('climb_date', [
        'id' => 'climb_date',
        'placeholder' => '日付を選択'
    ]); ?>
</div>
<div class="field">
    <label>コメント</label>
    <?php echo $this->Form->textarea('comment', [
        'id' => 'comment',
        'placeholder' => '改行有効'
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
        <button type='button' class='ui gray button' onClick="location.href='/records/'">
            戻る
        </button>
    </div>
</div>
<?php echo $this->Form->end(); ?>
