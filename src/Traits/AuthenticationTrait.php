<?php
declare(strict_types=1);

namespace App\Traits;

use Cake\Http\Session;

/**
 * Auth認証操作Trait
 *
 * @package App\Traits
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
trait AuthenticationTrait
{
    /**
     * ユーザIDを取得
     *
     * @return int ユーザID
     */
    public function getId(): ?int
    {
        $sessionData = new Session();
        return $sessionData->read('Auth.id');
    }

    /**
     * 権限を取得
     *
     * @return int 権限ID
     */
    public function getIsAdmin(): ?int
    {
        $sessionData = new Session();
        return $sessionData->read('Auth.is_admin');
    }

    /**
     * メールアドレスを取得
     *
     * @return string メールアドレス
     */
    public function getEmail(): ?string
    {
        $sessionData = new Session();
        return $sessionData->read('Auth.email');
    }

    /**
     * ユーザ名を取得
     *
     * @return string ユーザ名
     */
    public function getUserName(): ?string
    {
        $sessionData = new Session();
        return $sessionData->read('Auth.name');
    }
}
