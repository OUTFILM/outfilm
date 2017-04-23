<?php
require_once '../lib/DataSourceResult.php';
require_once '../lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $field = $_POST['field'];

    $request = json_decode(file_get_contents('php://input'));

    $result = new DataSourceResult('sqlite:..//sample.db');

    $allItems = $result->read('Employees', array($field, 'Country'));

    $hashTable = array();

    $uniqueItems = array();

    foreach ($allItems['data'] as $key) {
        $val = $key[$field];
        if(!array_key_exists($val, $hashTable)) {
            $hashTable[$val] = true;
            array_push($uniqueItems, $key);
        }
    }

    echo json_encode($uniqueItems);

    exit;
}

require_once '../include/header.php';

//Client configuration
$transport = new \Kendo\Data\DataSourceTransport();

$create = new \Kendo\Data\DataSourceTransportCreate();

$create->url('editing.php?type=create')
     ->contentType('application/json')
     ->type('POST');

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url('editing.php?type=read')
     ->contentType('application/json')
     ->type('POST');

$update = new \Kendo\Data\DataSourceTransportUpdate();

$update->url('editing.php?type=update')
     ->contentType('application/json')
     ->type('POST');

$destroy = new \Kendo\Data\DataSourceTransportDestroy();

$destroy->url('editing.php?type=destroy')
     ->contentType('application/json')
     ->type('POST');

$transport->create($create)
          ->read($read)
          ->update($update)
          ->destroy($destroy)
          ->parameterMap('function(data) {
              return kendo.stringify(data);
          }');

$model = new \Kendo\Data\DataSourceSchemaModel();

$productIDField = new \Kendo\Data\DataSourceSchemaModelField('ProductID');
$productIDField->type('number')
               ->editable(false)
               ->nullable(true);

$productNameField = new \Kendo\Data\DataSourceSchemaModelField('ProductName');
$productNameField->type('string')
                 ->validation(array('required' => true));


$unitPriceValidation = new \Kendo\Data\DataSourceSchemaModelFieldValidation();
$unitPriceValidation->required(true)
                    ->min(1);

$unitPriceField = new \Kendo\Data\DataSourceSchemaModelField('UnitPrice');
$unitPriceField->type('number')
               ->validation($unitPriceValidation);

$unitsInStockField = new \Kendo\Data\DataSourceSchemaModelField('UnitsInStock');
$unitsInStockField->type('number');

$discontinuedField = new \Kendo\Data\DataSourceSchemaModelField('Discontinued');
$discontinuedField->type('boolean');

$model->id('ProductID')
    ->addField($productIDField)
    ->addField($productNameField)
    ->addField($unitPriceField)
    ->addField($unitsInStockField)
    ->addField($discontinuedField);

$schema = new \Kendo\Data\DataSourceSchema();
$schema->data('data')
       ->errors('errors')
       ->model($model)
       ->total('total');

$dataSource = new \Kendo\Data\DataSource();

$dataSource->transport($transport)
           ->batch(true)
           ->pageSize(30)
           ->schema($schema);

$client = new \Kendo\UI\Grid('client');

$columnFilterable = new \Kendo\UI\GridColumnFilterable();
$columnFilterable->multi(true);

$productName = new \Kendo\UI\GridColumn();
$productName->field('ProductName')
            ->filterable($columnFilterable)
            ->title('Product Name');

$unitPrice = new \Kendo\UI\GridColumn();
$unitPrice->field('UnitPrice')
          ->filterable($columnFilterable)
          ->format('{0:c}')
          ->width(150)
          ->title('Unit Price');

$unitsInStock = new \Kendo\UI\GridColumn();
$unitsInStock->field('UnitsInStock')
          ->width(150)
          ->filterable($columnFilterable)
          ->title('Units In Stock');

$discontinued = new \Kendo\UI\GridColumn();
$discontinued->field('Discontinued')
          ->filterable($columnFilterable)
          ->width(100);

