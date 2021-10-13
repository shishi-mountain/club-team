<?php
declare(strict_types=1);

namespace App\Facade;

use App\Model\Logic\UserLogic;

/**
 * Class UserFacade
 *
 * @package App\Facade
 * @property \App\Model\Logic\UserLogic $userLogic
 */
class UserFacade extends AppFacade
{
    /**
     * ユーザLogic
     *
     * @var \App\Model\Logic\UserLogic
     */
    private UserLogic $userLogic;

    /**
     * UserFacade constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Logic設定
        $this->userLogic = new UserLogic();
    }

    /**
     * ユーザ情報追加
     *
     * @param array $postData 画面入力データ
     * @return array 処理結果配列
     */
    public function executeAdd(array $postData): array
    {
        if ($postData) {
            // 登録
            $result = $this->userLogic->addUser($postData);
        } else {
            // 一覧 -> 登録画面遷移時(まだ何も入力なし)
            return [
                'userEntity' => null,
                'messageList' => null,
            ];
        }

        // 処理結果を返す
        return [
            'userEntity' => $result['entity'],
            'messageList' => $result['messageList'],
        ];
    }

    /**
     * ユーザ情報編集
     *
     * ユーザー情報の編集・更新を行なう<br>
     * 登録時の情報を配列にして返却する<br>
     *
     * @param string|null $userId ユーザID
     * @param array $postData 画面入力データ
     * @return array 処理結果配列
     */
    public function executeEdit(?string $userId = null, array $postData): array
    {
        if ($postData) {
            // 更新
            $result = $this->userLogic->editUser($postData);
        } else {
            // 一覧 -> 登録画面遷移時（初期表示時処理）
            $result = $this->userLogic->fetchUserById((int)$userId);
        }

        // 処理結果を返す
        return [
            'userEntity' => $result['entity'],
            'messageList' => $result['messageList'],
        ];
    }
}
