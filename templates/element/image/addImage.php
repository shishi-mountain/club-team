<?php
/**
 * addImage.php
 *
 * addImage 画像をアップする時のドラッグ＆ドロップ制御
 */
?>
<script>
    // ドロップするエリア
    let dropZoneImprint = document.getElementById('drop-zone-imprint');
    // ファイルの制限サイズ
    const sizeLimit = 1024 * 1024 * 10;

    // ドロップエリアの制御
    dropZoneImprint.addEventListener('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
        this.style.background = '#b0e0e6';
    }, false);

    dropZoneImprint.addEventListener('dragleave', function(e) {
        e.stopPropagation();
        e.preventDefault();
        this.style.background = '#ffffff';
    }, false);

    dropZoneImprint.addEventListener('drop', function(e) {
        // 「ファイルをドラッグ＆ドロップ」からの処理
        e.stopPropagation();
        e.preventDefault();
        //背景色を白に戻す
        this.style.background = '#ffffff';
        //ドロップしたファイルを取得
        let files = e.dataTransfer.files;

        // アップロードしたファイルのチェック（複数ファイル対応）
        let checkMsg = checkPdfFile(files);
        if (checkMsg !== '') {
            return errorMessage(checkMsg);
        }

        //inputのvalueにドラッグしたファイルを代入
        document.getElementById('input_file').files = files;

        // ファイルのプレビュー表示
        previewFile();
    }, false);

    // アップロードしたファイルのチェック（複数ファイル対応）
    function checkPdfFile(files) {
        if (files.length > 1) {
            return 'アップロードできるファイル数は1つです';
        }
        if (files[0].type !== "image/png") {
            return 'アップロードできるファイルはPNGファイルだけです';
        }
        if (files[0].size > sizeLimit) {
            return 'ファイルサイズは10MB以下にしてください';
        }
        return '';
    }

    // エラーメッセージ表示
    function errorMessage(message) {
        Swal.fire({
            html: message,
            icon: 'warning',
        });
    }

</script>
