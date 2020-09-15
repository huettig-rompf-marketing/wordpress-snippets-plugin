<div class="hur_management">
    <h1><?= __('Hüttig & Rompf Snippets - Settings', 'hur-snippets') ?></h1>
    <form class="hur_management__form" method="post">
        <div class="hur_form-group">
            <label><?= __('Proxy URL', 'hur-snippets') ?> <small>(<?= __('Optional proxy to enhance your user\'s privacy. Has to be installed on your server, tho.', 'hur-snippets') ?>
                    <a href="https://github.com/huettig-rompf-marketing/webhub-proxy" target="_blank" rel="noopener"><?= __('Find the source on GitHub', 'hur-snippets') ?></a>)</small></label>
            <input name="proxyUrl" type="url" value="<?= $data['proxyUrl'] ?? null ?>">
            <?php if(isset($data['errors']['proxyUrl'])): ?>
                <span class="hur_form-error"><?= $data['errors']['proxyUrl'] ?></span>
            <?php endif; ?>
        </div>
        <div class="hur_form-group">
            <button type="submit" name="save" class="button button-primary"><?= __('Save', 'hur-snippets') ?></button>
        </div>
    </form>
</div>
