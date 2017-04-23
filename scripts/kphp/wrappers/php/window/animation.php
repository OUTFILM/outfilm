<?php

require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';

?>
<div class="configuration k-widget k-header">
    <span class="configHead">Animation Settings</span>
    <ul class="options">
        <li>
            <input id="default" name="animation" type="radio" checked="checked" /> <label for="default">default/zoom animation</label>
        </li>
        <li>
            <input id="toggle" name="animation" type="radio" /> <label for="toggle">toggle animation</label>
        </li>
        <li>
            <input id="expand" name="animation" type="radio" checked="checked" /> <label for="expand">expand animation</label>
        </li>
        <li>
            <input id="opacity" type="checkbox" checked="checked" /> <label for="opacity">animate opacity</label>
        </li>
    </ul>
</div>

<?php
    $window = new \Kendo\UI\Window('window');

    $window->title('EGG CHAIR')
           ->width('500px')
           ->close('onClose')
           ->startContent(); ?>

                <div style="text-align: center;">
                    <img src="../content/web/window/egg-chair.png" />
                    <p>ARNE JACOBSEN EGG CHAIR<br /> Image by: <a href="http://www.conranshop.co.uk/" title="http://www.conranshop.co.uk/">http://www.conranshop.co.uk/</a></p>
                </div>
<?php
    $window->endContent();

    echo $window->render();
?>

<span id="undo" style="display:none" class="k-group">Click here to open the window.</span>

<script>
    function onClose() {
        $("#undo").fadeIn(300);
    }

    $(document).ready(function() {
        var original = $("#window").clone(true);

        $(".configuration input").change( function() {
            var clone = original.clone(true);

            $("#undo").hide();
            $("#window").data("kendoWindow").destroy();

            setTimeout( function () {
                $("#example").append(clone);
                initWindow();
            }, 200);
        });

        var getEffects = function () {
            return (($("#expand")[0].checked ? "expand:vertical " : "") +
                    ($("#opacity")[0].checked ? "fadeIn" : "")) || false;
        };

        function initWindow () {
            var windowOptions = {
                width: "500px",
                title: "EGG CHAIR",
                visible: false,
                close: onClose
            };

            if (!$("#default")[0].checked)
                windowOptions.animation = { open: { effects: getEffects() }, close: { effects: getEffects(), reverse: true } };

            $("#window").kendoWindow(windowOptions);

            $("#undo")
                .bind("click", function() {
                    window.open();
                    undo.fadeOut(300);
                });

            $("#window").data("kendoWindow").open();
        }
    });
</script>

<style>
    #example {
        min-height:400px;
    }

    #undo {
        text-align: center;
        position: absolute;
        white-space: nowrap;
        border-width: 1px;
        border-style: solid;
        padding: 2em;
        cursor: pointer;
    }
</style>

<?php require_once '../include/footer.php'; ?>
