<?php
    function read_navigation($filename) {
        $navigation = json_decode(file_get_contents($filename), true);

        return $navigation;
    }

    function example_url($example) {
        return $example['url'] . '.php';
    }

    function example_exists($example) {
        return file_exists(example_url($example));
    }

    function include_in_navigation($item) {
        if (!array_key_exists('packages', $item)) {
            return true;
        }

        $packages = $item['packages'];

        $invert = false;
        $match = false;

        foreach ($packages as $packageName) {
            $name = $packageName;

            if ($name[0] == '!') {
                $invert = true;
                $name = substr($name, 1);
            }

            if ($name == 'php') {
                $match = true;
            }
        }

        $result = (!$invert && $match) || ($invert && !$match);


        return $result;
    }

    $widgets = read_navigation($jsonFilename);

?>
    <ul>
<?php
    foreach ($widgets as $widget) {
?>
<?php
        if (include_in_navigation($widget)) {
?>
        <li>
            <h2><?= $widget['text'] ?></h2>
            <ul>
<?php
                foreach($widget['items'] as $example) {
                    if (include_in_navigation($example) && example_exists($example)) {
?>
                <li><a href="<?= example_url($example) ?>"><?= $example['text'] ?></a></li>
<?php
                    }
                }
?>
            </ul>
        </li>
<?php
        }
    }
?>
    </ul>
