<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * datatables定数クラス
 *
 * @package App\Constant
 */
class DatatablesConstant extends AppConstant
{
    /**
     * フリーワード検索部分の表示文言
     *
     * @var string
     */
    const DATATABLES_SEARCH = 'フリーワード検索';

    /**
     * データ表示状況文言
     *
     * @var string
     */
    const DATATABLES_INFO = '全 _PAGES_ ページ中の _PAGE_ ページ目を表示 / 全データ数_MAX_件';

    /**
     * データが存在しない場合の表示文言
     *
     * @var string
     */
    const DATATABLES_INFO_EMPTY = '表示するデータがありません。';

    /**
     * 表示結果からフィルタリングしている際の表示文言
     *
     * @var string
     */
    const DATATABLES_INFO_FILTERED = '【全 _MAX_ 件からの絞り込み結果】';

    /**
     * フリーワード検索時にヒットするデータが存在しない場合の表示文言
     *
     * @var string
     */
    const DATATABLES_ZERO_RECORDS = '検索条件にマッチするデータがありません。';

    /**
     * データ読み込み中表示文言
     *
     * @var string
     */
    const DATATABLES_LOADING_RECORDS = 'Loading...';

    /**
     * 1ページに表示する件数表示文言
     *
     * @var string
     */
    const DATATABLES_LENGTH_MENU = '_MENU_';

    /**
     * 1ページ目に遷移する際のページネーション文言
     *
     * @var string
     */
    const DATATABLES_PAGINATE_FIRST = '<<';

    /**
     * 最終ページに遷移する際のページネーション文言
     *
     * @var string
     */
    const DATATABLES_PAGINATE_LAST = '>>';

    /**
     * 前ページに遷移する際のページネーション文言
     *
     * @var string
     */
    const DATATABLES_PAGINATE_PREVIOUS = 'Prev';

    /**
     * 次ページに遷移する際のページネーション文言
     *
     * @var string
     */
    const DATATABLES_PAGINATE_NEXT = 'Next';
}
