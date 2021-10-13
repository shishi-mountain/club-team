<?php
declare(strict_types=1);

namespace App\Message;

/**
 * ユーザー情報メッセージ定数クラス
 *
 * @package App\Message
 */
class UserMessage extends AppMessage
{
    /**
     * 更新成功メッセージ
     *
     * @var string
     */
    public const SUCCESS_USER_001 = 'ユーザ情報を%sしました。';

    /**
     * ログイン成功時メッセージ
     *
     * @var string
     */
    public const SUCCESS_USER_002 = "ログイン成功しました。";

    /**
     * ログアウト成功時メッセージ
     *
     * @var string
     */
    public const SUCCESS_USER_003 = "ログアウトしました。";

    /**
     * ログイン失敗時メッセージ
     *
     * @var string
     */
    public const SUCCESS_USER_004 = "ログインに失敗しました。";
}
