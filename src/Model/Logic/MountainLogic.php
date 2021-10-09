<?php
declare(strict_types=1);

namespace App\Model\Logic;

use Cake\Datasource\ResultSetInterface;
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
        // TODO: $mountainType振り分け
        $query = $this->mountains->find();

        return $this->fetchResultSetInterface($query);
    }

    /**
     * 取得した一覧をJSON形式に変換
     *
     * カラム順に合わせて配列にセットしJSONエンコードして返す
     *
     * @param \Cake\Datasource\ResultSetInterface $dataList 取得した一覧
     * @return string|null 契約情報一覧(JSON形式)
     */
    public function generateListJson(ResultSetInterface $dataList): ?string
    {
        $dataSet = [];

        foreach ($dataList as $data) {
//            $dataSet[] = $this->setDataList($data);
            $dataSet[] = $data;
        }

        // JSONエンコードして返す
        return json_encode($dataSet, JSON_UNESCAPED_UNICODE);
    }
}
