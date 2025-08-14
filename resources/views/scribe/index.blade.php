<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ExowTasks API API Documentation</title>

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
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.3.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.3.0.js") }}"></script>

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
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-login">
                                <a href="#endpoints-POSTapi-v1-auth-login">Connexion utilisateur</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-logout">
                                <a href="#endpoints-POSTapi-v1-auth-logout">Déconnexion utilisateur</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-auth-user">
                                <a href="#endpoints-GETapi-v1-auth-user">Récupérer les informations de l'utilisateur connecté</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-teams">
                                <a href="#endpoints-GETapi-v1-teams">Affiche la liste des équipes</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-teams--team_id-">
                                <a href="#endpoints-GETapi-v1-teams--team_id-">Affiche une équipe spécifique</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-members">
                                <a href="#endpoints-GETapi-v1-members">Affiche la liste des membres avec filtres</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-members--member_id-">
                                <a href="#endpoints-GETapi-v1-members--member_id-">Affiche un membre spécifique</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-tasks">
                                <a href="#endpoints-GETapi-v1-tasks">Affiche la liste des tâches avec filtres</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-tasks--task_id-">
                                <a href="#endpoints-GETapi-v1-tasks--task_id-">Affiche une tâche spécifique</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-tasks--task_id-">
                                <a href="#endpoints-PUTapi-v1-tasks--task_id-">Met à jour une tâche</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-teams">
                                <a href="#endpoints-POSTapi-v1-teams">Crée une nouvelle équipe</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-teams--team_id-">
                                <a href="#endpoints-DELETEapi-v1-teams--team_id-">Supprime une équipe avec toutes ses données associées</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-members">
                                <a href="#endpoints-POSTapi-v1-members">Crée un nouveau membre</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-members--member_id-">
                                <a href="#endpoints-DELETEapi-v1-members--member_id-">Supprime un membre</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-tasks">
                                <a href="#endpoints-POSTapi-v1-tasks">Crée une nouvelle tâche</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-tasks--task_id-">
                                <a href="#endpoints-DELETEapi-v1-tasks--task_id-">Supprime une tâche</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-tasks--task_id--assign">
                                <a href="#endpoints-POSTapi-v1-tasks--task_id--assign">Assigne des membres à une tâche</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-tasks--task_id--unassign">
                                <a href="#endpoints-DELETEapi-v1-tasks--task_id--unassign">Désassigne des membres d'une tâche2</a>
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
        <li>Last updated: August 14, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-v1-auth-login">Connexion utilisateur</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/auth/login" \
    --header "Authorization: " \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/auth/login"
);

