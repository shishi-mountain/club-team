<?php
declare(strict_types=1);

namespace App\Library;

use Cake\Chronos\Chronos;
use Exception;

/**
 * 日付 / 時間操作用ライブラリ
 *
 * 本クラスのメソッドはstaticで作成
 *
 * @package App\Library
 */
class ChronosLibrary
{
    /**
     * ハイフン区切り日時フォーマット(Y-m-d H:i:s)
     *
     * @var string
     */
    private const FORMAT_HYPHEN_YMDHIS = 'Y-m-d H:i:s';

    /**
     * スラッシュ区切り日時フォーマット(Y/m/d H:i:s)
     *
     * @var string
     */
    private const FORMAT_SLASH_YMDHIS = 'Y/m/d H:i:s';

    /**
     * 日時フォーマット(YmdHis)
     *
     * @var string
     */
    private const FORMAT_YMDHIS = 'YmdHis';

    /**
     * ハイフン区切り日付フォーマット(Y-m-d)
     *
     * @var string
     */
    private const FORMAT_HYPHEN_YMD = 'Y-m-d';

    /**
     * スラッシュ区切り日付フォーマット(Y/m/d)
     *
     * @var string
     */
    private const FORMAT_SLASH_YMD = 'Y/m/d';

    /**
     * 日付フォーマット(Ymd)
     *
     * @var string
     */
    private const FORMAT_YMD = 'Ymd';

    /**
     * ハイフン区切り日付フォーマット(Y-m)
     *
     * @var string
     */
    private const FORMAT_HYPHEN_YM = 'Y-m';

    /**
     * スラッシュ区切り日付フォーマット(Y/m)
     *
     * @var string
     */
    private const FORMAT_SLASH_YM = 'Y/m';

    /**
     * 日付フォーマット(Ym)
     *
     * @var string
     */
    private const FORMAT_YM = 'Ym';

    /**
     * システム日時を指定フォーマット形式の文字列で返す
     *
     * @param string $format システム日時の指定フォーマット
     * @return string フォーマットに合わせたシステム日時
     */
    public static function getSystemDateTime($format = self::FORMAT_HYPHEN_YMDHIS): string
    {
        return Chronos::now()->format($format);
    }
}
