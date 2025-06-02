<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Pescaderias Benito API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://fish_shop.test";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.0.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.0.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-categories-v2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="categories-v2">
                    <a href="#categories-v2">Categories V2</a>
                </li>
                                    <ul id="tocify-subheader-categories-v2" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="categories-v2-GETapi-v2-categories">
                                <a href="#categories-v2-GETapi-v2-categories">Get a list of all categories.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-v2-GETapi-v2-categories--category_id-">
                                <a href="#categories-v2-GETapi-v2-categories--category_id-">Get a specific category.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-v2-POSTapi-v2-categories">
                                <a href="#categories-v2-POSTapi-v2-categories">Store a new category.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-v2-PUTapi-v2-categories--category_id-">
                                <a href="#categories-v2-PUTapi-v2-categories--category_id-">Update an existing category.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-v2-DELETEapi-v2-categories--category_id-">
                                <a href="#categories-v2-DELETEapi-v2-categories--category_id-">Delete a specific category.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-fishes-v1" class="tocify-header">
                <li class="tocify-item level-1" data-unique="fishes-v1">
                    <a href="#fishes-v1">Fishes V1</a>
                </li>
                                    <ul id="tocify-subheader-fishes-v1" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="fishes-v1-GETapi-v1-fishes">
                                <a href="#fishes-v1-GETapi-v1-fishes">Get a list of all fishes.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fishes-v1-GETapi-v1-fishes--fish_id-">
                                <a href="#fishes-v1-GETapi-v1-fishes--fish_id-">Get a specific fish.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fishes-v1-POSTapi-v1-fishes">
                                <a href="#fishes-v1-POSTapi-v1-fishes">Store a new fish.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fishes-v1-PUTapi-v1-fishes--fish_id-">
                                <a href="#fishes-v1-PUTapi-v1-fishes--fish_id-">Update an existing fish.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fishes-v1-DELETEapi-v1-fishes--fish_id-">
                                <a href="#fishes-v1-DELETEapi-v1-fishes--fish_id-">Delete a specific fish.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-fishes-v2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="fishes-v2">
                    <a href="#fishes-v2">Fishes V2</a>
                </li>
                                    <ul id="tocify-subheader-fishes-v2" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="fishes-v2-GETapi-v2-fishes">
                                <a href="#fishes-v2-GETapi-v2-fishes">Get a list of all fishes.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fishes-v2-GETapi-v2-fishes--fish_id-">
                                <a href="#fishes-v2-GETapi-v2-fishes--fish_id-">Get a specific fish.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fishes-v2-POSTapi-v2-fishes">
                                <a href="#fishes-v2-POSTapi-v2-fishes">Store a new fish.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fishes-v2-PUTapi-v2-fishes--fish_id-">
                                <a href="#fishes-v2-PUTapi-v2-fishes--fish_id-">Update an existing fish.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fishes-v2-DELETEapi-v2-fishes--fish_id-">
                                <a href="#fishes-v2-DELETEapi-v2-fishes--fish_id-">Delete a specific fish.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-products-v2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="products-v2">
                    <a href="#products-v2">Products V2</a>
                </li>
                                    <ul id="tocify-subheader-products-v2" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="products-v2-GETapi-v2-products">
                                <a href="#products-v2-GETapi-v2-products">Get a list of all products.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-v2-GETapi-v2-products--product_id-">
                                <a href="#products-v2-GETapi-v2-products--product_id-">Get a specific product.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-v2-POSTapi-v2-products">
                                <a href="#products-v2-POSTapi-v2-products">Store a new product.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-v2-PUTapi-v2-products--product_id-">
                                <a href="#products-v2-PUTapi-v2-products--product_id-">Update an existing product.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-v2-DELETEapi-v2-products--product_id-">
                                <a href="#products-v2-DELETEapi-v2-products--product_id-">Delete a specific product.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-transactions-v2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="transactions-v2">
                    <a href="#transactions-v2">Transactions V2</a>
                </li>
                                    <ul id="tocify-subheader-transactions-v2" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="transactions-v2-GETapi-v2-transactions">
                                <a href="#transactions-v2-GETapi-v2-transactions">Get a list of all transactions.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="transactions-v2-POSTapi-v2-transactions">
                                <a href="#transactions-v2-POSTapi-v2-transactions">Store a new transaction.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="transactions-v2-GETapi-v2-transactions--id-">
                                <a href="#transactions-v2-GETapi-v2-transactions--id-">Get a specific transaction.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="transactions-v2-PUTapi-v2-transactions--id-">
                                <a href="#transactions-v2-PUTapi-v2-transactions--id-">Update an existing transaction.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="transactions-v2-DELETEapi-v2-transactions--id-">
                                <a href="#transactions-v2-DELETEapi-v2-transactions--id-">Delete a transaction.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: June 2, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://fish_shop.test</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="categories-v2">Categories V2</h1>

    

                                <h2 id="categories-v2-GETapi-v2-categories">Get a list of all categories.</h2>

<p>
</p>



<span id="example-requests-GETapi-v2-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v2/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v2-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Freshwater&quot;,
            &quot;display_name&quot;: &quot;Freshwater Fish&quot;,
            &quot;description&quot;: &quot;Fish that live in freshwater environments&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v2-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v2-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v2-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v2-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v2-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v2-categories" data-method="GET"
      data-path="api/v2/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v2-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v2-categories"
                    onclick="tryItOut('GETapi-v2-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v2-categories"
                    onclick="cancelTryOut('GETapi-v2-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v2-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v2/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v2-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v2-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="categories-v2-GETapi-v2-categories--category_id-">Get a specific category.</h2>

<p>
</p>



<span id="example-requests-GETapi-v2-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v2/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v2-categories--category_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;freshwater&quot;,
        &quot;display_name&quot;: &quot;Freshwater Fish&quot;,
        &quot;description&quot;: &quot;Fish that live in freshwater environments&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Category not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v2-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v2-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v2-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v2-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v2-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v2-categories--category_id-" data-method="GET"
      data-path="api/v2/categories/{category_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v2-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v2-categories--category_id-"
                    onclick="tryItOut('GETapi-v2-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v2-categories--category_id-"
                    onclick="cancelTryOut('GETapi-v2-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v2-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v2/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v2-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v2-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="GETapi-v2-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category"                data-endpoint="GETapi-v2-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="categories-v2-POSTapi-v2-categories">Store a new category.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v2-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://fish_shop.test/api/v2/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"freshwater\",
    \"display_name\": \"Freshwater Fish\",
    \"description\": \"Fish that live in freshwater environments\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "freshwater",
    "display_name": "Freshwater Fish",
    "description": "Fish that live in freshwater environments"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v2-categories">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;freshwater&quot;,
        &quot;display_name&quot;: &quot;Freshwater Fish&quot;,
        &quot;description&quot;: &quot;Fish that live in freshwater environments&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v2-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v2-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v2-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v2-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v2-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v2-categories" data-method="POST"
      data-path="api/v2/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v2-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v2-categories"
                    onclick="tryItOut('POSTapi-v2-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v2-categories"
                    onclick="cancelTryOut('POSTapi-v2-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v2-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v2/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v2-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v2-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v2-categories"
               value="freshwater"
               data-component="body">
    <br>
