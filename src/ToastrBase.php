<?php

namespace QCubed\Plugin;

use QCubed\Control\Panel;
use QCubed\Exception\Caller;
use QCubed\Exception\InvalidCast;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Application;
use QCubed\ApplicationBase;
use QCubed\Type;

/**
 * Class ToastrBase
 *
 * @property string $AlertType *const specifies the type of warning: success, info, warning, error.
 *                              Here are used: TYPE_SUCCESS, TYPE_INFO, TYPE_WARNING, TYPE_ERROR.
 * @property string $PositionClass * const determines the position where the toast is displayed relative to the screen:
 *                                  'Toast-top-right', 'toast-bottom-right', 'toast-bottom-left', 'toast-top-left',
 *                                  'toast-top-full-width', 'toast-bottom-full-width', 'toast-top-center', 'toast-bottom-center'.
 *                                  Here are used: POSITION_TOP_RIGHT, POSITION_BOTTOM_RIGHT, POSITION_BOTTOM_LEFT,
 *                                  POSITION_TOP_LEFT, POSITION_TOP_FULL_WIDTH, POSITION_BOTTOM_FULL_WIDTH, POSITION_TOP_CENTER.
 * Usage
 * $toastr = new QCubed\Plugin\Toastr($this);
 * $toastr->AlertType = QCubed\Plugin\Toastr::TYPE_SUCCESS;
 * $toastr->PositionClass = QCubed\Plugin\Toastr::POSITION_TOP_CENTER;
 * $toastr->Message = t('message');
 * $toastr->Title = t('title');
 *
 * @property string $Message
 * @property string $Title
 * @property string $MessageClass Default string 'toast-message', see in the style folder - toastr.css
 * @property string $TitleClass Default string 'toast-title', see in the style folder - toastr.css
 * @property boolean $TapToDismiss Default boolean true If you want to force the toast and ignore the focus,
 *                                                       add a button to the toast and write the function.
 * @property string $ToastClass  Default: string 'toast'
 * @property string $ContainerId Default: string 'toast-container', see in the style folder - toastr.css
 * @property boolean $Debug  Default: boolean false,
 * @property string $ShowMethod Default: string 'fadeIn', // fadeIn, slideDown, and show are built into jQuery.
 * @property string $HideMethod Default: string 'fadeOut', // fadeOut, slideUp, and hide are built into jQuery.
 * @property integer $ShowDuration Default: integer 300
 * @property integer $HideDuration Default integer 1000
 * @property integer $TimeOut Default integer 5000, // How long the toast will display without user interaction
 * @property integer $ExtendedTimeOut Default integer 1000, // How long the toast will display after a user hovers over it.
 *                   Optionally override the animation easing to show or hide the toasts. Default is swing. Swing and
 *                   linear are built into jQuery.
 * @property string $ShowEasing Default string 'swing', // swing and linear are built into jQuery.
 * @property string $HideEasing Default string 'swing', // swing and linear are built into jQuery.
 * @property string $CloseEasing Default string false, // swing and linear are built into jQuery.
 * @property boolean $CloseOnHover Default boolean true
 * @property array $IconClasses Default IconClasses = json_encode('error' => 'toast-error', 'info' =>'toast-info',
 *                                                                'success' => 'toast-success', 'warning' => 'toast-warning')
 * @property string $IconClass Default: strings 'toast_success', 'toast-info', 'toast-warning' and 'toast-error'
 * @property boolean $EscapeHtml Default boolean false, In case you want to escape HTML characters in title and message.
 * @property string Target Default string 'body'
 * @property string $CloseHtml Default string '<button type="button">&times;</button>', Optionally override the close button's HTML.
 * @property string $CloseClass Default: string 'toast-close-button', see in the style folder - toastr.css
 * @property boolean $CloseButton Optionally enable a close button
 * @property boolean $NewestOnTop Default boolean true, Show the newest toast at bottom (top is default).
 * @property boolean $PreventDuplicates Default boolean false, Rather than having identical toasts stack,
 *                                     set the preventDuplicates property to true. Duplicates are matched to the previous
 *                                     toast based on their message content.
 * @property boolean $ProgressBar Default boolean false, Visually indicate how long before a toast expires.
 * @property string $ProgressClass Default string 'toast-progress', see in the style folder - toastr.css
 * @property boolean $RTL Default boolean false, Flip the toastr to be displayed properly for right-to-left languages.
 *
 *
 * @see examples and options in the folder /assets/toastr-master.
 * @package QCubed\Plugin
 */

