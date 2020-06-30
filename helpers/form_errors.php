<?php if(count($errors) > 0): ?>
<div class="tile is-parent">
    <article class="tile is-child notification is-danger">
        <div class="content has-text-centered">
            <?php foreach($errors as $error): ?>
                <p id="register-error-message"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    </article>
</div>
<?php endif; ?>