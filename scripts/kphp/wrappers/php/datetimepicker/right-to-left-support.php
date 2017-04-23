<?php

require_once '../lib/Kendo/Autoload.php';
require_once '../include/header.php';
?>
<div class="demo-section">
    <div class="k-rtl">
        <label for="datetimepicker">Choose date:</label>
<?php
$dateTimePicker = new \Kendo\UI\DateTimePicker('datetimepicker');

echo $dateTimePicker->render();
?>
    </div>
</div>
<style>
    .demo-section {
        width: 400px;
        text-align: center;
        margin: 50px auto;
        padding-top: 50px;
        padding-bottom: 50px;
    }
</style>
<?php require_once '../include/footer.php'; ?>
