<?php
require_once '../lib/Kendo/Autoload.php';
require_once '../include/header.php';
?>
<div class="configuration k-widget k-header">
    <span class="infoHead">Information</span>
    <p>
        The Upload can be used as a drop-in replacement
        for file input elements.
    </p>
    <p>
        This "synchronous" mode does not require
        special handling on the server.
    </p>
</div>

<form method="post" action="result.php" style="width:45%">
    <div>
<?php
$upload = new \Kendo\UI\Upload('files[]');

echo $upload->render();
?>
        <p>
            <input type="submit" value="Submit" class="k-button" />
        </p>
    </div>
</form>
<?php require_once '../include/footer.php'; ?>
