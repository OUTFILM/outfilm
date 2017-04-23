<?php
require_once '../lib/Kendo/Autoload.php';
require_once '../include/chart_data.php';

require_once '../include/header.php';

$series = new \Kendo\Dataviz\UI\ChartSeriesItem();
$series->type('scatterLine')
       ->xField('x')
       ->yField('y')
       ->style('smooth')
       ->markers(array('visible' => false));

$dataSource = new \Kendo\Data\DataSource();

$dataSource->data(sine_interval());

$chart = new \Kendo\Dataviz\UI\Chart('chart');

$chart->dataSource($dataSource)
      ->renderAs('canvas')
      ->addSeriesItem($series)      
      ->addXAxisItem(array(
          'min' => -2,
          'max' => 2,
          'labels' => array('format' => '{0:n1}')
      ))
      ->addYAxisItem(array(
          'labels' => array('format' => '{0:n2}')
      ))
      ->pannable(true)
      ->zoomable(true);

echo $chart->render();
?>
<?php require_once '../include/footer.php'; ?>
