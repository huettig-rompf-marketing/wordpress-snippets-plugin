<div class="hur_management">
    <h1><?= __('Hüttig & Rompf Snippets - Settings', 'hur-snippets') ?></h1>
    <form class="hur_management__form" method="post">
        <div class="hur_form-group">
            <label><?= __('Proxy URL', 'hur-snippets') ?> <small>(<a href="https://github.com/huettig-rompf-marketing/webhub-proxy" target="_blank" rel="noopener">GitHub</a>)</small></label>
            <input name="proxyUrl" type="url" value="<?= $data['proxyUrl'] ?? null ?>">
            <?php if(isset($data['errors']['proxyUrl'])): ?>
                <span class="hur_form-error"><?= $data['errors']['proxyUrl'] ?></span>
            <?php endif; ?>
        </div>
        <div class="hur_form-group">
            <button type="submit" name="save" class="button button-primary"><?= __('Save') ?></button>
        </div>
    </form>
</div>
