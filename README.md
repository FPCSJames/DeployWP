# DeployWP
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://fpcs.mit-license.org)

Deploy WordPress with (almost) just a shell script.

This script is somewhat tailored to our typical environment, but should work well on any reasonably high-quality shared host, VPS, or other environment with cPanel.

## Why not go fully wp-cli?
I've opted to keep as much of this install script as is sane usable with just a bare shell and PHP in case wp-cli can't be effectively installed in your environment. While it's unlikely that you'd be able to run this script and not be able to run wp-cli as well, there's always that edge case.

## Configuration
Basic server details live under the `# Config` comment.

* `basedir`: the base directory for new subdomains' public directories, relative to your home directory
* `cpaneluser`: your cPanel user account
* `cpanelpass` (optional): your cPanel password. Uncomment to supply the password in the script (beware the security implications) or keep as-is to be prompted each time.
* `rootdomain`: the domain under which subdomains will be created.
* `cpanelurl`: the complete URL to cPanel. Always use HTTPS port 2083. No exceptions.
* `nobanner` (optional): uncomment to remove the banner printed at the start of the script. Why would you want to do that?

The `# WP Prefs` comment denotes the start of WordPress-related items.

* `filestoremove`: keep in quotes and enter the relative path (from the base WP install directory) to files you wish to remove. **Double-check your entries here. _rm -rf is used._ Don't be an idiot.**
* `pluginstoadd`: one per line, add the WP plugin directory slug of plugins you want to be downloaded and installed automatically.
* `themetokeep`: choose one default theme to remain available, to keep things sane until you install your chosen theme.

The `# WP CLI` comment begins optional WP-CLI-driven config items.

* `havewpcli`: set to 1 to enable everything below. **Note: if you use Apache, make sure to set up WP-CLI to be aware of mod_rewrite. See [the docs](http://wp-cli.org/commands/rewrite/flush/).**
* `timezone`: your local time zone in [PHP format](http://php.net/manual/en/timezones.php).
* `commentstatus`: turn comments globally off by default with `closed` and on by default with `open`
* `pingstatus`: see above, but for pingbacks to you.
* `permalinks`: your desired [permalink structure](https://codex.wordpress.org/Using_Permalinks#Choosing_your_permalink_structure).

Under `# Custom functions` is a `customplugins` function where you can install the plugins of your choice by the method of your choice. As examples, the script downloads, unpacks, and removes the zips of [the community updated build of W3 Total Cache](https://github.com/szepeviktor/fix-w3tc), my UI-less [cleanup plugin](https://github.com/fpcsjames/wp-anti-detritus), and a [modified build](https://github.com/fpcsjames/authy-wordpress/) of the since-removed Authy plugin. There's also a `customwpcli` function to add extra WP-CLI commands - if you don't have WP-CLI enabled you can ignore its contents or clear them.

## bcrypt and you

This script installs the [Roots wp-password-bcrypt plugin](https://github.com/roots/wp-password-bcrypt) as a must-use plugin to ensure that even the initial admin user's password is even more securely hashed from the get-go. Please see the [Roots blog follow-up post](https://roots.io/wordpress-password-security-follow-up/) for more information on why bcrypt is probably preferable to WordPress's implementation of phpass. Is it 100% guaranteed necessary? No. Does it hurt to beef up the algorithm some? Nope. This implemention calls for PHP >= 5.5, but you should be there already, or looking for a host who supports it.

## Questions?

Questions? Comments? Send me an email at `james -at- flashpointcs -dot- net`. Please do not post issues for support; issues are for bug reports, feature requests, and suggestions for improvement only.

## License

> Copyright (c) 2016-2023 Flashpoint Computer Services, LLC <info@flashpointcs.net>
>
> Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
>
> The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
>
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
