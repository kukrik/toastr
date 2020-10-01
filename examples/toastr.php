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

    protected function formCreate()
    {
        $this->btn1 = new Bs\Button($this);
        $this->btn1->addAction(new Q\Event\Click(), new Q\Action\Ajax('showToast_1'));
        $this->btn1->Text = " Show Toast 1";
        $this->btn1->SizeClass = Bs\Bootstrap::BUTTON_SMALL; //BUTTON_EXTRA_SMALL
        $this->btn1->CssClass = 'btn btn-default';
    }

    public function showToast_1($strFormId, $strControlId, $strParameter)
    {
        $this->toastr1 = new Q\Plugin\Toastr($this);
        $this->toastr1->AlertType = Q\Plugin\Toastr::TYPE_SUCCESS;
        $this->toastr1->Text = t('Have fun storming the castle!');
        $this->toastr1->Title = t('Miracle Max Says');
    }
}
ExamplesForm::Run('ExamplesForm');