class ToastrBase extends Panel
{
    const string TYPE_SUCCESS = 'success';
    const string TYPE_INFO = 'info';
    const string TYPE_WARNING = 'warning';
    const string TYPE_ERROR = 'error';

    const string POSITION_TOP_RIGHT = 'toast-top-right';
    const string POSITION_BOTTOM_RIGHT = 'toast-bottom-right';
    const string POSITION_BOTTOM_LEFT = 'toast-bottom-left';
    const string POSITION_TOP_LEFT = 'toast-top-left';
    const string POSITION_TOP_FULL_WIDTH = 'toast-top-full-width';
    const string POSITION_BOTTOM_FULL_WIDTH = 'toast-bottom-full-width';
    const string POSITION_TOP_CENTER = 'toast-top-center';
    const string POSITION_BOTTOM_CENTER = 'toast-bottom-center';

    /** @var string */
    protected string $strAlertType;
    /** @var string */
    protected string $strPositionType;
    /** @var string|null */
    protected ?string $strMessage = null;
    /** @var string|null */
    protected ?string $strTitle = null;
    /** @var string|null */
    protected ?string $strMessageClass = null;
    /** @var string|null */
    protected ?string $strTitleClass = null;
    /** @var boolean */
    protected ?bool $blnTapToDismiss = null;
    /** @var string|null */
    protected ?string $strToastClass = null;
    /** @var string|null */
    protected ?string $strContainerId = null;
    /** @var boolean */
    protected ?bool $blnDebug = null;
    /** @var string|null */
    protected ?string $strShowMethod = null;
    /** @var string|null */
    protected ?string $strHideMethod = null;
    /** @var integer|null */
    protected ?int $intShowDuration = null;
    /** @var integer|null */
    protected ?int $intHideDuration = null;
    /** @var integer|null */
    protected ?int $intTimeOut = null;
    /** @var integer|null */
    protected ?int $intExtendedTimeOut = null;
    /** @var string|null */
    protected ?string $strShowEasing = null;
    /** @var string|null */
    protected ?string $strHideEasing = null;
    /** @var string|null */
    protected ?string $strCloseEasing = null;
    /** @var boolean */
    protected ?bool $blnCloseOnHover = null;
    /** @var array|null */
    protected ?array $arrIconClasses = null;
    /** @var string|null */
    protected ?string $strIconClass = null;
    /** @var string|null */
    protected ?string $strPositionClass = null;
    /** @var boolean */
    protected ?bool $blnEscapeHtml = null;
    /** @var string|null */
    protected ?string $strTarget = null;
    /** @var string|null */
    protected ?string $strCloseHtml = null;
    /** @var string|null */
    protected ?string $strCloseClass = null;
    /** @var boolean */
    protected ?bool $blnCloseButton = null;
    /** @var boolean */
    protected ?bool $blnNewestOnTop = null;
    /** @var boolean */
    protected ?bool $blnPreventDuplicates = null;
    /** @var boolean */
    protected ?bool $blnProgressBar = null;
    /** @var string|null */
    protected ?string $strProgressClass = null;
    /** @var boolean */
    protected ?bool $blnRTL = null;

