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
<?php echo $this->Flash->render(); ?>
<div class="ui grid">
    <?php echo $this->Flash->render() ?>
    <h3>百名山</h3>
    <table id="datatables" class="ui celled table dataTable table-condensed table-bordered nowrap table-hover compact" cellspacing="0" width="100%">
    </table>
</div>
