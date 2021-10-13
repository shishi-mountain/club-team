<?php
namespace App\Controller;

use App\Facade\UserFacade;
use App\Message\UserMessage;
use Cake\Http\Response;

class UsersController extends AppController
{
    /**
     * ユーザFacade
     *
     * @var \App\Facade\UserFacade
     */
    private UserFacade $userFacade;

    /**
     * 初期化
     *
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->userFacade = new UserFacade();
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // ログインアクションを認証を必要としないように設定することで、
        // 無限リダイレクトループの問題を防ぐことができます
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // POSTやGETに関係なく、ユーザーがログインしていればリダイレクトします
        if ($result->isValid()) {
            // ログイン成功後に /Tops にリダイレクトします
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Tops',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // ユーザーの送信と認証に失敗した場合にエラーを表示します
        if ($this->request->is('post') && !$result->isValid()) {
            // エラーメッセージをセット
            $this->Flash->error(
                $this->setFlashMessage([
                    UserMessage::SUCCESS_USER_004
                ])
            );
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // POSTやGETに関係なく、ユーザーがログインしていればリダイレクトします
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function index()
    {
        $this->set('Users', $this->Users->find('all'));
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        // ユーザ情報登録実行
        $result = $this->userFacade->executeAdd(
            $this->request->getData()
        );

        // 結果をメッセージ出力
        if (!is_null($result['messageList'])) {
            if (!is_null($result['userEntity'])) {
                // 登録エラー：メッセージ出力
                $this->Flash->error($result['messageList']);
            } else {
                // 登録成功：一覧画面にリダイレクト
                $this->Flash->success($result['messageList']);
                $this->redirect(['action' => 'login']);

                return null;
            }
        }

        // Viewにデータセット
        $this->set([
            'action' => 'add',
            'userEntity' => $result['userEntity'],
        ]);

        return null;
    }

    /**
     * ユーザ情報編集
     *
     * @param string|null $userId ユーザID
     * @return \Cake\Http\Response|null
     */
    public function edit(?string $userId = null): ?Response
    {
        // ユーザ情報更新実行
        $result = $this->userFacade->executeEdit(
            $userId,
            $this->request->getData()
        );

        // 結果をメッセージ出力
        if (!is_null($result['messageList'])) {
            if (!is_null($result['userEntity'])) {
                // 登録エラー：メッセージ出力
                $this->Flash->error($result['messageList']);
            } else {
                // 登録成功：一覧画面にリダイレクト
                $this->Flash->success($result['messageList']);
//                $this->redirect(['action' => 'index']);

                return null;
            }
        }

        // Viewにデータセット
        $this->set([
            'action' => 'edit',
            'userEntity' => $result['userEntity'],
        ]);

        return null;
    }
}
