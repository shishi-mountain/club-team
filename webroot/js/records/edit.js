/**
 * プレビュー画像を表示する処理
 */
function previewFile(maxSize) {
    const preview = document.getElementById('preview');
    const reader = new FileReader();
    const fileInput = document.getElementById('input_file');
    const files = fileInput.files;

    // ファイルが読み込まれたときに実行する
    reader.onload = function (e) {
        // 既にプレビュー画像がある場合は削除
        while(preview.lastChild){
            preview.removeChild(preview.lastChild);
        }

        for (let i = 0; i < files.length; i++) {
            const imageUrl = e.target.result;
            img = document.createElement('img');
            img.src = imageUrl;
            img.id = 'thumbnail_' + i;
            img.style.width = '100%';
            preview.appendChild(img);
        }
    }

    // // 画像ファイルを一つずつプレビューする
    // function previewFileThumbnail(fileList) {
    //     previewAreaThumbnail.innerHTML = "";
    //     for (let i = 0; i < files.length; i++) {
    //         uploadImageThumbnail(files[i], i);
    //     }
    // }

    // TODO: 複数ファイル登録、ファイルドロップ
    if (files.length > 0 && checkFileSize(files[0].size, maxSize)) {
        reader.readAsDataURL(files[0]);
    } else {
        // 選択した画像を外した場合、プレビューされた画像も削除
        preview.removeChild(preview.lastChild);
    }
}

/**
 * ファイルサイズをチェックし、エラーメッセージ表示
 */
function checkFileSize(fileSize, maxSize) {
    if (fileSize > maxSize) {
        Swal.fire({
            html: '10M以下の画像ファイル（PNG）を選択してください。',
            icon: 'warning',
        });
        return false;
    }
    return true;
}
