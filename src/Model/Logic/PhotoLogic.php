<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Library\FileLibrary;
use App\Message\PhotoMessage;
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
     * @param array $photoData 写真情報設定内容
     * @param int $recordId 記録テーブルID
     * @return array 処理結果格納配列
     */
    public function addPhoto(array $photoData, int $recordId): array
    {
//        // 追加パラメータセット
//        $addData = [
//            'record_id' => $recordId,
//            'file_path' => "/photo_{$recordId}.png",
//            'created_by' => $this->getId(),
//            'modified_by' => $this->getId(),
//        ];
//
//        // 登録データに追加パラメータをappend
//        $photoData += $addData;
//
//        // データ保存実行
//        return $this->savePhoto($photoData);
        foreach ($photoData['input_file'] as $inputFile) {
            if ($inputFile->getError() == UPLOAD_ERR_OK) {
                // アップされたファイルにエラーがない場合、保存する
                // 追加パラメータセット
                $addData['record_id'] = $recordId;
                $addData['file_path'] = $inputFile->getClientFilename();
                $addData['created_by'] = $this->getId();
                $addData['modified_by'] = $this->getId();

                // データ保存実行
                $result = $this->savePhoto($addData);
                if (!is_null($result['entity'])) {
                    // saveエラー
                    return $result;
                } else {
                    // INSERTした写真IDを配列にセット
                    $tempList[] = [
                        'id' => $result['photoId'],
                        'fileName' => $inputFile,
                    ];
                }
            }
        }

        // 契約書類リストを返却配列に追加
        $result['photoList'] = $tempList;

        return $result;
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


    /**
     * 写真をS3にアップロードし、S3オブジェクトパスを取得し返却する
     *
     * @param array $postData 画面入力内容
     * @param int $recordId 記録ID
     * @param array $photoList 写真リスト
     * @return array 処理結果格納配列
     */
    public function uploadPhotoS3(
        array $postData,
        int $recordId,
        array $photoList
    ): array {
        // 入力ファイルを一時フォルダにコピー
        $copyFilePaths = FileLibrary::copyInputFile($postData['input_file']);
//
//        // アップロード先ファイルパスをセット
//        $uploadFileList = $this->generateUploadPath($recordId, $photoList);
//
//        foreach ($uploadFileList as $key => $uploadFile) {
//            // S3アップロードパスに存在するファイルを削除
//            $existFileList = AwsS3Library::getFileList(
//                ContractDocumentConstant::S3_BUCKET,
//                $uploadFile['path'],
//            );
//            if ($existFileList) {
//                foreach ($existFileList['Contents'] as $object) {
//                    AwsS3Library::delete(
//                        ContractDocumentConstant::S3_BUCKET,
//                        $object['Key'],
//                    );
//                }
//            }
//
//            // S3アップロード
//            $result = AwsS3Library::upload(
//                ContractDocumentConstant::S3_BUCKET,
//                $uploadFile['path'] . '/' . $uploadFile['name'],
//                $copyFilePaths[$key],
//            );
//
//            // 契約書類テーブル更新用パラメータ
//            $updateDocumentList[] = [
//                'id' => $uploadFile['id'],
//                'file_path' => $uploadFile['path'] . '/' . $uploadFile['name'],
//            ];
//        }
//
//        // 一時フォルダの入力ファイルを削除
//        FileLibrary::deleteInputFile($copyFilePaths);

        return [
//            'result' => $result,
            'result' => true,
            'message' => PhotoMessage::ERROR_S3_UPLOAD,
//            'updateDocumentList' => $updateDocumentList,
            'updateDocumentList' => $copyFilePaths,
        ];
    }
}
