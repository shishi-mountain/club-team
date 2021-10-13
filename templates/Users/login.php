<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
            <div class="content">
                日本百名山
            </div>
        </h2>
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->Form->create(null, [
            'type' => 'post',
            'url' => [
                'action' => 'login'
            ],
            'class' => 'ui large form',
        ]); ?>
        <div class="ui stacked segment">
            <div class="field">
                <div class="ui left icon input">
                    <i class="user icon"></i>
                    <?php echo $this->Form->text('email', [
                        'class' => 'form-control',
                        'autofocus' => true,
                        'placeholder' => 'ログインID（メールアドレス）を入力して下さい',
                    ]); ?>
                </div>
            </div>
            <div class="field">
                <div class="ui left icon input">
                    <i class="lock icon"></i>
                    <?php echo $this->Form->text('password', [
                        'class' => 'form-control',
                        'type' => 'password',
                        'placeholder' => 'パスワードを入力して下さい',
                    ]); ?>
                </div>
            </div>
            <div class="field">
                <button class="ui button fluid teal">login</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <br>
        <?= $this->Html->link("サインアップ", ['action' => 'add']) ?>
    </div>
</div>
