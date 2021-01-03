<h1>ReactNative for Laravel</h1>
<small>Tested on Laravel 8</small>
<p>Use WebView Component technology for embeding your Blade & Tailwind views in a ReactNative App. Or a simple URL for a PWA project.</p>

<h3>Step 1</h3>
<pre><code>composer require quantical-solutions/reactnative</code></pre>
<h3>Step 2</h3>
<pre><code>sudo npm install -g expo-cli</code></pre>
<h3>Step 3</h3>
<pre><code>php artisan vendor:publish --tag=reactnative-support</code></pre>
<h3>Step 4</h3>
<pre><code>cd yourProject/ReactNative
npm install && npm run linker</code></pre>
<h3>Step 5</h3>
<pre><code># For general App launch
npm run start
# For Android preview
npm run android</code></pre>