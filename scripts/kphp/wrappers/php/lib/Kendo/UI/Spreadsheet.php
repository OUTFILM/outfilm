<?php

namespace Kendo\UI;

class Spreadsheet extends \Kendo\UI\Widget {
    public function name() {
        return 'Spreadsheet';
    }
//>> Properties

    /**
    * The name of the currently active sheet.Must match one of the (sheet names)[#configuration-sheets.name] exactly.
    * @param string $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function activeSheet($value) {
        return $this->setProperty('activeSheet', $value);
    }

    /**
    * The default column width in pixels.
    * @param float $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function columnWidth($value) {
        return $this->setProperty('columnWidth', $value);
    }

    /**
    * The number of columns in the document.
    * @param float $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function columns($value) {
        return $this->setProperty('columns', $value);
    }

    /**
    * The height of the header row in pixels.
    * @param float $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function headerHeight($value) {
        return $this->setProperty('headerHeight', $value);
    }

    /**
    * The width of the header column in pixels.
    * @param float $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function headerWidth($value) {
        return $this->setProperty('headerWidth', $value);
    }

    /**
    * Configures the Kendo UI Spreadsheet Excel export settings.
    * @param \Kendo\UI\SpreadsheetExcel|array $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function excel($value) {
        return $this->setProperty('excel', $value);
    }

    /**
    * The default row height in pixels.
    * @param float $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function rowHeight($value) {
        return $this->setProperty('rowHeight', $value);
    }

    /**
    * The number of rows in the document.
    * @param float $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function rows($value) {
        return $this->setProperty('rows', $value);
    }

    /**
    * Adds SpreadsheetSheet to the Spreadsheet.
    * @param \Kendo\UI\SpreadsheetSheet|array,... $value one or more SpreadsheetSheet to add.
    * @return \Kendo\UI\Spreadsheet
    */
    public function addSheet($value) {
        return $this->add('sheets', func_get_args());
    }

    /**
    * A boolean value indicating if the toolbar should be displayed.
    * @param boolean $value
    * @return \Kendo\UI\Spreadsheet
    */
    public function toolbar($value) {
        return $this->setProperty('toolbar', $value);
    }

    /**
    * Sets the render event of the Spreadsheet.
    * Triggered after the widget has completed rendering.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Spreadsheet
    */
    public function renderEvent($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('render', $value);
    }

    /**
    * Sets the excelExport event of the Spreadsheet.
    * Fired when the user clicks the "Export to Excel" toolbar button.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Spreadsheet
    */
    public function excelExport($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('excelExport', $value);
    }


//<< Properties
}

?>
