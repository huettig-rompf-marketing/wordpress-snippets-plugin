<div class="hur_management">
    <h1><?= __('Hüttig & Rompf Snippets - Settings', 'hur-snippets') ?></h1>
    <p><?= __('Change your default settings for the Hütting & Rompf Marketing Snippets.', 'hur-snippets') ?></p>
    <form class="hur_management__form" method="post">
        <div class="hur_form-group">
            <label><?= __('Snippet Type', 'hur-snippets') ?></label>
            <select name="snippetType">
                <?php foreach ($data['snippetTypes'] as $name => $value): ?>
                    <option value="<?= $value ?>" <?= $value === ($data['snippetType'] ?? null) ? 'selected="selected"' : '' ?>><?= $name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if(isset($data['errors']['snippetType'])): ?>
                <span class="hur_form-error"><?= $data['errors']['snippetType'] ?></span>
            <?php endif; ?>
        </div>
        <div class="hur_form-group">
            <label><?= __('Primary Color', 'hur-snippets') ?></label>
            <input name="primaryColor" type="color" value="<?= $data['primaryColor'] ?? null ?>">
            <?php if(isset($data['errors']['primaryColor'])): ?>
                <span class="hur_form-error"><?= $data['errors']['primaryColor'] ?></span>
            <?php endif; ?>
        </div>
        <div class="hur_form-group">
            <label><?= __('Secondary Color', 'hur-snippets') ?></label>
            <input name="secondaryColor" type="color" value="<?= $data['secondaryColor'] ?? null ?>">
            <?php if(isset($data['errors']['secondaryColor'])): ?>
                <span class="hur_form-error"><?= $data['errors']['secondaryColor'] ?></span>
            <?php endif; ?>
        </div>
        <div class="hur_form-group">
            <label><?= __('Customize Configuration', 'hur-snippets') ?></label>
            <textarea name="configuration"><?= $data['configuration'] ?? null ?></textarea>
            <?php if(isset($data['errors']['configuration'])): ?>
                <span class="hur_form-error"><?= $data['errors']['configuration'] ?></span>
            <?php endif; ?>
        </div>
        <h2 data-hide="hur_form-advanced">Advanced</h2>
        <div class="hur_form-advanced">
            <div class="hur_form-group">
                <label><?= __('Proxy URL', 'hur-snippets') ?> <small>(<a href="https://github.com/huettig-rompf-marketing/webhub-proxy" target="_blank" rel="noopener">GitHub</a>)</small></label>
                <input name="proxyUrl" type="url" value="<?= $data['proxyUrl'] ?? null ?>">
                <?php if(isset($data['errors']['proxyUrl'])): ?>
                    <span class="hur_form-error"><?= $data['errors']['proxyUrl'] ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="hur_form-group">
            <button type="submit" name="save" class="button button-primary"><?= __('Save') ?></button>
        </div>
    </form>
</div>
