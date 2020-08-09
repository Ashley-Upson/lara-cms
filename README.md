#lara-cms

<h2>Installation instructions</h2>
<p>Open up your Laravel application, or create a new one.</p>
<p>As there are currently no releases on git or composer, you need to add this repo into your composer.json file:</p>
<b>composer.json</b>
<br />
<code><pre>{
    "name": "laravel/laravel",
    ...
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ashley-upson/lara-cms"
        }
    ],
    ...
    
}</pre></code>

<p>Now that you've added the repo to your composer.json file, you can now go ahead and run <code>composer require ashley-upson/lara-cms</code> as normal.</p>

<p>If you wish to modify any of the packages configurations, this is the time to do so.</p>

<p>Pusblish the packages files using: <code>php artisan vendor:publish --provider="LaraCMS\CMSServiceProvider"</code> and then change the config/lara-cms.php file as you wish.</p>

<p>You will now need to run <code>php artisan migrate</code> to build the tables required to make the CMS work.</p>

<p>The CMS is now ready! Have fun coding!</p>