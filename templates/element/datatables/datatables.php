<?php
/** @var string $dataJson datatablesにセットするJSON */
/** @var string $columnDefsJson datatablesのカラムオプションにセットするJSON */
/** @var string $lengthMenuJson datatablesの表示ページメニューオプションにセットするJSON */
/** @var string $languageJson datatablesの言語設定オプションにセットするJSON */
?>
<script>
    $(function() {
        $('#datatables').DataTable({
            data: <?php echo $dataJson; ?>,
            columnDefs: <?php echo $columnDefsJson; ?>,
            order: [
                [0, 'asc']
            ],
            dom:"ftrp",
            autoWidth: true,
            scrollX: true,
            scrollY: '50vh',
            scrollCollapse: true,
            pageLength: 100,
            lengthMenu: <?php echo $lengthMenuJson; ?>,
            language: <?php echo $languageJson; ?>
        });
    });
</script>
