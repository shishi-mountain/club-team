<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePrefectures extends AbstractMigration
{
    public $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('prefectures', [
            'comment' => '都道府県マスタ',
        ]);

        $table->addColumn('id', 'biginteger', [
            'autoIncrement' => true,
            'limit' => 20,
            'null' => false,
            'signed' => false,
            'comment' => 'ID',
        ]);

        $table->addColumn('prefecture_name', 'string', [
            'limit' => 255,
            'null' => false,
            'comment' => '都道府県名',
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
            'comment' => 'データ作成日',
        ]);

        $table->addPrimaryKey('id');

        $table->create();
    }
}