<p>The unique identifier of the category. Example: <code>freshwater</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>display_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="display_name"                data-endpoint="POSTapi-v2-categories"
               value="Freshwater Fish"
               data-component="body">
    <br>
<p>The display name of the category. Example: <code>Freshwater Fish</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v2-categories"
               value="Fish that live in freshwater environments"
               data-component="body">
    <br>
<p>The description of the category. Example: <code>Fish that live in freshwater environments</code></p>
        </div>
        </form>

                    <h2 id="categories-v2-PUTapi-v2-categories--category_id-">Update an existing category.</h2>

<p>
</p>



<span id="example-requests-PUTapi-v2-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://fish_shop.test/api/v2/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"display_name\": \"Freshwater Fish\",
    \"description\": \"Fish that live in freshwater environments\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "display_name": "Freshwater Fish",
    "description": "Fish that live in freshwater environments"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v2-categories--category_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;freshwater&quot;,
        &quot;display_name&quot;: &quot;Updated Freshwater Fish&quot;,
        &quot;description&quot;: &quot;Updated description&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Category not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v2-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v2-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v2-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v2-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v2-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v2-categories--category_id-" data-method="PUT"
      data-path="api/v2/categories/{category_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v2-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v2-categories--category_id-"
                    onclick="tryItOut('PUTapi-v2-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v2-categories--category_id-"
                    onclick="cancelTryOut('PUTapi-v2-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v2-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v2/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v2-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v2-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="PUTapi-v2-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category"                data-endpoint="PUTapi-v2-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v2-categories--category_id-"
               value="b"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>display_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="display_name"                data-endpoint="PUTapi-v2-categories--category_id-"
               value="Freshwater Fish"
               data-component="body">
    <br>
<p>The display name of the category. Example: <code>Freshwater Fish</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v2-categories--category_id-"
               value="Fish that live in freshwater environments"
               data-component="body">
    <br>
<p>The description of the category. Example: <code>Fish that live in freshwater environments</code></p>
        </div>
        </form>

                    <h2 id="categories-v2-DELETEapi-v2-categories--category_id-">Delete a specific category.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v2-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://fish_shop.test/api/v2/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v2-categories--category_id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Category not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v2-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v2-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v2-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v2-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v2-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v2-categories--category_id-" data-method="DELETE"
      data-path="api/v2/categories/{category_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v2-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v2-categories--category_id-"
                    onclick="tryItOut('DELETEapi-v2-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v2-categories--category_id-"
                    onclick="cancelTryOut('DELETEapi-v2-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v2-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v2/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v2-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v2-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="DELETEapi-v2-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category"                data-endpoint="DELETEapi-v2-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="fishes-v1">Fishes V1</h1>

    

                                <h2 id="fishes-v1-GETapi-v1-fishes">Get a list of all fishes.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-fishes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v1/fishes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v1/fishes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fishes">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Salmon&quot;,
            &quot;image&quot;: &quot;https://via.placeholder.com/640x480.png/007777?text=sint&quot;,
            &quot;type&quot;: [
                &quot;Freshwater&quot;
            ],
            &quot;description&quot;: &quot;Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore.&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fishes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fishes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fishes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fishes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fishes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fishes" data-method="GET"
      data-path="api/v1/fishes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fishes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fishes"
                    onclick="tryItOut('GETapi-v1-fishes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fishes"
                    onclick="cancelTryOut('GETapi-v1-fishes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fishes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fishes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fishes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fishes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="fishes-v1-GETapi-v1-fishes--fish_id-">Get a specific fish.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-fishes--fish_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v1/fishes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v1/fishes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fishes--fish_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;name&quot;: &quot;Salmon&quot;,
    &quot;image&quot;: &quot;https://via.placeholder.com/640x480.png/007777?text=sint&quot;,
    &quot;type&quot;: [
        &quot;Freshwater&quot;
    ],
    &quot;description&quot;: &quot;Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fishes--fish_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fishes--fish_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fishes--fish_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fishes--fish_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fishes--fish_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fishes--fish_id-" data-method="GET"
      data-path="api/v1/fishes/{fish_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fishes--fish_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fishes--fish_id-"
                    onclick="tryItOut('GETapi-v1-fishes--fish_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fishes--fish_id-"
                    onclick="cancelTryOut('GETapi-v1-fishes--fish_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fishes--fish_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fishes/{fish_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish_id"                data-endpoint="GETapi-v1-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish"                data-endpoint="GETapi-v1-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="fishes-v1-POSTapi-v1-fishes">Store a new fish.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-fishes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://fish_shop.test/api/v1/fishes" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=Salmon"\
    --form "scientific_name=n"\
    --form "description=Eius et animi quos velit et."\
    --form "average_size_cm=1"\
    --form "diet=Carnivore"\
    --form "lifespan_years=42"\
    --form "habitat=l"\
    --form "conservation_status=j"\
    --form "type=Freshwater"\
    --form "characteristics[state]=Allowed"\
    --form "characteristics[temperature_range]=b"\
    --form "characteristics[ph_range]=n"\
    --form "characteristics[salinity]=0"\
    --form "characteristics[oxygen_level]=1"\
    --form "characteristics[migration_pattern]=Anadromous"\
    --form "characteristics[recorded_since]=17"\
    --form "characteristics[notes]=architecto"\
    --form "price=10.5"\
    --form "image=@C:\Users\gines\AppData\Local\Temp\php1E29.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v1/fishes"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'Salmon');
body.append('scientific_name', 'n');
body.append('description', 'Eius et animi quos velit et.');
body.append('average_size_cm', '1');
body.append('diet', 'Carnivore');
body.append('lifespan_years', '42');
body.append('habitat', 'l');
body.append('conservation_status', 'j');
body.append('type', 'Freshwater');
body.append('characteristics[state]', 'Allowed');
body.append('characteristics[temperature_range]', 'b');
body.append('characteristics[ph_range]', 'n');
body.append('characteristics[salinity]', '0');
body.append('characteristics[oxygen_level]', '1');
body.append('characteristics[migration_pattern]', 'Anadromous');
body.append('characteristics[recorded_since]', '17');
body.append('characteristics[notes]', 'architecto');
body.append('price', '10.5');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-fishes">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;name&quot;: &quot;Salmon&quot;,
    &quot;image&quot;: &quot;https://via.placeholder.com/640x480.png/007777?text=sint&quot;,
    &quot;type&quot;: [
        &quot;Freshwater&quot;
    ],
    &quot;description&quot;: &quot;Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-fishes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-fishes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-fishes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-fishes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-fishes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-fishes" data-method="POST"
      data-path="api/v1/fishes"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-fishes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-fishes"
                    onclick="tryItOut('POSTapi-v1-fishes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-fishes"
                    onclick="cancelTryOut('POSTapi-v1-fishes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-fishes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/fishes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-fishes"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-fishes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-fishes"
               value="Salmon"
               data-component="body">
    <br>
