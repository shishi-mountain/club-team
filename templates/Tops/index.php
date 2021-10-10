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
<div class="ui grid">
    <?php echo $this->Flash->render() ?>
    <h3>dashboard</h3>
    <div class="four column row">
        <div class="left floated column"></div>
        <div class="right floated column">
            <a href="/records/">登山記録</a>
        </div>
    </div>
    <div class="three wide column">
        <p>百名山</p>
        <a href="/mountains/"><span>7 / 100</span></a>
    </div>
    <div class="three wide column">
        <p>二百名山</p>
        <span>15 / 100</span>
    </div>
    <div class="three wide column">
        <p>三百名山</p>
        <span>18 / 100</span>
    </div>
<!--    <table id="datatables" class="ui celled table dataTable table-condensed table-bordered nowrap table-hover compact" cellspacing="0" width="100%">-->
<!--    </table>-->

</div>
