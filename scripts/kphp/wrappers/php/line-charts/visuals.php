<?php
require_once '../lib/Kendo/Autoload.php';
require_once '../include/chart_data.php';
require_once '../include/header.php';

$highlight = new \Kendo\Dataviz\UI\ChartSeriesItemHighlight();
$highlight->toggle('toggleHandler');

$markers = new \Kendo\Dataviz\UI\ChartSeriesItemMarkers();
$markers->visual('markerVisual')
        ->size(32);

$series = new \Kendo\Dataviz\UI\ChartSeriesItem();
$series->field('temperature')
        ->categoryField('day')
        ->highlight($highlight)
        ->markers($markers);

$valueAxis = new \Kendo\Dataviz\UI\ChartValueAxisItem();

$valueAxis->labels(array('template' => '#:value#℃'));

$categoryAxis = new \Kendo\Dataviz\UI\ChartCategoryAxisItem();

$categoryAxis->majorGridLines(array('visible' => false));

$tooltip = new \Kendo\Dataviz\UI\ChartTooltip();
$tooltip->visible(true)
        ->template('#= category #: #= value #℃');

$dataSource = new \Kendo\Data\DataSource();

$dataSource->data(forecast_data());

$chart = new \Kendo\Dataviz\UI\Chart('chart');
$chart->title(array('text' => 'Internet Users in United States'))
      ->dataSource($dataSource)
      ->legend(array('visible' => false))
      ->addSeriesItem($series)
      ->addValueAxisItem($valueAxis)
      ->addCategoryAxisItem($categoryAxis)
      ->seriesDefaults(array(
          'type' => 'line',
          'labels' => array(
              'visible' => true,
              'format'=> '{0}%',
              'background' => 'transparent'
          )
      ))
      ->tooltip($tooltip);

echo $chart->render();
?>

<script>
    function toggleHandler(e) {
        e.preventDefault();
        var visual = e.visual;
        var transform = null;
        if (e.show) {
            transform = kendo.geometry.transform().scale(1.5, 1.5, visual.rect().center());
        }
        visual.transform(transform);
    }
    
    function markerVisual(e) {
        var src = kendo.format('../content/dataviz/chart/images/{0}.png', e.dataItem.weather);
        var image = new kendo.drawing.Image(src, e.rect);
        return image;
    }

</script>

<?php require_once '../include/footer.php'; ?>