<p>The name of the fish. Example: <code>Salmon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>scientific_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="scientific_name"                data-endpoint="POSTapi-v1-fishes"
               value="n"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-v1-fishes"
               value=""
               data-component="body">
    <br>
<p>El campo value debe ser una imagen. El campo value no debe ser mayor que 2048 kilobytes. Example: <code>C:\Users\gines\AppData\Local\Temp\php1E29.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-fishes"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>average_size_cm</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="average_size_cm"                data-endpoint="POSTapi-v1-fishes"
               value="1"
               data-component="body">
    <br>
<p>El campo value tiene que estar entre 0 - 1000. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diet</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diet"                data-endpoint="POSTapi-v1-fishes"
               value="Carnivore"
               data-component="body">
    <br>
<p>Example: <code>Carnivore</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Carnivore</code></li> <li><code>Herbivore</code></li> <li><code>Omnivore</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lifespan_years</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="lifespan_years"                data-endpoint="POSTapi-v1-fishes"
               value="42"
               data-component="body">
    <br>
<p>El tamaño de value debe ser de al menos 0. Example: <code>42</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>habitat</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="habitat"                data-endpoint="POSTapi-v1-fishes"
               value="l"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>l</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>conservation_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="conservation_status"                data-endpoint="POSTapi-v1-fishes"
               value="j"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>j</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-v1-fishes"
               value="Freshwater"
               data-component="body">
    <br>
<p>The type of the fish. Example: <code>Freshwater</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>characteristics</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.state"                data-endpoint="POSTapi-v1-fishes"
               value="Allowed"
               data-component="body">
    <br>
<p>Example: <code>Allowed</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Allowed</code></li> <li><code>Forbidden</code></li> <li><code>Biological rest</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>temperature_range</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.temperature_range"                data-endpoint="POSTapi-v1-fishes"
               value="b"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>b</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>ph_range</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.ph_range"                data-endpoint="POSTapi-v1-fishes"
               value="n"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>n</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>salinity</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="characteristics.salinity"                data-endpoint="POSTapi-v1-fishes"
               value="0"
               data-component="body">
    <br>
<p>El campo value tiene que estar entre 0 - 100. Example: <code>0</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>oxygen_level</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="characteristics.oxygen_level"                data-endpoint="POSTapi-v1-fishes"
               value="1"
               data-component="body">
    <br>
<p>El campo value tiene que estar entre 0 - 100. Example: <code>1</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>migration_pattern</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.migration_pattern"                data-endpoint="POSTapi-v1-fishes"
               value="Anadromous"
               data-component="body">
    <br>
<p>Example: <code>Anadromous</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Non-migratory</code></li> <li><code>Anadromous</code></li> <li><code>Catadromous</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>recorded_since</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="characteristics.recorded_since"                data-endpoint="POSTapi-v1-fishes"
               value="17"
               data-component="body">
    <br>
<p>El tamaño de value debe ser de al menos 1900. El campo value no debe ser mayor que 2025. Example: <code>17</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.notes"                data-endpoint="POSTapi-v1-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-v1-fishes"
               value="10.5"
               data-component="body">
    <br>
<p>The price of the fish. Example: <code>10.5</code></p>
        </div>
        </form>

                    <h2 id="fishes-v1-PUTapi-v1-fishes--fish_id-">Update an existing fish.</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-fishes--fish_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://fish_shop.test/api/v1/fishes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Salmon\",
    \"scientific_name\": \"n\",
    \"description\": \"Eius et animi quos velit et.\",
    \"average_size_cm\": 1,
    \"diet\": \"Carnivore\",
    \"lifespan_years\": 42,
    \"habitat\": \"l\",
    \"conservation_status\": \"j\",
    \"type\": \"Freshwater\",
    \"characteristics\": {
        \"state\": \"Forbidden\",
        \"temperature_range\": \"b\",
        \"ph_range\": \"n\",
        \"salinity\": 0,
        \"oxygen_level\": 1,
        \"migration_pattern\": \"Non-migratory\",
        \"recorded_since\": 17,
        \"notes\": \"architecto\"
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v1/fishes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Salmon",
    "scientific_name": "n",
    "description": "Eius et animi quos velit et.",
    "average_size_cm": 1,
    "diet": "Carnivore",
    "lifespan_years": 42,
    "habitat": "l",
    "conservation_status": "j",
    "type": "Freshwater",
    "characteristics": {
        "state": "Forbidden",
        "temperature_range": "b",
        "ph_range": "n",
        "salinity": 0,
        "oxygen_level": 1,
        "migration_pattern": "Non-migratory",
        "recorded_since": 17,
        "notes": "architecto"
    }
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-fishes--fish_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;name&quot;: &quot;Updated Salmon&quot;,
    &quot;image&quot;: &quot;https://via.placeholder.com/640x480.png/007777?text=sint&quot;,
    &quot;type&quot;: [
        &quot;Freshwater&quot;
    ],
    &quot;description&quot;: &quot;Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-fishes--fish_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-fishes--fish_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-fishes--fish_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-fishes--fish_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-fishes--fish_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-fishes--fish_id-" data-method="PUT"
      data-path="api/v1/fishes/{fish_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-fishes--fish_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-fishes--fish_id-"
                    onclick="tryItOut('PUTapi-v1-fishes--fish_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-fishes--fish_id-"
                    onclick="cancelTryOut('PUTapi-v1-fishes--fish_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-fishes--fish_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/fishes/{fish_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish_id"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="Salmon"
               data-component="body">
    <br>
<p>The name of the fish. Example: <code>Salmon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>scientific_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="scientific_name"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="n"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="image"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>average_size_cm</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="average_size_cm"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="1"
               data-component="body">
    <br>
<p>El campo value tiene que estar entre 0 - 1000. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diet</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diet"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="Carnivore"
               data-component="body">
    <br>
<p>Example: <code>Carnivore</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Carnivore</code></li> <li><code>Herbivore</code></li> <li><code>Omnivore</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lifespan_years</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="lifespan_years"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="42"
               data-component="body">
    <br>
<p>El tamaño de value debe ser de al menos 0. Example: <code>42</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>habitat</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="habitat"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="l"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>l</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>conservation_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="conservation_status"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="j"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>j</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="Freshwater"
               data-component="body">
    <br>
<p>The type of the fish. Example: <code>Freshwater</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>characteristics</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.state"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="Forbidden"
               data-component="body">
    <br>
<p>Example: <code>Forbidden</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Allowed</code></li> <li><code>Forbidden</code></li> <li><code>Biological rest</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>temperature_range</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.temperature_range"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="b"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>b</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>ph_range</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.ph_range"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="n"
               data-component="body">
    <br>
<p>El campo value no debe ser mayor que 255 caracteres. Example: <code>n</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>salinity</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="characteristics.salinity"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="0"
               data-component="body">
    <br>
<p>El campo value tiene que estar entre 0 - 100. Example: <code>0</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>oxygen_level</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="characteristics.oxygen_level"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="1"
               data-component="body">
    <br>
