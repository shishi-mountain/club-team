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
        $dataList = $this->recordFacade->executeIndex();

        $this->set([
            'dataJson' => $dataList['dataJson'],
            'columnDefsJson' => $dataList['columnDefsJson'],
            'lengthMenuJson' => $dataList['lengthMenuJson'],
            'languageJson' => $dataList['languageJson'],
        ]);
    }

    /**
     * 記録情報追加
     *
     * @return \Cake\Http\Response|null
     */
    public function add(): ?Response
    {
        // 記録情報登録実行
        $result = $this->recordFacade->executeAdd(
            $this->request->getData()
        );

        // 結果をメッセージ出力
        if (!is_null($result['messageList'])) {
            if (!is_null($result['recordEntity'])) {
                // 登録エラー：メッセージ出力
                $this->Flash->error($result['messageList']);
            } else {
                // 登録成功：一覧画面にリダイレクト
                $this->Flash->success($result['messageList']);
                $this->redirect(['action' => 'index']);

                return null;
            }
        }

        // Viewにデータセット
        $this->set([
            'action' => 'add',
            'recordEntity' => $result['recordEntity'],
            'mountainList' => $result['mountainList'],
        ]);

        $this->render('edit');

        return null;
    }

    /**
     * 記録情報編集
     *
     * @param string|null $recordId 記録ID
     * @return \Cake\Http\Response|null
     */
    public function edit(?string $recordId = null): ?Response
    {
        // 記録情報更新実行
        $result = $this->recordFacade->executeEdit(
            $recordId,
            $this->request->getData()
        );

        // 結果をメッセージ出力
        if (!is_null($result['messageList'])) {
            if (!is_null($result['recordEntity'])) {
                // 登録エラー：メッセージ出力
                $this->Flash->error($result['messageList']);
            } else {
                // 登録成功：一覧画面にリダイレクト
                $this->Flash->success($result['messageList']);
                $this->redirect(['action' => 'index']);

                return null;
            }
        }

        // Viewにデータセット
        $this->set([
            'action' => 'edit',
            'recordEntity' => $result['recordEntity'],
        ]);

        return null;
    }

    /**
     * 記録情報削除
     *
     * @return \Cake\Http\Response|null
     */
    public function delete(): ?Response
    {
        // 記録情報削除実行
        $result = $this->recordFacade->executeDelete(
            $this->request->getData()
        );

        // 結果をメッセージ出力
        if (!is_null($result['messageList'])) {
            if (!is_null($result['recordEntity'])) {
                // 登録エラー：メッセージ出力
                $this->Flash->error($result['messageList']);
            } else {
                // 登録成功：一覧画面にリダイレクト
                $this->Flash->success($result['messageList']);
            }
        }

        $this->redirect(['action' => 'index']);

        return null;
    }
}
