<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css([
        'cake',
        'home',
        'plugin/semantic-ui/semantic.min',
        'plugin/semantic-ui/default-style',
        'style',
    ]) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?php echo $this->element('layout/header'); ?>
    <div class="ui container" style="margin-top: 10px">
        <div class="ui segment">
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
    <?php echo $this->element('layout/footer'); ?>
    <?php echo $this->Html->script([
        'jquery-3.6.0.min',
        'plugin/semantic-ui/semantic.min',
    ]); ?>
    <?php echo $this->fetch('script'); ?>
    <?php echo $this->fetch('scriptBottom'); ?>
    <?php echo $this->fetch('ignitionScript'); ?>
</body>
</html>
