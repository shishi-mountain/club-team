<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Message\UserMessage;
use App\Constant\UserConstant;
use App\Model\Entity\User;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Table;

/**
 * Class UserLogic
 *
 * @package App\Model\Logic
 * @property \Cake\ORM\Table $tops
 */
class UserLogic extends AppLogic
{
    // Table
    private Table $users;

    public function __construct()
    {
        parent::__construct();

        // Model設定
        $this->users = $this->getTableLocator()->get('Users');
    }

        /**
     * ユーザ情報追加処理
     *
     * ユーザ情報をDBに追加する
     *
     * @param array $userData ユーザ情報設定内容
     * @return array 処理結果格納配列
     */
    public function addUser(array $userData): array
    {
        // 追加パラメータセット
        $addData = [
            'created_by' => UserConstant::SYSTEM_USER,
            'modified_by' => UserConstant::SYSTEM_USER,
        ];

        // 登録データに追加パラメータをappend
        $userData += $addData;

        // データ保存実行
        return $this->saveUser($userData);
    }

    /**
     * ユーザ情報編集処理
     *
     * ユーザ情報をDB更新する
     *
     * @param array $userData ユーザ情報設定内容
     * @return array 処理結果格納配列
     */
    public function editUser(array $userData): array
    {
        // データ保存実行
        return $this->saveUser($userData);
    }

    /**
     * ユーザ情報設定処理
     *
     * ユーザ情報をDBに設定する
     *
     * @param array $data ユーザ情報設定内容
     * @return array 処理結果格納配列
     */
    private function saveUser(array $data): array
    {
        if (empty($data['id'])) {
            // INSERT
            $userEntity = $this->createNewEmptyEntity($this->users);
        } else {
            // UPDATE
            $userEntity = $this->users->get($data['id']);
        }

        // Entity生成
        $userEntity = $this->createPatchEntity($this->users, $userEntity, $data);

        // データ保存実行
        $resultEntity = $this->storeEntity($this->users, $userEntity);

        // エラーの場合はメッセージをセットし返却
        if ($resultEntity === false || !empty($userEntity->getErrors())) {
            return [
                'entity' => $userEntity,
                'messageList' => $this->setValidationErrorMessage($userEntity->getErrors()),
            ];
        }

        // 正常時
        return [
            'entity' => null,
            'messageList' => sprintf(userMessage::SUCCESS_USER_001, '更新'),
        ];
    }


    /**
     * ユーザ情報取得処理(edit）
     *
     * IDにてユーザ情報を取得する
     * 取得できなかった場合はnullを返す
     *
     * @param int $id ユーザID
     * @return array
     */
    public function fetchUserById(int $id): array
    {
        $userEntity = $this->users->get($id);

        return [
            'entity' => $userEntity,
            'messageList' => null,
        ];
    }
}
