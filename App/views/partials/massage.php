<?php if (isset($_SESSION['success_message'])): ?>
    <div class="massage bg-100-green p-3 my-3"> <?php $_SESSION['success_message'] ?></div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif ?>
<?php if (isset($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <div class="massage bg-red-100 my-3"><?= $error ?></div>
    <?php endforeach; ?>
<?php endif; ?>