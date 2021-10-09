<?php
declare(strict_types=1);

namespace App\Controller;

use App\Facade\MountainFacade;
use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * 山Controller
 *
 * @package App\Controller
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class MountainsController extends AppController
{
    private MountainFacade $mountainFacade;

    /**
     * 初期化
     *
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->mountainFacade = new MountainFacade();
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
     * 山一覧画面表示
     */
    public function index(): void
    {
        $dataList = $this->mountainFacade->executeIndex();

        $this->set([
            'dataJson' => $dataList['dataJson'],
            'columnDefsJson' => $dataList['columnDefsJson'],
            'lengthMenuJson' => $dataList['lengthMenuJson'],
            'languageJson' => $dataList['languageJson'],
        ]);
    }
}
