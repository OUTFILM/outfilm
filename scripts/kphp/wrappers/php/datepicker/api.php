<?php

require_once '../lib/Kendo/Autoload.php';
require_once '../include/header.php';
?>
<?php
$datePicker = new \Kendo\UI\DatePicker('datepicker');

echo $datePicker->render();
?>

<script>
    $(document).ready(function() {
        var datepicker = $("#datepicker").data("kendoDatePicker");

        var setValue = function () {
            datepicker.value($("#value").val());
        };

        $("#enable").click(function() {
            datepicker.enable();
        });

        $("#disable").click(function() {
            datepicker.enable(false);
        });

        $("#readonly").click(function() {
            datepicker.readonly();
        });

        $("#open").click(function() {
            datepicker.open();
        });

        $("#close").click(function() {
            datepicker.close();
        });

        $("#value").kendoDatePicker({
            change: setValue
        });

        $("#set").click(setValue);

        $("#get").click(function() {
            alert(datepicker.value());
        });
    });
</script>
<div class="configuration k-widget k-header" style="width: 220px">
    <span class="configHead">API Functions</span>
    <ul class="options">
        <li>
           <button id="get" class="k-button">Get value</button>
       </li>
       <li>
           <input id="value" value="10/10/2000" style="float:none" />
           <button id="set" class="k-button">Set value</button>
       </li>
        <li>
            <button id="enable" class="k-button">Enable</button> or <button id="disable" class="k-button">Disable</button> or <button id="readonly" class="k-button">Readonly</button>
        </li>
        <li>
            <button id="open" class="k-button">Open</button> or <button id="close" class="k-button">Close</button> the calendar
        </li>
    </ul>
</div>
<?php require_once '../include/footer.php'; ?>
