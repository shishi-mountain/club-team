<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * Record定数クラス
 *
 * @package App\Constant
 */
class RecordConstant extends AppConstant
{
    /**
     * S3バケット名：記録画面用
     *
     * @var string
     */
    public const S3_BUCKET = 'climb-record';

    /**
     * S3へアップロードする画像ファイルサイズの上限（10MB）
     *
     * @var int
     */
    public const S3_MAX_FILE_SIZE = 10485760;
}
