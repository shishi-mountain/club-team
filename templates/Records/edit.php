<?php
/** @var TYPE_NAME $recordEntity */
/** @var TYPE_NAME $action */
/** @var TYPE_NAME $mountainList */
use App\Constant\RecordConstant;
?>
<?php echo $this->Html->css(
    [
        'image/modalAddImage',
    ],
    [
        'block' => 'scriptBottom',
    ]
); ?>
<?php echo $this->Html->script(
    [
        'records/edit',
    ],
    [
        'block' => 'scriptBottom',
    ]
); ?>
<?php
$this->start('ignitionScript');
echo $this->element('semantic-ui/dropdown');
echo $this->element('image/addImage');
$this->end();
?>
<?php echo $this->Flash->render(); ?>
<?php echo $this->Form->create($recordEntity, [
    'type' => 'file',
    'class' => 'ui form',
    'url' => ['action' => $action]
]); ?>
<?php echo $this->Form->hidden('id', [
    'value' => $recordEntity['id']
]); ?>
<h3 class="ui dividing header">
    登山記録を登録
</h3>
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
<div id="drop-zone-imprint" class="drop-zone-imprint" style="margin-bottom:10px;">
    <div class="ui icon header">
        <i class="images outline icon"></i>
        写真をアップロード
    </div>
    <label><br>ファイルをドラッグ＆ドロップ、または</label>
    <div>
        <label for="input_file" class="ui grey basic button">ファイル選択
            <?php echo $this->Form->file(
                'input_file',
                [
                    'id' => 'input_file',
                    'name' => 'input_file[]',
                    'label' => false,
                    'multiple' => true,
                    'accept' => '.png',
                    'onChange' => 'previewFile(' . RecordConstant::S3_MAX_FILE_SIZE . ');',
                    'style' => 'background: transparent; display:none;',
                ]
                ); ?>
        </label>
    </div>
</div>

<div id="preview" class="field" style="max-width: 180px;margin:0 auto;">
    <img style="width: 100%;" src="/webroot/upload/test.png">
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