<p>El campo value tiene que estar entre 0 - 100. Example: <code>1</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>migration_pattern</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.migration_pattern"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="Non-migratory"
               data-component="body">
    <br>
<p>Example: <code>Non-migratory</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Non-migratory</code></li> <li><code>Anadromous</code></li> <li><code>Catadromous</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>recorded_since</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="characteristics.recorded_since"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="17"
               data-component="body">
    <br>
<p>El tamaño de value debe ser de al menos 1900. El campo value no debe ser mayor que 2025. Example: <code>17</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.notes"                data-endpoint="PUTapi-v1-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="fishes-v1-DELETEapi-v1-fishes--fish_id-">Delete a specific fish.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-fishes--fish_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://fish_shop.test/api/v1/fishes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v1/fishes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-fishes--fish_id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-fishes--fish_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-fishes--fish_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-fishes--fish_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-fishes--fish_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-fishes--fish_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-fishes--fish_id-" data-method="DELETE"
      data-path="api/v1/fishes/{fish_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-fishes--fish_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-fishes--fish_id-"
                    onclick="tryItOut('DELETEapi-v1-fishes--fish_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-fishes--fish_id-"
                    onclick="cancelTryOut('DELETEapi-v1-fishes--fish_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-fishes--fish_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/fishes/{fish_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish_id"                data-endpoint="DELETEapi-v1-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish"                data-endpoint="DELETEapi-v1-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="fishes-v2">Fishes V2</h1>

    

                                <h2 id="fishes-v2-GETapi-v2-fishes">Get a list of all fishes.</h2>

<p>
</p>



<span id="example-requests-GETapi-v2-fishes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v2/fishes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/fishes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v2-fishes">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Salmon&quot;,
            &quot;scientific_name&quot;: &quot;Salmo salar&quot;,
            &quot;image&quot;: &quot;https://via.placeholder.com/640x480.png/007777?text=sint&quot;,
            &quot;description&quot;: &quot;Et consectetur nisi excepturi esse aut.&quot;,
            &quot;average_size_cm&quot;: 75.5,
            &quot;diet&quot;: &quot;Carnivore&quot;,
            &quot;lifespan_years&quot;: 7,
            &quot;habitat&quot;: &quot;Rivers and Oceans&quot;,
            &quot;conservation_status&quot;: &quot;Least Concern&quot;,
            &quot;type&quot;: [
                &quot;Freshwater&quot;,
                &quot;Saltwater&quot;
            ],
            &quot;characteristics&quot;: {
                &quot;state&quot;: &quot;Allowed&quot;,
                &quot;temperature_range&quot;: &quot;20-25&deg;C&quot;,
                &quot;ph_range&quot;: &quot;7.0-8.0&quot;,
                &quot;salinity&quot;: 1.03,
                &quot;oxygen_level&quot;: 5.94,
                &quot;migration_pattern&quot;: &quot;Anadromous&quot;,
                &quot;recorded_since&quot;: 1990,
                &quot;notes&quot;: &quot;Quo illo facere odio et sed.&quot;
            },
            &quot;water_type_details&quot;: {
                &quot;type&quot;: &quot;Freshwater&quot;,
                &quot;ph_level&quot;: 7.2,
                &quot;temperature_range&quot;: &quot;10-25&deg;C&quot;,
                &quot;salinity_level&quot;: 0.05,
                &quot;region&quot;: &quot;Rivers, Lakes, Ponds&quot;,
                &quot;description&quot;: &quot;Water with low salt concentration&quot;
            },
            &quot;created_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v2-fishes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v2-fishes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v2-fishes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v2-fishes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v2-fishes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v2-fishes" data-method="GET"
      data-path="api/v2/fishes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v2-fishes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v2-fishes"
                    onclick="tryItOut('GETapi-v2-fishes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v2-fishes"
                    onclick="cancelTryOut('GETapi-v2-fishes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v2-fishes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v2/fishes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v2-fishes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v2-fishes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="fishes-v2-GETapi-v2-fishes--fish_id-">Get a specific fish.</h2>

<p>
</p>



<span id="example-requests-GETapi-v2-fishes--fish_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v2/fishes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/fishes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v2-fishes--fish_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Salmon&quot;,
        &quot;scientific_name&quot;: &quot;Salmo salar&quot;,
        &quot;image&quot;: &quot;https://via.placeholder.com/640x480.png/007777?text=sint&quot;,
        &quot;description&quot;: &quot;Et consectetur nisi excepturi esse aut.&quot;,
        &quot;average_size_cm&quot;: 75.5,
        &quot;diet&quot;: &quot;Carnivore&quot;,
        &quot;lifespan_years&quot;: 7,
        &quot;habitat&quot;: &quot;Rivers and Oceans&quot;,
        &quot;conservation_status&quot;: &quot;Least Concern&quot;,
        &quot;type&quot;: [
            &quot;Freshwater&quot;,
            &quot;Saltwater&quot;
        ],
        &quot;characteristics&quot;: {
            &quot;state&quot;: &quot;Allowed&quot;,
            &quot;temperature_range&quot;: &quot;20-25&deg;C&quot;,
            &quot;ph_range&quot;: &quot;7.0-8.0&quot;,
            &quot;salinity&quot;: 1.03,
            &quot;oxygen_level&quot;: 5.94,
            &quot;migration_pattern&quot;: &quot;Anadromous&quot;,
            &quot;recorded_since&quot;: 1990,
            &quot;notes&quot;: &quot;Quo illo facere odio et sed.&quot;
        },
        &quot;water_type_details&quot;: {
            &quot;type&quot;: &quot;Freshwater&quot;,
            &quot;ph_level&quot;: 7.2,
            &quot;temperature_range&quot;: &quot;10-25&deg;C&quot;,
            &quot;salinity_level&quot;: 0.05,
            &quot;region&quot;: &quot;Rivers, Lakes, Ponds&quot;,
            &quot;description&quot;: &quot;Water with low salt concentration&quot;
        },
        &quot;created_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v2-fishes--fish_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v2-fishes--fish_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v2-fishes--fish_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v2-fishes--fish_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v2-fishes--fish_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v2-fishes--fish_id-" data-method="GET"
      data-path="api/v2/fishes/{fish_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v2-fishes--fish_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v2-fishes--fish_id-"
                    onclick="tryItOut('GETapi-v2-fishes--fish_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v2-fishes--fish_id-"
                    onclick="cancelTryOut('GETapi-v2-fishes--fish_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v2-fishes--fish_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v2/fishes/{fish_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v2-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v2-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish_id"                data-endpoint="GETapi-v2-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish"                data-endpoint="GETapi-v2-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="fishes-v2-POSTapi-v2-fishes">Store a new fish.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v2-fishes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://fish_shop.test/api/v2/fishes" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=Salmon"\
    --form "scientific_name=Salmo salar"\
    --form "description=Eius et animi quos velit et."\
    --form "average_size_cm=architecto"\
    --form "diet=architecto"\
    --form "lifespan_years=16"\
    --form "habitat=architecto"\
    --form "conservation_status=architecto"\
    --form "type=architecto"\
    --form "characteristics[]=architecto"\
    --form "image=@C:\Users\gines\AppData\Local\Temp\php1E8A.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/fishes"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'Salmon');
