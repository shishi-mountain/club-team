<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Message\PhotoMessage;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Table;

/**
 * Class PhotoLogic
 *
 * @package App\Model\Logic
 * @property \Cake\ORM\Table $tops
 */
class PhotoLogic extends AppLogic
{
    // Table
    private Table $photos;

    public function __construct()
    {
        parent::__construct();

        // Model設定
        $this->photos = $this->getTableLocator()->get('Photos');
    }

    /**
     * 新規追加時 空エンティティ生成処理
     *
     * @return array
     */
    public function initAdd(): array
    {
        return [
            'entity' => $this->createNewEmptyEntity($this->photos),
            'messageList' => null,
        ];
    }


    /**
     * 写真情報追加処理
     *
     * 写真情報をDBに追加する
     *
     * @param array $data 写真情報設定内容
     * @param int $recordId 記録テーブルID
     * @return array 処理結果格納配列
     */
    public function addPhoto(array $photoData, int $recordId): array
    {
        // 追加パラメータセット
        $addData = [
            'record_id' => $recordId,
            'file_path' => "/photo/{$recordId}",
            'created_by' => $this->getId(),
            'modified_by' => $this->getId(),
        ];

        // 登録データに追加パラメータをappend
        $photoData += $addData;

        // データ保存実行
        return $this->savePhoto($photoData);
    }

    /**
     * 写真情報編集処理
     *
     * 写真情報をDB更新する
     *
     * @param array $photoData 写真情報設定内容
     * @return array 処理結果格納配列
     */
    public function editPhoto(array $photoData): array
    {
        // データ保存実行
        return $this->savePhoto($photoData);
    }

    /**
     * 写真情報設定処理
     *
     * 写真情報をDBに設定する
     *
     * @param array $data 写真情報設定内容
     * @return array 処理結果格納配列
     */
    private function savePhoto(array $data): array
    {
        if (empty($data['id'])) {
            // INSERT
            $photoEntity = $this->createNewEmptyEntity($this->photos);
        } else {
            // UPDATE
            $photoEntity = $this->photos->get($data['id']);
        }

        // Entity生成
        $photoEntity = $this->createPatchEntity($this->photos, $photoEntity, $data);

        // データ保存実行
        $resultEntity = $this->storeEntity($this->photos, $photoEntity);

        // エラーの場合はメッセージをセットし返却
        if ($resultEntity === false || !empty($photoEntity->getErrors())) {
            return [
                'entity' => $photoEntity,
                'messageList' => $this->setValidationErrorMessage($photoEntity->getErrors()),
            ];
        }

        // 正常時
        return [
            'entity' => null,
            'messageList' => sprintf(photoMessage::SUCCESS_001, '更新'),
            'photoId' => $resultEntity->id,
        ];
    }
}
