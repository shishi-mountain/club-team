<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Traits\AuthenticationTrait;
use App\Traits\FlashTrait;
use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class AppController extends Controller
{
    // Trait設定
    use FlashTrait;
    use AuthenticationTrait;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        // Add this line to check authentication result and lock your site
        $this->loadComponent('Authentication.Authentication');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // このアプリケーションのすべてのコントローラのために、
        // インデックスとビューのアクションを公開し、認証チェックをスキップします
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);

        if ($this->Authentication->getIdentity()) {
            // 既にログインしている場合
            $this->set('authenticationData', $this->setAuthenticationData());
        }
    }

    /**
     * Auth認証済のユーザ情報を取得し配列で返却する
     *
     * @return array Auth認証済ユーザ情報
     */
    private function setAuthenticationData(): array
    {
        return [
            'id' => $this->getId(),
            'authorityId' => $this->getIsAdmin(),
            'email' => $this->getEmail(),
            'userName' => $this->getUserName(),
        ];
    }
}
