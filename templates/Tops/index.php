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
</div>
