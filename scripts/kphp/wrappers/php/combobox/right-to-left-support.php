<?php

require_once '../lib/DataSourceResult.php';
require_once '../lib/Kendo/Autoload.php';
require_once '../include/header.php';
?>
<div class="demo-section">
    <div class="k-rtl">
        <h2>RTL ComboBox</h2>
<?php
$comboBox = new \Kendo\UI\ComboBox('combobox');

$comboBox->dataTextField('text')
         ->dataValueField('value')
         ->dataSource(array(
             array('text' => 'Item 1', 'value' => '1'),
             array('text' => 'Item 2', 'value' => '2'),
             array('text' => 'Item 3', 'value' => '3')
         ));
echo $comboBox->render();
?>
    </div>
</div>
<style>
    .demo-section {
        width: 250px;
        margin: 35px auto 50px;
        padding: 30px;
    }
    .demo-section h2 {
        text-transform: uppercase;
        font-size: 1.2em;
        margin-bottom: 10px;
    }
</style>
<?php require_once '../include/footer.php'; ?>