$command = new \Kendo\UI\GridColumn();
$command->addCommandItem('destroy')
        ->title('&nbsp;')
        ->filterable($columnFilterable)
        ->width(220);

$client->addColumn($productName, $unitPrice, $unitsInStock, $discontinued, $command)
     ->dataSource($dataSource)
     ->addToolbarItem(new \Kendo\UI\GridToolbarItem('create'),
        new \Kendo\UI\GridToolbarItem('save'), new \Kendo\UI\GridToolbarItem('cancel'))
     ->height(550)
     ->navigatable(true)
     ->filterable(true)
     ->editable(true)
     ->pageable(true);

//Server configuration
$transport = new \Kendo\Data\DataSourceTransport();

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url('detailtemplate.php')
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

$server = new \Kendo\UI\Grid('server');

$filterableTransport = new \Kendo\Data\DataSourceTransport();
$filterableRead = new \Kendo\Data\DataSourceTransportRead();
$filterableRead->url('filter-multi-checkboxes.php')
     ->data('{ field: "FirstName" }')
     ->type('POST');
$filterableTransport->read($filterableRead);
$filterableDataSource = new \Kendo\Data\DataSource();
$filterableDataSource->transport($filterableTransport);

$columnFilterable = new \Kendo\UI\GridColumnFilterable();
$columnFilterable->multi(true)
                ->dataSource($filterableDataSource);

$firstName = new \Kendo\UI\GridColumn();
$firstName->field('FirstName')
    ->width(220)
    ->filterable($columnFilterable)
    ->title('First Name');

$filterableRead->data('{ field: "LastName" }');
$filterableTransport->read($filterableRead);
$filterableDataSource->transport($filterableTransport);
$columnFilterable->dataSource($filterableDataSource);


$lastName = new \Kendo\UI\GridColumn();
$lastName->field('LastName')
    ->width(220)
    ->filterable($columnFilterable)
    ->title('Last Name');

$filterableRead->data('{ field: "Country" }');
$filterableTransport->read($filterableRead);
$filterableDataSource->transport($filterableTransport);
$columnFilterable->dataSource($filterableDataSource)
                ->itemTemplate('itemTemplate');

$country = new \Kendo\UI\GridColumn();
$country->field('Country')
    ->filterable($columnFilterable)
    ->width(220);


$filterableRead->data('{ field: "City" }');
$filterableTransport->read($filterableRead);
$filterableDataSource->transport($filterableTransport);
$columnFilterable = new \Kendo\UI\GridColumnFilterable();
$columnFilterable->multi(true)
                ->dataSource($filterableDataSource);

$city = new \Kendo\UI\GridColumn();
$city->field('City')
    ->filterable($columnFilterable)
    ->width(220);

$filterableRead->data('{ field: "Title" }');
$filterableTransport->read($filterableRead);
$filterableDataSource->transport($filterableTransport);
$columnFilterable->dataSource($filterableDataSource);

$title = new \Kendo\UI\GridColumn();
$title->field('Title')
    ->filterable($columnFilterable);

$server->addColumn($firstName, $lastName, $country, $city, $title)
     ->dataSource($dataSource)
     ->sortable(true)
     ->filterable(true)
     ->pageable(true);
?>


<div id="example">
    <h4>Client Operations</h4>
    <?php echo $client->render(); ?>
    <h4>Server Operations</h4>
    <?php echo $server->render(); ?>
</div>

<style>
    .k-multicheck-wrap
    {
        overflow-x: hidden;
    }
</style>
<script>
    function itemTemplate(e) {
            if (e.field == "all") {
                //handle the check-all checkbox template
                return "<div><label><strong><input type='checkbox' />#= all#</strong></label></div>";
            } else {
            //handle the other checkboxes
                return "<span><label><input type='checkbox' name='" + e.field + "' value='#=Country#'/><span>#= Country #</span></label></span>"
            }
    }
</script>



<?php require_once '../include/footer.php'; ?>