body.append('scientific_name', 'Salmo salar');
body.append('description', 'Eius et animi quos velit et.');
body.append('average_size_cm', 'architecto');
body.append('diet', 'architecto');
body.append('lifespan_years', '16');
body.append('habitat', 'architecto');
body.append('conservation_status', 'architecto');
body.append('type', 'architecto');
body.append('characteristics[]', 'architecto');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v2-fishes">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Salmon&quot;,
        &quot;scientific_name&quot;: &quot;Salmo salar&quot;,
        &quot;image&quot;: &quot;https://via.placeholder.com/640x480.png/007777?text=sint&quot;,
        &quot;description&quot;: &quot;Et consectetur nisi excepturi esse aut.&quot;,
        &quot;average_size_cm&quot;: 75.5,
        &quot;diet&quot;: &quot;Carnivore&quot;,
        &quot;lifespan_years&quot;: 7,
        &quot;habitat&quot;: &quot;Rivers and Oceans&quot;,
        &quot;conservation_status&quot;: &quot;Least Concern&quot;,
        &quot;type&quot;: [
            &quot;Freshwater&quot;,
            &quot;Saltwater&quot;
        ],
        &quot;characteristics&quot;: {
            &quot;state&quot;: &quot;Allowed&quot;,
            &quot;temperature_range&quot;: &quot;20-25&deg;C&quot;,
            &quot;ph_range&quot;: &quot;7.0-8.0&quot;,
            &quot;salinity&quot;: 1.03,
            &quot;oxygen_level&quot;: 5.94,
            &quot;migration_pattern&quot;: &quot;Anadromous&quot;,
            &quot;recorded_since&quot;: 1990,
            &quot;notes&quot;: &quot;Quo illo facere odio et sed.&quot;
        },
        &quot;water_type_details&quot;: {
            &quot;type&quot;: &quot;Freshwater&quot;,
            &quot;ph_level&quot;: 7.2,
            &quot;temperature_range&quot;: &quot;10-25&deg;C&quot;,
            &quot;salinity_level&quot;: 0.05,
            &quot;region&quot;: &quot;Rivers, Lakes, Ponds&quot;,
            &quot;description&quot;: &quot;Water with low salt concentration&quot;
        },
        &quot;created_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v2-fishes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v2-fishes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v2-fishes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v2-fishes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v2-fishes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v2-fishes" data-method="POST"
      data-path="api/v2/fishes"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v2-fishes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v2-fishes"
                    onclick="tryItOut('POSTapi-v2-fishes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v2-fishes"
                    onclick="cancelTryOut('POSTapi-v2-fishes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v2-fishes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v2/fishes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v2-fishes"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v2-fishes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v2-fishes"
               value="Salmon"
               data-component="body">
    <br>
<p>The name of the fish. Example: <code>Salmon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>scientific_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="scientific_name"                data-endpoint="POSTapi-v2-fishes"
               value="Salmo salar"
               data-component="body">
    <br>
<p>The scientific name of the fish. Example: <code>Salmo salar</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-v2-fishes"
               value=""
               data-component="body">
    <br>
<p>The image of the fish. Example: <code>C:\Users\gines\AppData\Local\Temp\php1E8A.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v2-fishes"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>A description of the fish. Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>average_size_cm</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="average_size_cm"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The average size in centimeters. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diet</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diet"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The diet type (Carnivore, Herbivore, Omnivore). Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lifespan_years</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="lifespan_years"                data-endpoint="POSTapi-v2-fishes"
               value="16"
               data-component="body">
    <br>
<p>The lifespan in years. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>habitat</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="habitat"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The natural habitat. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>conservation_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="conservation_status"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The conservation status. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The type of water (Saltwater, Freshwater). Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>characteristics</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
<br>
<p>The water characteristics.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.state"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The state (Allowed, Forbidden, Biological rest). Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>temperature_range</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.temperature_range"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The temperature range. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>ph_range</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.ph_range"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The pH range. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>salinity</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.salinity"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The salinity level. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>oxygen_level</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.oxygen_level"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The oxygen level. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>migration_pattern</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.migration_pattern"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>The migration pattern. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>recorded_since</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="characteristics.recorded_since"                data-endpoint="POSTapi-v2-fishes"
               value="16"
               data-component="body">
    <br>
<p>The year recorded since. Example: <code>16</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.notes"                data-endpoint="POSTapi-v2-fishes"
               value="architecto"
               data-component="body">
    <br>
<p>Additional notes. Example: <code>architecto</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="fishes-v2-PUTapi-v2-fishes--fish_id-">Update an existing fish.</h2>

<p>
</p>



<span id="example-requests-PUTapi-v2-fishes--fish_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://fish_shop.test/api/v2/fishes/1" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=Salmon"\
    --form "scientific_name=Salmo salar"\
    --form "description=Eius et animi quos velit et."\
    --form "average_size_cm=architecto"\
    --form "diet=architecto"\
    --form "lifespan_years=16"\
    --form "habitat=architecto"\
    --form "conservation_status=architecto"\
    --form "type=architecto"\
    --form "characteristics[]=architecto"\
    --form "image=@C:\Users\gines\AppData\Local\Temp\php1EAB.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/fishes/1"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'Salmon');
body.append('scientific_name', 'Salmo salar');
body.append('description', 'Eius et animi quos velit et.');
body.append('average_size_cm', 'architecto');
body.append('diet', 'architecto');
body.append('lifespan_years', '16');
body.append('habitat', 'architecto');
body.append('conservation_status', 'architecto');
body.append('type', 'architecto');
body.append('characteristics[]', 'architecto');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v2-fishes--fish_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Updated Salmon&quot;,
        &quot;scientific_name&quot;: &quot;Salmo salar&quot;,
        &quot;image&quot;: &quot;https://via.placeholder.com/640x480.png/007777?text=sint&quot;,
        &quot;description&quot;: &quot;Updated description&quot;,
        &quot;average_size_cm&quot;: 80,
        &quot;diet&quot;: &quot;Carnivore&quot;,
        &quot;lifespan_years&quot;: 8,
        &quot;habitat&quot;: &quot;Updated habitat&quot;,
        &quot;conservation_status&quot;: &quot;Least Concern&quot;,
        &quot;type&quot;: [
            &quot;Freshwater&quot;,
            &quot;Saltwater&quot;
        ],
        &quot;characteristics&quot;: {
            &quot;state&quot;: &quot;Allowed&quot;,
            &quot;temperature_range&quot;: &quot;22-28&deg;C&quot;,
            &quot;ph_range&quot;: &quot;7.2-8.0&quot;,
            &quot;salinity&quot;: 1.02,
            &quot;oxygen_level&quot;: 6,
            &quot;migration_pattern&quot;: &quot;Anadromous&quot;,
            &quot;recorded_since&quot;: 1990,
            &quot;notes&quot;: &quot;Updated notes&quot;
        },
        &quot;water_type_details&quot;: {
            &quot;type&quot;: &quot;Freshwater&quot;,
            &quot;ph_level&quot;: 7.2,
            &quot;temperature_range&quot;: &quot;10-25&deg;C&quot;,
            &quot;salinity_level&quot;: 0.05,
            &quot;region&quot;: &quot;Rivers, Lakes, Ponds&quot;,
            &quot;description&quot;: &quot;Water with low salt concentration&quot;
        },
        &quot;created_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v2-fishes--fish_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v2-fishes--fish_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v2-fishes--fish_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v2-fishes--fish_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v2-fishes--fish_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v2-fishes--fish_id-" data-method="PUT"
      data-path="api/v2/fishes/{fish_id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v2-fishes--fish_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v2-fishes--fish_id-"
                    onclick="tryItOut('PUTapi-v2-fishes--fish_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v2-fishes--fish_id-"
                    onclick="cancelTryOut('PUTapi-v2-fishes--fish_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v2-fishes--fish_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v2/fishes/{fish_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish_id"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="Salmon"
               data-component="body">
    <br>
