<?php
declare(strict_types=1);

namespace App\Facade;

use App\Constant\RecordConstant;
use App\Library\DatatablesLibrary;
use App\Message\RecordMessage;
use App\Model\Logic\RecordLogic;
use App\Model\Logic\MountainLogic;

/**
 * Class TopFacade
 *
 * @package App\Facade
 * @property \App\Model\Logic\RecordLogic $recordLogic
 * @property \App\Model\Logic\MountainLogic $mountainLogic
 */
class RecordFacade extends AppFacade
{
    /**
     * ContractLogic
     *
     * @var \App\Model\Logic\MountainLogic
     */
    private RecordLogic $recordLogic;
    private MountainLogic $mountainLogic;

    public function __construct()
    {
        parent::__construct();

        // Logic設定
        $this->recordLogic = new RecordLogic();
        $this->mountainLogic = new MountainLogic();
    }

    /**
     * 登山記録一覧表示
     *
     * 表示可能な登山記録一覧を取得<br>
     * datatablesに必要なデータを配列にして返却する<br>
     *
     * @param string|null $mountainId 山ID
     * @return array 処理結果配列
     */
    public function executeIndex(?string $mountainId): array
    {
        // データ取得
        $resultSetInterface = $this->recordLogic->fetchList($mountainId);

        // 取得データを配列にして渡す
        if (is_null($resultSetInterface)) {
            $dataList = null;
        } else {
            $dataList = $this->recordLogic->generateList($resultSetInterface);
        }
        // 処理結果を返す
        return [
            'dataList' => $dataList,
        ];
    }

    /**
     * 記録情報追加
     *
     * 記録情報を新規にDB登録する<br>
     * 登録時の情報を配列にして返却する<br>
     *
     * @param array $postData 画面入力データ
     * @return array 処理結果配列
     */
    public function executeAdd(array $postData): array
    {
        if ($postData) {
            // 登録
            $result = $this->recordLogic->addRecord($postData);
        } else {
            // 一覧 -> 登録画面遷移時(まだ何も入力なし)
            $result = $this->recordLogic->initAdd();
        }

        // 処理結果を返す
        return [
            'recordEntity' => $result['entity'],
            'messageList' => $result['messageList'],
            'mountainList' => $this->mountainLogic->fetchActiveList(),
        ];
    }

    /**
     * 記録情報編集
     *
     * 記録ー情報の編集・更新を行なう<br>
     * 登録時の情報を配列にして返却する<br>
     *
     * @param string|null $recordId 記録ID
     * @param array $postData 画面入力データ
     * @return array 処理結果配列
     */
    public function executeEdit(?string $recordId = null, array $postData): array
    {
        if ($postData) {
            // 入力されたメールアドレスでユーザ情報を取得
            $userEntity = $this->userLogic->fetchUserByEmail($postData['email']);

            // 更新
            $result = $this->recordLogic->editRecord($postData, $userEntity);
        } else {
            // 一覧 -> 登録画面遷移時（初期表示時処理）
            $result = $this->recordLogic->fetchRecordById((int)$recordId);
        }

        // 処理結果を返す
        return [
            'recordEntity' => $result['entity'],
            'messageList' => $result['messageList'],
        ];
    }

    /**
     * 記録情報削除
     *
     * 記録ー情報をDBから論理削除する<br>
     * 登録時の情報を配列にして返却する<br>
     *
     * @param array $postData 画面入力データ
     * @return array 処理結果配列
     */
    public function executeDelete(array $postData): array
    {
        // 更新（論理削除）
        $postData['is_deleted'] = RecordConstant::DELETED;
        $result = $this->recordLogic->editRecord($postData);

        // 処理結果を返す
        return [
            'recordEntity' => $result['entity'],
            'messageList' => sprintf(RecordMessage::SUCCESS_CONTACT_001, '削除'),
        ];
    }
}
