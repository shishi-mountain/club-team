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
//echo $this->element('datatables/tops');
echo $this->element('semantic-ui/dropdown');
$this->end();
?>
<?php echo $this->Flash->render(); ?>
<div class="Tops form">
    <?php echo $this->Flash->render() ?>
    <h3>Top画面</h3>

    <p>百名山一覧</p>
<!--    <table id="datatables" class="ui celled table dataTable table-condensed table-bordered nowrap table-hover compact" cellspacing="0" width="100%">-->
<!--    </table>-->

</div>
