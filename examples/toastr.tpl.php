<?php

// https://stackoverflow.com/questions/16549885/how-do-i-implement-toastr-js
?>

<?php require(QCUBED_CONFIG_DIR . '/header.inc.php'); ?>

<style >
    body {font-size: 14px;}
    p, footer {font-size: medium;}
</style>
<?php $this->RenderBegin(); ?>

<section>
    <div class="instructions">
        <h1 class="instruction_title">The Toastr Control</h1>
        <p>Toastr is a Javascript library for non-blocking notifications. jQuery is required. The goal is to create a simple
        core library that can be customized and extended.</p>
        <p>Home page for the lib is <a href="https://github.com/CodeSeven/toastr">https://github.com/CodeSeven/toastr</a>
        and demo is at <a href="https://codeseven.github.io/toastr/demo.html">https://codeseven.github.io/toastr/demo.html</a>,
        where you can see example of use.</p>
        <p>The Toast can implement toasts as documented in the Toastr Javascript documentation.</p>
        <p>Here are some examples.</p>
    </div>
    <div style="margin: 25px 0px;">
        <?= _r($this->btn1); ?>
        <?= _r($this->btn2); ?>
        <?= _r($this->btn3); ?>
    </div>
</section>


<?php $this->RenderEnd(); ?>
<?php require(QCUBED_CONFIG_DIR . '/footer.inc.php'); ?>