    /**
     * Constructor method for initializing the object.
     *
     * @param ControlBase|FormBase $objParentObject The parent control or form object.
     * @param string|null $strControlId Optional control ID for the object. If null, a default ID will be generated.
     *
     * @throws Caller
     */
    public function __construct(ControlBase|FormBase $objParentObject, ?string $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);
        $this->registerFiles();
    }

    /**
     * Registers necessary JavaScript and CSS files required for the component's functionality and appearance.
     *
     * @return void
     * @throws Caller
     */

    protected function registerFiles(): void
    {
        $this->AddJavascriptFile(QCUBED_TOASTR_ASSETS_URL . "/js/toastr.js");
        $this->addCssFile(QCUBED_TOASTR_ASSETS_URL . "/css/toastr.css");
        $this->addCssFile(QCUBED_TOASTR_ASSETS_URL . "/css/toastr.fontawesome.css");
        $this->AddCssFile(QCUBED_BOOTSTRAP_CSS); // make sure they know
        $this->AddCssFile(QCUBED_FONT_AWESOME_CSS); // make sure they know
    }

    /**
     * Retrieves the jQuery setup function name.
     *
     * @return string The name of the jQuery setup function.
     */
    public function getJqSetupFunction(): string
    {
        return 'toastr';
    }

    /**
     * Constructs an array of jQuery options for a customizable UI/UX element based on the
     * object's properties. Each property is checked for a non-null value, and if set, the
     * corresponding key-value pair is added to the option array.
     *
     * @return array An associative array of jQuery options if at least one property has
     *                    a non-null value, or null if no options are set.
     */
    protected function makeJqOptions(): array
    {
        $jqOptions = null;
        if (!is_null($val = $this->TapToDismiss)) {$jqOptions['tapToDismiss'] = $val;}
        if (!is_null($val = $this->ToastClass)) {$jqOptions['toastClass'] = $val;}
        if (!is_null($val = $this->ContainerId)) {$jqOptions['containerId'] = $val;}
        if (!is_null($val = $this->Debug)) {$jqOptions['debug'] = $val;}
        if (!is_null($val = $this->ShowMethod)) {$jqOptions['showMethod'] = $val;}
        if (!is_null($val = $this->HideMethod)) {$jqOptions['hideMethod'] = $val;}
        if (!is_null($val = $this->ShowDuration)) {$jqOptions['showDuration'] = $val;}
        if (!is_null($val = $this->HideDuration)) {$jqOptions['hideDuration'] = $val;}
        if (!is_null($val = $this->TimeOut)) {$jqOptions['timeOut'] = $val;}
        if (!is_null($val = $this->ExtendedTimeOut)) {$jqOptions['extendedTimeOut'] = $val;}
        if (!is_null($val = $this->ShowEasing)) {$jqOptions['showEasing'] = $val;}
        if (!is_null($val = $this->HideEasing)) {$jqOptions['hideEasing'] = $val;}
        if (!is_null($val = $this->CloseEasing)) {$jqOptions['closeEasing'] = $val;}
        if (!is_null($val = $this->CloseOnHover)) {$jqOptions['closeOnHover'] = $val;}
        if (!is_null($val = $this->IconClasses)) {$jqOptions['iconClasses'] = $val;}
        if (!is_null($val = $this->IconClass)) {$jqOptions['iconClass'] = $val;}
        if (!is_null($val = $this->PositionClass)) {$jqOptions['positionClass'] = $val;}
        if (!is_null($val = $this->EscapeHtml)) {$jqOptions['escapeHtml'] = $val;}
        if (!is_null($val = $this->Target)) {$jqOptions['target'] = $val;}
        if (!is_null($val = $this->CloseHtml)) {$jqOptions['closeHtml'] = $val;}
        if (!is_null($val = $this->CloseClass)) {$jqOptions['closeClass '] = $val;}
        if (!is_null($val = $this->CloseButton)) {$jqOptions['closeButton'] = $val;}
        if (!is_null($val = $this->NewestOnTop)) {$jqOptions['newestOnTop'] = $val;}
        if (!is_null($val = $this->PreventDuplicates)) {$jqOptions['preventDuplicates'] = $val;}
        if (!is_null($val = $this->ProgressBar)) {$jqOptions['progressBar'] = $val;}
        if (!is_null($val = $this->ProgressClass)) {$jqOptions['progressClass'] = $val;}
        if (!is_null($val = $this->RTL)) {$jqOptions['rtl'] = $val;}
        return $jqOptions;
    }

    /**
     * Triggers a JavaScript notification using the specified alert type, message, and title.
     * Optionally includes additional jQuery options if provided.
     *
     * @return void
     * @throws Caller
     */
    public function notify(): void
    {
        $jqOptions = $this->makeJqOptions();

        if (empty($jqOptions)) {
            Application::executeJavaScript(sprintf('%s.%s("%s", "%s")',
                $this->getJqSetupFunction(), $this->AlertType, $this->Message, $this->Title), ApplicationBase::PRIORITY_HIGH);
        } else {
            Application::executeJavaScript(sprintf('%s.%s("%s", "%s", %s)',
                $this->getJqSetupFunction(), $this->AlertType, $this->Message, $this->Title, json_encode($jqOptions)),
                ApplicationBase::PRIORITY_HIGH);
        }
    }

    /**
     * Magic getter method to retrieve the value of a property by name.
     *
     * @param string $strName The name of the property to retrieve.
     *
     * @return mixed The value of the requested property. Returns different types depending on the property accessed.
     *
     * @throws Caller If the requested property does not exist or cannot be accessed.
     */
    public function __get(string $strName): mixed
    {
        switch ($strName) {
            case 'AlertType': return $this->strAlertType;
            case 'Message': return $this->strMessage;
            case "Title": return $this->strTitle;
            case "TapToDismiss": return $this->blnTapToDismiss;
            case "ToastClass": return $this->strToastClass;
            case "ContainerId": return $this->strContainerId;
            case "Debug": return $this->blnDebug;
            case "ShowMethod": return $this->strShowMethod;
            case "HideMethod": return $this->strHideMethod;
            case "ShowDuration": return $this->intShowDuration;
            case "HideDuration": return $this->intHideDuration;
            case "TimeOut": return $this->intTimeOut;
            case "ExtendedTimeOut": return $this->intExtendedTimeOut;
            case "ShowEasing": return $this->strShowEasing;
            case "HideEasing": return $this->strHideEasing;
            case "CloseEasing": return $this->strCloseEasing;
            case "CloseOnHover": return $this->blnCloseOnHover;
            case "IconClasses": return $this->arrIconClasses;
            case "IconClass": return $this->strIconClass;
            case "PositionClass": return $this->strPositionClass;
            case "EscapeHtml": return $this->blnEscapeHtml;
            case "Target": return $this->strTarget;
            case "CloseHtml": return $this->strCloseHtml;
            case "CloseClass": return $this->strCloseClass;
            case "CloseButton": return $this->blnCloseButton;
            case "NewestOnTop": return $this->blnNewestOnTop;
            case "PreventDuplicates": return $this->blnPreventDuplicates;
            case "ProgressBar": return $this->blnProgressBar;
            case "ProgressClass": return $this->strProgressClass;
            case "RTL": return $this->blnRTL;

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
     * Magic method to set properties dynamically based on the property name.
     *
     * @param string $strName The name of the property to set.
     * @param mixed $mixValue The value to assign to the specified property.
     *
     * @return void
     *
     * @throws InvalidCast Throws an exception if the value provided cannot be cast to the expected type.
     * @throws Caller Throws an exception if the property name is invalid.
     */
    public function __set(string $strName, mixed $mixValue): void
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

            case 'Message':
                try {
                    $this->strMessage = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'Title':
                try {
                    $this->strTitle = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'TapToDismiss':
                try {
                    $this->blnTapToDismiss = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'ToastClass':
                try {
                    $this->strToastClass = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'ContainerId':
                try {
                    $this->strContainerId = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'Debug':
                try {
                    $this->blnDebug = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'ShowMethod':
                try {
                    $this->strShowMethod = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'HideMethod':
                try {
                    $this->strHideMethod = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'ShowDuration':
                try {
                    $this->intShowDuration = Type::cast($mixValue, Type::INTEGER);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'HideDuration':
                try {
                    $this->intHideDuration = Type::cast($mixValue, Type::INTEGER);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'TimeOut':
                try {
                    $this->intTimeOut = Type::cast($mixValue, Type::INTEGER);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'ExtendedTimeOut':
                try {
                    $this->intExtendedTimeOut = Type::cast($mixValue, Type::INTEGER);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'ShowEasing':
                try {
                    $this->strShowEasing = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'HideEasing':
                try {
                    $this->strHideEasing = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'CloseEasing':
                try {
                    $this->strCloseEasing = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'CloseOnHover':
                try {
                    $this->blnCloseOnHover = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'IconClasses':
                try {
                    $this->arrIconClasses = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'IconClass':
                try {
                    $this->strIconClass = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'PositionClass':
                try {
                    $this->strPositionClass = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'EscapeHtml':
                try {
                    $this->blnEscapeHtml = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'Target':
                try {
                    $this->strTarget = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'CloseHtml':
                try {
                    $this->strCloseHtml = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'CloseClass':
                try {
                    $this->strCloseClass = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'CloseButton':
                try {
                    $this->blnCloseButton = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'NewestOnTop':
                try {
                    $this->blnNewestOnTop = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'PreventDuplicates':
                try {
                    $this->blnPreventDuplicates = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'ProgressBar':
                try {
                    $this->blnProgressBar = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'ProgressClass':
                try {
                    $this->strProgressClass = Type::cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'RTL':
                try {
                    $this->blnRTL = Type::cast($mixValue, Type::BOOLEAN);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
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

