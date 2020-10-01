<?php require(QCUBED_CONFIG_DIR . '/header.inc.php'); ?>
<?php $this->RenderBegin(); ?>

<div class="instructions">
    <h1 class="instruction_title">The Toastr Control</h1>
    <p>Toastr is a Javascript library for non-blocking notifications. jQuery is required. The goal is to create a simple
        core library that can be customized and extended.</p>
    <p>Home page for the lib is <a href="https://github.com/CodeSeven/toastr">https://github.com/CodeSeven/toastr</a>
        and demo is at <a href="https://codeseven.github.io/toastr/demo.html">https://codeseven.github.io/toastr/demo.html</a>,
        where you can see example of use.</p>
</div>

<div > <!--style="display: inline-block; width: 50%; float: left;"-->
    <h3>First example</h3>
    <br /><br /><br /><br /><br />
    <?= _r($this->btn1); ?>
</div>


<?php $this->RenderEnd(); ?>
<?php require(QCUBED_CONFIG_DIR . '/footer.inc.php'); ?>
