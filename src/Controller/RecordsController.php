<?php
declare(strict_types=1);

namespace App\Controller;

use App\Facade\RecordFacade;
use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * 記録Controller
 *
 * @package App\Controller
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class RecordsController extends AppController
{
    private RecordFacade $recordFacade;

    /**
     * 初期化
     *
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->recordFacade = new RecordFacade();
    }

    /**
     * 前処理
     *
     * @param \Cake\Event\EventInterface $event
     * @return \Cake\Http\Response|void|null
     */
    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
    }

    /**
     * Record画面表示
     */
    public function index(): void
    {
//        $dataList = $this->recordFacade->executeIndex();

//        $this->set([
//            'selectMenu' => $dataList['selectMenu'],
//            'dataJson' => $dataList['dataJson'],
//            'columnDefsJson' => $dataList['columnDefsJson'],
//            'lengthMenuJson' => $dataList['lengthMenuJson'],
//            'languageJson' => $dataList['languageJson'],
//        ]);
    }
}
