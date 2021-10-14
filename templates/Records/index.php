<?php
use App\Message\RecordMessage;
?>
<?php echo $this->Html->css([
],
    ['block' => 'cssHead']
); ?>
<?php echo $this->Html->script([
],
    ['block' => 'scriptBottom']
); ?>
<?php
$this->start('ignitionScript');
echo $this->element('semantic-ui/dropdown');
$this->end();
?>
<h3 class="ui dividing header">
    登山記録
</h3>
<div class="ui text menu">
    <div class="item right menu">
        <a class="ui positive button" href="<?php echo $this->Url->build(['action' => 'add']); ?>">記録を入力する</a>
    </div>
</div>
<?php echo $this->Flash->render(); ?>
<?php if (isset($dataList)) : ?>
    <div class="ui three column grid">
        <?php foreach ($dataList as $data): ?>
            <div class="column">
                <div class="ui fluid card" >
                    <div class="image" style="margin: 10px;">
                        <img src="/webroot/upload/test.png">
                    </div>
                    <div class="content">
                        <div class="header"><?php echo $data['name']; ?></div>
                    </div>
                    <div class="description">
                        <?php echo $data['comment']; ?>
                    </div>
                    <div class="extra content">
                        <span class="right floated"><?php echo $data['climb_date']; ?></span>
                        <span><i class="user icon"></i>75 いいね！</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="ui two column centered grid">
        <div class="column"><?php echo RecordMessage::UNREGISTERED; ?></div>
    </div>
<?php endif; ?>
