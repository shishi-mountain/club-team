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
}
