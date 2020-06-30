<div class="card mb-5">
    <header class="card-header">
        <p class="card-header-title">
        Categories
        </p>
    </header>
    <div class="card-content">
        <div class="content">
            <aside class="menu">
                <ul class="menu-list has-text-centered unstyle">
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="index.php?cat_id=<?php
                                echo $category['id'] . "&cat_title=" . $category['title']; 
                                ?>">
                            <?php echo $category['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </div>
</div>
