<?php

namespace QCubed\Plugin;

use QCubed as Q;
use QCubed\Bootstrap as Bs;
use QCubed\Exception\Caller;
use QCubed\Exception\InvalidCast;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Type;

/**
 * Class ToastrBase
 *
 * @property string $AlertType ............
 * @property string $Title ............

 * @property integer $Rows          specifies how many rows you want to have shown.
 * @property string $LabelForRequired
 * @property string $LabelForRequiredUnnamed
 * @property string $SelectionMode SELECTION_MODE_* const specifies if this is a "Single" or "Multiple" select control.

 * @package QCubed\Plugin
 */

class Toastr/*Base*/ extends \QCubed\Control\Panel
{
    const TYPE_SUCCESS = 'success';
    const TYPE_INFO = 'info';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';

    protected $strJavaScripts = QCUBED_JQUI_JS;

    /** @var */
    //protected $strControlId;
    /** @var string */
    protected $strAlertType;
    /** @var string */
    protected $strTitle = null;


    /**
     * Toastr constructor
     *
     * @param ControlBase|FormBase|null $objParentObject
     * @param null|string $strControlId
     */
    public function __construct($objParentObject, $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);
        $this->registerFiles();
    }

    /**
     * @throws Caller
     */
    protected function registerFiles() {
        $this->AddJavascriptFile(QCUBED_TOASTR_ASSETS_URL . "/js/toastr.min.js");
        $this->AddCssFile(QCUBED_BOOTSTRAP_CSS); // make sure they know
        $this->addCssFile(QCUBED_TOASTR_ASSETS_URL . "/css/toastr.min.css");
    }

    /**
     * Returns the control id for purposes of attaching events.
     * @return string
     */
    public function getControlJavaScript() {
        return sprintf('jQuery("#%s").%s.%s(%s, %s %s)',
            $this->getJqControlId(),
            $this->getJqSetupFunction(),
            $this->AlertType,
            $this->Text,
            $this->Title,
            $this->makeJqOptions());
    }

    /**
     * @return string
     */
    public function getEndScript() {
        return  $this->getControlJavaScript() . '; ' . parent::getEndScript();
    }

    /**
     * @return string
     */
    public function getJqSetupFunction()
    {
        return 'toastr';
    }

    /**
     * @return string
     */
    public function getJqControlId()
    {
        return $this->ControlId . '_ctl';
    }


    /**
     * Returns an array of options that get set to the setup function as javascript.
     * @return null
     */
    protected function makeJqOptions()
    {
        $jqOptions = null;
        if (!is_null($val = $this->Text)) {$jqOptions['message'] = $val;}
        if (!is_null($val = $this->Title)) {$jqOptions['title'] = $val;}

        return $jqOptions;
    }

    /**
     * PHP magic method
     *
     * @param string $strName
     *
     * @return mixed
     * @throws \Exception|Caller
     */
    public function __get($strName)
    {
        switch ($strName) {
            case 'AlertType': return $this->strAlertType;
            case 'Text': return $this->strTitle;
            case "Title": return $this->strTitle;

            default:
                try {
                    return parent::__get($strName);
                } catch (Caller $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
        }
    }

    /**
     * PHP magic method
     *
     * @param string $strName
     * @param string $mixValue
     *
     * @throws \Exception|Caller|InvalidCast
     */
    public function __set($strName, $mixValue)
    {
        switch ($strName) {
            case 'AlertType':
                try {
                    $this->strAlertType = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'Text' :
                try {
                    $this->strText = Type::cast($mixValue, Type::STRING);
                    $this->blnModified = true;    // redraw
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }

            case 'Title' :
                try {
                    $this->strTitle = Type::cast($mixValue, Type::STRING);
                    $this->blnModified = true;    // redraw
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }





            case 'Toastr':
                // stub, does nothing
                break;

            default:
                try {
                    parent::__set($strName, $mixValue);
                    break;
                } catch (Caller $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
        }
    }

}

