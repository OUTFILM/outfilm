<?php

require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';

?>

<div class="demo-section" style="max-width:400px;">

<?php
    $tabstrip = new \Kendo\UI\TabStrip('tabstrip');

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Tab 1 with long text")
        ->selected(true)
        ->startContent();
?>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer felis libero, lobortis ac rutrum quis, varius a velit.</p>
<?php
    $item->endContent();
    $tabstrip->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Tab 2 with long text")
        ->startContent();
?>
  <p>Donec lacus erat, cursus sed porta quis, adipiscing et ligula. Duis volutpat, sem pharetra accumsan pharetra, mi ligula cursus felis, ac aliquet leo diam eget risus.</p>
<?php
    $item->endContent();
    $tabstrip->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Tab 3 with long text")
        ->startContent();
?>
  <p>Integer facilisis, justo cursus venenatis vehicula, massa nisl tempor sem, in ullamcorper neque mauris in orci.</p>
<?php
    $item->endContent();
    $tabstrip->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Tab 4 with long text")
        ->startContent();
?>
  <p>Ut orci ligula, varius ac consequat in, rhoncus in dolor. Mauris pulvinar molestie accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
<?php

    $item->endContent();
    $tabstrip->addItem($item);
    echo $tabstrip->render();
?>

</div>
  
<?php require_once '../include/footer.php'; ?>
