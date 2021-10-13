<?php
declare(strict_types=1);

use App\Library\ChronosLibrary;
use Cake\ORM\TableRegistry;
use Migrations\AbstractSeed;

/**
 * Schedules seed.
 */
class SchedulesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        $executeTime = ChronosLibrary::getSystemDateTime();

        // 既にデータが入っている場合は実行しない
        $schedules = TableRegistry::getTableLocator()->get('schedules');
        if ($schedules->find()->count() == 0) {
            $data = [
                [
                    'id' => '1',
                    'schedule_name' => '前夜泊日帰り',
                    'created' => $executeTime,
                    'created_by' => '1',
                    'modified' => $executeTime,
                    'modified_by' => '1',
                ],
                [
                    'id' => '2',
                    'schedule_name' => '日帰り',
                    'created' => $executeTime,
                    'created_by' => '1',
                    'modified' => $executeTime,
                    'modified_by' => '1',
                ],
                [
                    'id' => '3',
                    'schedule_name' => '1泊2日',
                    'created' => $executeTime,
                    'created_by' => '1',
                    'modified' => $executeTime,
                    'modified_by' => '1',
                ],
                [
                    'id' => '4',
                    'schedule_name' => '2泊3日',
                    'created' => $executeTime,
                    'created_by' => '1',
                    'modified' => $executeTime,
                    'modified_by' => '1',
                ],
                [
                    'id' => '5',
                    'schedule_name' => '3泊4日',
                    'created' => $executeTime,
                    'created_by' => '1',
                    'modified' => $executeTime,
                    'modified_by' => '1',
                ],
            ];
        }

        $table = $this->table('schedules');
        $table->insert($data)->save();
    }
}
