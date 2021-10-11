<header>
    <div class="ui segment">
        <?php if (!empty($authenticationData['userName'])) : ?>
            <div class="ui text menu">
                <a class="item" href="/tops/">
                    <h4 class="ui header blue">Top</h4>
                </a>
                <div class="ui right dropdown item">
                    <i class="user circle icon"></i>
                    <?php echo $authenticationData['userName']; ?>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="/records/">
                            活動記録
                        </a>
                        <a class="item" href="/users/edit/<?php echo $authenticationData['id']; ?>">
                            プロフィール編集
                        </a>
                        <a class="item" href="/users/logout">
                            ログアウト
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</header>
