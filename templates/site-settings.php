<?php /** @var array $data */ ?>
<div class="hur_management">
    <h1><?= __('Hüttig & Rompf Snippets - Settings', 'hur-snippets') ?></h1>
    <p class="content"><?= __('These are the default settings for the snippets you place on your site. To show a snippet you can simply add the <code>[hur_snippet]</code> short-code somewhere in your content. All settings you take here can be adjusted using the json definition in the short code. If you have a special reqest or need help, <a href="mailto:marketing@huettig-rompf.de">feel free to contact us directly</a>.', 'hur-snippets') ?></p>
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

        <div class="hur_form-group fieldToggle fieldToggle--default">
            <label><?= __('Primary Color', 'hur-snippets') ?></label>
            <input name="primaryColor" type="color" value="<?= $data['primaryColor'] ?? HUR_SNIPPETS_PRIMARY_COLOR ?>">
            <?php if(isset($data['errors']['primaryColor'])): ?>
                <span class="hur_form-error"><?= $data['errors']['primaryColor'] ?></span>
            <?php endif; ?>
        </div>

        <div class="hur_form-group fieldToggle fieldToggle--default">
            <label><?= __('Headline override', 'hur-snippets') ?></label>
            <input name="headline" type="text" value="<?= $data['headline'] ?? null ?>" placeholder="<?= __('Default: What does this real estate cost...', 'hur-snippets') ?>">
            <?php if(isset($data['errors']['headline'])): ?>
                <span class="hur_form-error"><?= $data['errors']['headline'] ?></span>
            <?php endif; ?>
        </div>

        <div class="hur_form-group fieldToggle fieldToggle--default">
            <label><?= __('Sub-Headline override', 'hur-snippets') ?></label>
            <input name="subHeadline" type="text" value="<?= $data['subHeadline'] ?? null ?>" placeholder="<?= __('Default: A service of...', 'hur-snippets') ?>">
            <?php if(isset($data['errors']['subHeadline'])): ?>
                <span class="hur_form-error"><?= $data['errors']['subHeadline'] ?></span>
            <?php endif; ?>
        </div>

        <div class="hur_form-group fieldToggle fieldToggle--default">
            <label><?= __('Static property price', 'hur-snippets') ?></label>
            <input name="propertyPrice" type="text" value="<?= $data['propertyPrice'] ?? null ?>" placeholder="<?= __('Default: The user can adjust the price', 'hur-snippets') ?>">
            <small><?= sprintf(__('You can also set this in your short code like so: %s', 'hur-snippets'), '<br><code>[hur_snippet property-price="125000.55"]</code>') ?></small>
            <?php if(isset($data['errors']['propertyPrice'])): ?>
                <span class="hur_form-error"><?= $data['errors']['propertyPrice'] ?></span>
            <?php endif; ?>
        </div>

        <div class="hur_form-group fieldToggle fieldToggle--default">
            <label><?= __('Property location zip', 'hur-snippets') ?></label> <small>(<?= __('Can be used to define the location for the property, so we can calculate with the correct tax rates.', 'hur-snippets') ?>)</small>
            <input name="propertyZip" type="text" value="<?= $data['propertyZip'] ?? null ?>">
            <small><?= sprintf(__('You can also set this in your short code like so: %s', 'hur-snippets'), '<br><code>[hur_snippet property-zip="60306"]</code>') ?></small>
            <?php if(isset($data['errors']['propertyZip'])): ?>
                <span class="hur_form-error"><?= $data['errors']['propertyZip'] ?></span>
            <?php endif; ?>
        </div>

        <div class="hur_form-group fieldToggle fieldToggle--default">
            <label><?= __('Show the Hüttig & Rompf logo', 'hur-snippets') ?></label>
            <select name="showLogo">
                <option value="1" <?= ($data['showLogo'] ?? '1') === '1' ? 'selected' : '' ?>><?= __('Yes', 'hur-snippets') ?></option>
                <option value="0" <?= ($data['showLogo'] ?? '1') === '0' ? 'selected' : '' ?>><?= __('No', 'hur-snippets') ?></option>
            </select>
        </div>

        <div class="hur_form-group fieldToggle fieldToggle--default">
            <label><?= __('Inherit website fonts', 'hur-snippets') ?></label>
            <select name="inheritFonts">
                <option value="0" <?= ($data['inheritFonts'] ?? '0') === '0' ? 'selected' : '' ?>><?= __('No', 'hur-snippets') ?></option>
                <option value="1" <?= ($data['inheritFonts'] ?? '0') === '1' ? 'selected' : '' ?>><?= __('Yes', 'hur-snippets') ?></option>
            </select>
        </div>


        <h2 data-hide="hur_form-advanced"><?= __('Advanced Configuration', 'hur-snippets') ?></h2>
        <div class="hur_form-advanced">
            <div class="hur_form-group">
                <label><?= __('JSON Configuration', 'hur-snippets') ?></label>
                <textarea name="configuration" rows="6"><?= $data['configuration'] ?? null ?></textarea>
                <?php if(isset($data['errors']['configuration'])): ?>
                    <span class="hur_form-error"><?= $data['errors']['configuration'] ?></span>
                <?php endif; ?>
            </div>

            <div class="hur_form-group">
                <label><?= __('Proxy URL', 'hur-snippets') ?> <small>(<?= __('Optional proxy to enhance your user\'s privacy. Has to be installed on your server, tho.', 'hur-snippets') ?>
                        <a href="https://github.com/huettig-rompf-marketing/webhub-proxy" target="_blank" rel="noopener"><?= __('Find the source on GitHub', 'hur-snippets') ?></a>)</small></label>
                <input name="proxyUrl" type="url" value="<?= $data['proxyUrl'] ?? null ?>" placeholder="<?= $data['network']['proxyUrl'] ?? null ?>">
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
