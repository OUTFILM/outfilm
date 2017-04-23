<?php

require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';

?>

<h3>Left</h3>

<?php
    $tabstrip-left = new \Kendo\UI\TabStrip('tabstrip-left');

    $item = new \Kendo\UI\TabStripItem();
    $item->text("One")
        ->selected(true)
        ->startContent();
?>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer felis libero, lobortis ac rutrum quis, varius a velit. Donec lacus erat, cursus sed porta quis, adipiscing et ligula. Duis volutpat, sem pharetra accumsan pharetra, mi ligula cursus felis, ac aliquet leo diam eget risus. Integer facilisis, justo cursus venenatis vehicula, massa nisl tempor sem, in ullamcorper neque mauris in orci.</p>
<?php
    $item->endContent();
    $tabstrip-left->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Two")
        ->startContent();
?>
    <p>Ut orci ligula, varius ac consequat in, rhoncus in dolor. Mauris pulvinar molestie accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean velit ligula, pharetra quis aliquam sed, scelerisque sed sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam dui mi, vulputate vitae pulvinar ac, condimentum sed eros.</p>
<?php
    $item->endContent();
    $tabstrip-left->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Three")
        ->startContent();
?>
    <p>Aliquam at nisl quis est adipiscing bibendum. Nam malesuada eros facilisis arcu vulputate at aliquam nunc tempor. In commodo scelerisque enim, eget sodales lorem condimentum rutrum. Phasellus sem metus, ultricies at commodo in, tristique non est. Morbi vel mauris eget mauris commodo elementum. Nam eget libero lacus, ut sollicitudin ante. Nam odio quam, suscipit a fringilla eget, dignissim nec arcu. Donec tristique arcu ut sapien elementum pellentesque.</p>
<?php
    $item->endContent();
    $tabstrip-left->addItem($item);

    // set animation
    $animation = new \Kendo\UI\TabStripAnimation();
    $openAnimation = new \Kendo\UI\TabStripAnimationOpen();
    $openAnimation->effects("fadeIn");
    $animation->open($openAnimation);

    $tabstrip-left->animation($animation);

    echo $tabstrip-left->render();
?>

<h3>Right</h3>

<?php
    $tabstrip-right = new \Kendo\UI\TabStrip('tabstrip-right');

    $item = new \Kendo\UI\TabStripItem();
    $item->text("One")
        ->selected(true)
        ->startContent();
?>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer felis libero, lobortis ac rutrum quis, varius a velit. Donec lacus erat, cursus sed porta quis, adipiscing et ligula. Duis volutpat, sem pharetra accumsan pharetra, mi ligula cursus felis, ac aliquet leo diam eget risus. Integer facilisis, justo cursus venenatis vehicula, massa nisl tempor sem, in ullamcorper neque mauris in orci.</p>
<?php
    $item->endContent();
    $tabstrip-right->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Two")
        ->startContent();
?>
<p>Ut orci ligula, varius ac consequat in, rhoncus in dolor. Mauris pulvinar molestie accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean velit ligula, pharetra quis aliquam sed, scelerisque sed sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam dui mi, vulputate vitae pulvinar ac, condimentum sed eros.</p>
<?php
    $item->endContent();
    $tabstrip-right->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Three")
        ->startContent();
?>
<p>Aliquam at nisl quis est adipiscing bibendum. Nam malesuada eros facilisis arcu vulputate at aliquam nunc tempor. In commodo scelerisque enim, eget sodales lorem condimentum rutrum. Phasellus sem metus, ultricies at commodo in, tristique non est. Morbi vel mauris eget mauris commodo elementum. Nam eget libero lacus, ut sollicitudin ante. Nam odio quam, suscipit a fringilla eget, dignissim nec arcu. Donec tristique arcu ut sapien elementum pellentesque.</p>
<?php
    $item->endContent();
    $tabstrip-right->addItem($item);

    // set animation
    $animation = new \Kendo\UI\TabStripAnimation();
    $openAnimation = new \Kendo\UI\TabStripAnimationOpen();
    $openAnimation->effects("fadeIn");
    $animation->open($openAnimation);

    $tabstrip-right->animation($animation);

    echo $tabstrip-right->render();
?>

<h3>Bottom</h3>

<?php
    $tabstrip-bottom = new \Kendo\UI\TabStrip('tabstrip-bottom');

    $item = new \Kendo\UI\TabStripItem();
    $item->text("One")
        ->selected(true)
        ->startContent();
?>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer felis libero, lobortis ac rutrum quis, varius a velit. Donec lacus erat, cursus sed porta quis, adipiscing et ligula. Duis volutpat, sem pharetra accumsan pharetra, mi ligula cursus felis, ac aliquet leo diam eget risus. Integer facilisis, justo cursus venenatis vehicula, massa nisl tempor sem, in ullamcorper neque mauris in orci.</p>
<?php
    $item->endContent();
    $tabstrip-bottom->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Two")
        ->startContent();
?>
<p>Ut orci ligula, varius ac consequat in, rhoncus in dolor. Mauris pulvinar molestie accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean velit ligula, pharetra quis aliquam sed, scelerisque sed sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam dui mi, vulputate vitae pulvinar ac, condimentum sed eros.</p>
<?php
    $item->endContent();
    $tabstrip-bottom->addItem($item);

    $item = new \Kendo\UI\TabStripItem();
    $item->text("Three")
        ->startContent();
?>
<p>Aliquam at nisl quis est adipiscing bibendum. Nam malesuada eros facilisis arcu vulputate at aliquam nunc tempor. In commodo scelerisque enim, eget sodales lorem condimentum rutrum. Phasellus sem metus, ultricies at commodo in, tristique non est. Morbi vel mauris eget mauris commodo elementum. Nam eget libero lacus, ut sollicitudin ante. Nam odio quam, suscipit a fringilla eget, dignissim nec arcu. Donec tristique arcu ut sapien elementum pellentesque.</p>
<?php
    $item->endContent();
    $tabstrip-bottom->addItem($item);

    // set animation
    $animation = new \Kendo\UI\TabStripAnimation();
    $openAnimation = new \Kendo\UI\TabStripAnimationOpen();
    $openAnimation->effects("fadeIn");
    $animation->open($openAnimation);

    $tabstrip-bottom->animation($animation);

    echo $tabstrip-bottom->render();
?>

<?php require_once '../include/footer.php'; ?>