<p>The name of the fish. Example: <code>Salmon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>scientific_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="scientific_name"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="Salmo salar"
               data-component="body">
    <br>
<p>The scientific name of the fish. Example: <code>Salmo salar</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value=""
               data-component="body">
    <br>
<p>The image of the fish. Example: <code>C:\Users\gines\AppData\Local\Temp\php1EAB.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>A description of the fish. Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>average_size_cm</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="average_size_cm"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The average size in centimeters. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diet</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diet"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The diet type (Carnivore, Herbivore, Omnivore). Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lifespan_years</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="lifespan_years"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="16"
               data-component="body">
    <br>
<p>The lifespan in years. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>habitat</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="habitat"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The natural habitat. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>conservation_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="conservation_status"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The conservation status. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The type of water (Saltwater, Freshwater). Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>characteristics</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
<br>
<p>The water characteristics.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.state"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The state (Allowed, Forbidden, Biological rest). Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>temperature_range</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.temperature_range"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The temperature range. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>ph_range</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.ph_range"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The pH range. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>salinity</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.salinity"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The salinity level. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>oxygen_level</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.oxygen_level"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The oxygen level. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>migration_pattern</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.migration_pattern"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The migration pattern. Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>recorded_since</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="characteristics.recorded_since"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="16"
               data-component="body">
    <br>
<p>The year recorded since. Example: <code>16</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="characteristics.notes"                data-endpoint="PUTapi-v2-fishes--fish_id-"
               value="architecto"
               data-component="body">
    <br>
<p>Additional notes. Example: <code>architecto</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="fishes-v2-DELETEapi-v2-fishes--fish_id-">Delete a specific fish.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v2-fishes--fish_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://fish_shop.test/api/v2/fishes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/fishes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v2-fishes--fish_id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v2-fishes--fish_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v2-fishes--fish_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v2-fishes--fish_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v2-fishes--fish_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v2-fishes--fish_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v2-fishes--fish_id-" data-method="DELETE"
      data-path="api/v2/fishes/{fish_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v2-fishes--fish_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v2-fishes--fish_id-"
                    onclick="tryItOut('DELETEapi-v2-fishes--fish_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v2-fishes--fish_id-"
                    onclick="cancelTryOut('DELETEapi-v2-fishes--fish_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v2-fishes--fish_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v2/fishes/{fish_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v2-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v2-fishes--fish_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish_id"                data-endpoint="DELETEapi-v2-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fish</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fish"                data-endpoint="DELETEapi-v2-fishes--fish_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fish. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="products-v2">Products V2</h1>

    

                                <h2 id="products-v2-GETapi-v2-products">Get a list of all products.</h2>

<p>
</p>



<span id="example-requests-GETapi-v2-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v2/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/products"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v2-products">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Salmon&quot;,
            &quot;description&quot;: &quot;Fresh salmon&quot;,
            &quot;price&quot;: 19.99,
            &quot;stock&quot;: 100,
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;freshwater&quot;,
                &quot;display_name&quot;: &quot;Freshwater Fish&quot;
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v2-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v2-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v2-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v2-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v2-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v2-products" data-method="GET"
      data-path="api/v2/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v2-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v2-products"
                    onclick="tryItOut('GETapi-v2-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v2-products"
                    onclick="cancelTryOut('GETapi-v2-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v2-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v2/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v2-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v2-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="products-v2-GETapi-v2-products--product_id-">Get a specific product.</h2>

<p>
</p>



<span id="example-requests-GETapi-v2-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v2/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v2-products--product_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Salmon&quot;,
        &quot;description&quot;: &quot;Fresh salmon&quot;,
        &quot;price&quot;: 19.99,
        &quot;stock&quot;: 100,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;freshwater&quot;,
            &quot;display_name&quot;: &quot;Freshwater Fish&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v2-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v2-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v2-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v2-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v2-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v2-products--product_id-" data-method="GET"
      data-path="api/v2/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v2-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v2-products--product_id-"
                    onclick="tryItOut('GETapi-v2-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v2-products--product_id-"
                    onclick="cancelTryOut('GETapi-v2-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v2-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v2/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v2-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v2-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="GETapi-v2-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="GETapi-v2-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="products-v2-POSTapi-v2-products">Store a new product.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v2-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://fish_shop.test/api/v2/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Salmon\",
    \"category_id\": 1,
    \"price_per_kg\": 39,
    \"stock_kg\": 84,
    \"description\": \"Fresh salmon\",
    \"price\": 19.99,
    \"stock\": 100
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/products"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Salmon",
    "category_id": 1,
    "price_per_kg": 39,
    "stock_kg": 84,
    "description": "Fresh salmon",
    "price": 19.99,
    "stock": 100
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v2-products">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Salmon&quot;,
        &quot;description&quot;: &quot;Fresh salmon&quot;,
        &quot;price&quot;: 19.99,
        &quot;stock&quot;: 100,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;freshwater&quot;,
            &quot;display_name&quot;: &quot;Freshwater Fish&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v2-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v2-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v2-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v2-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v2-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v2-products" data-method="POST"
      data-path="api/v2/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v2-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v2-products"
                    onclick="tryItOut('POSTapi-v2-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v2-products"
                    onclick="cancelTryOut('POSTapi-v2-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v2-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v2/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v2-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v2-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v2-products"
               value="Salmon"
               data-component="body">
    <br>
<p>The name of the product. Example: <code>Salmon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="POSTapi-v2-products"
               value="1"
               data-component="body">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price_per_kg</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price_per_kg"                data-endpoint="POSTapi-v2-products"
               value="39"
               data-component="body">
    <br>
<p>El tamaño de value debe ser de al menos 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>stock_kg</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="stock_kg"                data-endpoint="POSTapi-v2-products"
               value="84"
               data-component="body">
    <br>
<p>El tamaño de value debe ser de al menos 0. Example: <code>84</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v2-products"
               value="Fresh salmon"
               data-component="body">
    <br>
<p>The description of the product. Example: <code>Fresh salmon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-v2-products"
               value="19.99"
               data-component="body">
    <br>
