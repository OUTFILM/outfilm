<?php
require_once '../lib/Kendo/Autoload.php';

require_once '../include/header.php';

$total = new \Kendo\Dataviz\UI\ChartSeriesItem();
$total->name('Total Visits')
      ->data(array(56000, 63000, 74000, 91000, 117000, 138000, 128000, 115000, 102000, 98000, 123000, 113000));

$unique = new \Kendo\Dataviz\UI\ChartSeriesItem();
$unique->name('Unique visitors')
       ->data(array(52000, 34000, 23000, 48000, 67000, 83000, 40000, 50000, 64000, 72000, 75000, 81000));

$valueAxis = new \Kendo\Dataviz\UI\ChartValueAxisItem();
$valueAxis->line(array('visible' => false));

$categoryAxis = new \Kendo\Dataviz\UI\ChartCategoryAxisItem();
$categoryAxis->categories(array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'))
             ->majorGridLines(array('visible' => false))
             ->line(array('visible' => false));

$tooltip = new \Kendo\Dataviz\UI\ChartTooltip();
$tooltip->visible(true);

$pane = new \Kendo\Dataviz\UI\ChartPane();
$pane->clip(false);

$chart = new \Kendo\Dataviz\UI\Chart('chart');
$chart->addSeriesItem($total, $unique)
      ->addValueAxisItem($valueAxis)
      ->addPane($pane)
      ->addCategoryAxisItem($categoryAxis)
      ->legend(array('position' => 'bottom', 'item' => array('visual' => new \Kendo\JavaScriptFunction('createLegendItem'))))
      ->seriesDefaults(array('type' => 'column', 'stack' => true, 'visual' => new \Kendo\JavaScriptFunction('columnVisual'), 'highlight' => array('toggle' => new \Kendo\JavaScriptFunction('toggleHandler'))))
      ->title(array('text' => 'Site Visitors Stats /thousands/'))
      ->tooltip($tooltip);

echo $chart->render();
?>

<script>
    var drawing = kendo.drawing;
    var geometry = kendo.geometry;

    function columnVisual(e) {
        return createColumn(e.rect, e.options.color);
    }

    function toggleHandler(e) {
        e.preventDefault();
        var visual = e.visual;
        var opacity = e.show ? 0.8 : 1;

        visual.opacity(opacity);
    }

    function createLegendItem(e) {
        var color = e.options.markers.background;
        var labelColor = e.options.labels.color;
        var rect = new geometry.Rect([0, 0], [120, 50]);
        var layout = new drawing.Layout(rect, {
            spacing: 5,
            alignItems: "center"
        });

        var overlay = drawing.Path.fromRect(rect, {
            fill: {
                color: "#fff",
                opacity: 0
            },
            stroke: {
                color: "none"
            },
            cursor: "pointer"
        });

        var column = createColumn(new geometry.Rect([0, 0], [15, 10]), color);
        var label = new drawing.Text(e.series.name, [0, 0], {
            fill: {
                color: labelColor
            }
        })

        layout.append(column, label);
        layout.reflow();

        var group = new drawing.Group().append(layout, overlay);

        return group;
    }

    function createColumn(rect, color) {
        var origin = rect.origin;
        var center = rect.center();
        var bottomRight = rect.bottomRight();
        var radiusX = rect.width() / 2;
        var radiusY = radiusX / 3;
        var gradient = new drawing.LinearGradient({
            stops: [{
                offset: 0,
                color: color
            }, {
                offset: 0.5,
                color: color,
                opacity: 0.9
            }, {
                offset: 0.5,
                color: color,
                opacity: 0.9
            }, {
                offset: 1,
                color: color
            }]
        });

        var path = new drawing.Path({
            fill: gradient,
            stroke: {
                color: "none"
            }
        }).moveTo(origin.x, origin.y)
            .lineTo(origin.x, bottomRight.y)
            .arc(180, 0, radiusX, radiusY, true)
            .lineTo(bottomRight.x, origin.y)
            .arc(0, 180, radiusX, radiusY);

        var topArcGeometry = new geometry.Arc([center.x, origin.y], {
            startAngle: 0,
            endAngle: 360,
            radiusX: radiusX,
            radiusY: radiusY
        });

        var topArc = new drawing.Arc(topArcGeometry, {
            fill: {
                color: color
            },
            stroke: {
                color: "#ebebeb"
            }
        });
        var group = new drawing.Group();
        group.append(path, topArc);
        return group;
    }

</script>
<?php require_once '../include/footer.php'; ?>
