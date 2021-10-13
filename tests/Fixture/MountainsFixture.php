<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MountainsFixture
 */
class MountainsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => null, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'ID', 'autoIncrement' => true, 'precision' => null],
        'mountain_no' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '山No', 'precision' => null, 'autoIncrement' => null],
        'mountain_name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '山名', 'precision' => null],
        'area' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'エリア', 'precision' => null],
        'elevation' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '標高（m）', 'precision' => null],
        'difficulty_level' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '難易度', 'precision' => null],
        'physical_level' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '体力度', 'precision' => null],
        'schedule_type' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '参考日程', 'precision' => null, 'autoIncrement' => null],
        'active_volcano' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '活火山指定', 'precision' => null],
        'snow_season' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '積雪期', 'precision' => null],
        'remaining_snow_season' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '残雪期', 'precision' => null],
        'climbing_season_type' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '登山適期', 'precision' => null],
        'autumn_season_type' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '紅葉期', 'precision' => null],
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
                'mountain_no' => 1,
                'mountain_name' => 'Lorem ipsum dolor sit amet',
                'area' => 'Lorem ipsum dolor ',
                'elevation' => 'Lorem ipsum dolor ',
                'difficulty_level' => 'Lorem ipsum dolor ',
                'physical_level' => 'Lorem ipsum dolor ',
                'schedule_type' => 1,
                'active_volcano' => 'Lorem ipsum dolor ',
                'snow_season' => 'Lorem ipsum dolor ',
                'remaining_snow_season' => 'Lorem ipsum dolor ',
                'climbing_season_type' => 'Lorem ipsum dolor ',
                'autumn_season_type' => 'Lorem ipsum dolor ',
                'created' => '2021-10-09 07:29:36',
                'created_by' => 1,
                'modified' => '2021-10-09 07:29:36',
                'modified_by' => 1,
            ],
        ];
        parent::init();
    }
}
