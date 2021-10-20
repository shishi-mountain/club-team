<?php
declare(strict_types=1);

namespace App\Library;

/**
 * ファイル操作ライブラリ
 *
 * @package App\Library
 */
class FileLibrary
{
    // サーバ側一時フォルダ
    private const FILE_TEMPORARY_DIR = WWW_ROOT . 'upload/';

    /**
     * ファイルコピー処理
     *
     * 指定されたファイルオブジェクトをサーバ側に一時コピー
     *
     * @param array $inputFiles 入力ファイルリスト
     * @return array コピーファイルフルパスリスト
     */
    public static function copyInputFile(array $inputFiles): array
    {
        $path = self::FILE_TEMPORARY_DIR;

        // パスの存在確認
        if (!file_exists($path)) {
            mkdir(self::FILE_TEMPORARY_DIR, 0700);
        }

        // 入力ファイルを一時フォルダにコピー
        foreach ($inputFiles as $inputFile) {
            $copyFilePath = $path . $inputFile->getClientFilename();
            $inputFile->moveTo($copyFilePath);
            exec('chmod 777 ' . $copyFilePath);
            $copyFilePathList[] = $copyFilePath;
        }

        return $copyFilePathList;
    }

    /**
     * 一時フォルダ名取得処理
     *
     * ダウンロード用一時フォルダをサーバに作成し、フォルダ名を返却する
     *
     * @return string 一時フォルダ名
     */
    public static function setTemporaryPath(): string
    {
        $path = self::FILE_TEMPORARY_DIR;

        // パスの存在確認
        if (!file_exists($path)) {
            mkdir(self::FILE_TEMPORARY_DIR, 0700);
        }

        return $path;
    }

    /**
     * ファイルサイズチェック処理
     *
     * 指定されたファイルのサイズが指定サイズ以上ならばエラーとする
     *
     * @param array $inputFiles 入力ファイルリスト
     * @param int $maxSize ファイルサイズ上限
     * @return array チェック結果
     */
    public static function checkSizeInputFile(array $inputFiles, int $maxSize): array
    {
        foreach ($inputFiles as $inputFile) {
            if ($inputFile->getSize() > $maxSize) {
                return [
                    'result' => false,
                    'errorFileName' => $inputFile->getClientFilename(),
                ];
            }
        }

        return [
            'result' => true,
            'errorFileName' => null,
        ];
    }

    /**
     * ファイル削除処理
     * パラメータ指定したファイルを削除する
     * 指定のない場合は、一時フォルダのファイルを削除する
     *
     * @param array|null $copyFilePathList コピーファイルフルパスリスト
     * @return bool
     */
    public static function deleteInputFile(?array $copyFilePathList = null): bool
    {
        if (is_null($copyFilePathList)) {
            $tempPath = self::FILE_TEMPORARY_DIR;
            foreach (glob($tempPath . '*.*') as $file) {
                if (!unlink($file)) {
                    return false;
                }
            }
        } else {
            foreach ($copyFilePathList as $copyFilePath) {
                if (!unlink($copyFilePath)) {
                    return false;
                }
            }
        }

        return true;
    }
}
