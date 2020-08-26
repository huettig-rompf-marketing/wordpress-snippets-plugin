# Hüttig & Rompf Snippets

This plugin helps you settings up customized Hüttig & Rompf Marketing Snippets.

## Description

This plugin let you easily configure the Hüttig & Rompf Marketing Snippets. You can set your preferred snippet type, colors
or even provide a custom configuration. With the help of a shortcode you can use your customized snippet where ever you
need it inside you page. You can also customize single shortcodes even further if required.

### Usage

#### Network

If you install the plugin inside your network you can only configure an overall proxy which will be used to get the
Hüttig & Rompf Marketing Snippets. This proxy can be useful if you want to reach GDPR compatibility. We also provide an
proxy library which you can checkout here.

#### Site

Inside a site you can configure your defaults for the snippets. Go to "Settings" -> "Hüttig & Rompf Snippet Settings".
Here you can set "Snippet Type", "Primary color", "Secondary color" and "Customize Configuration". If you are an advanced
user you can also provide your own proxy url for the snippets. If you are unsure just leave the "Proxy URL" as it is, everything
will work out of the box.

After configure your default snippet you can use it with the following shortcode `[hur-snippet]`. If you want to overwrite
the defaults you can provide custom JSON inside the content: `[hur-snippet]{"primaryColor": "#123456"}[/hur-snippet]`.
This will overwrite the `primaryColor` set inside your snippet settings. You can also provide additional data, which will
be append to the snippet: `[hur-snippet]{"additionalData": ["awesome", "things"]}[/hur-snippet]`.

## Installation

You can install this plugin in two ways:

Way 1: Sign into you wordpress installation, go to "Plugins" -> "Install" and search for this plugin.
Way 2: Download the latest version of this plugin on GitHub as ZIP, unzip and upload it manually to your plugins directory.