<p>The price of the product. Example: <code>19.99</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="stock"                data-endpoint="POSTapi-v2-products"
               value="100"
               data-component="body">
    <br>
<p>The stock quantity. Example: <code>100</code></p>
        </div>
        </form>

                    <h2 id="products-v2-PUTapi-v2-products--product_id-">Update an existing product.</h2>

<p>
</p>



<span id="example-requests-PUTapi-v2-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://fish_shop.test/api/v2/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Salmon\",
    \"category_id\": 1,
    \"price_per_kg\": 39,
    \"stock_kg\": 84,
    \"description\": \"Fresh salmon\",
    \"price\": 19.99,
    \"stock\": 100
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Salmon",
    "category_id": 1,
    "price_per_kg": 39,
    "stock_kg": 84,
    "description": "Fresh salmon",
    "price": 19.99,
    "stock": 100
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v2-products--product_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Updated Salmon&quot;,
        &quot;description&quot;: &quot;Updated description&quot;,
        &quot;price&quot;: 24.99,
        &quot;stock&quot;: 50,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;freshwater&quot;,
            &quot;display_name&quot;: &quot;Freshwater Fish&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v2-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v2-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v2-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v2-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v2-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v2-products--product_id-" data-method="PUT"
      data-path="api/v2/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v2-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v2-products--product_id-"
                    onclick="tryItOut('PUTapi-v2-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v2-products--product_id-"
                    onclick="cancelTryOut('PUTapi-v2-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v2-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v2/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v2-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v2-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="PUTapi-v2-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="PUTapi-v2-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v2-products--product_id-"
               value="Salmon"
               data-component="body">
    <br>
<p>The name of the product. Example: <code>Salmon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="PUTapi-v2-products--product_id-"
               value="1"
               data-component="body">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price_per_kg</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price_per_kg"                data-endpoint="PUTapi-v2-products--product_id-"
               value="39"
               data-component="body">
    <br>
<p>El tamaño de value debe ser de al menos 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>stock_kg</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="stock_kg"                data-endpoint="PUTapi-v2-products--product_id-"
               value="84"
               data-component="body">
    <br>
<p>El tamaño de value debe ser de al menos 0. Example: <code>84</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v2-products--product_id-"
               value="Fresh salmon"
               data-component="body">
    <br>
<p>The description of the product. Example: <code>Fresh salmon</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="PUTapi-v2-products--product_id-"
               value="19.99"
               data-component="body">
    <br>
<p>The price of the product. Example: <code>19.99</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="stock"                data-endpoint="PUTapi-v2-products--product_id-"
               value="100"
               data-component="body">
    <br>
<p>The stock quantity. Example: <code>100</code></p>
        </div>
        </form>

                    <h2 id="products-v2-DELETEapi-v2-products--product_id-">Delete a specific product.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v2-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://fish_shop.test/api/v2/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v2-products--product_id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v2-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v2-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v2-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v2-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v2-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v2-products--product_id-" data-method="DELETE"
      data-path="api/v2/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v2-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v2-products--product_id-"
                    onclick="tryItOut('DELETEapi-v2-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v2-products--product_id-"
                    onclick="cancelTryOut('DELETEapi-v2-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v2-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v2/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v2-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v2-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="DELETEapi-v2-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="DELETEapi-v2-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="transactions-v2">Transactions V2</h1>

    

                                <h2 id="transactions-v2-GETapi-v2-transactions">Get a list of all transactions.</h2>

<p>
</p>



<span id="example-requests-GETapi-v2-transactions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v2/transactions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/transactions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v2-transactions">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;tpv&quot;: &quot;TPV001&quot;,
            &quot;serial_number&quot;: &quot;SN123456&quot;,
            &quot;terminal_number&quot;: &quot;TN789012&quot;,
            &quot;operation&quot;: &quot;SALE&quot;,
            &quot;amount&quot;: 150.5,
            &quot;card_number&quot;: &quot;4111111111111111&quot;,
            &quot;date_time&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
            &quot;transaction_number&quot;: &quot;TRX123456&quot;,
            &quot;sale_id&quot;: 1,
            &quot;user&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;John Doe&quot;,
                &quot;email&quot;: &quot;john@example.com&quot;
            },
            &quot;created_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v2-transactions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v2-transactions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v2-transactions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v2-transactions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v2-transactions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v2-transactions" data-method="GET"
      data-path="api/v2/transactions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v2-transactions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v2-transactions"
                    onclick="tryItOut('GETapi-v2-transactions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v2-transactions"
                    onclick="cancelTryOut('GETapi-v2-transactions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v2-transactions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v2/transactions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v2-transactions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v2-transactions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="transactions-v2-POSTapi-v2-transactions">Store a new transaction.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v2-transactions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://fish_shop.test/api/v2/transactions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tpv\": \"TPV001\",
    \"serial_number\": \"SN123456\",
    \"terminal_number\": \"TN789012\",
    \"operation\": \"SALE\",
    \"amount\": \"150.50\",
    \"card_number\": \"4111111111111111\",
    \"date_time\": \"2024-02-11 18:24:59\",
    \"transaction_number\": \"TRX123456\",
    \"sale_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/transactions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tpv": "TPV001",
    "serial_number": "SN123456",
    "terminal_number": "TN789012",
    "operation": "SALE",
    "amount": "150.50",
    "card_number": "4111111111111111",
    "date_time": "2024-02-11 18:24:59",
    "transaction_number": "TRX123456",
    "sale_id": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v2-transactions">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;tpv&quot;: &quot;TPV001&quot;,
        &quot;serial_number&quot;: &quot;SN123456&quot;,
        &quot;terminal_number&quot;: &quot;TN789012&quot;,
        &quot;operation&quot;: &quot;SALE&quot;,
        &quot;amount&quot;: 150.5,
        &quot;card_number&quot;: &quot;4111111111111111&quot;,
        &quot;date_time&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;transaction_number&quot;: &quot;TRX123456&quot;,
        &quot;sale_id&quot;: 1,
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;
        },
        &quot;created_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v2-transactions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v2-transactions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v2-transactions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v2-transactions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v2-transactions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v2-transactions" data-method="POST"
      data-path="api/v2/transactions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v2-transactions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v2-transactions"
                    onclick="tryItOut('POSTapi-v2-transactions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v2-transactions"
                    onclick="cancelTryOut('POSTapi-v2-transactions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v2-transactions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v2/transactions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v2-transactions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v2-transactions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tpv</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tpv"                data-endpoint="POSTapi-v2-transactions"
               value="TPV001"
               data-component="body">
    <br>
<p>The TPV identifier. Example: <code>TPV001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>serial_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="serial_number"                data-endpoint="POSTapi-v2-transactions"
               value="SN123456"
               data-component="body">
    <br>
<p>The serial number. Example: <code>SN123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>terminal_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="terminal_number"                data-endpoint="POSTapi-v2-transactions"
               value="TN789012"
               data-component="body">
    <br>
<p>The terminal number. Example: <code>TN789012</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>operation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="operation"                data-endpoint="POSTapi-v2-transactions"
               value="SALE"
               data-component="body">
    <br>
