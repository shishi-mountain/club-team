<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMountains extends AbstractMigration
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
        $table = $this->table('Mountains', [
            'comment' => '山テーブル',
        ]);

        $table->addColumn('id', 'biginteger', [
            'autoIncrement' => true,
            'limit' => 20,
            'null' => false,
            'signed' => false,
            'comment' => 'ID',
        ]);

        $table->addColumn('mountain_no', 'integer', [
            'limit' => 4,
            'null' => false,
            'signed' => false,
            'comment' => '山No',
        ]);

        $table->addColumn('mountain_name', 'string', [
            'limit' => 255,
            'null' => false,
            'comment' => '山名',
        ]);

        $table->addColumn('area', 'string', [
            'limit' => 20,
            'null' => false,
            'comment' => 'エリア',
        ]);

        $table->addColumn('elevation', 'string', [
            'limit' => 20,
            'null' => false,
            'comment' => '標高（m）',
        ]);

        $table->addColumn('difficulty_level', 'string', [
            'limit' => 20,
            'null' => true,
            'comment' => '難易度',
        ]);

        $table->addColumn('physical_level', 'string', [
            'limit' => 20,
            'null' => true,
            'comment' => '体力度',
        ]);

        $table->addColumn('schedule_type', 'integer', [
            'limit' => 4,
            'null' => true,
            'comment' => '参考日程',
        ]);

        $table->addColumn('active_volcano', 'string', [
            'limit' => 20,
            'null' => true,
            'comment' => '活火山指定',
        ]);

        $table->addColumn('snow_season', 'string', [
            'limit' => 20,
            'null' => true,
            'comment' => '積雪期',
        ]);

        $table->addColumn('remaining_snow_season', 'string', [
            'limit' => 20,
            'null' => true,
            'comment' => '残雪期',
        ]);

        $table->addColumn('climbing_season_type', 'string', [
            'limit' => 20,
            'null' => true,
            'comment' => '登山適期',
        ]);

        $table->addColumn('autumn_season_type', 'string', [
            'limit' => 20,
            'null' => true,
            'comment' => '紅葉期',
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
