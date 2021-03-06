<?php
require_once '../lib/DataSourceResult.php';
require_once '../lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $request = json_decode(file_get_contents('php://input'));

    $result = new DataSourceResult('sqlite:..//sample.db');

    if (array_key_exists('details', $_GET)) {
        echo json_encode($result->read('Orders', array('OrderID', 'ShipCountry', 'ShipAddress', 'ShipName', 'EmployeeID'), $request));
    } else {
        echo json_encode($result->read('Employees', array('EmployeeID', 'FirstName', 'LastName', 'Country', 'City', 'Title'), $request));
    }

    exit;
}

require_once '../include/header.php';

$transport = new \Kendo\Data\DataSourceTransport();

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url('hierarchy.php')
     ->contentType('application/json')
     ->type('POST');

$transport->read($read)
          ->parameterMap('function(data) {
              return kendo.stringify(data);
          }');

$model = new \Kendo\Data\DataSourceSchemaModel();

$schema = new \Kendo\Data\DataSourceSchema();
$schema->data('data')
       ->total('total');

$dataSource = new \Kendo\Data\DataSource();

$dataSource->transport($transport)
           ->pageSize(6)
           ->schema($schema)
           ->serverSorting(true)
           ->serverPaging(true);

$grid = new \Kendo\UI\Grid('grid');

$firstName = new \Kendo\UI\GridColumn();
$firstName->field('FirstName')
    ->width(110)
    ->title('First Name');


$lastName = new \Kendo\UI\GridColumn();
$lastName->field('LastName')
    ->width(110)
    ->title('Last Name');

$country = new \Kendo\UI\GridColumn();
$country->field('Country')
    ->width(110);

$city = new \Kendo\UI\GridColumn();
$city->field('City')
    ->width(110);

$title = new \Kendo\UI\GridColumn();
$title->field('Title');

$grid->addColumn($firstName, $lastName, $country, $city, $title)
     ->dataSource($dataSource)
     ->height(430)
     ->sortable(true)
     ->pageable(true)
     ->dataBound('dataBound')
     ->detailTemplateId('details');

echo $grid->render();
?>

<script id="details" type="text/x-kendo-template">
   <?php

        $transport = new \Kendo\Data\DataSourceTransport();

        $read = new \Kendo\Data\DataSourceTransportRead();

        $read->url('hierarchy.php?details=details')
            ->contentType('application/json')
            ->type('POST');

        $transport->read($read)
            ->parameterMap('function(data) {
                return kendo.stringify(data);
              }');

        $schema = new \Kendo\Data\DataSourceSchema();
        $schema->data('data')
           ->total('total');

        $dataSource = new \Kendo\Data\DataSource();

        $filter = new \Kendo\Data\DataSourceFilterItem();
        $filter->field('EmployeeID')
            ->operator('eq')
            ->value('#=EmployeeID#');

        $dataSource->transport($transport)
           ->pageSize(10)
           ->schema($schema)
           ->addFilterItem($filter)
           ->serverSorting(true)
           ->serverFiltering(true)
           ->serverPaging(true);

        $detailGrid = new \Kendo\UI\Grid('detailGrid#=EmployeeID#');

        $orderID = new \Kendo\UI\GridColumn();
        $orderID->field('OrderID')
            ->width(110)
            ->title('Order ID');

        $shipCountry = new \Kendo\UI\GridColumn();
        $shipCountry->field('ShipCountry')
            ->width(110)
            ->title('Ship Country');

        $shipAddress = new \Kendo\UI\GridColumn();
        $shipAddress->field('ShipAddress')
            ->title('Ship Address');

        $shipName = new \Kendo\UI\GridColumn();
        $shipName->field('ShipName')
            ->title('Ship Name')
            ->width(200);

        $detailGrid->dataSource($dataSource)
            ->addColumn($orderID, $shipCountry, $shipAddress, $shipName)
            ->pageable(true)
            ->sortable(true)
            ->scrollable(false);

        echo $detailGrid->renderInTemplate();
    ?>
</script>

<script>
    function dataBound() {
        this.expandRow(this.tbody.find("tr.k-master-row").first());
    }
</script>

<?php require_once '../include/footer.php'; ?>
