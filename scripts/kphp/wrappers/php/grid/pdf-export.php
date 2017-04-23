<?php
require_once '../lib/DataSourceResult.php';
require_once '../lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_GET['type'];
    if ($type == 'save') {
        $fileName = $_POST['fileName'];
        $contentType = $_POST['contentType'];
        $base64 = $_POST['base64'];

        $data = base64_decode($base64);

        header('Content-Type:' . $contentType);
        header('Content-Length:' . strlen($data));
        header('Content-Disposition: attachment; filename=' . $fileName);

        echo $data;
    } else {
        header('Content-Type: application/json');

        $request = json_decode(file_get_contents('php://input'));

        $result = new DataSourceResult('sqlite:..//sample.db');

        echo json_encode($result->read('Employees', array('EmployeeID', 'FirstName', 'LastName', 'Title', 'Country'), $request), JSON_NUMERIC_CHECK);
    }

    exit;
}

require_once '../include/header.php';

$transport = new \Kendo\Data\DataSourceTransport();

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url('pdf-export.php?type=read')
     ->contentType('application/json')
     ->type('POST');

$transport->read($read)
          ->parameterMap('function(data) {
              return kendo.stringify(data);
          }');

$model = new \Kendo\Data\DataSourceSchemaModel();

$employeeIDField = new \Kendo\Data\DataSourceSchemaModelField('EmployeeID');
$employeeIDField->type('number');

$firstNameField = new \Kendo\Data\DataSourceSchemaModelField('FirstName');
$firstNameField->type('string');

$lastNameField = new \Kendo\Data\DataSourceSchemaModelField('LastName');
$lastNameField->type('string');

$countryField = new \Kendo\Data\DataSourceSchemaModelField('Country');
$countryField->type('string');

$photoField = new \Kendo\Data\DataSourceSchemaModelField('Photo');
$photoField->type('string');

$model->addField($employeeIDField)
      ->addField($firstNameField)
      ->addField($lastNameField)
      ->addField($countryField)
      ->addField($photoField);

$schema = new \Kendo\Data\DataSourceSchema();
$schema->data('data')
       ->model($model)
       ->total('total');

$dataSource = new \Kendo\Data\DataSource();

$dataSource->transport($transport)
           ->schema($schema)
           ->pageSize(5);

$picture = new \Kendo\UI\GridColumn();
$picture->field('EmployeeID')
        ->width(140)
        ->title('Picture');

$details = new \Kendo\UI\GridColumn();
$details->width(350)
        ->title('Details');

$country = new \Kendo\UI\GridColumn();
$country->field('Country')
        ->title('Country');

$id = new \Kendo\UI\GridColumn();
$id->title('ID');

$pdf = new \Kendo\UI\GridPdf();
$pdf->allPages(true)
    ->fileName('Kendo UI Grid Export.pdf')
    ->proxyURL('pdf-export.php?type=save');

$grid = new \Kendo\UI\Grid('grid');

$grid->dataSource($dataSource)
     ->addToolbarItem(new \Kendo\UI\GridToolbarItem('pdf'))
     ->addColumn($picture, $details, $country, $id)
     ->pdf($pdf)
     ->height(500)
     ->scrollable(true)
     ->pageable(true)
     ->attr('style', 'width: 900px')
     ->rowTemplateId('row-template')
     ->altRowTemplateId('alt-row-template');

echo $grid->render();
?>

<style>
    /*
        Use the DejaVu Sans font for display and embedding in the PDF file.
        The standard PDF fonts have no support for Unicode characters.
    */
    .k-grid {
        font-family: "DejaVu Sans", "Arial", sans-serif;
    }

    /* Hide the Grid header and pager during export */
    .k-pdf-export .k-grid-toolbar,
    .k-pdf-export .k-pager-wrap
    {
        display: none;
    }
</style>

<!-- Load Pako ZLIB library to enable PDF compression -->
<script src="../content/shared/js/pako.min.js"></script>

<script id="row-template" type="text/x-kendo-template">
  <tr data-uid="#: uid #">
    <td class="photo">
      <img src="../content/web/Employees/#:EmployeeID#.jpg" alt="#: EmployeeID #" />
    </td>
    <td class="details">
       <span class="name">#: FirstName# #: LastName# </span>
       <span class="title">Title: #: Title #</span>
    </td>
    <td class="country">
      #: Country #
    </td>
    <td class="employeeID">
      #: EmployeeID #
    </td>
  </tr>
</script>

<script id="alt-row-template" type="text/x-kendo-template">
  <tr class="k-alt" data-uid="#: uid #">
    <td class="photo">
      <img src="../content/web/Employees/#:EmployeeID#.jpg" alt="#: EmployeeID #" />
    </td>
    <td class="details">
       <span class="name">#: FirstName# #: LastName# </span>
       <span class="title">Title: #: Title #</span>
    </td>
    <td class="country">
      #: Country #
    </td>
    <td class="employeeID">
      #: EmployeeID #
    </td>
  </tr>
</script>

<style>
    .employeeID,
    .country {
        font-size: 50px;
        font-weight: bold;
        color: #898989;
    }
    .name {
        display: block;
        font-size: 1.6em;
    }
    .title {
        display: block;
        padding-top: 1.6em;
    }
    td.photo, .employeeID {
        text-align: center;
    }
    .k-grid-header .k-header {
        padding: 10px 20px;
    }
    .k-grid tr {
        background: -moz-linear-gradient(top,  rgba(0,0,0,0.05) 0%, rgba(0,0,0,0.15) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.05)), color-stop(100%,rgba(0,0,0,0.15)));
        background: -webkit-linear-gradient(top,  rgba(0,0,0,0.05) 0%,rgba(0,0,0,0.15) 100%);
        background: -o-linear-gradient(top,  rgba(0,0,0,0.05) 0%,rgba(0,0,0,0.15) 100%);
        background: -ms-linear-gradient(top,  rgba(0,0,0,0.05) 0%,rgba(0,0,0,0.15) 100%);
        background: linear-gradient(to bottom,  rgba(0,0,0,0.05) 0%,rgba(0,0,0,0.15) 100%);
        padding: 20px;
    }
    .k-grid tr.k-alt {
        background: -moz-linear-gradient(top,  rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.1) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.2)), color-stop(100%,rgba(0,0,0,0.1)));
        background: -webkit-linear-gradient(top,  rgba(0,0,0,0.2) 0%,rgba(0,0,0,0.1) 100%);
        background: -o-linear-gradient(top,  rgba(0,0,0,0.2) 0%,rgba(0,0,0,0.1) 100%);
        background: -ms-linear-gradient(top,  rgba(0,0,0,0.2) 0%,rgba(0,0,0,0.1) 100%);
        background: linear-gradient(to bottom,  rgba(0,0,0,0.2) 0%,rgba(0,0,0,0.1) 100%);
    }
</style>

<?php require_once '../include/footer.php'; ?>
