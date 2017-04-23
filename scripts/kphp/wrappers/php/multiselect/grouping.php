<?php

require_once '../lib/DataSourceResult.php';
require_once '../lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $request = json_decode(file_get_contents('php://input'));

    $result = new DataSourceResult('sqlite:..//sample.db');

    echo json_encode($result->read('Products', array('ProductID', 'ProductName'), $request));

    exit;
}

require_once '../include/header.php';

$transport = new \Kendo\Data\DataSourceTransport();

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url('http://demos.telerik.com/kendo-ui/service/Northwind.svc/Customers');

$transport->read($read);

$group = new \Kendo\Data\DataSourceGroupItem();
$group->field('Country');

$dataSource = new \Kendo\Data\DataSource();

$dataSource->type('odata')
           ->transport($transport)
           ->addGroupItem($group);

$multiselect = new \Kendo\UI\MultiSelect('customers');

$multiselect->dataSource($dataSource)
         ->placeholder('Select customers...')
         ->dataTextField('ContactName')
         ->dataValueField('CustomerID')
         ->height(400)
         ->attr('style', 'width: 400px');

?>
<div class="demo-section">
    <h2>Customers</h2>
<?php
echo $multiselect->render();
?>
</div>
<style>
    .demo-section {
        width: 400px;
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
