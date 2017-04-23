<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileName = $_POST['fileName'];
    $contentType = $_POST['contentType'];
    $base64 = $_POST['base64'];

    $data = base64_decode($base64);

    header('Content-Type:' . $contentType);
    header('Content-Length:' . strlen($data));
    header('Content-Disposition: attachment; filename=' . $fileName);

    echo $data;

    exit;
}

require_once '../lib/Kendo/Autoload.php';
require_once '../include/header.php';

$dataSource = new \Kendo\Data\DataSource();
$dataSource->type("geojson")
           ->transport(array('read' => '../content/dataviz/map/countries-users.geo.json'));

$layer = new \Kendo\Dataviz\UI\MapLayer();
$layer->type("shape")
      ->dataSource($dataSource)
      ->style(array('fill' => array('opacity' => 0.7)));

$map = new \Kendo\Dataviz\UI\Map('map');
$map->center(array(30.2681, -97.7448))
    ->zoom(3)
    ->addLayer($layer)
    ->shapeCreated('onShapeCreated')
    ->shapeMouseEnter('onShapeMouseEnter')
    ->shapeMouseLeave('onShapeMouseLeave');
?>

<!-- Chroma.js used to colorize the map in the demo -->
<script src="../content/dataviz/map/js/chroma.min.js"></script>

<!-- Load Pako ZLIB library to enable PDF compression -->
<script src="../content/shared/js/pako.min.js"></script>

<div class="box">
    <h4>Export options</h4>
    <div class="box-col">
        <button class='export-pdf k-button'>Export as PDF</button>
    </div>
    <div class="box-col">
        <button class='export-img k-button'>Export as Image</button>
    </div>
    <div class="box-col">
        <button class='export-svg k-button'>Export as SVG</button>
    </div>
</div>
<div class="demo-section k-header" style="padding: 1em;">
<?php
    echo $map->render();
?>
</div>
<script>
    $(".export-pdf").click(function() {
        // Convert the DOM element to a drawing using kendo.drawing.drawDOM
        kendo.drawing.drawDOM($(".demo-section"))
        .then(function(group) {
            // Render the result as a PDF file
            return kendo.drawing.exportPDF(group, {
                paperSize: "auto",
                margin: { left: "1cm", top: "1cm", right: "1cm", bottom: "1cm" }
            });
        })
        .done(function(data) {
            // Save the PDF file
            kendo.saveAs({
                dataURI: data,
                fileName: "Map.pdf",
                proxyURL: "export.php?type=save"
            });
        });
    });

    $(".export-img").click(function() {
        // Convert the DOM element to a drawing using kendo.drawing.drawDOM
        kendo.drawing.drawDOM($(".demo-section"))
        .then(function(group) {
            // Render the result as a PNG image
            return kendo.drawing.exportImage(group);
        })
        .done(function(data) {
            // Save the image file
            kendo.saveAs({
                dataURI: data,
                fileName: "Map.png",
                proxyURL: "export.php?type=save"
            });
        });
    });

    $(".export-svg").click(function() {
        // Convert the DOM element to a drawing using kendo.drawing.drawDOM
        kendo.drawing.drawDOM($(".demo-section"))
        .then(function(group) {
            // Render the result as a SVG document
            return kendo.drawing.exportSVG(group);
        })
        .done(function(data) {
            // Save the SVG document
            kendo.saveAs({
                dataURI: data,
                fileName: "Map.svg",
                proxyURL: "export.php?type=save"
            });
        });
    });


var scale = chroma
    .scale(["white", "green"])
    .domain([1, 1000]);

function onShapeCreated(e) {
    var shape = e.shape;
    var users = shape.dataItem.properties.users;
    if (users) {
        var color = scale(users).hex();
        shape.options.fill.set("color", color);
    }
}

function onShapeMouseEnter(e) {
    e.shape.options.set("fill.opacity", 1);
}

function onShapeMouseLeave(e) {
    e.shape.options.set("fill.opacity", 0.7);
}

</script>

<?php require_once '../include/footer.php'; ?>
