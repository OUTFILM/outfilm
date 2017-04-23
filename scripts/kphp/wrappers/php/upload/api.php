<?php
require_once '../lib/Kendo/Autoload.php';
require_once '../include/header.php';
?>
<div class="configuration k-widget k-header">
    <span class="configHead">API Functions</span>
    <ul class="options">
        <li>
            <button class="toggleEnabled k-button">Toggle enabled state</button>
        </li>
        <li>
            <button class="enable k-button">Enable</button>
        </li>
        <li>
            <button class="disable k-button">Disable</button>
        </li>
    </ul>
</div>
<form method="post" style="width:45%">
    <div>
<?php
$upload = new \Kendo\UI\Upload('files[]');

echo $upload->render();
?>
    </div>
</form>
<script>
    function getUpload() {
        return $("#files\\[\\]").data("kendoUpload");
    }

    $(document).ready(function() {
        $(".toggleEnabled").click(function() {
            getUpload().toggle();
        });

        $(".enable").click(function() {
            getUpload().enable();
        });

        $(".disable").click(function() {
            getUpload().disable();
        });
    });
</script>
<?php require_once '../include/footer.php'; ?>
