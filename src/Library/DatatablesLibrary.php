<?php
declare(strict_types=1);

namespace App\Library;

use App\Constant\DatatablesConstant;

/**
 * datatables操作ライブラリ
 *
 * @package App\Library
 */
class DatatablesLibrary
{
    /**
     * datatables表示ページメニューオプション設定
     *
     * @return string JSONエンコードした表示ページプロパティ
     */
    public static function setLengthMenuJson(): string
    {
        $lengthMenu = [
            [50, 100, 200, 500, -1],
            [
                '50件 / 1ページ',
                '100件 / 1ページ',
                '200件 / 1ページ',
                '500件 / 1ページ',
                '全件表示'
            ]
        ];

        // JSONエンコードして返す
        return json_encode($lengthMenu, JSON_UNESCAPED_UNICODE);
    }

    /**
     * datatables言語オプション設定
     *
     * @return string JSONエンコードした言語プロパティ
     */
    public static function setLanguageJson(): string
    {
        $language = [
            'search' => DatatablesConstant::DATATABLES_SEARCH,
            'info' => DatatablesConstant::DATATABLES_INFO,
            'infoEmpty' => DatatablesConstant::DATATABLES_INFO_EMPTY,
            'infoFiltered' => DatatablesConstant::DATATABLES_INFO_FILTERED,
            'loadingRecords' => DatatablesConstant::DATATABLES_LOADING_RECORDS,
            'lengthMenu' => DatatablesConstant::DATATABLES_LENGTH_MENU,
            'zeroRecords' => DatatablesConstant::DATATABLES_ZERO_RECORDS,
            'paginate' => [
                'first' => DatatablesConstant::DATATABLES_PAGINATE_FIRST,
                'last' => DatatablesConstant::DATATABLES_PAGINATE_LAST,
                'previous' => DatatablesConstant::DATATABLES_PAGINATE_PREVIOUS,
                'next' => DatatablesConstant::DATATABLES_PAGINATE_NEXT
            ]
        ];

        // JSONエンコードして返す
        return json_encode($language, JSON_UNESCAPED_UNICODE);
    }
}
