<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('Users', [
            'comment' => 'ユーザーテーブル',
        ]);

        $table->addColumn('id', 'biginteger', [
            'autoIncrement' => true,
            'limit' => 20,
            'null' => false,
            'signed' => false,
            'comment' => 'ID',
        ]);

        $table->addColumn('email', 'string', [
            'limit' => 255,
            'null' => false,
            'comment' => 'メールアドレス',
        ]);

        $table->addColumn('password', 'string', [
            'limit' => 255,
            'null' => false,
            'comment' => 'パスワード',
        ]);

        $table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
            'comment' => '名前',
        ]);

        $table->addColumn('is_admin', 'biginteger', [
            'default' => 0,
            'null' => false,
            'comment' => '管理者フラグ',
        ]);

        $table->addColumn('is_deleted', 'boolean', [
            'default' => 0,
            'null' => false,
            'comment' => '削除フラグ(0：有効 / 1：削除済)',
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
            'comment' => 'データ作成日',
        ]);

        $table->addColumn('created_by', 'biginteger', [
            'limit' => 20,
            'default' => null,
            'null' => true,
            'comment' => 'データ作成者',
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
            'comment' => 'データ更新日',
        ]);

        $table->addColumn('modified_by', 'biginteger', [
            'limit' => 20,
            'default' => null,
            'null' => true,
            'comment' => 'データ更新者',
        ]);

        $table->addPrimaryKey('id');

        $table->create();
    }
}
