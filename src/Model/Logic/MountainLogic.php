<?php
declare(strict_types=1);

namespace App\Model\Logic;

use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 * Class MountainLogic
 *
 * @package App\Model\Logic
 * @property \Cake\ORM\Table $tops
 */
class MountainLogic extends AppLogic
{
    // Table
    private Table $mountains;

    public function __construct()
    {
        parent::__construct();

        // Model設定
        $this->mountains = $this->getTableLocator()->get('mountains');
        $this->records = $this->getTableLocator()->get('records');
    }


    /**
     * 山一覧取得処理
     *
     * 指定の種別の山情報を取得する
     * 取得できなかった場合はnullを返す
     *
     * @param int $mountainType (1:百名山、2:二百名山、3:三百名山、指定なしは全て）
     * @return \Cake\Datasource\ResultSetInterface 処理結果ResultSetInterface
     */
    public function fetchList(?int $mountainType): ?ResultSetInterface
    {
        $subQuery = $this->generateSubQueryRecordCount();
        // TODO: $mountainType振り分け
        $query = $this->mountains->find()
            ->leftJoin(
                ['subQuery' => $subQuery],
                ['subQuery.mountain_id = mountains.id']
            )
            ->select($this->mountains);

        $query->select([
            'climb_count' => 'subQuery.climb_count'
        ]);



        return $this->fetchResultSetInterface($query);
    }


    /**
     * 登山記録回数を取得するサブクエリ文を作成する
     *
     * @return \Cake\ORM\Query $query
     */
    private function generateSubQueryRecordCount(): ?Query
    {
        $query = $this->records
            ->find('active')
            ->find('createdBy', [
                'created_by' => $this->getId()
            ])
            ->group('mountain_id');

        $query->select([
            'mountain_id' => 'records.mountain_id' ,
            'climb_count' => $query->func()->count('*'),
        ]);

        return $query;
    }

    /**
     * 取得した一覧をJSON形式に変換
     *
     * カラム順に合わせて配列にセットしJSONエンコードして返す
     *
     * @param \Cake\Datasource\ResultSetInterface $dataList 取得した一覧
     * @return string|null 山情報一覧(JSON形式)
     */
    public function generateListJson(ResultSetInterface $dataList): ?string
    {
        $dataSet = [];

        foreach ($dataList as $data) {
            $dataSet[] = $this->setDataList($data);
        }

        // JSONエンコードして返す
        return json_encode($dataSet, JSON_UNESCAPED_UNICODE);
    }

    /**
     * datatablesカラムセット処理
     *
     * @param object $mountains  山情報
     * @return array
     */
    private function setDataList(object $mountains): array
    {
        $recordUrl = "/records/?mountain_id={$mountains->id}";

        return [
            'no' => $mountains->mountain_no,
            'mountain_name' => $mountains->mountain_name,
            'area' => $mountains->area,
            'climb_count' => "<a href='{$recordUrl}'>{$mountains->climb_count}</a>",
            'elevation' => $mountains->elevation,
            'difficulty_level' => $mountains->difficulty_level,
            'physical_level' => $mountains->physical_level,
            'schedule_type' => $mountains->schedule_type,
        ];
    }


    /**
     * datatablesのcolumnDefs設定
     *
     * data部分は取得したデータカラム名と一致させること
     *
     * @return string
     */
    public function setColumnDefsJson(): string
    {
        $columnDefs = [
            [
                'targets' => 0,
                'title' => 'No',
                'data' => 'no',
                'className' => 'dt-body-left',
            ],
            [
                'targets' => 1,
                'title' => '名',
                'data' => 'mountain_name',
                'className' => 'dt-body-center',
            ],
            [
                'targets' => 2,
                'title' => 'エリア',
                'data' => 'area',
                'className' => 'dt-body-center',
            ],
            [
                'targets' => 3,
                'title' => 'My活動記録',
                'data' => 'climb_count',
                'className' => 'dt-body-center',
            ],
            [
                'targets' => 4,
                'title' => '標高（m）',
                'data' => 'elevation',
                'className' => 'dt-body-center',
            ],
            [
                'targets' => 5,
                'title' => '難易度',
                'data' => 'difficulty_level',
                'className' => 'dt-body-center',
            ],
            [
                'targets' => 6,
                'title' => '体力度',
                'data' => 'physical_level',
                'className' => 'dt-body-center',
            ],
            [
                'targets' => 7,
                'title' => '参考日程',
                'data' => 'schedule_type',
                'className' => 'dt-body-center',
            ],
        ];

        // JSONエンコードして返す
        return json_encode($columnDefs, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 山リスト取得処理
     *
     * 山テーブルより有効な権限リストを取得する
     *
     * @return array|null 山リスト
     */
    public function fetchActiveList(): ?array
    {
        return $this->fetchOptionList(
            $this->mountains,
            [],
            [
                'key' => 'id',
                'value' => 'mountain_name',
            ]
        );
    }
}
