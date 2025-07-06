<?php
require('qcubed.inc.php');

use QCubed as Q;
use QCubed\Bootstrap as Bs;
use QCubed\Exception\Caller;
use QCubed\Project\Control\FormBase as Form;

class ExamplesForm extends Form
{
    protected Q\Plugin\Toastr $toastr1;
    protected Bs\Button $btn1;

    protected Q\Plugin\Toastr $toastr2;
    protected Bs\Button $btn2;

    protected Q\Plugin\Toastr $toastr3;
    protected Bs\Button $btn3;

    /**
     * Initializes the form by creating Toast notifications and buttons, setting their properties, and configuring actions.
     *
     * @return void
     * @throws Caller
     */
    protected function formCreate(): void
    {
        $this->toastr1 = new Q\Plugin\Toastr($this);
        $this->toastr1->AlertType = Q\Plugin\ToastrBase::TYPE_SUCCESS;
        $this->toastr1->PositionClass = Q\Plugin\ToastrBase::POSITION_TOP_CENTER;
        $this->toastr1->Title = t('Success');
        $this->toastr1->Message = t('<strong>Well done!</strong> The post has been saved or modified.');

        $this->toastr2 = new Q\Plugin\Toastr($this);
        $this->toastr2->AlertType = Q\Plugin\ToastrBase::TYPE_WARNING;
        $this->toastr2->PositionClass = Q\Plugin\ToastrBase::POSITION_TOP_FULL_WIDTH;
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
        $this->toastr3->AlertType = Q\Plugin\ToastrBase::TYPE_INFO;
        $this->toastr3->PositionClass = Q\Plugin\ToastrBase::POSITION_TOP_RIGHT;
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

    /**
     * Displays a toast notification using the toastr library.
     *
     * @param string $strFormId The ID of the form triggering the notification.
     * @param string $strControlId The ID of the control that interacts with the event.
     * @param mixed $strParameter Additional parameters for the notification.
     *
     * @return void The result of the toastr notification execution.
     */
    public function showToast_1(string $strFormId, string $strControlId, mixed $strParameter): void
    {
        $this->toastr1->notify();
    }

    public function showToast_2(string $strFormId, string $strControlId, mixed $strParameter): void
    {
        $this->toastr2->notify();
    }

    public function showToast_3(string $strFormId, string $strControlId, mixed $strParameter): void
    {
        $this->toastr3->notify();
    }
}
ExamplesForm::run('ExamplesForm');

