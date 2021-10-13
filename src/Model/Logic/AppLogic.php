<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Traits\AuthenticationTrait;
use App\Traits\FlashTrait;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 * Logic基底クラス
 *
 * Logic側でクエリを生成して、本クラスでデータ取得処理を一元化
 *
 * @package App\Model\Logic
 * @author K.Nakamura
 */
class AppLogic
{
    // Trait設定
    use AuthenticationTrait;
    use FlashTrait;
    // TableLocator設定
    use LocatorAwareTrait;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }

    /**
     * EntityInterface取得処理
     *
     * 実行クエリ結果が存在する場合のみEntityInterfaceを返す
     * 結果が存在しない場合はnullを返す
     *
     * @param \Cake\ORM\Query $query 実行クエリ
     * @return \Cake\Datasource\EntityInterface|null 対象モデルEntityInterface
     */
    public function fetchEntityInterface(Query $query): ?EntityInterface
    {
        return $query->first();
    }

    /**
     * ResultSetInterface取得処理
     *
     * 実行クエリ結果が存在する場合のみResultSetInterfaceを返す
     * 結果が存在しない場合はnullを返す
     *
     * @param \Cake\ORM\Query $query 実行クエリ
     * @return \Cake\Datasource\ResultSetInterface 対象モデルResultSetInterface
     */
    public function fetchResultSetInterface(Query $query): ?ResultSetInterface
    {
        $resultSetInterface = $query->all();

        if ($resultSetInterface->isEmpty()) {
            return null;
        }

        return $resultSetInterface;
    }

    /**
     * データ件数取得処理
     *
     * クエリ実行結果件数を返す
     *
     * @param \Cake\ORM\Query $query 実行クエリ
     * @return int  取得したデータ件数
     */
    public function fetchCount(Query $query): int
    {
        return $query->count();
    }

    /**
     * オプションリスト取得処理
     *
     * セレクトボックスにリストとしてセットする場合等に使用<br>
     * 条件に合致するリストをKey-Value形式で取得して返す<br>
     *
     * 条件に合致するデータが存在しない場合はnullを返す
     *
     * $keyValueList配列内容は以下の通り
     *
     * - `key` セレクトボックスKey
     * - `value` セレクトボックスValue
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @param array|null $condition 取得条件
     * @param array $keyValueList リストにセットするKey-Value
     * @return array|null 生成したオプションリスト
     */
    public function fetchOptionList(Table $targetTable, ?array $condition, array $keyValueList): ?array
    {
        $query = $targetTable->find('list', [
            'keyField' => $keyValueList['key'],
            'valueField' => function ($entity) use ($keyValueList) {
                return $entity->get($keyValueList['value']);
            },
        ]);

        if (!is_null($condition)) {
            $query->where($condition);
        }

        $resultList = $query->toArray();

        if (is_null($resultList)) {
            return null;
        } else {
            return $resultList;
        }
    }

    /**
     * 新規登録用EntityInterface生成処理
     *
     * セットされたパラメータに対してバリデーションを実行してEntityを生成
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @param array $params 登録データ配列
     * @return \Cake\Datasource\EntityInterface 生成したEntityInterface
     */
    public function createNewEntity(Table $targetTable, array $params): EntityInterface
    {
        return $targetTable->newEntity($params);
    }

    /**
     * 新規登録用EntityInterface生成処理
     *
     * バリデーションを実行せずに空Entityを生成する
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @return \Cake\Datasource\EntityInterface 生成したEntityInterface
     */
    public function createNewEmptyEntity(Table $targetTable): EntityInterface
    {
        return $targetTable->newEmptyEntity();
    }

    /**
     * 登録EntityInterface配列生成処理
     *
     * 複数データ新規登録時(saveMany)に使用
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @param array $dataList 登録データ配列
     * @return array 生成したEntityInterface配列
     */
    public function createNewEntities(Table $targetTable, array $dataList): array
    {
        return $targetTable->newEntities($dataList);
    }

    /**
     * 更新EntityInterface生成処理
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @param \Cake\Datasource\EntityInterface $entityInterface 対象EntityInterface
     * @param array $params 登録パラメータ
     * @return \Cake\Datasource\EntityInterface 生成したEntityInterface
     */
    public function createPatchEntity(
        Table $targetTable,
        EntityInterface $entityInterface,
        array $params
    ): EntityInterface {
        return $targetTable->patchEntity($entityInterface, $params);
    }

    /**
     * データ登録処理
     *
     * INSERT / UPDATE両方対応<br>
     * 対象データを1件INSERT / UPDATE実行<br>
     * エラー時はfalseを返すため、必要あれば呼び元でエラーメッセージを取得すること<br>
     * 例：$entityInterface->getErrors(); // エラーメッセージが配列で格納される
     *
     * @param \Cake\ORM\Table $targetTable
     * @param \Cake\Datasource\EntityInterface $entityInterface
     * @return \Cake\Datasource\EntityInterface|false
     */
    public function storeEntity(Table $targetTable, EntityInterface $entityInterface)
    {
        if ($entityInterface->hasErrors()) {
            // バリデーションエラー時は処理中断
            return false;
        }

        // データ登録処理実行
        $targetTable->save($entityInterface);

        return $entityInterface;
    }

    /**
     * データ一括登録処理
     *
     * INSERT / UPDATE両方対応<br>
     * saveManyを実行し異常時はfalseを返す
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @param iterable $entities 対象iterable(entities)
     * @return \Cake\Datasource\EntityInterface[]|\Cake\Datasource\ResultSetInterface|false 登録後EntityInterface / ResultSetInterface
     * @throws \Exception
     */
    public function storeEntities(Table $targetTable, iterable $entities)
    {
        // データ登録処理実行
        return $targetTable->saveMany($entities);
    }

    /**
     * データ一括削除処理
     *
     * deleteAllを実行し対象データを物理削除<br>
     * 削除条件は配列で指定
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @param array $conditions 削除条件
     * @return int 処理件数
     */
    public function bulkDelete(Table $targetTable, array $conditions): int
    {
        // データ一括削除実行
        return $targetTable->deleteAll($conditions);
    }

    /**
     * IDリスト生成処理
     *
     * Ajaxで取得したパラメータをベースにid列を配列として返す
     *
     * @param array $selectedDataList 選択されたデータリスト
     * @return array 生成したIDリスト
     */
    public function buildIdList(array $selectedDataList): array
    {
        $idList = [];

        foreach ($selectedDataList as $target) {
            array_push($idList, $target->id);
        }

        return $idList;
    }
}
