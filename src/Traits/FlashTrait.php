<?php
declare(strict_types=1);

namespace App\Traits;

/**
 * Flash出力Trait
 *
 * Flashメッセージ成形を一元管理
 *
 * @package App\Traits
 */
trait FlashTrait
{
    /**
     * Flashメッセージセット
     *
     * 通常のFlashメッセージの場合に使用<br>
     * Flashメッセージとして改行を含める場合に改行コードを埋め込んで連結した文字列に変換<br>
     *
     * @param array $messageList 表示するメッセージ配列
     * @return string 生成したメッセージ文字列
     */
    public static function setFlashMessage(array $messageList): string
    {
        $generateMessage = [];

        foreach ($messageList as $message) {
            $generateMessage[] = $message;
        }

        return implode("<br>", $generateMessage);
    }

    /**
     * バリデーションエラーメッセージセット
     *
     * バリデーションエラーを項目/エラー内容で分割しFlashメッセージ形式で返す
     *
     * @param array $validationErrorList バリデーションエラー格納配列
     * @return string 生成したメッセージ文字列
     */
    public static function setValidationErrorMessage(array $validationErrorList): string
    {
        // バリデーションエラー格納配列を初期化
        $errors = [];

        foreach ($validationErrorList as $errorList) {
            foreach ($errorList as $error) {
                $errors[] = $error;
            }
        }

        // Flashメッセージ形式に成形して返す
        return self::setFlashMessage($errors);
    }
}
