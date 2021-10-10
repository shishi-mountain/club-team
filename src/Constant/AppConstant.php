<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * 定数基底クラス
 *
 * 全ての定数クラスは本クラスを継承<br>
 * 本クラスには汎用的に使うであろう定数のみを宣言すること
 *
 * @package App\Constant
 */
class AppConstant
{
    /**
     * システムユーザID
     *
     * @var int
     */
    public const SYSTEM_USER = 1;
    /**
     * 未削除
     *
     * @var int
     */
    public const NOT_DELETED = 0;

    /**
     * 削除済み
     *
     * @var int
     */
    public const DELETED = 1;

    /**
     * 無効
     *
     * @var int
     */
    public const INVALID = 0;

    /**
     * 有効
     *
     * @var int
     */
    public const VALID = 1;

    /**
     * 空文字(置換時に使用)
     *
     * @var string
     */
    public const EMPTY = '';

    /**
     * 半角スペース
     *
     * @var string
     */
    public const HALF_SPACE = ' ';
    /**
     * データが存在する
     *
     * @var string
     */
    public const DATA_EXIST = '有';

    /**
     * データが存在しない
     *
     * @var string
     */
    public const DATA_NOT_EXIST = '無';
}
