<select id='<?=$id?>' class='logaty-switcher'>
    <?php foreach ($this->app->enabled() as $lang) : ?>
        <option <?=($lang == logaty()->current() ? 'selected ': '')?>class='logaty-switcher__option' value='<?= $this->app->link('', $lang) ?>'>
            <?= $this->app->nameN($lang); ?>
        </option>
    <?php endforeach; ?>
</select>
<script>
    window['select_element_' + '<?=$id?>'] = document.getElementById('<?=$id?>');

    window['select_element_' + '<?=$id?>'].onchange = function () {
        let elem = (typeof this.selectedIndex === undefined ? window.event.srcElement : this);
        window.location.href = elem.value || elem.options[elem.selectedIndex].value;
    }
</script>
