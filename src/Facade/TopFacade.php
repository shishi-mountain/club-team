<?php
declare(strict_types=1);

namespace App\Facade;

//use App\Constant\TopConstant;
//use App\Library\DatatablesLibrary;
//use App\Model\Logic\ContractLogic;

/**
 * Class TopFacade
 *
 * @package App\Facade
 * @property \App\Model\Logic\ContractLogic $contractLogic
 */
class TopFacade extends AppFacade
{
    /**
     * ContractLogic
     *
     * @var \App\Model\Logic\ContractLogic
     */
//    private ContractLogic $contractLogic;

    public function __construct()
    {
        parent::__construct();

        // Logic設定
//        $this->contractLogic = new ContractLogic();
    }

    /**
     * トップ画面一覧表示（締結済契約書類一覧）
     *
     * 表示可能な締結済契約書類一覧を取得<br>
     * datatablesに必要なデータを配列にして返却する<br>
     *
     * @param string|null $selectMenu 選択したメニュー
     * @return array 処理結果配列
     */
    public function executeIndex(?string $selectMenu): array
    {
//        if (is_null($selectMenu)) {
//            // 初期表示は締結済み書類
//            $selectMenu = (string)TopConstant::TOP_MENU_CONCLUDED;
//        }
//
//        // セッション情報を上書き
//        $this->municipalityLogic->rewriteSessionMunicipalityId($this->getMunicipalityId());
//
//        // データ取得
//        $resultSetInterface = $this->contractLogic->fetchContractList($selectMenu);
//
//        // 取得データをJsonに変換する
//        if (is_null($resultSetInterface)) {
//            $dataJson = json_encode((object)null);
//        } else {
//            $dataJson = $this->contractLogic->generateContractListJson($resultSetInterface, $selectMenu);
//        }
//
//        // columnDefs設定取得
//        $columnDefsJson = $this->contractLogic->setColumnDefsJson();
//
//        // 選択メニュー名をセット
//        $selectMenuName = $this->contractLogic->setSelectMenuName($selectMenu);
//
//        // 処理結果を返す
//        return [
//            'selectMenu' => $selectMenuName,
//            'dataJson' => $dataJson,
//            'columnDefsJson' => $columnDefsJson,
//            'lengthMenuJson' => DatatablesLibrary::setLengthMenuJson(),
//            'languageJson' => DatatablesLibrary::setLanguageJson(),
//        ];
    }
}
