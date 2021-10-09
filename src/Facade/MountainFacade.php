<?php
declare(strict_types=1);

namespace App\Facade;

use App\Library\DatatablesLibrary;
use App\Model\Logic\MountainLogic;

/**
 * Class MountainFacade
 *
 * @package App\Facade
 * @property \App\Model\Logic\MountainLogic $mountainLogic
 */
class MountainFacade extends AppFacade
{
    /**
     * ContractLogic
     *
     * @var \App\Model\Logic\MountainLogic
     */
    private MountainLogic $mountainLogic;

    public function __construct()
    {
        parent::__construct();

        // Logic設定
        $this->mountainLogic = new MountainLogic();
    }

    /**
     * 山一覧表示
     *
     * 表示可能な山一覧を取得<br>
     * datatablesに必要なデータを配列にして返却する<br>
     *
     * @return array 処理結果配列
     */
    public function executeIndex(): array
    {
        // データ取得
        $resultSetInterface = $this->mountainLogic->fetchList(1);

        // 取得データをJsonに変換する
        if (is_null($resultSetInterface)) {
            $dataJson = json_encode((object)null);
        } else {
            $dataJson = $this->mountainLogic->generateListJson($resultSetInterface);
        }

        // columnDefs設定取得
        $columnDefsJson = $this->mountainLogic->setColumnDefsJson();

        // 処理結果を返す
        return [
            'dataJson' => $dataJson,
            'columnDefsJson' => $columnDefsJson,
            'lengthMenuJson' => DatatablesLibrary::setLengthMenuJson(),
            'languageJson' => DatatablesLibrary::setLanguageJson(),
        ];
    }
}
