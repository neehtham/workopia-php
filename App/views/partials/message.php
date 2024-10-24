<?php

use Framework\Session;

$success_message = Session::getFlashmessage('success_message'); ?>
<?php if ($success_message !== null): ?>
    <div class="massage bg-green-100 p-3 my-3">
        <?= $success_message ?>
    </div>
    <?php unset($success_message); ?>
<?php endif ?>

<?php $error_message = Session::getFlashmessage('error_message'); ?>
<?php if ($error_message !== null): ?>
    <div class="massage bg-red-100 p-3 my-3">
        <?= $error_message ?>
    </div>
    <?php unset($error_message); ?>
<?php endif ?>