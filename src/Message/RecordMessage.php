<?php
declare(strict_types=1);

namespace App\Message;

/**
 * 記録情報メッセージ定数クラス
 *
 * @package App\Message
 */
class RecordMessage extends AppMessage
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
    public const UNREGISTERED = 'まだ記録がありません。';

    /**
     * S3アップロードエラー
     *
     * @var string
     */
    public const ERROR_S3_UPLOAD = 'S3アップロードでエラーが発生しました。';

    /**
     * ファイルサイズエラーメッセージ（%s：ファイル名を指定）
     *
     * @var string
     */
    public const ERROR_FILE_SIZE = 'ファイルのサイズは10MB以下にしてください。（%s）';
}
