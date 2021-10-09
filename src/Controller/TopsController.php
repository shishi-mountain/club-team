<?php
declare(strict_types=1);

namespace App\Controller;

use App\Facade\TopFacade;
use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * 認証用Controller
 *
 * @package App\Controller
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class TopsController extends AppController
{
    private TopFacade $topFacade;

    /**
     * 初期化
     *
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->topFacade = new TopFacade();
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
     * TOP画面表示
     */
    public function index(): void
    {
//        $dataList = $this->topFacade->executeIndex($this->request->getQuery('menu'));
//
//        $this->set([
//            'selectMenu' => $dataList['selectMenu'],
//            'dataJson' => $dataList['dataJson'],
//            'columnDefsJson' => $dataList['columnDefsJson'],
//            'lengthMenuJson' => $dataList['lengthMenuJson'],
//            'languageJson' => $dataList['languageJson'],
//        ]);
    }
}
