<ul class='logaty-switcher'>

    <?php foreach ( $this->app->enabled() as $lang ) : ?>
        <li class='logaty-switcher__li' data-value='<?=$lang?>'>
            <a href='<?=$this->app->link('', $lang)?>'>
                <img alt="<?=$lang?>" src='<?=$this->app->flag($lang)?>'>
                 <?=$this->app->nameN($lang);?>
            </a>
        </li>
    <?php endforeach; ?>

</ul>