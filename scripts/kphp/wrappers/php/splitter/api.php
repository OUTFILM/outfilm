<?php

require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';

?>

<div class="configuration k-widget k-header" style="z-index:10000">
    <span class="configHead">API Functions</span>
    <ul class="options">
        <li>
            The pane index: <input id="index" type="text" value="0" class="k-textbox" style="margin-top: -5px;" />
        </li>
        <li>Functions:</li>
        <li>
             <button id="toggle" class="k-button">Expand/Collapse</button>
        </li>
        <li>
            <input id="size" type="text" value="100px" class="k-textbox" /> <button id="setSize" class="k-button">Set size</button>
        </li>
        <li>
            <input id="min" type="text" value="50px" class="k-textbox" /> <button id="setMinSize" class="k-button">Set minimum size</button>
        </li>
        <li>
            <input id="max" type="text" value="150px" class="k-textbox" /> <button id="setMaxSize" class="k-button">Set maximum size</button>
        </li>
        <li>
            <button id="appendPane" class="k-button">Append a pane</button>
        </li>
        <li>
            <button id="removePane" class="k-button">Remove pane</button>
        </li>
        <li>
            <button id="insertBefore" class="k-button">Insert before index</button>
        </li>
        <li>
            <button id="insertAfter" class="k-button">Insert after index</button>
        </li>
    </ul>
</div>

<?php
    $splitter = new \Kendo\UI\Splitter('splitter');
    $splitter->attr('style', 'height: 300px; width: 72%;');

    $topPane = new \Kendo\UI\SplitterPane();
    $topPane->attr('id', 'top_pane')
        ->content('<p>Left pane</p>')
        ->collapsible(true)
        ->size(100);

    $splitter->addPane($topPane);

    $ajaxPane = new \Kendo\UI\SplitterPane();
    $ajaxPane->attr('id', 'ajax_pane')
             ->contentUrl('../content/web/splitter/ajax/ajaxContent1.html')
             ->collapsible(false);
    $splitter->addPane($ajaxPane);

    $bottomPane = new \Kendo\UI\SplitterPane();
    $bottomPane->attr('id', 'bottom_pane')
               ->content('<p>Right pane</p>')
               ->collapsible(true)
               ->size('20%');
    $splitter->addPane($bottomPane);

    echo $splitter->render();
?>

<script>
    var panes = $("#splitter").children(),
        getPane = function (index) {
            index = Number(index);

            if(!isNaN(index) && index < panes.length) {
                return panes[index];
            }
        },
        setSize = function (e) {
            if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode) {
                var pane = getPane($("#index").val());

                if (!pane) return;

                $("#splitter").data("kendoSplitter").size(pane, $("#size").val());
            }
        },
        setMinSize = function (e) {
            if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode) {
                var pane = getPane($("#index").val());

                if (!pane) return;

                $("#splitter").data("kendoSplitter").min(pane, $("#min").val());
            }
        },
        setMaxSize = function (e) {
            if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode) {
                var pane = getPane($("#index").val());

                if (!pane) return;

                $("#splitter").data("kendoSplitter").max(pane, $("#max").val());
            }
        },
        appendPane = function (e) {
            $("#splitter").data("kendoSplitter").append().html("appended pane");
        },
        removePane = function (e) {
            $("#splitter").data("kendoSplitter").remove($("#splitter").children(".k-pane").eq($("#index").val()));
        },
        insertBefore = function (e) {
            $("#splitter").data("kendoSplitter").insertBefore({}, $("#splitter").children(".k-pane").eq($("#index").val())).html("inserted before");
        },
        insertAfter = function (e) {
            $("#splitter").data("kendoSplitter").insertAfter({}, $("#splitter").children(".k-pane").eq($("#index").val())).html("inserted after");
        };

    $("#toggle").click( function (e) {
        var pane = getPane($("#index").val());
        if (!pane) return;

        $("#splitter").data("kendoSplitter").toggle(pane, $(pane).width() <= 0);
    });

    $("#setSize").click(setSize);
    $("#size").keypress(setSize);

    $("#setMinSize").click(setMinSize);
    $("#min").keypress(setMinSize);

    $("#setMaxSize").click(setMaxSize);
    $("#max").keypress(setMaxSize);
    
    $("#appendPane").click(appendPane);
    $("#removePane").click(removePane);

    $("#insertBefore").click(insertBefore);
    $("#insertAfter").click(insertAfter);
          
</script>

<style>
    .configuration .options input
    {
        width: 40px;
    }
</style>

<?php require_once '../include/footer.php'; ?>
