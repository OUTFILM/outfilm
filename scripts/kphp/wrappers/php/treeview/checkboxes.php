<?php

require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';

?>

<?php
    $treeview = new \Kendo\UI\TreeView('treeview');
    $treeview->attr('class', 'demo-section');

    $checkboxes = new \Kendo\UI\TreeViewCheckboxes();
    $checkboxes->checkChildren(true);
    $treeview->checkboxes($checkboxes);

    // helper function that creates TreeViewItem with id and spriteCssClass
    function TreeViewItem($id, $text, $spriteCssClass) {
        $item = new \Kendo\UI\TreeViewItem($text);
        $item->spriteCssClass($spriteCssClass);
        $item->id = $id;
        return $item;
    }

    $documents = TreeViewItem(1, 'My Documents', 'rootfolder');
    $documents->expanded(true);

    $kendoproject = TreeViewItem(2, 'Kendo UI Project', 'folder');
    $kendoproject->expanded(true);
    $kendoproject->addItem(TreeViewItem(3, 'about.html', 'html'))
                 ->addItem(TreeViewItem(4, 'index.html', 'html'))
                 ->addItem(TreeViewItem(5, 'logo.png', 'image'));

    $newsite = TreeViewItem(6, 'New Web Site', 'folder');
    $newsite->expanded(true);
    $newsite->addItem(TreeViewItem(7, 'mockup.jpg', 'image'))
            ->addItem(TreeViewItem(8, 'Research.pdf', 'pdf'));


    $reports = TreeViewItem(9, 'Reports', 'folder');
    $reports->expanded(true);
    $reports->addItem(TreeViewItem(10, 'February.pdf', 'pdf'))
            ->addItem(TreeViewItem(11, 'March.pdf', 'pdf'))
            ->addItem(TreeViewItem(12, 'April.pdf', 'pdf'));

    $documents->addItem($kendoproject, $newsite, $reports);

    $dataSource = new \Kendo\Data\HierarchicalDataSource();

    $dataSource->data(array($documents));

    $treeview->dataSource($dataSource);

    echo $treeview->render();
?>

<style>
    #treeview {
        width: 300px;
        margin: 0 auto;
    }

    #treeview .k-sprite {
        background-image: url("../content/web/treeview/coloricons-sprite.png");
    }

    .rootfolder { background-position: 0 0; }
    .folder     { background-position: 0 -16px; }
    .pdf        { background-position: 0 -32px; }
    .html       { background-position: 0 -48px; }
    .image      { background-position: 0 -64px; }
</style>

<?php require_once '../include/footer.php'; ?>
