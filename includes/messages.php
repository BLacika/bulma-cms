<?php if(isset($_SESSION["message"])): ?>
<div class="columns" id="message">
    <div class="column is-half is-offset-one-quarter">
        <div class="tile is-parent">
            <article class="tile is-child notification is-<?php echo $_SESSION["type"] ?>">
                <div class="content has-text-centered">
                    <p><?php echo $_SESSION["message"]; ?></p>
                    <?php 
                    unset($_SESSION["message"]);
                    unset($_SESSION["type"]);
                    ?>
                </div>
            </article>
        </div>
    </div>
</div>
<?php 
echo '<script type="text/javascript">',
            'showMessage();',
    '</script>';
?>
<?php endif; ?>