const headers = {
    "Authorization": "",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "password": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-login">
</span>
<span id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-login" data-method="POST"
      data-path="api/v1/auth/login"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-login"
                    onclick="tryItOut('POSTapi-v1-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-auth-login"
               value=""
               data-component="header">
    <br>

            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-login"
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
                              name="Accept"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-login"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-login"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-auth-logout">Déconnexion utilisateur</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/auth/logout" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/auth/logout"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-logout">
</span>
<span id="execution-results-POSTapi-v1-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-logout" data-method="POST"
      data-path="api/v1/auth/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-logout"
                    onclick="tryItOut('POSTapi-v1-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-auth-logout"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-logout"
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
                              name="Accept"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-auth-user">Récupérer les informations de l&#039;utilisateur connecté</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-auth-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/auth/user" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/auth/user"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-auth-user">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Utilisateur r&eacute;cup&eacute;r&eacute; avec succ&egrave;s&quot;,
    &quot;data&quot;: {
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
            &quot;first_name&quot;: &quot;Rodrigue&quot;,
            &quot;last_name&quot;: &quot;Agossou&quot;,
            &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
            &quot;role&quot;: &quot;manager&quot;,
            &quot;team_id&quot;: 1,
            &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-auth-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-auth-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-auth-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-auth-user" data-method="GET"
      data-path="api/v1/auth/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-auth-user"
                    onclick="tryItOut('GETapi-v1-auth-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-auth-user"
                    onclick="cancelTryOut('GETapi-v1-auth-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-auth-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/auth/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-auth-user"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-auth-user"
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
                              name="Accept"                data-endpoint="GETapi-v1-auth-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-teams">Affiche la liste des équipes</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-teams">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/teams" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/teams"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-teams">
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-teams" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-teams"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-teams"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-teams" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-teams">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-teams" data-method="GET"
      data-path="api/v1/teams"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-teams', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-teams"
                    onclick="tryItOut('GETapi-v1-teams');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-teams"
                    onclick="cancelTryOut('GETapi-v1-teams');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-teams"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/teams</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-teams"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-teams"
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
                              name="Accept"                data-endpoint="GETapi-v1-teams"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-teams--team_id-">Affiche une équipe spécifique</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-teams--team_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/teams/1" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/teams/1"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-teams--team_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;&Eacute;quipe r&eacute;cup&eacute;r&eacute;e avec succ&egrave;s&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Equipe A&quot;,
        &quot;slug&quot;: &quot;equipe-a&quot;,
        &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
        &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;,
        &quot;membres&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;Ulrich Sogbossi&quot;,
                &quot;first_name&quot;: &quot;Ulrich&quot;,
                &quot;last_name&quot;: &quot;Sogbossi&quot;,
                &quot;email&quot;: &quot;ulrich.sogbossi@yahoo.fr&quot;,
                &quot;role&quot;: &quot;developer&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2025-01-11 03:52:23&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            },
            {
                &quot;id&quot;: 4,
                &quot;full_name&quot;: &quot;Christelle Hound&eacute;t&eacute;&quot;,
                &quot;first_name&quot;: &quot;Christelle&quot;,
                &quot;last_name&quot;: &quot;Hound&eacute;t&eacute;&quot;,
                &quot;email&quot;: &quot;christelle.houndete@gmail.com&quot;,
                &quot;role&quot;: &quot;developer&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2025-01-16 14:52:17&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            },
            {
                &quot;id&quot;: 5,
                &quot;full_name&quot;: &quot;Landry Gnonlonfoun&quot;,
                &quot;first_name&quot;: &quot;Landry&quot;,
                &quot;last_name&quot;: &quot;Gnonlonfoun&quot;,
                &quot;email&quot;: &quot;landry.gnonlonfoun@yahoo.fr&quot;,
                &quot;role&quot;: &quot;designer&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2025-05-01 08:32:04&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            },
            {
                &quot;id&quot;: 6,
                &quot;full_name&quot;: &quot;Prisca Kpoch&eacute;m&egrave;&quot;,
                &quot;first_name&quot;: &quot;Prisca&quot;,
                &quot;last_name&quot;: &quot;Kpoch&eacute;m&egrave;&quot;,
                &quot;email&quot;: &quot;prisca.kpocheme@gmail.com&quot;,
                &quot;role&quot;: &quot;developer&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-09-25 11:49:37&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-teams--team_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-teams--team_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-teams--team_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-teams--team_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-teams--team_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-teams--team_id-" data-method="GET"
      data-path="api/v1/teams/{team_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-teams--team_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-teams--team_id-"
                    onclick="tryItOut('GETapi-v1-teams--team_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-teams--team_id-"
                    onclick="cancelTryOut('GETapi-v1-teams--team_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-teams--team_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/teams/{team_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-teams--team_id-"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-teams--team_id-"
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
                              name="Accept"                data-endpoint="GETapi-v1-teams--team_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>team_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="team_id"                data-endpoint="GETapi-v1-teams--team_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the team. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-members">Affiche la liste des membres avec filtres</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-members">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/members" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/members"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-members">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Membres r&eacute;cup&eacute;r&eacute;s avec succ&egrave;s&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 8,
            &quot;full_name&quot;: &quot;&Eacute;ric Dossou&quot;,
            &quot;first_name&quot;: &quot;&Eacute;ric&quot;,
            &quot;last_name&quot;: &quot;Dossou&quot;,
            &quot;email&quot;: &quot;eric.dossou@gmail.com&quot;,
            &quot;role&quot;: &quot;designer&quot;,
            &quot;team_id&quot;: 2,
            &quot;joined_at&quot;: &quot;2024-09-02 11:45:41&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;equipe&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Equipe H&quot;,
                &quot;slug&quot;: &quot;equipe-h&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;created_tasks&quot;: [],
            &quot;assigned_tasks&quot;: [
                {
                    &quot;id&quot;: 10,
                    &quot;title&quot;: &quot;Cr&eacute;er le design system&quot;,
                    &quot;description&quot;: &quot;Velit repellendus quo quia. Molestias quo vel maiores dolorum facere tenetur iure ipsam. Nostrum vitae voluptas atque sunt quod.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-29 12:54:51&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;title&quot;: &quot;Concevoir l&#039;identit&eacute; visuelle&quot;,
                    &quot;description&quot;: &quot;Et rerum accusamus quae id provident est est voluptates. Est aut reprehenderit dolore laborum veniam aut est. Eum voluptate consectetur ratione nemo et quia aut. Quas delectus unde voluptate mollitia quas debitis.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-22 05:09:08&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;title&quot;: &quot;Valider l&#039;accessibilit&eacute;&quot;,
                    &quot;description&quot;: &quot;Quia cupiditate rerum ullam aliquid quis velit officiis. Autem qui non non et. Est cupiditate aut tenetur. Labore dolorem quidem omnis deleniti explicabo beatae natus. Aut laboriosam id aut nulla eligendi nemo.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-31 00:51:04&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 7,
            &quot;full_name&quot;: &quot;Germain Ahissou&quot;,
            &quot;first_name&quot;: &quot;Germain&quot;,
            &quot;last_name&quot;: &quot;Ahissou&quot;,
            &quot;email&quot;: &quot;germain.ahissou@gmail.com&quot;,
            &quot;role&quot;: &quot;designer&quot;,
            &quot;team_id&quot;: 2,
            &quot;joined_at&quot;: &quot;2024-12-30 08:27:37&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;equipe&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Equipe H&quot;,
                &quot;slug&quot;: &quot;equipe-h&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;created_tasks&quot;: [],
            &quot;assigned_tasks&quot;: [
                {
                    &quot;id&quot;: 12,
                    &quot;title&quot;: &quot;Optimiser l&#039;UX mobile&quot;,
                    &quot;description&quot;: &quot;Dolores enim quisquam fuga rerum adipisci rerum. Nam dolor rerum consequuntur ea unde quis. Assumenda rerum repudiandae nihil mollitia qui perspiciatis.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-18 09:20:05&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;title&quot;: &quot;Cr&eacute;er les animations&quot;,
                    &quot;description&quot;: &quot;Aperiam fuga officia sed officiis enim quod in. Nesciunt autem sed in ut et molestias. Facilis aut atque numquam eveniet.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-25 12:24:38&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 3,
            &quot;full_name&quot;: &quot;Ulrich Sogbossi&quot;,
            &quot;first_name&quot;: &quot;Ulrich&quot;,
            &quot;last_name&quot;: &quot;Sogbossi&quot;,
            &quot;email&quot;: &quot;ulrich.sogbossi@yahoo.fr&quot;,
            &quot;role&quot;: &quot;developer&quot;,
            &quot;team_id&quot;: 1,
            &quot;joined_at&quot;: &quot;2025-01-11 03:52:23&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;equipe&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Equipe A&quot;,
                &quot;slug&quot;: &quot;equipe-a&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;created_tasks&quot;: [],
            &quot;assigned_tasks&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;D&eacute;velopper l&#039;interface utilisateur&quot;,
                    &quot;description&quot;: &quot;Eveniet ut voluptatem voluptatum eum. Soluta dolorem eaque est repellat velit aut. Est neque quo fuga facilis recusandae consectetur. Quod quia accusantium hic est ut ex expedita.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-12 10:55:03&quot;,
                    &quot;status&quot;: &quot;todo&quot;,
                    &quot;is_overdue&quot;: true,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;title&quot;: &quot;Configurer la base de donn&eacute;es&quot;,
                    &quot;description&quot;: &quot;Sequi illo quisquam eum voluptas eum quisquam. Est doloremque molestiae sapiente dolores modi quia impedit molestiae. Voluptas veritatis odio eius quis quos ratione. Est laborum qui nam nihil sed dolores.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-29 13:21:24&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;title&quot;: &quot;Projet collaboratif &eacute;quipe A&quot;,
                    &quot;description&quot;: &quot;Magnam quos itaque veniam recusandae soluta tempora. Et nihil voluptates et ipsa possimus quam. Quo quaerat asperiores provident harum consequatur maxime.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-22 20:55:05&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 4,
            &quot;full_name&quot;: &quot;Christelle Hound&eacute;t&eacute;&quot;,
            &quot;first_name&quot;: &quot;Christelle&quot;,
            &quot;last_name&quot;: &quot;Hound&eacute;t&eacute;&quot;,
            &quot;email&quot;: &quot;christelle.houndete@gmail.com&quot;,
            &quot;role&quot;: &quot;developer&quot;,
            &quot;team_id&quot;: 1,
            &quot;joined_at&quot;: &quot;2025-01-16 14:52:17&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;equipe&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Equipe A&quot;,
                &quot;slug&quot;: &quot;equipe-a&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;created_tasks&quot;: [],
            &quot;assigned_tasks&quot;: [
                {
                    &quot;id&quot;: 9,
                    &quot;title&quot;: &quot;Projet collaboratif &eacute;quipe A&quot;,
                    &quot;description&quot;: &quot;Magnam quos itaque veniam recusandae soluta tempora. Et nihil voluptates et ipsa possimus quam. Quo quaerat asperiores provident harum consequatur maxime.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-22 20:55:05&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 6,
            &quot;full_name&quot;: &quot;Prisca Kpoch&eacute;m&egrave;&quot;,
            &quot;first_name&quot;: &quot;Prisca&quot;,
            &quot;last_name&quot;: &quot;Kpoch&eacute;m&egrave;&quot;,
            &quot;email&quot;: &quot;prisca.kpocheme@gmail.com&quot;,
            &quot;role&quot;: &quot;developer&quot;,
            &quot;team_id&quot;: 1,
            &quot;joined_at&quot;: &quot;2024-09-25 11:49:37&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;equipe&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Equipe A&quot;,
                &quot;slug&quot;: &quot;equipe-a&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;created_tasks&quot;: [],
            &quot;assigned_tasks&quot;: [
                {
                    &quot;id&quot;: 5,
                    &quot;title&quot;: &quot;Concevoir les maquettes&quot;,
                    &quot;description&quot;: &quot;Vero et dolor rerum minus assumenda voluptatibus. Iusto et nihil et quibusdam vitae quidem repellendus atque. Repellendus amet aut debitis facilis. Sunt cum expedita iure consequatur doloribus id. Facilis ea voluptas eligendi eum.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-07 04:49:54&quot;,
                    &quot;status&quot;: &quot;todo&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;title&quot;: &quot;Int&eacute;grer l&#039;API REST&quot;,
                    &quot;description&quot;: &quot;Quas omnis quisquam minima voluptatem. Sint eveniet ut est id nostrum ipsam molestiae. Laborum dignissimos explicabo occaecati quis hic.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-07 14:01:57&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;title&quot;: &quot;Documenter le code&quot;,
                    &quot;description&quot;: &quot;Et ea et nam quisquam ea dolorum atque. Incidunt natus architecto ea maiores. Cupiditate voluptatem aliquid quam. Ipsam debitis rerum hic dolor.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-14 14:23:24&quot;,
                    &quot;status&quot;: &quot;todo&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 5,
            &quot;full_name&quot;: &quot;Landry Gnonlonfoun&quot;,
            &quot;first_name&quot;: &quot;Landry&quot;,
            &quot;last_name&quot;: &quot;Gnonlonfoun&quot;,
            &quot;email&quot;: &quot;landry.gnonlonfoun@yahoo.fr&quot;,
            &quot;role&quot;: &quot;designer&quot;,
            &quot;team_id&quot;: 1,
            &quot;joined_at&quot;: &quot;2025-05-01 08:32:04&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;equipe&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Equipe A&quot;,
                &quot;slug&quot;: &quot;equipe-a&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;created_tasks&quot;: [],
            &quot;assigned_tasks&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;title&quot;: &quot;Cr&eacute;er les tests unitaires&quot;,
                    &quot;description&quot;: &quot;Illo quas ea vero accusamus. Ipsum id consequatur a quas voluptatem assumenda. Quo illo et voluptates voluptates qui. Nihil porro nisi qui consequatur illum saepe ut atque. Unde et sint ducimus animi cum modi.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-14 12:27:50&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;title&quot;: &quot;Optimiser les performances&quot;,
                    &quot;description&quot;: &quot;Maxime assumenda officia ipsa voluptatem voluptatem. A molestiae qui consequuntur molestiae nulla officiis totam. Modi quia nihil atque iste fugit dolorem. Veniam voluptatem quo nulla ex quia.&quot;,
                    &quot;due_date&quot;: &quot;2025-10-04 09:49:08&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;title&quot;: &quot;Corriger les bugs critiques&quot;,
                    &quot;description&quot;: &quot;Corporis adipisci officiis ut repellendus ad id. Quaerat aut non hic animi aperiam a. Non vel voluptas minus est provident. Maxime autem aliquam assumenda.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-28 15:17:21&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 2,
            &quot;full_name&quot;: &quot;Gr&acirc;ce Tchokponhou&eacute;&quot;,
            &quot;first_name&quot;: &quot;Gr&acirc;ce&quot;,
            &quot;last_name&quot;: &quot;Tchokponhou&eacute;&quot;,
            &quot;email&quot;: &quot;grace.tchokponhoue@yahoo.fr&quot;,
            &quot;role&quot;: &quot;manager&quot;,
            &quot;team_id&quot;: 2,
            &quot;joined_at&quot;: &quot;2025-06-18 04:37:16&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;,
            &quot;equipe&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Equipe H&quot;,
                &quot;slug&quot;: &quot;equipe-h&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;created_tasks&quot;: [
                {
                    &quot;id&quot;: 10,
                    &quot;title&quot;: &quot;Cr&eacute;er le design system&quot;,
                    &quot;description&quot;: &quot;Velit repellendus quo quia. Molestias quo vel maiores dolorum facere tenetur iure ipsam. Nostrum vitae voluptas atque sunt quod.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-29 12:54:51&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;title&quot;: &quot;Concevoir l&#039;identit&eacute; visuelle&quot;,
                    &quot;description&quot;: &quot;Et rerum accusamus quae id provident est est voluptates. Est aut reprehenderit dolore laborum veniam aut est. Eum voluptate consectetur ratione nemo et quia aut. Quas delectus unde voluptate mollitia quas debitis.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-22 05:09:08&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;title&quot;: &quot;Optimiser l&#039;UX mobile&quot;,
                    &quot;description&quot;: &quot;Dolores enim quisquam fuga rerum adipisci rerum. Nam dolor rerum consequuntur ea unde quis. Assumenda rerum repudiandae nihil mollitia qui perspiciatis.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-18 09:20:05&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;title&quot;: &quot;Cr&eacute;er les animations&quot;,
                    &quot;description&quot;: &quot;Aperiam fuga officia sed officiis enim quod in. Nesciunt autem sed in ut et molestias. Facilis aut atque numquam eveniet.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-25 12:24:38&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;title&quot;: &quot;Valider l&#039;accessibilit&eacute;&quot;,
                    &quot;description&quot;: &quot;Quia cupiditate rerum ullam aliquid quis velit officiis. Autem qui non non et. Est cupiditate aut tenetur. Labore dolorem quidem omnis deleniti explicabo beatae natus. Aut laboriosam id aut nulla eligendi nemo.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-31 00:51:04&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 2,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ],
            &quot;assigned_tasks&quot;: []
        },
        {
            &quot;id&quot;: 1,
            &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
            &quot;first_name&quot;: &quot;Rodrigue&quot;,
            &quot;last_name&quot;: &quot;Agossou&quot;,
            &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
            &quot;role&quot;: &quot;manager&quot;,
            &quot;team_id&quot;: 1,
            &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;,
            &quot;equipe&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Equipe A&quot;,
                &quot;slug&quot;: &quot;equipe-a&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;created_tasks&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;D&eacute;velopper l&#039;interface utilisateur&quot;,
                    &quot;description&quot;: &quot;Eveniet ut voluptatem voluptatum eum. Soluta dolorem eaque est repellat velit aut. Est neque quo fuga facilis recusandae consectetur. Quod quia accusantium hic est ut ex expedita.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-12 10:55:03&quot;,
                    &quot;status&quot;: &quot;todo&quot;,
                    &quot;is_overdue&quot;: true,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;title&quot;: &quot;Configurer la base de donn&eacute;es&quot;,
                    &quot;description&quot;: &quot;Sequi illo quisquam eum voluptas eum quisquam. Est doloremque molestiae sapiente dolores modi quia impedit molestiae. Voluptas veritatis odio eius quis quos ratione. Est laborum qui nam nihil sed dolores.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-29 13:21:24&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;title&quot;: &quot;Cr&eacute;er les tests unitaires&quot;,
                    &quot;description&quot;: &quot;Illo quas ea vero accusamus. Ipsum id consequatur a quas voluptatem assumenda. Quo illo et voluptates voluptates qui. Nihil porro nisi qui consequatur illum saepe ut atque. Unde et sint ducimus animi cum modi.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-14 12:27:50&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;title&quot;: &quot;Optimiser les performances&quot;,
                    &quot;description&quot;: &quot;Maxime assumenda officia ipsa voluptatem voluptatem. A molestiae qui consequuntur molestiae nulla officiis totam. Modi quia nihil atque iste fugit dolorem. Veniam voluptatem quo nulla ex quia.&quot;,
                    &quot;due_date&quot;: &quot;2025-10-04 09:49:08&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;title&quot;: &quot;Concevoir les maquettes&quot;,
                    &quot;description&quot;: &quot;Vero et dolor rerum minus assumenda voluptatibus. Iusto et nihil et quibusdam vitae quidem repellendus atque. Repellendus amet aut debitis facilis. Sunt cum expedita iure consequatur doloribus id. Facilis ea voluptas eligendi eum.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-07 04:49:54&quot;,
                    &quot;status&quot;: &quot;todo&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;title&quot;: &quot;Int&eacute;grer l&#039;API REST&quot;,
                    &quot;description&quot;: &quot;Quas omnis quisquam minima voluptatem. Sint eveniet ut est id nostrum ipsam molestiae. Laborum dignissimos explicabo occaecati quis hic.&quot;,
                    &quot;due_date&quot;: &quot;2025-09-07 14:01:57&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;title&quot;: &quot;Documenter le code&quot;,
                    &quot;description&quot;: &quot;Et ea et nam quisquam ea dolorum atque. Incidunt natus architecto ea maiores. Cupiditate voluptatem aliquid quam. Ipsam debitis rerum hic dolor.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-14 14:23:24&quot;,
                    &quot;status&quot;: &quot;todo&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;title&quot;: &quot;Corriger les bugs critiques&quot;,
                    &quot;description&quot;: &quot;Corporis adipisci officiis ut repellendus ad id. Quaerat aut non hic animi aperiam a. Non vel voluptas minus est provident. Maxime autem aliquam assumenda.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-28 15:17:21&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: false,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;title&quot;: &quot;Projet collaboratif &eacute;quipe A&quot;,
                    &quot;description&quot;: &quot;Magnam quos itaque veniam recusandae soluta tempora. Et nihil voluptates et ipsa possimus quam. Quo quaerat asperiores provident harum consequatur maxime.&quot;,
                    &quot;due_date&quot;: &quot;2025-08-22 20:55:05&quot;,
                    &quot;status&quot;: &quot;done&quot;,
                    &quot;is_overdue&quot;: false,
                    &quot;is_completed&quot;: true,
                    &quot;created_by&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ],
            &quot;assigned_tasks&quot;: []
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-members" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-members"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-members"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-members" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-members">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-members" data-method="GET"
      data-path="api/v1/members"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-members', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-members"
                    onclick="tryItOut('GETapi-v1-members');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-members"
                    onclick="cancelTryOut('GETapi-v1-members');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-members"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/members</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-members"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-members"
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
                              name="Accept"                data-endpoint="GETapi-v1-members"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-members--member_id-">Affiche un membre spécifique</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-members--member_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/members/1" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/members/1"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-members--member_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Membre r&eacute;cup&eacute;r&eacute; avec succ&egrave;s&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
        &quot;first_name&quot;: &quot;Rodrigue&quot;,
        &quot;last_name&quot;: &quot;Agossou&quot;,
        &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
        &quot;role&quot;: &quot;manager&quot;,
        &quot;team_id&quot;: 1,
        &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
        &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
        &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;,
        &quot;equipe&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Equipe A&quot;,
            &quot;slug&quot;: &quot;equipe-a&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
        },
        &quot;created_tasks&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;D&eacute;velopper l&#039;interface utilisateur&quot;,
                &quot;description&quot;: &quot;Eveniet ut voluptatem voluptatum eum. Soluta dolorem eaque est repellat velit aut. Est neque quo fuga facilis recusandae consectetur. Quod quia accusantium hic est ut ex expedita.&quot;,
                &quot;due_date&quot;: &quot;2025-08-12 10:55:03&quot;,
                &quot;status&quot;: &quot;todo&quot;,
                &quot;is_overdue&quot;: true,
                &quot;is_completed&quot;: false,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;title&quot;: &quot;Configurer la base de donn&eacute;es&quot;,
                &quot;description&quot;: &quot;Sequi illo quisquam eum voluptas eum quisquam. Est doloremque molestiae sapiente dolores modi quia impedit molestiae. Voluptas veritatis odio eius quis quos ratione. Est laborum qui nam nihil sed dolores.&quot;,
                &quot;due_date&quot;: &quot;2025-08-29 13:21:24&quot;,
                &quot;status&quot;: &quot;in_progress&quot;,
                &quot;is_overdue&quot;: false,
                &quot;is_completed&quot;: false,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;title&quot;: &quot;Cr&eacute;er les tests unitaires&quot;,
                &quot;description&quot;: &quot;Illo quas ea vero accusamus. Ipsum id consequatur a quas voluptatem assumenda. Quo illo et voluptates voluptates qui. Nihil porro nisi qui consequatur illum saepe ut atque. Unde et sint ducimus animi cum modi.&quot;,
                &quot;due_date&quot;: &quot;2025-08-14 12:27:50&quot;,
                &quot;status&quot;: &quot;done&quot;,
                &quot;is_overdue&quot;: false,
                &quot;is_completed&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            },
            {
                &quot;id&quot;: 4,
                &quot;title&quot;: &quot;Optimiser les performances&quot;,
                &quot;description&quot;: &quot;Maxime assumenda officia ipsa voluptatem voluptatem. A molestiae qui consequuntur molestiae nulla officiis totam. Modi quia nihil atque iste fugit dolorem. Veniam voluptatem quo nulla ex quia.&quot;,
                &quot;due_date&quot;: &quot;2025-10-04 09:49:08&quot;,
                &quot;status&quot;: &quot;done&quot;,
                &quot;is_overdue&quot;: false,
                &quot;is_completed&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            },
            {
                &quot;id&quot;: 5,
                &quot;title&quot;: &quot;Concevoir les maquettes&quot;,
                &quot;description&quot;: &quot;Vero et dolor rerum minus assumenda voluptatibus. Iusto et nihil et quibusdam vitae quidem repellendus atque. Repellendus amet aut debitis facilis. Sunt cum expedita iure consequatur doloribus id. Facilis ea voluptas eligendi eum.&quot;,
                &quot;due_date&quot;: &quot;2025-09-07 04:49:54&quot;,
                &quot;status&quot;: &quot;todo&quot;,
                &quot;is_overdue&quot;: false,
                &quot;is_completed&quot;: false,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            },
            {
                &quot;id&quot;: 6,
                &quot;title&quot;: &quot;Int&eacute;grer l&#039;API REST&quot;,
                &quot;description&quot;: &quot;Quas omnis quisquam minima voluptatem. Sint eveniet ut est id nostrum ipsam molestiae. Laborum dignissimos explicabo occaecati quis hic.&quot;,
                &quot;due_date&quot;: &quot;2025-09-07 14:01:57&quot;,
                &quot;status&quot;: &quot;done&quot;,
                &quot;is_overdue&quot;: false,
                &quot;is_completed&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            },
            {
                &quot;id&quot;: 7,
                &quot;title&quot;: &quot;Documenter le code&quot;,
                &quot;description&quot;: &quot;Et ea et nam quisquam ea dolorum atque. Incidunt natus architecto ea maiores. Cupiditate voluptatem aliquid quam. Ipsam debitis rerum hic dolor.&quot;,
                &quot;due_date&quot;: &quot;2025-08-14 14:23:24&quot;,
                &quot;status&quot;: &quot;todo&quot;,
                &quot;is_overdue&quot;: false,
                &quot;is_completed&quot;: false,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            },
            {
                &quot;id&quot;: 8,
                &quot;title&quot;: &quot;Corriger les bugs critiques&quot;,
                &quot;description&quot;: &quot;Corporis adipisci officiis ut repellendus ad id. Quaerat aut non hic animi aperiam a. Non vel voluptas minus est provident. Maxime autem aliquam assumenda.&quot;,
                &quot;due_date&quot;: &quot;2025-08-28 15:17:21&quot;,
                &quot;status&quot;: &quot;in_progress&quot;,
                &quot;is_overdue&quot;: false,
                &quot;is_completed&quot;: false,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            },
            {
                &quot;id&quot;: 9,
                &quot;title&quot;: &quot;Projet collaboratif &eacute;quipe A&quot;,
                &quot;description&quot;: &quot;Magnam quos itaque veniam recusandae soluta tempora. Et nihil voluptates et ipsa possimus quam. Quo quaerat asperiores provident harum consequatur maxime.&quot;,
                &quot;due_date&quot;: &quot;2025-08-22 20:55:05&quot;,
                &quot;status&quot;: &quot;done&quot;,
                &quot;is_overdue&quot;: false,
                &quot;is_completed&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
            }
        ],
        &quot;assigned_tasks&quot;: []
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-members--member_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-members--member_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-members--member_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-members--member_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-members--member_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-members--member_id-" data-method="GET"
      data-path="api/v1/members/{member_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-members--member_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-members--member_id-"
                    onclick="tryItOut('GETapi-v1-members--member_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-members--member_id-"
                    onclick="cancelTryOut('GETapi-v1-members--member_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-members--member_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/members/{member_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-members--member_id-"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-members--member_id-"
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
                              name="Accept"                data-endpoint="GETapi-v1-members--member_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member_id"                data-endpoint="GETapi-v1-members--member_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the member. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-tasks">Affiche la liste des tâches avec filtres</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-tasks">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/tasks" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/tasks"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-tasks">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;T&acirc;ches r&eacute;cup&eacute;r&eacute;es avec succ&egrave;s&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;D&eacute;velopper l&#039;interface utilisateur&quot;,
            &quot;description&quot;: &quot;Eveniet ut voluptatem voluptatum eum. Soluta dolorem eaque est repellat velit aut. Est neque quo fuga facilis recusandae consectetur. Quod quia accusantium hic est ut ex expedita.&quot;,
            &quot;due_date&quot;: &quot;2025-08-12 10:55:03&quot;,
            &quot;status&quot;: &quot;todo&quot;,
            &quot;is_overdue&quot;: true,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;full_name&quot;: &quot;Ulrich Sogbossi&quot;,
                    &quot;first_name&quot;: &quot;Ulrich&quot;,
                    &quot;last_name&quot;: &quot;Sogbossi&quot;,
                    &quot;email&quot;: &quot;ulrich.sogbossi@yahoo.fr&quot;,
                    &quot;role&quot;: &quot;developer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2025-01-11 03:52:23&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Configurer la base de donn&eacute;es&quot;,
            &quot;description&quot;: &quot;Sequi illo quisquam eum voluptas eum quisquam. Est doloremque molestiae sapiente dolores modi quia impedit molestiae. Voluptas veritatis odio eius quis quos ratione. Est laborum qui nam nihil sed dolores.&quot;,
            &quot;due_date&quot;: &quot;2025-08-29 13:21:24&quot;,
            &quot;status&quot;: &quot;in_progress&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;full_name&quot;: &quot;Ulrich Sogbossi&quot;,
                    &quot;first_name&quot;: &quot;Ulrich&quot;,
                    &quot;last_name&quot;: &quot;Sogbossi&quot;,
                    &quot;email&quot;: &quot;ulrich.sogbossi@yahoo.fr&quot;,
                    &quot;role&quot;: &quot;developer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2025-01-11 03:52:23&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Cr&eacute;er les tests unitaires&quot;,
            &quot;description&quot;: &quot;Illo quas ea vero accusamus. Ipsum id consequatur a quas voluptatem assumenda. Quo illo et voluptates voluptates qui. Nihil porro nisi qui consequatur illum saepe ut atque. Unde et sint ducimus animi cum modi.&quot;,
            &quot;due_date&quot;: &quot;2025-08-14 12:27:50&quot;,
            &quot;status&quot;: &quot;done&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: true,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 5,
                    &quot;full_name&quot;: &quot;Landry Gnonlonfoun&quot;,
                    &quot;first_name&quot;: &quot;Landry&quot;,
                    &quot;last_name&quot;: &quot;Gnonlonfoun&quot;,
                    &quot;email&quot;: &quot;landry.gnonlonfoun@yahoo.fr&quot;,
                    &quot;role&quot;: &quot;designer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2025-05-01 08:32:04&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Optimiser les performances&quot;,
            &quot;description&quot;: &quot;Maxime assumenda officia ipsa voluptatem voluptatem. A molestiae qui consequuntur molestiae nulla officiis totam. Modi quia nihil atque iste fugit dolorem. Veniam voluptatem quo nulla ex quia.&quot;,
            &quot;due_date&quot;: &quot;2025-10-04 09:49:08&quot;,
            &quot;status&quot;: &quot;done&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: true,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 5,
                    &quot;full_name&quot;: &quot;Landry Gnonlonfoun&quot;,
                    &quot;first_name&quot;: &quot;Landry&quot;,
                    &quot;last_name&quot;: &quot;Gnonlonfoun&quot;,
                    &quot;email&quot;: &quot;landry.gnonlonfoun@yahoo.fr&quot;,
                    &quot;role&quot;: &quot;designer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2025-05-01 08:32:04&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Concevoir les maquettes&quot;,
            &quot;description&quot;: &quot;Vero et dolor rerum minus assumenda voluptatibus. Iusto et nihil et quibusdam vitae quidem repellendus atque. Repellendus amet aut debitis facilis. Sunt cum expedita iure consequatur doloribus id. Facilis ea voluptas eligendi eum.&quot;,
            &quot;due_date&quot;: &quot;2025-09-07 04:49:54&quot;,
            &quot;status&quot;: &quot;todo&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 6,
                    &quot;full_name&quot;: &quot;Prisca Kpoch&eacute;m&egrave;&quot;,
                    &quot;first_name&quot;: &quot;Prisca&quot;,
                    &quot;last_name&quot;: &quot;Kpoch&eacute;m&egrave;&quot;,
                    &quot;email&quot;: &quot;prisca.kpocheme@gmail.com&quot;,
                    &quot;role&quot;: &quot;developer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2024-09-25 11:49:37&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Int&eacute;grer l&#039;API REST&quot;,
            &quot;description&quot;: &quot;Quas omnis quisquam minima voluptatem. Sint eveniet ut est id nostrum ipsam molestiae. Laborum dignissimos explicabo occaecati quis hic.&quot;,
            &quot;due_date&quot;: &quot;2025-09-07 14:01:57&quot;,
            &quot;status&quot;: &quot;done&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: true,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 6,
                    &quot;full_name&quot;: &quot;Prisca Kpoch&eacute;m&egrave;&quot;,
                    &quot;first_name&quot;: &quot;Prisca&quot;,
                    &quot;last_name&quot;: &quot;Kpoch&eacute;m&egrave;&quot;,
                    &quot;email&quot;: &quot;prisca.kpocheme@gmail.com&quot;,
                    &quot;role&quot;: &quot;developer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2024-09-25 11:49:37&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Documenter le code&quot;,
            &quot;description&quot;: &quot;Et ea et nam quisquam ea dolorum atque. Incidunt natus architecto ea maiores. Cupiditate voluptatem aliquid quam. Ipsam debitis rerum hic dolor.&quot;,
            &quot;due_date&quot;: &quot;2025-08-14 14:23:24&quot;,
            &quot;status&quot;: &quot;todo&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 6,
                    &quot;full_name&quot;: &quot;Prisca Kpoch&eacute;m&egrave;&quot;,
                    &quot;first_name&quot;: &quot;Prisca&quot;,
                    &quot;last_name&quot;: &quot;Kpoch&eacute;m&egrave;&quot;,
                    &quot;email&quot;: &quot;prisca.kpocheme@gmail.com&quot;,
                    &quot;role&quot;: &quot;developer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2024-09-25 11:49:37&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Corriger les bugs critiques&quot;,
            &quot;description&quot;: &quot;Corporis adipisci officiis ut repellendus ad id. Quaerat aut non hic animi aperiam a. Non vel voluptas minus est provident. Maxime autem aliquam assumenda.&quot;,
            &quot;due_date&quot;: &quot;2025-08-28 15:17:21&quot;,
            &quot;status&quot;: &quot;in_progress&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 5,
                    &quot;full_name&quot;: &quot;Landry Gnonlonfoun&quot;,
                    &quot;first_name&quot;: &quot;Landry&quot;,
                    &quot;last_name&quot;: &quot;Gnonlonfoun&quot;,
                    &quot;email&quot;: &quot;landry.gnonlonfoun@yahoo.fr&quot;,
                    &quot;role&quot;: &quot;designer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2025-05-01 08:32:04&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Projet collaboratif &eacute;quipe A&quot;,
            &quot;description&quot;: &quot;Magnam quos itaque veniam recusandae soluta tempora. Et nihil voluptates et ipsa possimus quam. Quo quaerat asperiores provident harum consequatur maxime.&quot;,
            &quot;due_date&quot;: &quot;2025-08-22 20:55:05&quot;,
            &quot;status&quot;: &quot;done&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: true,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 1,
                &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
                &quot;first_name&quot;: &quot;Rodrigue&quot;,
                &quot;last_name&quot;: &quot;Agossou&quot;,
                &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;full_name&quot;: &quot;Ulrich Sogbossi&quot;,
                    &quot;first_name&quot;: &quot;Ulrich&quot;,
                    &quot;last_name&quot;: &quot;Sogbossi&quot;,
                    &quot;email&quot;: &quot;ulrich.sogbossi@yahoo.fr&quot;,
                    &quot;role&quot;: &quot;developer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2025-01-11 03:52:23&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;full_name&quot;: &quot;Christelle Hound&eacute;t&eacute;&quot;,
                    &quot;first_name&quot;: &quot;Christelle&quot;,
                    &quot;last_name&quot;: &quot;Hound&eacute;t&eacute;&quot;,
                    &quot;email&quot;: &quot;christelle.houndete@gmail.com&quot;,
                    &quot;role&quot;: &quot;developer&quot;,
                    &quot;team_id&quot;: 1,
                    &quot;joined_at&quot;: &quot;2025-01-16 14:52:17&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Cr&eacute;er le design system&quot;,
            &quot;description&quot;: &quot;Velit repellendus quo quia. Molestias quo vel maiores dolorum facere tenetur iure ipsam. Nostrum vitae voluptas atque sunt quod.&quot;,
            &quot;due_date&quot;: &quot;2025-09-29 12:54:51&quot;,
            &quot;status&quot;: &quot;in_progress&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;Gr&acirc;ce Tchokponhou&eacute;&quot;,
                &quot;first_name&quot;: &quot;Gr&acirc;ce&quot;,
                &quot;last_name&quot;: &quot;Tchokponhou&eacute;&quot;,
                &quot;email&quot;: &quot;grace.tchokponhoue@yahoo.fr&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 2,
                &quot;joined_at&quot;: &quot;2025-06-18 04:37:16&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 8,
                    &quot;full_name&quot;: &quot;&Eacute;ric Dossou&quot;,
                    &quot;first_name&quot;: &quot;&Eacute;ric&quot;,
                    &quot;last_name&quot;: &quot;Dossou&quot;,
                    &quot;email&quot;: &quot;eric.dossou@gmail.com&quot;,
                    &quot;role&quot;: &quot;designer&quot;,
                    &quot;team_id&quot;: 2,
                    &quot;joined_at&quot;: &quot;2024-09-02 11:45:41&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 11,
            &quot;title&quot;: &quot;Concevoir l&#039;identit&eacute; visuelle&quot;,
            &quot;description&quot;: &quot;Et rerum accusamus quae id provident est est voluptates. Est aut reprehenderit dolore laborum veniam aut est. Eum voluptate consectetur ratione nemo et quia aut. Quas delectus unde voluptate mollitia quas debitis.&quot;,
            &quot;due_date&quot;: &quot;2025-08-22 05:09:08&quot;,
            &quot;status&quot;: &quot;in_progress&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;Gr&acirc;ce Tchokponhou&eacute;&quot;,
                &quot;first_name&quot;: &quot;Gr&acirc;ce&quot;,
                &quot;last_name&quot;: &quot;Tchokponhou&eacute;&quot;,
                &quot;email&quot;: &quot;grace.tchokponhoue@yahoo.fr&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 2,
                &quot;joined_at&quot;: &quot;2025-06-18 04:37:16&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 8,
                    &quot;full_name&quot;: &quot;&Eacute;ric Dossou&quot;,
                    &quot;first_name&quot;: &quot;&Eacute;ric&quot;,
                    &quot;last_name&quot;: &quot;Dossou&quot;,
                    &quot;email&quot;: &quot;eric.dossou@gmail.com&quot;,
                    &quot;role&quot;: &quot;designer&quot;,
                    &quot;team_id&quot;: 2,
                    &quot;joined_at&quot;: &quot;2024-09-02 11:45:41&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 12,
            &quot;title&quot;: &quot;Optimiser l&#039;UX mobile&quot;,
            &quot;description&quot;: &quot;Dolores enim quisquam fuga rerum adipisci rerum. Nam dolor rerum consequuntur ea unde quis. Assumenda rerum repudiandae nihil mollitia qui perspiciatis.&quot;,
            &quot;due_date&quot;: &quot;2025-09-18 09:20:05&quot;,
            &quot;status&quot;: &quot;done&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: true,
            &quot;created_by&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;Gr&acirc;ce Tchokponhou&eacute;&quot;,
                &quot;first_name&quot;: &quot;Gr&acirc;ce&quot;,
                &quot;last_name&quot;: &quot;Tchokponhou&eacute;&quot;,
                &quot;email&quot;: &quot;grace.tchokponhoue@yahoo.fr&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 2,
                &quot;joined_at&quot;: &quot;2025-06-18 04:37:16&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 7,
                    &quot;full_name&quot;: &quot;Germain Ahissou&quot;,
                    &quot;first_name&quot;: &quot;Germain&quot;,
                    &quot;last_name&quot;: &quot;Ahissou&quot;,
                    &quot;email&quot;: &quot;germain.ahissou@gmail.com&quot;,
                    &quot;role&quot;: &quot;designer&quot;,
                    &quot;team_id&quot;: 2,
                    &quot;joined_at&quot;: &quot;2024-12-30 08:27:37&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;Cr&eacute;er les animations&quot;,
            &quot;description&quot;: &quot;Aperiam fuga officia sed officiis enim quod in. Nesciunt autem sed in ut et molestias. Facilis aut atque numquam eveniet.&quot;,
            &quot;due_date&quot;: &quot;2025-09-25 12:24:38&quot;,
            &quot;status&quot;: &quot;in_progress&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;Gr&acirc;ce Tchokponhou&eacute;&quot;,
                &quot;first_name&quot;: &quot;Gr&acirc;ce&quot;,
                &quot;last_name&quot;: &quot;Tchokponhou&eacute;&quot;,
                &quot;email&quot;: &quot;grace.tchokponhoue@yahoo.fr&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 2,
                &quot;joined_at&quot;: &quot;2025-06-18 04:37:16&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 7,
                    &quot;full_name&quot;: &quot;Germain Ahissou&quot;,
                    &quot;first_name&quot;: &quot;Germain&quot;,
                    &quot;last_name&quot;: &quot;Ahissou&quot;,
                    &quot;email&quot;: &quot;germain.ahissou@gmail.com&quot;,
                    &quot;role&quot;: &quot;designer&quot;,
                    &quot;team_id&quot;: 2,
                    &quot;joined_at&quot;: &quot;2024-12-30 08:27:37&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 14,
            &quot;title&quot;: &quot;Valider l&#039;accessibilit&eacute;&quot;,
            &quot;description&quot;: &quot;Quia cupiditate rerum ullam aliquid quis velit officiis. Autem qui non non et. Est cupiditate aut tenetur. Labore dolorem quidem omnis deleniti explicabo beatae natus. Aut laboriosam id aut nulla eligendi nemo.&quot;,
            &quot;due_date&quot;: &quot;2025-08-31 00:51:04&quot;,
            &quot;status&quot;: &quot;in_progress&quot;,
            &quot;is_overdue&quot;: false,
            &quot;is_completed&quot;: false,
            &quot;created_by&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
            &quot;creator&quot;: {
                &quot;id&quot;: 2,
                &quot;full_name&quot;: &quot;Gr&acirc;ce Tchokponhou&eacute;&quot;,
                &quot;first_name&quot;: &quot;Gr&acirc;ce&quot;,
                &quot;last_name&quot;: &quot;Tchokponhou&eacute;&quot;,
                &quot;email&quot;: &quot;grace.tchokponhoue@yahoo.fr&quot;,
                &quot;role&quot;: &quot;manager&quot;,
                &quot;team_id&quot;: 2,
                &quot;joined_at&quot;: &quot;2025-06-18 04:37:16&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            },
            &quot;assigned_members&quot;: [
                {
                    &quot;id&quot;: 8,
                    &quot;full_name&quot;: &quot;&Eacute;ric Dossou&quot;,
                    &quot;first_name&quot;: &quot;&Eacute;ric&quot;,
                    &quot;last_name&quot;: &quot;Dossou&quot;,
                    &quot;email&quot;: &quot;eric.dossou@gmail.com&quot;,
                    &quot;role&quot;: &quot;designer&quot;,
                    &quot;team_id&quot;: 2,
                    &quot;joined_at&quot;: &quot;2024-09-02 11:45:41&quot;,
                    &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;
                }
            ]
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-tasks" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-tasks"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-tasks"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-tasks" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-tasks">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-tasks" data-method="GET"
      data-path="api/v1/tasks"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-tasks', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-tasks"
                    onclick="tryItOut('GETapi-v1-tasks');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-tasks"
                    onclick="cancelTryOut('GETapi-v1-tasks');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-tasks"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/tasks</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-tasks"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-tasks"
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
                              name="Accept"                data-endpoint="GETapi-v1-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-tasks--task_id-">Affiche une tâche spécifique</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-tasks--task_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/tasks/1" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/tasks/1"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-tasks--task_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;T&acirc;che r&eacute;cup&eacute;r&eacute;e avec succ&egrave;s&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;D&eacute;velopper l&#039;interface utilisateur&quot;,
        &quot;description&quot;: &quot;Eveniet ut voluptatem voluptatum eum. Soluta dolorem eaque est repellat velit aut. Est neque quo fuga facilis recusandae consectetur. Quod quia accusantium hic est ut ex expedita.&quot;,
        &quot;due_date&quot;: &quot;2025-08-12 10:55:03&quot;,
        &quot;status&quot;: &quot;todo&quot;,
        &quot;is_overdue&quot;: true,
        &quot;is_completed&quot;: false,
        &quot;created_by&quot;: 1,
        &quot;created_at&quot;: &quot;2025-08-11 14:22:11&quot;,
        &quot;updated_at&quot;: &quot;2025-08-11 14:22:11&quot;,
        &quot;creator&quot;: {
            &quot;id&quot;: 1,
            &quot;full_name&quot;: &quot;Rodrigue Agossou&quot;,
            &quot;first_name&quot;: &quot;Rodrigue&quot;,
            &quot;last_name&quot;: &quot;Agossou&quot;,
            &quot;email&quot;: &quot;rodrigue.agossou@gmail.com&quot;,
            &quot;role&quot;: &quot;manager&quot;,
            &quot;team_id&quot;: 1,
            &quot;joined_at&quot;: &quot;2024-12-18 18:11:03&quot;,
            &quot;created_at&quot;: &quot;2025-08-11 14:22:09&quot;,
            &quot;updated_at&quot;: &quot;2025-08-11 14:22:09&quot;
        },
        &quot;assigned_members&quot;: [
            {
                &quot;id&quot;: 3,
                &quot;full_name&quot;: &quot;Ulrich Sogbossi&quot;,
                &quot;first_name&quot;: &quot;Ulrich&quot;,
                &quot;last_name&quot;: &quot;Sogbossi&quot;,
                &quot;email&quot;: &quot;ulrich.sogbossi@yahoo.fr&quot;,
                &quot;role&quot;: &quot;developer&quot;,
                &quot;team_id&quot;: 1,
                &quot;joined_at&quot;: &quot;2025-01-11 03:52:23&quot;,
                &quot;created_at&quot;: &quot;2025-08-11 14:22:10&quot;,
                &quot;updated_at&quot;: &quot;2025-08-11 14:22:10&quot;
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-tasks--task_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-tasks--task_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-tasks--task_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-tasks--task_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-tasks--task_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-tasks--task_id-" data-method="GET"
      data-path="api/v1/tasks/{task_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-tasks--task_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-tasks--task_id-"
                    onclick="tryItOut('GETapi-v1-tasks--task_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-tasks--task_id-"
                    onclick="cancelTryOut('GETapi-v1-tasks--task_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-tasks--task_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/tasks/{task_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-tasks--task_id-"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-tasks--task_id-"
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
                              name="Accept"                data-endpoint="GETapi-v1-tasks--task_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="GETapi-v1-tasks--task_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-tasks--task_id-">Met à jour une tâche</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-tasks--task_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/v1/tasks/1" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"b\",
    \"description\": \"Eius et animi quos velit et.\",
    \"due_date\": \"2051-09-07\",
    \"status\": \"done\",
    \"created_by\": 16,
    \"assigned_members\": [
        16
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/tasks/1"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "b",
    "description": "Eius et animi quos velit et.",
    "due_date": "2051-09-07",
    "status": "done",
    "created_by": 16,
    "assigned_members": [
        16
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-tasks--task_id-">
</span>
<span id="execution-results-PUTapi-v1-tasks--task_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-tasks--task_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-tasks--task_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-tasks--task_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-tasks--task_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-tasks--task_id-" data-method="PUT"
      data-path="api/v1/tasks/{task_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-tasks--task_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-tasks--task_id-"
                    onclick="tryItOut('PUTapi-v1-tasks--task_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-tasks--task_id-"
                    onclick="cancelTryOut('PUTapi-v1-tasks--task_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-tasks--task_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/tasks/{task_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-tasks--task_id-"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-tasks--task_id-"
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
                              name="Accept"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>due_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="due_date"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="2051-09-07"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>today</code>. Example: <code>2051-09-07</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="done"
               data-component="body">
    <br>
<p>Example: <code>done</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>todo</code></li> <li><code>in_progress</code></li> <li><code>done</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>created_by</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="created_by"                data-endpoint="PUTapi-v1-tasks--task_id-"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the membres table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>assigned_members</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="assigned_members[0]"                data-endpoint="PUTapi-v1-tasks--task_id-"
               data-component="body">
        <input type="number" style="display: none"
               name="assigned_members[1]"                data-endpoint="PUTapi-v1-tasks--task_id-"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the membres table.</p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-teams">Crée une nouvelle équipe</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-teams">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/teams" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/teams"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-teams">
</span>
<span id="execution-results-POSTapi-v1-teams" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-teams"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-teams"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-teams" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-teams">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-teams" data-method="POST"
      data-path="api/v1/teams"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-teams', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-teams"
                    onclick="tryItOut('POSTapi-v1-teams');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-teams"
                    onclick="cancelTryOut('POSTapi-v1-teams');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-teams"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/teams</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-teams"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-teams"
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
                              name="Accept"                data-endpoint="POSTapi-v1-teams"
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
                              name="name"                data-endpoint="POSTapi-v1-teams"
               value="b"
               data-component="body">
    <br>
<p>Must be at least 2 characters. Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-teams--team_id-">Supprime une équipe avec toutes ses données associées</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-teams--team_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/v1/teams/1" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/teams/1"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-teams--team_id-">
</span>
<span id="execution-results-DELETEapi-v1-teams--team_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-teams--team_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-teams--team_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-teams--team_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-teams--team_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-teams--team_id-" data-method="DELETE"
      data-path="api/v1/teams/{team_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-teams--team_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-teams--team_id-"
                    onclick="tryItOut('DELETEapi-v1-teams--team_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-teams--team_id-"
                    onclick="cancelTryOut('DELETEapi-v1-teams--team_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-teams--team_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/teams/{team_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-teams--team_id-"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-teams--team_id-"
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
                              name="Accept"                data-endpoint="DELETEapi-v1-teams--team_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>team_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="team_id"                data-endpoint="DELETEapi-v1-teams--team_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the team. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-members">Crée un nouveau membre</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-members">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/members" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"b\",
    \"last_name\": \"n\",
    \"email\": \"ashly64@example.com\",
    \"role\": \"developer\",
    \"team_id\": 4326.41688,
    \"joined_at\": \"2025-08-14T09:43:55\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/members"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "b",
    "last_name": "n",
    "email": "ashly64@example.com",
    "role": "developer",
    "team_id": 4326.41688,
    "joined_at": "2025-08-14T09:43:55"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-members">
</span>
<span id="execution-results-POSTapi-v1-members" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-members"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-members"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-members" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-members">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-members" data-method="POST"
      data-path="api/v1/members"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-members', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-members"
                    onclick="tryItOut('POSTapi-v1-members');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-members"
                    onclick="cancelTryOut('POSTapi-v1-members');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-members"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/members</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-members"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-members"
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
                              name="Accept"                data-endpoint="POSTapi-v1-members"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-v1-members"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-v1-members"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-members"
               value="ashly64@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>ashly64@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="POSTapi-v1-members"
               value="developer"
               data-component="body">
    <br>
<p>Example: <code>developer</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>manager</code></li> <li><code>developer</code></li> <li><code>designer</code></li> <li><code>tester</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>team_id</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="team_id"                data-endpoint="POSTapi-v1-members"
               value="4326.41688"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the equipes table. Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>joined_at</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="joined_at"                data-endpoint="POSTapi-v1-members"
               value="2025-08-14T09:43:55"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-08-14T09:43:55</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-members--member_id-">Supprime un membre</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-members--member_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/v1/members/1" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/members/1"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-members--member_id-">
</span>
<span id="execution-results-DELETEapi-v1-members--member_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-members--member_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-members--member_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-members--member_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-members--member_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-members--member_id-" data-method="DELETE"
      data-path="api/v1/members/{member_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-members--member_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-members--member_id-"
                    onclick="tryItOut('DELETEapi-v1-members--member_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-members--member_id-"
                    onclick="cancelTryOut('DELETEapi-v1-members--member_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-members--member_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/members/{member_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-members--member_id-"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-members--member_id-"
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
                              name="Accept"                data-endpoint="DELETEapi-v1-members--member_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member_id"                data-endpoint="DELETEapi-v1-members--member_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the member. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-tasks">Crée une nouvelle tâche</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-tasks">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/tasks" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"b\",
    \"description\": \"Eius et animi quos velit et.\",
    \"due_date\": \"2051-09-07\",
    \"status\": \"todo\",
    \"created_by\": 16,
    \"assigned_members\": [
        16
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/tasks"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "b",
    "description": "Eius et animi quos velit et.",
    "due_date": "2051-09-07",
    "status": "todo",
    "created_by": 16,
    "assigned_members": [
        16
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-tasks">
</span>
<span id="execution-results-POSTapi-v1-tasks" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-tasks"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-tasks"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-tasks" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-tasks">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-tasks" data-method="POST"
      data-path="api/v1/tasks"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-tasks', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-tasks"
                    onclick="tryItOut('POSTapi-v1-tasks');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-tasks"
                    onclick="cancelTryOut('POSTapi-v1-tasks');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-tasks"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/tasks</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-tasks"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-tasks"
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
                              name="Accept"                data-endpoint="POSTapi-v1-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-v1-tasks"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-tasks"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>due_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="due_date"                data-endpoint="POSTapi-v1-tasks"
               value="2051-09-07"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>today</code>. Example: <code>2051-09-07</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-v1-tasks"
               value="todo"
               data-component="body">
    <br>
<p>Example: <code>todo</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>todo</code></li> <li><code>in_progress</code></li> <li><code>done</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>created_by</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="created_by"                data-endpoint="POSTapi-v1-tasks"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the membres table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>assigned_members</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="assigned_members[0]"                data-endpoint="POSTapi-v1-tasks"
               data-component="body">
        <input type="number" style="display: none"
               name="assigned_members[1]"                data-endpoint="POSTapi-v1-tasks"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the membres table.</p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-tasks--task_id-">Supprime une tâche</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-tasks--task_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/v1/tasks/1" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/tasks/1"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-tasks--task_id-">
</span>
<span id="execution-results-DELETEapi-v1-tasks--task_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-tasks--task_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-tasks--task_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-tasks--task_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-tasks--task_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-tasks--task_id-" data-method="DELETE"
      data-path="api/v1/tasks/{task_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-tasks--task_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-tasks--task_id-"
                    onclick="tryItOut('DELETEapi-v1-tasks--task_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-tasks--task_id-"
                    onclick="cancelTryOut('DELETEapi-v1-tasks--task_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-tasks--task_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/tasks/{task_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-tasks--task_id-"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-tasks--task_id-"
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
                              name="Accept"                data-endpoint="DELETEapi-v1-tasks--task_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="DELETEapi-v1-tasks--task_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-tasks--task_id--assign">Assigne des membres à une tâche</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-tasks--task_id--assign">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/tasks/1/assign" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"member_ids\": [
        16
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/tasks/1/assign"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "member_ids": [
        16
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-tasks--task_id--assign">
</span>
<span id="execution-results-POSTapi-v1-tasks--task_id--assign" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-tasks--task_id--assign"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-tasks--task_id--assign"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-tasks--task_id--assign" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-tasks--task_id--assign">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-tasks--task_id--assign" data-method="POST"
      data-path="api/v1/tasks/{task_id}/assign"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-tasks--task_id--assign', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-tasks--task_id--assign"
                    onclick="tryItOut('POSTapi-v1-tasks--task_id--assign');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-tasks--task_id--assign"
                    onclick="cancelTryOut('POSTapi-v1-tasks--task_id--assign');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-tasks--task_id--assign"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/tasks/{task_id}/assign</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-tasks--task_id--assign"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-tasks--task_id--assign"
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
                              name="Accept"                data-endpoint="POSTapi-v1-tasks--task_id--assign"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="POSTapi-v1-tasks--task_id--assign"
               value="1"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>member_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member_ids[0]"                data-endpoint="POSTapi-v1-tasks--task_id--assign"
               data-component="body">
        <input type="number" style="display: none"
               name="member_ids[1]"                data-endpoint="POSTapi-v1-tasks--task_id--assign"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the membres table.</p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-tasks--task_id--unassign">Désassigne des membres d&#039;une tâche2</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-tasks--task_id--unassign">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/v1/tasks/1/unassign" \
    --header "Authorization: Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"member_ids\": [
        16
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/tasks/1/unassign"
);

const headers = {
    "Authorization": "Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "member_ids": [
        16
    ]
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-tasks--task_id--unassign">
</span>
<span id="execution-results-DELETEapi-v1-tasks--task_id--unassign" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-tasks--task_id--unassign"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-tasks--task_id--unassign"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-tasks--task_id--unassign" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-tasks--task_id--unassign">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-tasks--task_id--unassign" data-method="DELETE"
      data-path="api/v1/tasks/{task_id}/unassign"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-tasks--task_id--unassign', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-tasks--task_id--unassign"
                    onclick="tryItOut('DELETEapi-v1-tasks--task_id--unassign');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-tasks--task_id--unassign"
                    onclick="cancelTryOut('DELETEapi-v1-tasks--task_id--unassign');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-tasks--task_id--unassign"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/tasks/{task_id}/unassign</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-tasks--task_id--unassign"
               value="Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb"
               data-component="header">
    <br>
<p>Example: <code>Bearer 1|AlgoLk4OLY7VAdhCI5VyiZd3TYOICzRjb4mrQEbX1d5516fb</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-tasks--task_id--unassign"
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
                              name="Accept"                data-endpoint="DELETEapi-v1-tasks--task_id--unassign"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>task_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="task_id"                data-endpoint="DELETEapi-v1-tasks--task_id--unassign"
               value="1"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>member_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member_ids[0]"                data-endpoint="DELETEapi-v1-tasks--task_id--unassign"
               data-component="body">
        <input type="number" style="display: none"
               name="member_ids[1]"                data-endpoint="DELETEapi-v1-tasks--task_id--unassign"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the membres table.</p>
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
