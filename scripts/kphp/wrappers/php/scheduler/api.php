<?php
require_once '../lib/DataSourceResult.php';
require_once '../lib/SchedulerDataSourceResult.php';
require_once '../lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $request = json_decode(file_get_contents('php://input'));

    $result = new SchedulerDataSourceResult('sqlite:..//sample.db');

    $type = $_GET['type'];

    $columns = array('TaskID', 'Title', 'Start', 'End', 'StartTimezone', 'EndTimezone', 'IsAllDay', 'Description', 'RecurrenceID', 'RecurrenceRule', 'RecurrenceException');

    switch($type) {
        case 'create':
            $result = $result->create('Tasks', $columns, $request->models, 'TaskID');
            break;
        case 'update':
            $result = $result->update('Tasks', $columns, $request->models, 'TaskID');
            break;
        case 'destroy':
            $result = $result->destroy('Tasks', $request->models, 'TaskID');
            break;
        default:
            $result = $result->read('Tasks', array('TaskID'), $request);
            break;
    }

    echo json_encode($result, JSON_NUMERIC_CHECK);

    exit;
}

require_once '../include/header.php';

$transport = new \Kendo\Data\DataSourceTransport();

$create = new \Kendo\Data\DataSourceTransportCreate();

$create->url('api.php?type=create')
     ->contentType('application/json')
     ->type('POST');

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url('api.php?type=read')
     ->contentType('application/json')
     ->type('POST');

$update = new \Kendo\Data\DataSourceTransportUpdate();

$update->url('api.php?type=update')
     ->contentType('application/json')
     ->type('POST');

$destroy = new \Kendo\Data\DataSourceTransportDestroy();

$destroy->url('api.php?type=destroy')
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

$taskIDField = new \Kendo\Data\DataSourceSchemaModelField('taskID');
$taskIDField->type('number')
            ->from('TaskID')
            ->nullable(true);

$titleField = new \Kendo\Data\DataSourceSchemaModelField('title');
$titleField->from('Title')
        ->defaultValue('No title')
        ->validation(array('required' => true));

$startField = new \Kendo\Data\DataSourceSchemaModelField('start');
$startField->type('date')
        ->from('Start');

$startTimezoneField = new \Kendo\Data\DataSourceSchemaModelField('startTimezone');
$startTimezoneField->from('StartTimezone');

$endField = new \Kendo\Data\DataSourceSchemaModelField('end');
$endField->type('date')
        ->from('End');

$endTimezoneField = new \Kendo\Data\DataSourceSchemaModelField('endTimezone');
$endTimezoneField->from('EndTimezone');

$isAllDayField = new \Kendo\Data\DataSourceSchemaModelField('isAllDay');
$isAllDayField->type('boolean')
        ->from('IsAllDay');

$descriptionField = new \Kendo\Data\DataSourceSchemaModelField('description');
$descriptionField->type('string')
        ->from('Description');

$recurrenceIdField = new \Kendo\Data\DataSourceSchemaModelField('recurrenceId');
$recurrenceIdField->from('RecurrenceID');

$recurrenceRuleField = new \Kendo\Data\DataSourceSchemaModelField('recurrenceRule');
$recurrenceRuleField->from('RecurrenceRule');

$recurrenceExceptionField = new \Kendo\Data\DataSourceSchemaModelField('recurrenceException');
$recurrenceExceptionField->from('RecurrenceException');

$model->id('taskID')
    ->addField($taskIDField)
    ->addField($titleField)
    ->addField($startField)
    ->addField($endField)
    ->addField($startTimezoneField)
    ->addField($endTimezoneField)
    ->addField($descriptionField)
    ->addField($recurrenceIdField)
    ->addField($recurrenceRuleField)
    ->addField($recurrenceExceptionField)
    ->addField($isAllDayField);

$schema = new \Kendo\Data\DataSourceSchema();
$schema->data('data')
        ->errors('errors')
        ->model($model);

$dataSource = new \Kendo\Data\DataSource();

$dataSource->transport($transport)
    ->schema($schema)
    ->batch(true);

$scheduler = new \Kendo\UI\Scheduler('scheduler');
$scheduler->timezone("Etc/UTC")
    ->date(new DateTime('2013/6/13'))
    ->height(400)
    ->addView(
        array('type' => 'day', 'startTime' => new DateTime('2013/6/13 7:00')),
        array('type' => 'week', 'selected' => true, 'startTime' => new DateTime('2013/6/13 7:00')),
        'month', 'agenda', 'timeline')
    ->dataSource($dataSource);

echo $scheduler->render();
?>
    <div class="demo-section">
        <p>
            <label>Current Date:</label>
            <?php
                $datePicker = new \Kendo\UI\DatePicker('date');
                $datePicker->value(new DateTime('2013/6/13'))
                      ->change('date_change');

                echo $datePicker->render();
            ?>
        </p>
        <p>
            <label>Current View:</label>
            <?php
                $viewsPicker = new \Kendo\UI\DropDownList('views');

                $viewsPicker->change('views_change')
                      ->dataTextField('text')
                      ->dataValueField('value')
                      ->value('week')
                      ->dataSource(array(
                          array('text' => 'Agenda', 'value' => 'agenda'),
                          array('text' => 'Day', 'value' => 'day'),
                          array('text' => 'Month', 'value' => 'month'),
                          array('text' => 'Week', 'value' => 'week'),
                          array('text' => 'Timeline', 'value' => 'timeline')
                      ));

                echo $viewsPicker->render();
            ?>
       </p>
    </div>

<script>
    function views_change() {
        $("#scheduler").data("kendoScheduler").view(this.value());
    }

    function date_change() {
        $("#scheduler").data("kendoScheduler").date(this.value());
    }
</script>

<?php require_once '../include/footer.php'; ?>