<p>The operation type. Example: <code>SALE</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="amount"                data-endpoint="POSTapi-v2-transactions"
               value="150.50"
               data-component="body">
    <br>
<p>The transaction amount. Example: <code>150.50</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>card_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="card_number"                data-endpoint="POSTapi-v2-transactions"
               value="4111111111111111"
               data-component="body">
    <br>
<p>The card number. Example: <code>4111111111111111</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_time</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_time"                data-endpoint="POSTapi-v2-transactions"
               value="2024-02-11 18:24:59"
               data-component="body">
    <br>
<p>The transaction date and time. Example: <code>2024-02-11 18:24:59</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>transaction_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="transaction_number"                data-endpoint="POSTapi-v2-transactions"
               value="TRX123456"
               data-component="body">
    <br>
<p>The transaction number. Example: <code>TRX123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sale_id"                data-endpoint="POSTapi-v2-transactions"
               value="1"
               data-component="body">
    <br>
<p>The sale ID. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="transactions-v2-GETapi-v2-transactions--id-">Get a specific transaction.</h2>

<p>
</p>



<span id="example-requests-GETapi-v2-transactions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://fish_shop.test/api/v2/transactions/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/transactions/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v2-transactions--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;tpv&quot;: &quot;TPV001&quot;,
        &quot;serial_number&quot;: &quot;SN123456&quot;,
        &quot;terminal_number&quot;: &quot;TN789012&quot;,
        &quot;operation&quot;: &quot;SALE&quot;,
        &quot;amount&quot;: 150.5,
        &quot;card_number&quot;: &quot;4111111111111111&quot;,
        &quot;date_time&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;transaction_number&quot;: &quot;TRX123456&quot;,
        &quot;sale_id&quot;: 1,
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;
        },
        &quot;created_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v2-transactions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v2-transactions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v2-transactions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v2-transactions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v2-transactions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v2-transactions--id-" data-method="GET"
      data-path="api/v2/transactions/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v2-transactions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v2-transactions--id-"
                    onclick="tryItOut('GETapi-v2-transactions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v2-transactions--id-"
                    onclick="cancelTryOut('GETapi-v2-transactions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v2-transactions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v2/transactions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v2-transactions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v2-transactions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v2-transactions--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the transaction. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>transaction</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="transaction"                data-endpoint="GETapi-v2-transactions--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the transaction. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="transactions-v2-PUTapi-v2-transactions--id-">Update an existing transaction.</h2>

<p>
</p>



<span id="example-requests-PUTapi-v2-transactions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://fish_shop.test/api/v2/transactions/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tpv\": \"TPV001\",
    \"serial_number\": \"SN123456\",
    \"terminal_number\": \"TN789012\",
    \"operation\": \"SALE\",
    \"amount\": \"150.50\",
    \"card_number\": \"4111111111111111\",
    \"date_time\": \"2024-02-11 18:24:59\",
    \"transaction_number\": \"TRX123456\",
    \"sale_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/transactions/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tpv": "TPV001",
    "serial_number": "SN123456",
    "terminal_number": "TN789012",
    "operation": "SALE",
    "amount": "150.50",
    "card_number": "4111111111111111",
    "date_time": "2024-02-11 18:24:59",
    "transaction_number": "TRX123456",
    "sale_id": 1
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v2-transactions--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;tpv&quot;: &quot;TPV001&quot;,
        &quot;serial_number&quot;: &quot;SN123456&quot;,
        &quot;terminal_number&quot;: &quot;TN789012&quot;,
        &quot;operation&quot;: &quot;SALE&quot;,
        &quot;amount&quot;: 150.5,
        &quot;card_number&quot;: &quot;4111111111111111&quot;,
        &quot;date_time&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;transaction_number&quot;: &quot;TRX123456&quot;,
        &quot;sale_id&quot;: 1,
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;
        },
        &quot;created_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-02-11T18:24:59.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v2-transactions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v2-transactions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v2-transactions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v2-transactions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v2-transactions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v2-transactions--id-" data-method="PUT"
      data-path="api/v2/transactions/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v2-transactions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v2-transactions--id-"
                    onclick="tryItOut('PUTapi-v2-transactions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v2-transactions--id-"
                    onclick="cancelTryOut('PUTapi-v2-transactions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v2-transactions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v2/transactions/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v2/transactions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v2-transactions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v2-transactions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v2-transactions--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the transaction. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>transaction</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="transaction"                data-endpoint="PUTapi-v2-transactions--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the transaction. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tpv</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tpv"                data-endpoint="PUTapi-v2-transactions--id-"
               value="TPV001"
               data-component="body">
    <br>
<p>The TPV identifier. Example: <code>TPV001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>serial_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="serial_number"                data-endpoint="PUTapi-v2-transactions--id-"
               value="SN123456"
               data-component="body">
    <br>
<p>The serial number. Example: <code>SN123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>terminal_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="terminal_number"                data-endpoint="PUTapi-v2-transactions--id-"
               value="TN789012"
               data-component="body">
    <br>
<p>The terminal number. Example: <code>TN789012</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>operation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="operation"                data-endpoint="PUTapi-v2-transactions--id-"
               value="SALE"
               data-component="body">
    <br>
<p>The operation type. Example: <code>SALE</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="amount"                data-endpoint="PUTapi-v2-transactions--id-"
               value="150.50"
               data-component="body">
    <br>
<p>The transaction amount. Example: <code>150.50</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>card_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="card_number"                data-endpoint="PUTapi-v2-transactions--id-"
               value="4111111111111111"
               data-component="body">
    <br>
<p>The card number. Example: <code>4111111111111111</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_time</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_time"                data-endpoint="PUTapi-v2-transactions--id-"
               value="2024-02-11 18:24:59"
               data-component="body">
    <br>
<p>The transaction date and time. Example: <code>2024-02-11 18:24:59</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>transaction_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="transaction_number"                data-endpoint="PUTapi-v2-transactions--id-"
               value="TRX123456"
               data-component="body">
    <br>
<p>The transaction number. Example: <code>TRX123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sale_id"                data-endpoint="PUTapi-v2-transactions--id-"
               value="1"
               data-component="body">
    <br>
<p>The sale ID. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="transactions-v2-DELETEapi-v2-transactions--id-">Delete a transaction.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v2-transactions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://fish_shop.test/api/v2/transactions/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://fish_shop.test/api/v2/transactions/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v2-transactions--id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v2-transactions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v2-transactions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v2-transactions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v2-transactions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v2-transactions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v2-transactions--id-" data-method="DELETE"
      data-path="api/v2/transactions/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v2-transactions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v2-transactions--id-"
                    onclick="tryItOut('DELETEapi-v2-transactions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v2-transactions--id-"
                    onclick="cancelTryOut('DELETEapi-v2-transactions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v2-transactions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v2/transactions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v2-transactions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v2-transactions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v2-transactions--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the transaction. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>transaction</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="transaction"                data-endpoint="DELETEapi-v2-transactions--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the transaction. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
