<?php
require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';
?>

<div class="demo-section">
    <h4>'Single' tag mode</h4>
<?php
$select = new \Kendo\UI\MultiSelect('required');
$select->dataSource(array('Steven White',
                          'Nancy King',
                          'Anne King',
                          'Nancy Davolio',
                          'Robert Davolio',
                          'Michael Leverling',
                          'Andrew Callahan',
                          'Michael Suyama',
                          'Anne King',
                          'Laura Peacock',
                          'Robert Fuller',
                          'Janet White',
                          'Nancy Leverling',
                          'Robert Buchanan',
                          'Andrew Fuller',
                          'Anne Davolio',
                          'Andrew Suyama',
                          'Nige Buchanan',
                          'Laura Fuller'))
       ->autoClose(false)
       ->tagMode('single')
       ->placeholder('Choose attendees...');

echo $select->render();
?>
<h4>'Multiple' tag mode</h4>
<?php

$select = new \Kendo\UI\MultiSelect('optional');
$select->dataSource(array('Steven White',
                          'Nancy King',
                          'Anne King',
                          'Nancy Davolio',
                          'Robert Davolio',
                          'Michael Leverling',
                          'Andrew Callahan',
                          'Michael Suyama',
                          'Anne King',
                          'Laura Peacock',
                          'Robert Fuller',
                          'Janet White',
                          'Nancy Leverling',
                          'Robert Buchanan',
                          'Andrew Fuller',
                          'Anne Davolio',
                          'Andrew Suyama',
                          'Nige Buchanan',
                          'Laura Fuller'))
       ->autoClose(false)
       ->placeholder('Choose attendees...');

echo $select->render();
?>
</div>
<style>
    .demo-section * + h4 {
        margin-top: 2em;
    }
</style>
<?php require_once '../include/footer.php'; ?>
