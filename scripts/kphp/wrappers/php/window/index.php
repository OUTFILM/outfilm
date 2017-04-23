<?php

require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';

$window = new \Kendo\UI\Window('window');

$window->title('About Alvar Aalto')
       ->width('600px')
       ->close('onClose')
       ->startContent();
?>
    <div class="armchair">
        <img src="../content/web/window/armchair-402.png"
             alt="Artek Alvar Aalto - Armchair 402" />
            Artek Alvar Aalto - Armchair 402
    </div>
    <p>
        Alvar Aalto is one of the greatest names in modern architecture and design.
        Glassblowers at the iittala factory still meticulously handcraft the legendary
        vases that are variations on one theme, fluid organic shapes that let the end user
        ecide the use. Interpretations of the shape in new colors and materials add to the
        growing Alvar Aalto Collection that remains true to his original design.
    </p>
    <p>
        Born Hugo Alvar Henrik Aalto (February 3, 1898 - May 11, 1976) in Kuortane, Finland,
        was noted for his humanistic approach to modernism. He studied architecture at the
        Helsinki University of Technology from 1916 to 1921. In 1924 he married architect
        Aino Marsio.
    </p>
    <p>
        Alvar Aalto was one of the first and most influential architects of the Scandinavian
        modern movement, and a member of the Congres Internationaux d'Architecture Moderne.
        Major architectural works include the Finlandia Hall in Helsinki, Finland,
        and the campus of Helsinki University of Technology.
    </p>
    <p>
        Source:
        <a href="http://www.aalto.com/about-alvar-aalto.html" title="About Alvar Aalto">www.aalto.com</a>
    </p>
<?php
    $window->endContent();

    echo $window->render();
?>

<span id="undo" style="display:none" class="k-button">Click here to open the window.</span>

<script>
    function onClose() {
        $("#undo").show();
    }

    $(function() {
        $("#undo").click(function() {
            $("#window").data("kendoWindow").open();
            $("#undo").hide();
        });
    });
</script>

<style>
    #example
    {
        min-height:500px;
    }

    #undo {
        text-align: center;
        position: absolute;
        white-space: nowrap;
        padding: 1em;
        cursor: pointer;
    }
    .armchair {
        float: left;
        margin: 30px 30px 120px 30px;
        text-align: center;
    }
    .armchair img {
        display: block;
        margin-bottom: 10px;
    }
</style>
<?php require_once '../include/footer.php'; ?>
