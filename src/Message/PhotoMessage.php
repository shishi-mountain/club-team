<?php
declare(strict_types=1);

namespace App\Message;

/**
 * 写真情報メッセージ定数クラス
 *
 * @package App\Message
 */
class PhotoMessage extends AppMessage
{
    /**
     * 更新成功メッセージ
     *
     * @var string
     */
    public const SUCCESS_001 = '%sしました。';

    /**
     * 未登録メッセージ
     *
     * @var string
     */
    public const UNREGISTERED = 'まだ写真がありません。';

    /**
     * S3アップロードエラー
     *
     * @var string
     */
    public const ERROR_S3_UPLOAD = 'S3アップロードでエラーが発生しました。';

    /**
     * S3ダウンロードエラー
     *
     * @var string
     */
    public const ERROR_S3_DOWNLOAD = 'S3ダウンロードでエラーが発生しました。';
}
