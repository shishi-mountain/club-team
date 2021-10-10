<?php echo $this->Html->css([
    'datatables/datatables.min',
],
    ['block' => 'cssHead']
); ?>
<?php echo $this->Html->script([
    'datatables/datatables.min',
],
    ['block' => 'scriptBottom']
); ?>
<?php
$this->start('ignitionScript');
echo $this->element('datatables/datatables');
echo $this->element('semantic-ui/dropdown');
$this->end();
?>
<h3 class="ui dividing header">
    百名山一覧
</h3>
<div class="ui text menu">
    <div class="item right menu">
        <a class="ui positive button" href="<?php echo $this->Url->build(['action' => 'add']); ?>">新規登録</a>
    </div>
</div>
<?php echo $this->Flash->render(); ?>
<table id="datatables" class="ui celled table dataTable table-condensed table-bordered table-hover compact" cellspacing="0" width="100%">
</table>

