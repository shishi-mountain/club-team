<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Constant\RecordConstant;
use App\Message\RecordMessage;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Table;

/**
 * Class RecordLogic
 *
 * @package App\Model\Logic
 * @property \Cake\ORM\Table $tops
 */
class RecordLogic extends AppLogic
{
    // Table
    private Table $records;

    public function __construct()
    {
        parent::__construct();

        // Model設定
        $this->records = $this->getTableLocator()->get('Records');
    }


    /**
     * 山一覧取得処理
     *
     * 指定の種別の山情報を取得する
     * 取得できなかった場合はnullを返す
     *
     * @param string|null $mountainId 山ID
     * @return \Cake\Datasource\ResultSetInterface 処理結果ResultSetInterface
     */
    public function fetchList(?string $mountainId): ?ResultSetInterface
    {
        $query = $this->records
            ->find('active')
            ->find('createdBy', [
                'created_by' => $this->getId()
            ])
            ->contain('Mountains');

        if (!empty($mountainId)) {
            $query->find('byMountainId', [
                'mountain_id' => (int)$mountainId
            ]);
        }

        return $this->fetchResultSetInterface($query);
    }

    /**
     * 取得した一覧を配列にする
     *
     * カラム順に合わせて配列にして返す
     *
     * @param \Cake\Datasource\ResultSetInterface $dataList 取得した一覧
     * @return array|null 記録一覧
     */
    public function generateList(ResultSetInterface $dataList): ?array
    {
        $dataSet = [];

        foreach ($dataList as $data) {
            $dataSet[] = $this->setDataList($data);
        }

        return $dataSet;
    }

    /**
     * datatablesカラムセット処理
     *
     * @param object $records  記録情報
     * @return array|null
     */
    private function setDataList(object $records): ?array
    {
        $climbDate = $records->climb_date;

        return [
            'no' => $records->mountain_id,
            'name' => $records->mountain['mountain_name'],
            'climb_date' => $climbDate->format('Y/m/d'),
            'comment' => $records->comment,
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
                'title' => '山名',
                'data' => 'name',
                'className' => 'dt-body-left',
            ],
            [
                'targets' => 2,
                'title' => '登山日',
                'data' => 'climb_date',
                'className' => 'dt-body-left',
            ],
            [
                'targets' => 3,
                'title' => 'コメント',
                'data' => 'comment',
                'className' => 'dt-body-left',
            ],
        ];

        // JSONエンコードして返す
        return json_encode($columnDefs, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 新規追加時 空エンティティ生成処理
     *
     * @return array
     */
    public function initAdd(): array
    {
        return [
            'entity' => $this->createNewEmptyEntity($this->records),
            'messageList' => null,
        ];
    }


    /**
     * 記録情報追加処理
     *
     * 記録情報をDBに追加する
     *
     * @param array $recordData 記録情報設定内容
     * @return array 処理結果格納配列
     */
    public function addRecord(array $recordData): array
    {
        // 追加パラメータセット
        $addData = [
            'created_by' => $this->getId(),
            'modified_by' => $this->getId(),
        ];

        // 登録データに追加パラメータをappend
        $recordData += $addData;

        // データ保存実行
        return $this->saveRecord($recordData);
    }

    /**
     * 記録情報編集処理
     *
     * 記録情報をDB更新する
     *
     * @param array $recordData 記録情報設定内容
     * @return array 処理結果格納配列
     */
    public function editRecord(array $recordData): array
    {
        // データ保存実行
        return $this->saveRecord($recordData);
    }

    /**
     * 記録情報設定処理
     *
     * 記録情報をDBに設定する
     *
     * @param array $data 記録情報設定内容
     * @return array 処理結果格納配列
     */
    private function saveRecord(array $data): array
    {
        if (empty($data['id'])) {
            // INSERT
            $recordEntity = $this->createNewEmptyEntity($this->records);
        } else {
            // UPDATE
            $recordEntity = $this->records->get($data['id']);
        }

        // Entity生成
        $recordEntity = $this->createPatchEntity($this->records, $recordEntity, $data);

        // データ保存実行
        $resultEntity = $this->storeEntity($this->records, $recordEntity);

        // エラーの場合はメッセージをセットし返却
        if ($resultEntity === false || !empty($recordEntity->getErrors())) {
            return [
                'entity' => $recordEntity,
                'messageList' => $this->setValidationErrorMessage($recordEntity->getErrors()),
            ];
        }

        // 正常時
        return [
            'entity' => null,
            'messageList' => sprintf(recordMessage::SUCCESS_001, '更新'),
            'recordId' => $resultEntity->id,
        ];
    }

    /**
     * 画面入力データでEntityを生成する処理
     * （更新処理前のエラーの際の画面戻り用）
     *
     * @param array $data 記録情報入力データ
     * @return \Cake\Datasource\EntityInterface 生成したEntityInterface
     */
    private function generateEntityByPostData(array $data): EntityInterface
    {
        $recordEntity = $this->createNewEmptyEntity($this->records);

        // Entity生成
        return $this->createPatchEntity($this->records, $recordEntity, $data);
    }
}
