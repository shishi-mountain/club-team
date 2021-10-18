<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PhotosFixture
 */
class PhotosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => null, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'ID', 'autoIncrement' => true, 'precision' => null],
        'record_id' => ['type' => 'biginteger', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '記録ID', 'precision' => null, 'autoIncrement' => null],
        'file_path' => ['type' => 'string', 'length' => 3000, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'ファイルの格納場所', 'precision' => null],
        'comment' => ['type' => 'string', 'length' => 3000, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'コメント', 'precision' => null],
        'is_deleted' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '削除フラグ(0：有効 / 1：削除済)', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => 'データ作成日'],
        'created_by' => ['type' => 'biginteger', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'データ作成者', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => 'データ更新日'],
        'modified_by' => ['type' => 'biginteger', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'データ更新者', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'record_id' => 1,
                'file_path' => 'Lorem ipsum dolor sit amet',
                'comment' => 'Lorem ipsum dolor sit amet',
                'is_deleted' => 1,
                'created' => '2021-10-18 22:27:39',
                'created_by' => 1,
                'modified' => '2021-10-18 22:27:39',
                'modified_by' => 1,
            ],
        ];
        parent::init();
    }
}
