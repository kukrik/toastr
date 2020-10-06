<?php
require('qcubed.inc.php');

use QCubed as Q;
use QCubed\Bootstrap as Bs;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase as Form;

class ExamplesForm extends Form
{
    protected $toastr1;
    protected $btn1;

    protected $toastr2;
    protected $btn2;

    protected $toastr3;
    protected $btn3;

    protected function formCreate()
    {
        $this->toastr1 = new Q\Plugin\Toastr($this);
        $this->toastr1->AlertType = Q\Plugin\Toastr::TYPE_SUCCESS;
        $this->toastr1->PositionClass = Q\Plugin\Toastr::POSITION_TOP_CENTER;
        $this->toastr1->Title = t('Success');
        $this->toastr1->Message = t('<strong>Well done!</strong> The post has been saved or modified.');

        $this->toastr2 = new Q\Plugin\Toastr($this);
        $this->toastr2->AlertType = Q\Plugin\Toastr::TYPE_WARNING;
        $this->toastr2->PositionClass = Q\Plugin\Toastr::POSITION_TOP_FULL_WIDTH;
        $this->toastr2->Title = t('Warning');
        $this->toastr2->Message = t('<strong>Sorry</strong>, the menu title is at least mandatory!');
        $this->toastr2->ProgressBar = true;
        $this->toastr2->TimeOut = 7000;

        /*$this->toastr2->IconClasses = json_encode(array(
            "error" => "alert-error",
            "info" => "alert-info",
            "success" => "alert-success",
            "warning" => "alert-warning"));*/

        $this->toastr3 = new Q\Plugin\Toastr($this);
        $this->toastr3->AlertType = Q\Plugin\Toastr::TYPE_INFO;
        $this->toastr3->PositionClass = Q\Plugin\Toastr::POSITION_TOP_RIGHT;
        $this->toastr3->Message = t('After the toast disappears, you can play through by clicking differently in order.');
        $this->toastr3->ProgressBar = true;
        $this->toastr3->TimeOut = 7000;

        $this->btn1 = new Bs\Button($this);
        $this->btn1->addAction(new Q\Event\Click(), new Q\Action\Ajax('showToast_1'));
        $this->btn1->Text = " Show Toast 1";
        $this->btn1->SizeClass = Bs\Bootstrap::BUTTON_MEDIUM;
        $this->btn1->StyleClass = Bs\Bootstrap::BUTTON_DEFAULT; //BUTTON_SUCCESS

        $this->btn2 = new Bs\Button($this);
        $this->btn2->addAction(new Q\Event\Click(), new Q\Action\Ajax('showToast_2'));
        $this->btn2->Text = " Show Toast 2";
        $this->btn2->SizeClass = Bs\Bootstrap::BUTTON_MEDIUM;
        $this->btn2->StyleClass = Bs\Bootstrap::BUTTON_DEFAULT; //BUTTON_WARNING

        $this->btn3 = new Bs\Button($this);
        $this->btn3->addAction(new Q\Event\Click(), new Q\Action\Ajax('showToast_3'));
        $this->btn3->Text = " Show Toast 3";
        $this->btn3->SizeClass = Bs\Bootstrap::BUTTON_MEDIUM; //BUTTON_EXTRA_SMALL
        $this->btn3->StyleClass = Bs\Bootstrap::BUTTON_DEFAULT;
    }

    public function showToast_1($strFormId, $strControlId, $strParameter)
    {
        return $this->toastr1->notify();
    }

    public function showToast_2($strFormId, $strControlId, $strParameter)
    {
        return $this->toastr2->notify();
    }

    public function showToast_3($strFormId, $strControlId, $strParameter)
    {
        return $this->toastr3->notify();
    }
}
ExamplesForm::Run('ExamplesForm');

