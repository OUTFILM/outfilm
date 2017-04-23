<?php
require_once '../lib/Kendo/Autoload.php';
require_once '../include/chart_data.php';
require_once '../include/header.php';

$series = new \Kendo\Dataviz\UI\ChartSeriesItem();
$series->field('value')
       ->categoryField('category');


$categoryAxis = new \Kendo\Dataviz\UI\ChartCategoryAxisItem();

$categoryAxis->min(0)
             ->max(10)
             ->labels(array('rotation' => 'auto'));

$dataSource = new \Kendo\Data\DataSource();

$dataSource->data(pan_and_zoom_data());

$pannable = new \Kendo\Dataviz\UI\ChartPannable();
$pannable->lock('y');

$selection = new \Kendo\Dataviz\UI\ChartZoomableSelection();
$selection->lock('y');

$mousewheel = new \Kendo\Dataviz\UI\ChartZoomableMousewheel();
$mousewheel->lock('y');

$zoomable = new \Kendo\Dataviz\UI\ChartZoomable();
$zoomable->selection($selection)
         ->mousewheel($mousewheel);

$chart = new \Kendo\Dataviz\UI\Chart('chart');
$chart->dataSource($dataSource)
      ->renderAs('canvas')
      ->addSeriesItem($series)
      ->addCategoryAxisItem($categoryAxis)
      ->pannable($pannable)
      ->zoomable($zoomable);

echo $chart->render();
?>
<?php require_once '../include/footer.php'; ?>
