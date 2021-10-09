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
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>">home</a>
        </div>
    </nav>
    <div class="ui container" style="margin-top: 10px">
        <div class="ui segment">
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
    <footer>
    </footer>
    <?php echo $this->Html->script([
        'jquery-3.6.0.min',
        'semantic-ui/semantic.min',
    ]); ?>
</body>
</html>
