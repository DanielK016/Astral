
# Configurare Mediu Dezvoltare

- **Visual Studio Code (VS Code)** – Editor Cod
- **Postman API Platform** – Testare API

## Instrucțiuni

1. Instalează [Visual Studio Code](https://code.visualstudio.com/).
2. Instalează [Postman](https://www.postman.com/downloads/).
3. Instalează Extensie [Postman](https://marketplace.visualstudio.com/items?itemName=Postman.postman-for-vscode).
4. Workspace Postman API Platform [Group Project API Test Workspace](https://lunar-firefly-684466.postman.co/workspace/Group-Project-API-Test~e468838b-ce98-4a7b-aac2-b274faabf6f2/)

# Documentație Rute

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/` | MenuController@menu | `menu` | Meniul principal |
| GET | `/continue` | MenuController@continue | `continue` | Continuare joc |
| POST | `/continue/{session}/load` | MenuController@load | `continue.load` | Încarcare sesiune |
| GET | `/settings` | MenuController@settings | `settings` | Setări joc |

## ***http_rest_api/menu/get_menu.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stellaris Galaxy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html, body { height: 100%; background: #050510; }
        .game-root { min-height: 100vh; background: radial-gradient(1200px 700px at 50% 20%, rgba(0,160,255,.10), transparent 60%), #050510; }
        .glass { backdrop-filter: blur(10px); background: rgba(0,0,0,.55); border: 1px solid rgba(0,170,255,.25); }
        .neon { text-shadow: 0 0 18px rgba(0,170,255,.55); }
        .btn-neon { border-color: rgba(0,170,255,.55); }
        .btn-neon:hover { box-shadow: 0 0 18px rgba(0,170,255,.35); }
        .menu-video { position: fixed; inset: 0; object-fit: cover; width: 100%; height: 100%; filter: contrast(1.05) saturate(1.05) brightness(0.75); }
        .menu-overlay { position: fixed; inset: 0; background: radial-gradient(900px 500px at 50% 20%, rgba(0,170,255,.12), transparent 60%), rgba(0,0,0,.55); }     
    </style>

    <style>
    .game-nav-shell {
        position: fixed;
        inset: 0 0 auto 0;
        z-index: 1100;
        padding: 10px 12px;
        pointer-events: none;
    }

    .game-nav-bar {
        pointer-events: auto;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 14px;
        border-radius: 22px;
        border: 1px solid rgba(143, 215, 255, .14);    
        background: linear-gradient(180deg, rgba(7, 14, 28, .82), rgba(4, 9, 18, .72));
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(0, 0, 0, .24);    
    }

    .game-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f1f7ff;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        text-decoration: none;
    }

    .game-nav-brand__dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8fd7ff;
        box-shadow: 0 0 16px rgba(143, 215, 255, .82); 
    }

    .game-nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .game-nav-label {
        color: rgba(220, 235, 255, .58);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .game-nav-lang {
        display: inline-flex;
        gap: 8px;
    }

    .game-nav-lang__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 13px;
        border: 1px solid rgba(143, 215, 255, .14);    
        background: rgba(255, 255, 255, .03);
        color: #d8e7ff;
        font-weight: 700;
        letter-spacing: .08em;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;  
    }

    .game-nav-lang__btn:hover,
    .game-nav-lang__btn.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .42);        
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);  
        color: #f4fbff;
    }

    .game-main {
        min-height: 100vh;
        padding-top: 82px;
    }

    .game-main--navless {
        padding-top: 0;
    }

    .astral-page-transition {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
        transition: opacity .46s ease, visibility .46s ease;
    }

    .astral-page-transition__glow {
        position: absolute;
        width: 42vmin;
        height: 42vmin;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(143, 215, 255, .22), transparent 68%);
        filter: blur(10px);
    }

    .astral-page-transition__label {
        position: relative;
        color: #eff7ff;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .30em;
        text-transform: uppercase;
    }

    .astral-page-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    @media (max-width: 720px) {
        .game-nav-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .game-nav-actions {
            justify-content: space-between;
        }
    }
</style>
</head>
<body>
    <div class="game-root " data-astral-page>
            <nav class="game-nav-shell">
            <div class="game-nav-bar">
                <a class="game-nav-brand" href="http://127.0.0.1:8000" data-page-link>
                    <span class="game-nav-brand__dot"></span>
                    Astral Empires
                </a>

                <div class="game-nav-actions">
                    <span class="game-nav-label">Language</span>
                    <div class="game-nav-lang" role="group" aria-label="Language">
                        <a class="game-nav-lang__btn active" href="http://127.0.0.1:8000/continue?lang=en" data-page-link>EN</a>
                        <a class="game-nav-lang__btn " href="http://127.0.0.1:8000/continue?lang=ro" data-page-link>RO</a>
                        <a class="game-nav-lang__btn " href="http://127.0.0.1:8000/continue?lang=ru" data-page-link>RU</a>
                    </div>
                </div>
            </div>
        </nav>

    <main class="game-main ">
        <div class="container py-5">
    <div class="glass rounded-4 p-4 p-md-5">
        <h2 class="text-info neon mb-4">Continue</h2>  

                    <div class="text-secondary">No saved games yet.</div>

        <a class="btn btn-outline-light mt-3" href="http://127.0.0.1:8000">← Back</a>
    </div>
</div>
    </main>

    <div class="astral-page-transition" data-page-transition>
        <div class="astral-page-transition__glow"></div>
        <div class="astral-page-transition__label">Loading</div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>      

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
      try { new bootstrap.Tooltip(el, { boundary: document.body }); } catch (e) {}
    });
  });
</script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.querySelector('[data-page-transition]');

        const showTransition = () => {
            overlay?.classList.add('is-visible');      
        };

        const hideTransition = () => {
            requestAnimationFrame(() => overlay?.classList.remove('is-visible'));
        };

        hideTransition();
        window.AstralPageTransition = { show: showTransition, hide: hideTransition };

        document.querySelectorAll('a[data-page-link]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }
                event.preventDefault();
                showTransition();
                setTimeout(() => window.location.href = href, 340);
        document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
            form.addEventListener('submit', () => showTransition());
        });
    });
</script>
</body>
</html>
```

## ***http_rest_api/menu/get_continue.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/continue
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/continue"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stellaris Galaxy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html, body { height: 100%; background: #050510; }
        .game-root { min-height: 100vh; background: radial-gradient(1200px 700px at 50% 20%, rgba(0,160,255,.10), transparent 60%), #050510; }
        .glass { backdrop-filter: blur(10px); background: rgba(0,0,0,.55); border: 1px solid rgba(0,170,255,.25); }
        .neon { text-shadow: 0 0 18px rgba(0,170,255,.55); }
        .btn-neon { border-color: rgba(0,170,255,.55); }
        .btn-neon:hover { box-shadow: 0 0 18px rgba(0,170,255,.35); }
        .menu-video { position: fixed; inset: 0; object-fit: cover; width: 100%; height: 100%; filter: contrast(1.05) saturate(1.05) brightness(0.75); }
        .menu-overlay { position: fixed; inset: 0; background: radial-gradient(900px 500px at 50% 20%, rgba(0,170,255,.12), transparent 60%), rgba(0,0,0,.55); }     
    </style>

    <style>
    .game-nav-shell {
        position: fixed;
        inset: 0 0 auto 0;
        z-index: 1100;
        padding: 10px 12px;
        pointer-events: none;
    }

    .game-nav-bar {
        pointer-events: auto;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 14px;
        border-radius: 22px;
        border: 1px solid rgba(143, 215, 255, .14);    
        background: linear-gradient(180deg, rgba(7, 14, 28, .82), rgba(4, 9, 18, .72));
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(0, 0, 0, .24);    
    }

    .game-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f1f7ff;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        text-decoration: none;
    }

    .game-nav-brand__dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8fd7ff;
        box-shadow: 0 0 16px rgba(143, 215, 255, .82); 
    }

    .game-nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .game-nav-label {
        color: rgba(220, 235, 255, .58);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .game-nav-lang {
        display: inline-flex;
        gap: 8px;
    }

    .game-nav-lang__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 13px;
        border: 1px solid rgba(143, 215, 255, .14);    
        background: rgba(255, 255, 255, .03);
        color: #d8e7ff;
        font-weight: 700;
        letter-spacing: .08em;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;  
    }

    .game-nav-lang__btn:hover,
    .game-nav-lang__btn.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .42);        
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);  
        color: #f4fbff;
    }

    .game-main {
        min-height: 100vh;
        padding-top: 82px;
    }

    .game-main--navless {
        padding-top: 0;
    }

    .astral-page-transition {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
        transition: opacity .46s ease, visibility .46s ease;
    }

    .astral-page-transition__glow {
        position: absolute;
        width: 42vmin;
        height: 42vmin;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(143, 215, 255, .22), transparent 68%);
        filter: blur(10px);
    }

    .astral-page-transition__label {
        position: relative;
        color: #eff7ff;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .30em;
        text-transform: uppercase;
    }

    .astral-page-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    @media (max-width: 720px) {
        .game-nav-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .game-nav-actions {
            justify-content: space-between;
        }
    }
</style>
</head>
<body>
    <div class="game-root " data-astral-page>
            <nav class="game-nav-shell">
            <div class="game-nav-bar">
                <a class="game-nav-brand" href="http://127.0.0.1:8000" data-page-link>
                    <span class="game-nav-brand__dot"></span>
                    Astral Empires
                </a>

                <div class="game-nav-actions">
                    <span class="game-nav-label">Language</span>
                    <div class="game-nav-lang" role="group" aria-label="Language">
                        <a class="game-nav-lang__btn active" href="http://127.0.0.1:8000/continue?lang=en" data-page-link>EN</a>
                        <a class="game-nav-lang__btn " href="http://127.0.0.1:8000/continue?lang=ro" data-page-link>RO</a>
                        <a class="game-nav-lang__btn " href="http://127.0.0.1:8000/continue?lang=ru" data-page-link>RU</a>
                    </div>
                </div>
            </div>
        </nav>

    <main class="game-main ">
        <div class="container py-5">
    <div class="glass rounded-4 p-4 p-md-5">
        <h2 class="text-info neon mb-4">Continue</h2>  

                    <div class="text-secondary">No saved games yet.</div>

        <a class="btn btn-outline-light mt-3" href="http://127.0.0.1:8000">← Back</a>
    </div>
</div>
    </main>

    <div class="astral-page-transition" data-page-transition>
        <div class="astral-page-transition__glow"></div>
        <div class="astral-page-transition__label">Loading</div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>      

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
      try { new bootstrap.Tooltip(el, { boundary: document.body }); } catch (e) {}
    });
  });
</script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.querySelector('[data-page-transition]');

        const showTransition = () => {
            overlay?.classList.add('is-visible');      
        };

        const hideTransition = () => {
            requestAnimationFrame(() => overlay?.classList.remove('is-visible'));
        };

        hideTransition();
        window.AstralPageTransition = { show: showTransition, hide: hideTransition };

        document.querySelectorAll('a[data-page-link]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }
                event.preventDefault();
                showTransition();
                setTimeout(() => window.location.href = href, 340);
        document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
            form.addEventListener('submit', () => showTransition());
        });
    });
</script>
</body>
</html>
```

## ***http_rest_api/menu/post_load.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/continue/1/load
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/continue/1/load" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Новая галактика", "seed": 1, "size": 300, "arms": 4, "notes": "Примечания" }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/menu/get_settings.sh***

**Postman API Platform**

***Request HTTP***

```
http://127.0.0.1:8000/settings
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/settings"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stellaris Galaxy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html, body { height: 100%; background: #050510; }
        .game-root { min-height: 100vh; background: radial-gradient(1200px 700px at 50% 20%, rgba(0,160,255,.10), transparent 60%), #050510; }
        .glass { backdrop-filter: blur(10px); background: rgba(0,0,0,.55); border: 1px solid rgba(0,170,255,.25); }
        .neon { text-shadow: 0 0 18px rgba(0,170,255,.55); }
        .btn-neon { border-color: rgba(0,170,255,.55); }
        .btn-neon:hover { box-shadow: 0 0 18px rgba(0,170,255,.35); }
        .menu-video { position: fixed; inset: 0; object-fit: cover; width: 100%; height: 100%; filter: contrast(1.05) saturate(1.05) brightness(0.75); }
        .menu-overlay { position: fixed; inset: 0; background: radial-gradient(900px 500px at 50% 20%, rgba(0,170,255,.12), transparent 60%), rgba(0,0,0,.55); } 
    </style>

    <style>
    .game-nav-shell {
        position: fixed;
        inset: 0 0 auto 0;
        z-index: 1100;
        padding: 10px 12px;
        pointer-events: none;
    }

    .game-nav-bar {
        pointer-events: auto;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 14px;
        border-radius: 22px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: linear-gradient(180deg, rgba(7, 14, 28, .82), rgba(4, 9, 18, .72));
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(0, 0, 0, .24);
    }

    .game-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f1f7ff;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        text-decoration: none;
    }

    .game-nav-brand__dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8fd7ff;
        box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .game-nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .game-nav-label {
        color: rgba(220, 235, 255, .58);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .game-nav-lang {
        display: inline-flex;
        gap: 8px;
    }

    .game-nav-lang__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 13px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #d8e7ff;
        font-weight: 700;
        letter-spacing: .08em;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .game-nav-lang__btn:hover,
    .game-nav-lang__btn.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .42);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);
        color: #f4fbff;
    }

    .game-main {
        min-height: 100vh;
        padding-top: 82px;
    }

    .game-main--navless {
        padding-top: 0;
    }

    .astral-page-transition {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
        transition: opacity .46s ease, visibility .46s ease;
    }

    .astral-page-transition__glow {
        position: absolute;
        width: 42vmin;
        height: 42vmin;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(143, 215, 255, .22), transparent 68%);
        filter: blur(10px);
    }

    .astral-page-transition__label {
        position: relative;
        color: #eff7ff;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .30em;
        text-transform: uppercase;
    }

    .astral-page-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    @media (max-width: 720px) {
        .game-nav-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .game-nav-actions {
            justify-content: space-between;
        }
    }
</style>
</head>
<body>
    <div class="game-root " data-astral-page>
            <nav class="game-nav-shell">
            <div class="game-nav-bar">
                <a class="game-nav-brand" href="http://127.0.0.1:8000" data-page-link>
                    <span class="game-nav-brand__dot"></span>
                    Astral Empires
                </a>

                <div class="game-nav-actions">
                    <span class="game-nav-label">Language</span>
                    <div class="game-nav-lang" role="group" aria-label="Language">
                        <a class="game-nav-lang__btn active" href="http://127.0.0.1:8000/settings?lang=en" data-page-link>EN</a>
                        <a class="game-nav-lang__btn " href="http://127.0.0.1:8000/settings?lang=ro" data-page-link>RO</a>
                        <a class="game-nav-lang__btn " href="http://127.0.0.1:8000/settings?lang=ru" data-page-link>RU</a>
                    </div>
                </div>
            </div>
        </nav>

    <main class="game-main ">
        <div class="container py-5">
    <div class="glass rounded-4 p-4 p-md-5">
        <h2 class="text-info neon mb-3">Settings</h2>
        <p class="text-secondary">Graphics, audio, and control settings will be added later.</p>
        <a class="btn btn-outline-light" href="http://127.0.0.1:8000">← Back</a>
    </div>
</div>
    </main>

    <div class="astral-page-transition" data-page-transition>
        <div class="astral-page-transition__glow"></div>
        <div class="astral-page-transition__label">Loading</div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
      try { new bootstrap.Tooltip(el, { boundary: document.body }); } catch (e) {}
    });
  });
</script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.querySelector('[data-page-transition]');

        const showTransition = () => {
            overlay?.classList.add('is-visible');
        };

        const hideTransition = () => {
            requestAnimationFrame(() => overlay?.classList.remove('is-visible'));
        };

        hideTransition();
        window.AstralPageTransition = { show: showTransition, hide: hideTransition };

        document.querySelectorAll('a[data-page-link]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }
                event.preventDefault();
                showTransition();
                setTimeout(() => window.location.href = href, 340);
            });
        });

        document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
            form.addEventListener('submit', () => showTransition());
        });
    });
</script>
</body>
</html>
```

## Rute Joc Nou

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/new-game/difficulty` | NewGameController@difficulty | `newgame.difficulty` | Selectare dificultate |
| POST | `/new-game/difficulty` | NewGameController@storeDifficulty | `newgame.difficulty.store` | Salvare dificultate |
| GET | `/new-game/race` | NewGameController@race | `newgame.race` | Selectează rasa jucătorului |
| POST | `/new-game/race` | NewGameController@storeRace | `newgame.race.store` | Salvează rasa |
| GET | `/new-game/configure` | NewGameController@configure | `newgame.configure` | Configurare setări joc |
| POST | `/new-game/configure` | NewGameController@storeConfigure | `newgame.configure.store` | Salvare configurație |
| GET | `/new-game/generate` | NewGameController@generating | `newgame.generate` | Afișare generare lume |
| POST | `/new-game/generate/run` | NewGameController@runGenerate | `newgame.generate.run` | Generare lume joc |

## ***http_rest_api/new_game/get_difficulty.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/new-game/difficulty
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/new-game/difficulty"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Choose Difficulty</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html, body { height: 100%; background: #050510; }
        .game-root { min-height: 100vh; background: radial-gradient(1200px 700px at 50% 20%, rgba(0,160,255,.10), transparent 60%), #050510; }
        .glass { backdrop-filter: blur(10px); background: rgba(0,0,0,.55); border: 1px solid rgba(0,170,255,.25); }
        .neon { text-shadow: 0 0 18px rgba(0,170,255,.55); }
        .btn-neon { border-color: rgba(0,170,255,.55); }
        .btn-neon:hover { box-shadow: 0 0 18px rgba(0,170,255,.35); }
        .menu-video { position: fixed; inset: 0; object-fit: cover; width: 100%; height: 100%; filter: contrast(1.05) saturate(1.05) brightness(0.75); }
        .menu-overlay { position: fixed; inset: 0; background: radial-gradient(900px 500px at 50% 20%, rgba(0,170,255,.12), transparent 60%), rgba(0,0,0,.55); } 
    </style>

    <style>
    .difficulty-scene {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        isolation: isolate;
        background: linear-gradient(180deg, rgba(4, 8, 16, .12), rgba(4, 8, 16, .76)),
        url("http://127.0.0.1:8000/assets/img_model_main/main_menu/mainMenu1.jpg") center center / cover no-repeat fixed;
    }

    .difficulty-scene::before,
    .difficulty-scene::after {
        content: '';
        position: fixed;
        inset: 0;
        pointer-events: none;
    }

    .difficulty-scene::before {
        background:
            radial-gradient(circle at 18% 20%, rgba(112, 201, 255, .16), transparent 24%),
            radial-gradient(circle at 84% 26%, rgba(255, 193, 119, .10), transparent 22%),
            linear-gradient(180deg, rgba(4, 10, 18, .24), rgba(3, 5, 11, .84));
        z-index: 1;
    }

    .difficulty-scene::after {
        background-image:
            linear-gradient(rgba(255, 255, 255, .026) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .02) 1px, transparent 1px);
        background-size: 64px 64px;
        mask-image: linear-gradient(180deg, transparent 0%, #000 20%, #000 84%, transparent 100%);
        opacity: .28;
        z-index: 2;
    }

    .difficulty-shell {
        position: relative;
        z-index: 3;
        min-height: 100vh;
        padding: clamp(22px, 3vw, 42px);
        display: grid;
        grid-template-columns: minmax(360px, 1.1fr) minmax(260px, .72fr);
        gap: clamp(20px, 2vw, 30px);
        align-items: stretch;
    }

    .difficulty-copy,
    .difficulty-nav {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity .85s ease, transform .85s ease;
    }

    .difficulty-scene.is-ready .difficulty-copy,
    .difficulty-scene.is-ready .difficulty-nav {
        opacity: 1;
        transform: translateY(0);
    }

    .difficulty-copy {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-width: 0;
    }

    .difficulty-header {
        max-width: min(820px, 100%);
    }

    .difficulty-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid rgba(144, 206, 255, .24);
        background: rgba(5, 12, 24, .34);
        backdrop-filter: blur(14px);
        font-size: .76rem;
        font-weight: 700;
        letter-spacing: .20em;
        text-transform: uppercase;
        color: #8fd7ff;
    }

    .difficulty-eyebrow::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #90d9ff;
        box-shadow: 0 0 18px rgba(144, 217, 255, .78);
    }

    .difficulty-heading {
        margin: 18px 0 14px;
        font-size: clamp(2.6rem, 5.2vw, 5rem);
        font-weight: 800;
        letter-spacing: .14em;
        line-height: .92;
        text-transform: uppercase;
        text-shadow: 0 0 36px rgba(59, 170, 255, .18);
        color: #f6fbff;

    }

    .difficulty-lead {
        max-width: 720px;
        margin: 0;
        color: rgba(236, 244, 255, .74);
        font-size: clamp(1rem, 1.28vw, 1.14rem);
        line-height: 1.78;
    }

    .difficulty-panel {
        margin-top: 26px;
        max-width: min(780px, 100%);
        padding: clamp(22px, 2.3vw, 30px);
        border-radius: 30px;
        background: linear-gradient(180deg, rgba(255, 255, 255, .048), rgba(255, 255, 255, .02)), rgba(5, 11, 22, .54);
        border: 1px solid rgba(150, 216, 255, .16);
        backdrop-filter: blur(18px);
        box-shadow: 0 24px 80px rgba(0, 0, 0, .34);
    }

    .difficulty-panel-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .difficulty-selected-eyebrow {
        color: #8fd7ff;
        font-size: .76rem;
        font-weight: 700;
        letter-spacing: .18em;
        text-transform: uppercase;
    }


    .difficulty-selected-name {
        margin: 10px 0 8px;
        font-size: clamp(1.85rem, 3vw, 2.5rem);
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #f6fbff;
    }

    .difficulty-selected-description,
    .difficulty-selected-summary,
    .difficulty-note {
        color: rgba(232, 241, 255, .76);
        line-height: 1.72;
    }

    .difficulty-skulls {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        min-width: 122px;
        justify-content: center;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, .08);
        background: rgba(255, 255, 255, .04);
    }

    .difficulty-skull {
        font-size: 1.16rem;
        opacity: .22;
        transition: opacity .22s ease, transform .22s ease, text-shadow .22s ease;
    }

    .difficulty-skull.is-active {
        opacity: 1;
        transform: translateY(-1px);
        text-shadow: 0 0 14px rgba(255, 208, 124, .48);
    }

    .difficulty-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-top: 22px;
    }

    .difficulty-meta-card {
        padding: 16px 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, .035);
        border: 1px solid rgba(255, 255, 255, .07);
    }

    .difficulty-meta-title {
        color: #ffd694;
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
    }

    .difficulty-meta-card ul {
        margin: 12px 0 0;
        padding-left: 18px;
        color: rgba(228, 238, 255, .82);
    }

    .difficulty-meta-card li+li {
        margin-top: 10px;
    }

    .difficulty-confirm {
        margin-top: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }

    .difficulty-submit {
        min-width: 268px;
        padding: 15px 24px;
        border-radius: 18px;
        border: 1px solid rgba(143, 215, 255, .34);
        background: linear-gradient(180deg, rgba(120, 205, 255, .16), rgba(255, 255, 255, .04));
        color: #f6fbff;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
        transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease, background .24s ease;
    }

    .difficulty-submit:hover,
    .difficulty-submit:focus-visible {
        transform: translateY(-2px);
        border-color: rgba(143, 215, 255, .58);
        box-shadow: 0 20px 46px rgba(0, 0, 0, .30), 0 0 24px rgba(96, 186, 255, .14);
        outline: none;
    }

    .difficulty-nav {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .difficulty-nav-panel {
        width: min(360px, 100%);
        padding: 20px;
        border-radius: 30px;
        background: linear-gradient(180deg, rgba(255, 255, 255, .05), rgba(255, 255, 255, .02)), rgba(4, 10, 22, .54);
        border: 1px solid rgba(150, 216, 255, .14);
        backdrop-filter: blur(18px);
        box-shadow: 0 24px 80px rgba(0, 0, 0, .34);
    }

    .difficulty-nav-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
    }

    .difficulty-back,
    .difficulty-lang a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 44px;
        padding: 0 14px;
        border-radius: 14px;
        border: 1px solid rgba(143, 215, 255, .16);
        background: rgba(255, 255, 255, .03);
        color: #eef8ff;
        text-decoration: none;
        transition: transform .2s ease, border-color .2s ease, background .2s ease, box-shadow .2s ease;
    }

    .difficulty-back:hover,
    .difficulty-lang a:hover,
    .difficulty-lang a.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .4);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .16);
    }

    .difficulty-lang {
        display: inline-flex;
        gap: 8px;
    }

    .difficulty-nav-title {
        color: rgba(232, 241, 255, .62);
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .difficulty-option {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        padding: 18px 18px 16px;
        border-radius: 22px;
        border: 1px solid rgba(163, 219, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #f1f7ff;
        text-align: left;
        transition: transform .26s ease, border-color .26s ease, background .26s ease, box-shadow .26s ease;
        box-shadow: 0 18px 40px rgba(0, 0, 0, .20);
    }

    .difficulty-option+.difficulty-option {
        margin-top: 12px;
    }

    .difficulty-option::after {
        content: '';
        position: absolute;
        inset: 1px;
        border-radius: inherit;
        border: 1px solid rgba(255, 255, 255, .04);
        pointer-events: none;
    }

    .difficulty-option:hover,
    .difficulty-option:focus-visible,
    .difficulty-option.is-active {
        transform: translateX(-4px);
        border-color: rgba(144, 217, 255, .34);
        background: rgba(95, 174, 255, .08);
        box-shadow: 0 22px 48px rgba(0, 0, 0, .26), 0 0 24px rgba(96, 186, 255, .12);
        outline: none;
    }

    .difficulty-option--easy.is-active {
        border-color: rgba(118, 255, 173, .34);
        background: rgba(40, 162, 98, .10);
    }

    .difficulty-option--hard.is-active {
        border-color: rgba(255, 139, 139, .34);
        background: rgba(160, 54, 54, .12);
    }

    .difficulty-option-eyebrow {
        color: rgba(232, 241, 255, .56);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .difficulty-option-name {
        font-size: 1.08rem;
        font-weight: 800;
        letter-spacing: .10em;
        text-transform: uppercase;
    }

    .difficulty-option-copy {
        color: rgba(232, 241, 255, .72);
        font-size: .92rem;
        line-height: 1.65;
    }

    @media (max-width: 1080px) {
        .difficulty-shell {
            grid-template-columns: 1fr;
        }

        .difficulty-nav {
            justify-content: stretch;
        }

        .difficulty-nav-panel,
        .difficulty-panel {
            width: 100%;
            max-width: none;
        }
    }

    @media (max-width: 720px) {
        .difficulty-shell {
            padding: 18px;
        }

        .difficulty-panel-top,
        .difficulty-confirm {
            flex-direction: column;
            align-items: flex-start;
        }

        .difficulty-meta-grid {
            grid-template-columns: 1fr;
        }

        .difficulty-submit {
            width: 100%;
            min-width: 0;
        }
    }
</style>
<style>
    .game-nav-shell {
        position: fixed;
        inset: 0 0 auto 0;
        z-index: 1100;
        padding: 10px 12px;
        pointer-events: none;
    }

    .game-nav-bar {
        pointer-events: auto;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 14px;
        border-radius: 22px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: linear-gradient(180deg, rgba(7, 14, 28, .82), rgba(4, 9, 18, .72));
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(0, 0, 0, .24);
    }

    .game-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f1f7ff;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        text-decoration: none;
    }

    .game-nav-brand__dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8fd7ff;
        box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .game-nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .game-nav-label {
        color: rgba(220, 235, 255, .58);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .game-nav-lang {
        display: inline-flex;
        gap: 8px;
    }

    .game-nav-lang__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 13px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #d8e7ff;
        font-weight: 700;
        letter-spacing: .08em;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .game-nav-lang__btn:hover,
    .game-nav-lang__btn.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .42);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);
        color: #f4fbff;
    }

    .game-main {
        min-height: 100vh;
        padding-top: 82px;
    }

    .game-main--navless {
        padding-top: 0;
    }

    .astral-page-transition {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
        transition: opacity .46s ease, visibility .46s ease;
    }

    .astral-page-transition__glow {
        position: absolute;
        width: 42vmin;
        height: 42vmin;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(143, 215, 255, .22), transparent 68%);
        filter: blur(10px);
    }

    .astral-page-transition__label {
        position: relative;
        color: #eff7ff;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .30em;
        text-transform: uppercase;
    }

    .astral-page-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    @media (max-width: 720px) {
        .game-nav-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .game-nav-actions {
            justify-content: space-between;
        }
    }
</style>
</head>
<body>
    <div class="game-root game-root--navless" data-astral-page>

    <main class="game-main game-main--navless">
        <div class="difficulty-scene" data-difficulty-scene>
    <form method="POST" action="http://127.0.0.1:8000/new-game/difficulty" class="difficulty-shell" data-difficulty-form>
        <input type="hidden" name="_token" value="E5PAE7vHLpHssRVjBcO4ZVbBYwcPRUvwtrsxGHwW">        <input type="hidden" name="difficulty" value="normal" data-difficulty-input>

        <section class="difficulty-copy">
            <div>
                <div class="difficulty-header">
                    <span class="difficulty-eyebrow">Campaign Setup</span>
                    <h1 class="difficulty-heading">Choose Difficulty</h1>
                    <p class="difficulty-lead">Set the tone of the campaign before creating your empire. The selected difficulty changes AI pressure, economic pacing, and the overall demand for precision. Once confirmed, difficulty cannot be changed later in the run.</p>
                </div>

                <div class="difficulty-panel">
                    <div class="difficulty-panel-top">
                        <div>
                            <div class="difficulty-selected-eyebrow" data-selected-eyebrow>Core Experience</div>
                            <div class="difficulty-selected-name" data-selected-name>Normal</div>
                            <p class="difficulty-selected-description mb-0" data-selected-description>The standard balance intended as the default campaign experience.</p>
                        </div>
                        <div class="difficulty-skulls" aria-label="Difficulty threat level">
                                                            <span class="difficulty-skull is-active" data-skull="1">☠</span>
                                                                <span class="difficulty-skull is-active" data-skull="2">☠</span>
                                                                <span class="difficulty-skull " data-skull="3">☠</span>
                                                        </div>
                    </div>

                    <div class="difficulty-meta-grid">
                        <div class="difficulty-meta-card">
                            <div class="difficulty-meta-title">Overview</div>
                            <p class="difficulty-selected-summary mb-0 mt-3" data-selected-summary>A balanced match between growth, threat, diplomacy, and decision pressure.</p>
                        </div>

                        <div class="difficulty-meta-card">
                            <div class="difficulty-meta-title">Parameters</div>
                            <ul class="mb-0" data-selected-parameters>
                                                                <li>Enemy empires use the intended default progression.</li>
                                                                <li>Economic pressure and expansion competition stay balanced.</li>
                                                                <li>Recommended for most players.</li>
                                                            </ul>
                        </div>
                    </div>

                    <div class="difficulty-confirm">
                        <p class="difficulty-note mb-0">Confirm your choice and continue to empire setup. This selection is locked for the current campaign.</p> 
                        <button type="submit" class="difficulty-submit">Confirm and Continue</button>
                    </div>
                </div>
            </div>
        </section>

        <aside class="difficulty-nav">
            <div class="difficulty-nav-panel">
                <div class="difficulty-nav-head">
                    <a class="difficulty-back" href="http://127.0.0.1:8000" data-page-link>←</a>
                    <div class="difficulty-lang" role="group" aria-label="Language">
                        <a href="http://127.0.0.1:8000/new-game/difficulty?lang=en" class="active" data-page-link>EN</a>
                        <a href="http://127.0.0.1:8000/new-game/difficulty?lang=ro" class="" data-page-link>RO</a>
                        <a href="http://127.0.0.1:8000/new-game/difficulty?lang=ru" class="" data-page-link>RU</a>
                    </div>
                </div>

                <div class="difficulty-nav-title">Difficulty Selection</div>

                                <button
                    type="button"
                    class="difficulty-option difficulty-option--easy "
                    data-difficulty-option="easy"
                    data-eyebrow="First Deployment"
                    data-name="Easy"
                    data-description="A gentle starting point for players entering Astral Empires for the first time."
                    data-summary="Best for learning exploration, expansion, claims, and planet management without constant pressure."
                    data-skulls="1"
                    data-parameters='["Enemy empires expand slower and react less aggressively.","Your economy stabilizes faster in the early game.","Early mistakes are easier to recover from."]'>
                    <span class="difficulty-option-eyebrow">First Deployment</span>
                    <span class="difficulty-option-name">Easy</span>
                    <span class="difficulty-option-copy">A gentle starting point for players entering Astral Empires for the first time.</span>
                </button>
                                <button
                    type="button"
                    class="difficulty-option difficulty-option--normal is-active"
                    data-difficulty-option="normal"
                    data-eyebrow="Core Experience"
                    data-name="Normal"
                    data-description="The standard balance intended as the default campaign experience."
                    data-summary="A balanced match between growth, threat, diplomacy, and decision pressure."
                    data-skulls="2"
                    data-parameters='["Enemy empires use the intended default progression.","Economic pressure and expansion competition stay balanced.","Recommended for most players."]'>
                    <span class="difficulty-option-eyebrow">Core Experience</span>
                    <span class="difficulty-option-name">Normal</span>
                    <span class="difficulty-option-copy">The standard balance intended as the default campaign experience.</span>
                </button>
                                <button
                    type="button"
                    class="difficulty-option difficulty-option--hard "
                    data-difficulty-option="hard"
                    data-eyebrow="Trial by Void"
                    data-name="Hard"
                    data-description="Designed for players who want to test their planning, tempo, and strategic discipline."
                    data-summary="Hostile empires capitalize on openings faster and poor decisions are much more punishing."
                    data-skulls="3"
                    data-parameters='["Enemies are more aggressive and reach power spikes sooner.","Territorial competition becomes harsher.","Optimization matters from the opening turns."]'>
                    <span class="difficulty-option-eyebrow">Trial by Void</span>
                    <span class="difficulty-option-name">Hard</span>
                    <span class="difficulty-option-copy">Designed for players who want to test their planning, tempo, and strategic discipline.</span>
                </button>
                            </div>
        </aside>
    </form>
</div>
    </main>

    <div class="astral-page-transition" data-page-transition>
        <div class="astral-page-transition__glow"></div>
        <div class="astral-page-transition__label">Loading</div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
      try { new bootstrap.Tooltip(el, { boundary: document.body }); } catch (e) {}
    });
  });
</script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const scene = document.querySelector('[data-difficulty-scene]');
        const difficultyInput = document.querySelector('[data-difficulty-input]');
        const optionButtons = Array.from(document.querySelectorAll('[data-difficulty-option]'));
        const eyebrow = document.querySelector('[data-selected-eyebrow]');
        const name = document.querySelector('[data-selected-name]');
        const description = document.querySelector('[data-selected-description]');
        const summary = document.querySelector('[data-selected-summary]');
        const parameters = document.querySelector('[data-selected-parameters]');
        const skulls = Array.from(document.querySelectorAll('[data-skull]'));

        requestAnimationFrame(() => scene?.classList.add('is-ready'));

        const applyDifficulty = (button) => {
            if (!button) return;

            optionButtons.forEach((item) => item.classList.toggle('is-active', item === button));
            difficultyInput.value = button.dataset.difficultyOption || 'normal';
            eyebrow.textContent = button.dataset.eyebrow || '';
            name.textContent = button.dataset.name || '';
            description.textContent = button.dataset.description || '';
            summary.textContent = button.dataset.summary || '';

            const parameterItems = JSON.parse(button.dataset.parameters || '[]');
            parameters.innerHTML = parameterItems.map((item) => `<li>${item}</li>`).join('');

            const level = Number(button.dataset.skulls || 0);
            skulls.forEach((skull) => {
                skull.classList.toggle('is-active', Number(skull.dataset.skull) <= level);
            });
        };

        optionButtons.forEach((button) => {
            button.addEventListener('click', () => applyDifficulty(button));
        });

        applyDifficulty(document.querySelector('[data-difficulty-option].is-active') || optionButtons[0]);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.querySelector('[data-page-transition]');

        const showTransition = () => {
            overlay?.classList.add('is-visible');
        };

        const hideTransition = () => {
            requestAnimationFrame(() => overlay?.classList.remove('is-visible'));
        };

        hideTransition();
        window.AstralPageTransition = { show: showTransition, hide: hideTransition };

        document.querySelectorAll('a[data-page-link]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }
                event.preventDefault();
                showTransition();
                setTimeout(() => window.location.href = href, 340);
            });
        });

        document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
            form.addEventListener('submit', () => showTransition());
        });
    });
</script>
</body>
</html>
```

## ***http_rest_api/new_game/post_storeDifficulty.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/new-game/difficulty
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/new-game/difficulty" \
     -H "Content-Type: application/json" \
     -d '{ "difficulty": "normal", "galaxy_size": "medium", "ai_count": 2 }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000/new-game/race'" />

        <title>Redirecting to http://127.0.0.1:8000/new-game/race</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000/new-game/race">http://127.0.0.1:8000/new-game/race</a>.
    </body>
</html>
```

## ***http_rest_api/new_game/get_race.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/new-game/race
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/new-game/race"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stellaris Galaxy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html, body { height: 100%; background: #050510; }
        .game-root { min-height: 100vh; background: radial-gradient(1200px 700px at 50% 20%, rgba(0,160,255,.10), transparent 60%), #050510; }
        .glass { backdrop-filter: blur(10px); background: rgba(0,0,0,.55); border: 1px solid rgba(0,170,255,.25); }
        .neon { text-shadow: 0 0 18px rgba(0,170,255,.55); }
        .btn-neon { border-color: rgba(0,170,255,.55); }
        .btn-neon:hover { box-shadow: 0 0 18px rgba(0,170,255,.35); }
        .menu-video { position: fixed; inset: 0; object-fit: cover; width: 100%; height: 100%; filter: contrast(1.05) saturate(1.05) brightness(0.75); }
        .menu-overlay { position: fixed; inset: 0; background: radial-gradient(900px 500px at 50% 20%, rgba(0,170,255,.12), transparent 60%), rgba(0,0,0,.55); } 
    </style>

    <style>
    .race-screen {
        min-height: 100vh;
        position: relative;
        padding: 1.5rem;
        background:
            radial-gradient(circle at 15% 15%, rgba(0, 180, 255, .14), transparent 28%),
            radial-gradient(circle at 85% 10%, rgba(19, 126, 255, .12), transparent 26%),
            linear-gradient(180deg, rgba(0, 16, 24, .92), rgba(0, 10, 18, .98));
        overflow: hidden;
    }

    .race-screen::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(98, 227, 255, .05), transparent 15%, transparent 85%, rgba(98, 227, 255, .05)),
            radial-gradient(circle at 50% 30%, rgba(0, 180, 255, .08), transparent 42%);
        pointer-events: none;
    }

    .race-topbar {
        position: relative;
        z-index: 3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        max-width: 1460px;
        margin: 0 auto 1rem;
    }

    .race-chip,
    .race-lang .btn,
    .race-nav-btn {
        backdrop-filter: blur(12px);
        background: rgba(3, 16, 28, .58);
        border: 1px solid rgba(98, 227, 255, .22);
        box-shadow: 0 0 24px rgba(0, 180, 255, .12);
        color: #d9fbff;
    }

    .race-chip {
        border-radius: 999px;
        padding: .7rem 1.05rem;
        text-decoration: none;
        font-weight: 700;
    }

    .race-lang .btn.active {
        background: rgba(0, 170, 255, .2);
        box-shadow: inset 0 0 0 1px rgba(120, 235, 255, .3), 0 0 18px rgba(0, 200, 255, .18);
    }

    .race-frame {
        position: relative;
        z-index: 2;
        max-width: 1460px;
        margin: 0 auto;
        padding: 1.15rem;
        border-radius: 24px;
        border: 1px solid rgba(111, 222, 255, .18);
        background: linear-gradient(180deg, rgba(5, 18, 28, .84), rgba(3, 11, 19, .94));
        box-shadow: 0 24px 60px rgba(0, 0, 0, .36), inset 0 0 0 1px rgba(145, 240, 255, .05);
    }

    .race-title {
        margin: 0 0 1rem;
        text-align: center;
        color: #effcff;
        font-size: clamp(1.8rem, 2.6vw, 2.8rem);
        font-weight: 700;
        letter-spacing: .04em;
        text-shadow: 0 0 22px rgba(86, 228, 255, .3);
    }

    .race-header-grid {
        display: grid;
        grid-template-columns: minmax(0, 2.45fr) minmax(260px, .85fr);
        gap: 1rem;
        align-items: stretch;
    }

    .hud-panel {
        position: relative;
        overflow: hidden;
        border-radius: 18px;
        background: linear-gradient(180deg, rgba(9, 28, 42, .68), rgba(5, 16, 25, .92));
        border: 1px solid rgba(98, 227, 255, .22);
        box-shadow: inset 0 0 0 1px rgba(128, 235, 255, .04), 0 14px 34px rgba(0, 0, 0, .3);
    }

    .hud-panel::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(123, 239, 255, .08), transparent 28%);
        pointer-events: none;
    }

    .race-banner-panel {
        display: grid;
        grid-template-columns: 160px minmax(0, 1fr);
        min-height: 290px;
    }

    .race-banner-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        border-right: 1px solid rgba(98, 227, 255, .14);
        background: linear-gradient(180deg, rgba(16, 40, 59, .78), rgba(8, 23, 34, .95));
    }

    .race-banner-icon img {
        width: min(100%, 132px);
        max-height: 132px;
        object-fit: contain;
        filter: drop-shadow(0 12px 20px rgba(0, 0, 0, .35));
    }

    .race-banner-main {
        position: relative;
        min-width: 0;
    }

    .race-banner-main img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .race-banner-overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(3, 12, 18, .3), rgba(3, 12, 18, .02) 40%, rgba(3, 12, 18, .42)),
            linear-gradient(180deg, rgba(132, 236, 255, .08), transparent 35%, rgba(0, 0, 0, .28));
    }

    .race-banner-copy {
        position: absolute;
        left: 1.15rem;
        right: 1.15rem;
        bottom: 1rem;
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 1rem;
        z-index: 2;
    }

    .race-banner-copy h2 {
        margin: 0;
        color: #f0fdff;
        font-size: clamp(1.3rem, 2vw, 2rem);
        font-weight: 700;
        text-shadow: 0 0 16px rgba(0, 0, 0, .45);
    }

    .race-banner-copy p {
        margin: .35rem 0 0;
        color: #a6f0ff;
        font-size: .95rem;
        max-width: 700px;
    }

    .race-homeworld-panel {
        display: flex;
        flex-direction: column;
        padding: 1rem;
        text-align: center;
    }

    .race-homeworld-name {
        color: #ffb449;
        font-size: 1.4rem;
        margin-bottom: .2rem;
    }

    .race-homeworld-type {
        color: #ecf9ff;
        font-size: 1.05rem;
        margin-bottom: .85rem;
    }

    .race-homeworld-panel img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(93, 225, 255, .18);
        box-shadow: 0 0 28px rgba(0, 170, 255, .16);
        background: rgba(0, 0, 0, .35);
    }

    .race-main-grid {
        display: grid;
        grid-template-columns: minmax(240px, .95fr) minmax(260px, .8fr) minmax(320px, 1.35fr);
        gap: 1rem;
        margin-top: 1rem;
        align-items: stretch;
    }

    .race-panel-title {
        margin: 0 0 .9rem;
        font-size: .88rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #89e8ff;
    }

    .race-info-panel,
    .race-avatar-panel,
    .race-description-panel {
        padding: 1rem;
    }

    .race-info-block+.race-info-block {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(98, 227, 255, .12);
    }

    .race-info-lead {
        color: #fff3d3;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: .8rem;
    }

    .race-bullet-list {
        display: grid;
        gap: .7rem;
    }

    .race-bullet-item {
        display: flex;
        gap: .75rem;
        align-items: start;
        color: #dff8ff;
        line-height: 1.35;
    }

    .race-bullet-item i {
        color: #28d7ff;
        text-shadow: 0 0 10px rgba(40, 215, 255, .4);
    }

    .race-avatar-label {
        color: #d8fcff;
        font-size: .95rem;
        margin-bottom: .7rem;
        font-weight: 600;
    }

    .race-avatar-box {
        overflow: hidden;
        border-radius: 14px;
        border: 1px solid rgba(98, 227, 255, .18);
        background: rgba(4, 14, 24, .85);
        aspect-ratio: 1 / 1;
        box-shadow: inset 0 0 0 1px rgba(145, 240, 255, .04);
    }

    .race-avatar-box img,
    .race-ship-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .race-select-wrap {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        gap: .8rem;
    }

    .race-nav-row {
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
    }

    .race-nav-btn,
    .race-select-btn {
        border-radius: 10px;
        border: 1px solid rgba(98, 227, 255, .22);
        text-decoration: none;
        transition: .2s ease;
    }

    .race-nav-btn {
        padding: .75rem 1rem;
        font-weight: 700;
    }

    .race-select-btn {
        width: 100%;
        padding: 16px 40px;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: .05em;
        text-transform: uppercase;
        color: #e7fdff;
        background: linear-gradient(180deg, rgba(6, 121, 152, .78), rgba(4, 66, 88, .92));
        box-shadow: inset 0 0 0 1px rgba(170, 244, 255, .08), 0 0 18px rgba(0, 200, 255, .18);
    }

    .race-nav-btn:hover,
    .race-select-btn:hover {
        transform: translateY(-1px);
        background: rgba(0, 255, 255, 0.15);
        box-shadow: 0 0 25px rgba(0, 200, 255, 0.5);
        color: #fff;
    }

    .race-description-panel {
        display: grid;
        grid-template-rows: auto auto;
        gap: 1rem;
    }

    .race-ship-box {
        overflow: hidden;
        border-radius: 14px;
        border: 1px solid rgba(98, 227, 255, .14);
        background: radial-gradient(circle at 30% 30%, rgba(0, 170, 255, .08), rgba(2, 8, 16, .92));
        min-height: 215px;
    }

    .race-ship-box img {
        object-fit: contain;
        padding: .5rem;
    }

    .race-lore {
        margin: 0;
        color: #d9f7ff;
        line-height: 1.5;
        white-space: pre-line;
    }

    @media (max-width: 1200px) {
        .race-main-grid {
            grid-template-columns: 1fr 1fr;
        }

        .race-description-panel {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 991.98px) {
        .race-screen {
            padding: 1rem;
        }

        .race-header-grid,
        .race-main-grid {
            grid-template-columns: 1fr;
        }

        .race-banner-panel {
            grid-template-columns: 120px minmax(0, 1fr);
            min-height: 260px;
        }
    }

    @media (max-width: 767.98px) {
        .race-topbar {
            flex-direction: column;
            align-items: stretch;
        }

        .race-frame {
            padding: .8rem;
            border-radius: 18px;
        }

        .race-title {
            font-size: clamp(1.35rem, 6vw, 2rem);
        }

        .race-banner-panel {
            grid-template-columns: 1fr;
            min-height: 340px;
        }

        .race-banner-icon {
            min-height: 120px;
            border-right: 0;
            border-bottom: 1px solid rgba(98, 227, 255, .14);
        }

        .race-banner-copy {
            left: .85rem;
            right: .85rem;
            bottom: .85rem;
            flex-direction: column;
            align-items: start;
        }
    }
</style>
<style>
    .game-nav-shell {
        position: fixed;
        inset: 0 0 auto 0;
        z-index: 1100;
        padding: 10px 12px;
        pointer-events: none;
    }

    .game-nav-bar {
        pointer-events: auto;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 14px;
        border-radius: 22px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: linear-gradient(180deg, rgba(7, 14, 28, .82), rgba(4, 9, 18, .72));
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(0, 0, 0, .24);
    }

    .game-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f1f7ff;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        text-decoration: none;
    }

    .game-nav-brand__dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8fd7ff;
        box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .game-nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .game-nav-label {
        color: rgba(220, 235, 255, .58);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .game-nav-lang {
        display: inline-flex;
        gap: 8px;
    }

    .game-nav-lang__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 13px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #d8e7ff;
        font-weight: 700;
        letter-spacing: .08em;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .game-nav-lang__btn:hover,
    .game-nav-lang__btn.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .42);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);
        color: #f4fbff;
    }

    .game-main {
        min-height: 100vh;
        padding-top: 82px;
    }

    .game-main--navless {
        padding-top: 0;
    }

    .astral-page-transition {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
        transition: opacity .46s ease, visibility .46s ease;
    }

    .astral-page-transition__glow {
        position: absolute;
        width: 42vmin;
        height: 42vmin;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(143, 215, 255, .22), transparent 68%);
        filter: blur(10px);
    }

    .astral-page-transition__label {
        position: relative;
        color: #eff7ff;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .30em;
        text-transform: uppercase;
    }

    .astral-page-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    @media (max-width: 720px) {
        .game-nav-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .game-nav-actions {
            justify-content: space-between;
        }
    }
</style>
</head>
<body>
    <div class="game-root game-root--navless" data-astral-page>

    <main class="game-main game-main--navless">
        <div class="race-screen">
    <div class="race-topbar">
        <a class="race-chip" href="http://127.0.0.1:8000/new-game/difficulty">← Back</a>

        <div class="btn-group race-lang" role="group" aria-label="Language">
            <a class="btn btn-sm btn-outline-info active" href="http://127.0.0.1:8000/new-game/race?lang=en">EN</a>
            <a class="btn btn-sm btn-outline-info " href="http://127.0.0.1:8000/new-game/race?lang=ro">RO</a>
            <a class="btn btn-sm btn-outline-info " href="http://127.0.0.1:8000/new-game/race?lang=ru">RU</a>
        </div>
    </div>

    <div class="race-frame">
        <h1 class="race-title">United Terran Federation</h1>

        <div class="race-header-grid">
            <section class="hud-panel race-banner-panel">
                <div class="race-banner-icon">
                    <img src="http://127.0.0.1:8000/assets/img_model_main/human/RASA/human_icon.png" alt="United Terran Federation icon">
                </div>

                <div class="race-banner-main">
                    <img src="http://127.0.0.1:8000/assets/img_model_main/human/RASA/human_baner.png" alt="United Terran Federation banner">
                    <div class="race-banner-overlay"></div>

                    <div class="race-banner-copy">
                        <div>
                            <h2>Select Race</h2>
                            <p>Diplomacy &amp; sensors. Balanced economy and research.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="hud-panel race-homeworld-panel">
                <div class="race-panel-title">Homeworld</div>
                <div class="race-homeworld-name">Terra Prime</div>
                <div class="race-homeworld-type">Continental World</div>
                <img src="http://127.0.0.1:8000/assets/img_model_main/human/RASA/human_planet.png" alt="United Terran Federation planet">
            </section>
        </div>

        <div class="race-main-grid">
            <section class="hud-panel race-info-panel">
                <div class="race-info-block">
                    <h3 class="race-panel-title">Government</h3>
                    <div class="race-info-lead">Parliamentary Federation</div>

                    <div class="race-bullet-list">
                                                <div class="race-bullet-item">
                            <i class="bi bi-stars"></i>
                            <span>Egalitarian</span>
                        </div>
                                                <div class="race-bullet-item">
                            <i class="bi bi-stars"></i>
                            <span>Xenophile</span>
                        </div>
                                            </div>
                </div>

                <div class="race-info-block">
                    <h3 class="race-panel-title">Traits</h3>

                    <div class="race-bullet-list">
                                                <div class="race-bullet-item">
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Adaptive</span>
                        </div>
                                                <div class="race-bullet-item">
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Diplomatic Corps</span>
                        </div>
                                                <div class="race-bullet-item">
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Research Driven</span>
                        </div>
                                                <div class="race-bullet-item">
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Balanced Growth</span>
                        </div>
                                            </div>
                </div>
            </section>

            <section class="hud-panel race-avatar-panel">
                <div class="race-avatar-label">Avatar</div>

                <div class="race-avatar-box">
                    <img src="http://127.0.0.1:8000/assets/img_model_main/human/RASA/human_avatar.png" alt="United Terran Federation avatar">
                </div>

                <div class="race-select-wrap">
                    <div class="race-nav-row">
                        <a class="race-nav-btn" href="http://127.0.0.1:8000/new-game/race?i=2">← Back</a>
                        <a class="race-nav-btn" href="http://127.0.0.1:8000/new-game/race?i=1">Next →</a>
                    </div>

                    <form method="POST" action="http://127.0.0.1:8000/new-game/race">
                        <input type="hidden" name="_token" value="lbovuZCzZz1xzAhNFikeh9GqLdOa7Yjp6zzAKmR2">                        <input type="hidden" name="race_key" value="humans">
                        <button class="race-select-btn" type="submit">Select</button>
                    </form>
                </div>
            </section>

            <section class="hud-panel race-description-panel">
                <div>
                    <h3 class="race-panel-title">Ship Class</h3>
                    <div class="race-ship-box">
                        <img src="http://127.0.0.1:8000/assets/img_model_main/human/RASA/human_ship.png" alt="United Terran Federation ship">
                    </div>
                </div>

                <div>
                    <h3 class="race-panel-title">Description</h3>
                    <p class="race-lore">United Terran Federation — a resilient, united human civilization.

Its worlds are bound by diplomacy, scientific ambition, and disciplined expansion across the stars.</p>
                </div>
            </section>
        </div>
    </div>
</div>
    </main>

    <div class="astral-page-transition" data-page-transition>
        <div class="astral-page-transition__glow"></div>
        <div class="astral-page-transition__label">Loading</div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
      try { new bootstrap.Tooltip(el, { boundary: document.body }); } catch (e) {}
    });
  });
</script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.querySelector('[data-page-transition]');

        const showTransition = () => {
            overlay?.classList.add('is-visible');
        };

        const hideTransition = () => {
            requestAnimationFrame(() => overlay?.classList.remove('is-visible'));
        };

        hideTransition();
        window.AstralPageTransition = { show: showTransition, hide: hideTransition };

        document.querySelectorAll('a[data-page-link]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }
                event.preventDefault();
                showTransition();
                setTimeout(() => window.location.href = href, 340);
            });
        });

        document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
            form.addEventListener('submit', () => showTransition());
        });
    });
</script>
</body>
</html>
```

## ***http_rest_api/new_game/post_storeRace.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/new-game/race
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "POST http://127.0.0.1:8000/new-game/race" \
     -H "Content-Type: application/json" \
     -d '{ "race_key": "Data" }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000/new-game/configure'" />

        <title>Redirecting to http://127.0.0.1:8000/new-game/configure</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000/new-game/configure">http://127.0.0.1:8000/new-game/configure</a>.
    </body>
</html>
```

## ***http_rest_api/new_game/get_configure.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/new-game/configure
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/new-game/configure"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stellaris Galaxy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html, body { height: 100%; background: #050510; }
        .game-root { min-height: 100vh; background: radial-gradient(1200px 700px at 50% 20%, rgba(0,160,255,.10), transparent 60%), #050510; }
        .glass { backdrop-filter: blur(10px); background: rgba(0,0,0,.55); border: 1px solid rgba(0,170,255,.25); }
        .neon { text-shadow: 0 0 18px rgba(0,170,255,.55); }
        .btn-neon { border-color: rgba(0,170,255,.55); }
        .btn-neon:hover { box-shadow: 0 0 18px rgba(0,170,255,.35); }
        .menu-video { position: fixed; inset: 0; object-fit: cover; width: 100%; height: 100%; filter: contrast(1.05) saturate(1.05) brightness(0.75); }
        .menu-overlay { position: fixed; inset: 0; background: radial-gradient(900px 500px at 50% 20%, rgba(0,170,255,.12), transparent 60%), rgba(0,0,0,.55); } 
    </style>

    <style>
    .game-root {
        background:
            linear-gradient(180deg, rgba(2, 8, 20, .45), rgba(2, 8, 20, .9)),
            radial-gradient(1200px 800px at 50% 10%, rgba(0, 165, 255, .18), transparent 58%),
            url('http://127.0.0.1:8000/assets/img_model_main/configure/img_fon/fon.png') center / cover no-repeat fixed;
    }

    .configure-page {
        min-height: calc(100vh - 72px);
        display: flex;
        align-items: center;
        padding: 1.5rem 0;
    }

    .configure-card {
        backdrop-filter: blur(14px);
        background: rgba(1, 9, 20, .52);
        border: 1px solid rgba(103, 227, 255, .18);
        border-radius: 1.25rem;
        box-shadow: 0 20px 44px rgba(0,0,0,.28);
        height: 100%;
    }

    .bonus-row {
        display: flex;
        align-items: flex-start;
        gap: .75rem;
    }

    .bonus-icon {
        width: 40px;
        height: 40px;
        object-fit: contain;
        flex: 0 0 40px;
        border-radius: .65rem;
        filter: drop-shadow(0 8px 15px rgba(0,0,0,.35));
    }

    .bonus-text {
        line-height: 1.25;
    }

    .form-check-input {
        margin-top: .45rem;
    }
</style>
<style>
    .game-nav-shell {
        position: fixed;
        inset: 0 0 auto 0;
        z-index: 1100;
        padding: 10px 12px;
        pointer-events: none;
    }

    .game-nav-bar {
        pointer-events: auto;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 14px;
        border-radius: 22px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: linear-gradient(180deg, rgba(7, 14, 28, .82), rgba(4, 9, 18, .72));
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(0, 0, 0, .24);
    }

    .game-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f1f7ff;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        text-decoration: none;
    }

    .game-nav-brand__dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8fd7ff;
        box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .game-nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .game-nav-label {
        color: rgba(220, 235, 255, .58);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .game-nav-lang {
        display: inline-flex;
        gap: 8px;
    }

    .game-nav-lang__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 13px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #d8e7ff;
        font-weight: 700;
        letter-spacing: .08em;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .game-nav-lang__btn:hover,
    .game-nav-lang__btn.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .42);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);
        color: #f4fbff;
    }

    .game-main {
        min-height: 100vh;
        padding-top: 82px;
    }

    .game-main--navless {
        padding-top: 0;
    }

    .astral-page-transition {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
        transition: opacity .46s ease, visibility .46s ease;
    }

    .astral-page-transition__glow {
        position: absolute;
        width: 42vmin;
        height: 42vmin;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(143, 215, 255, .22), transparent 68%);
        filter: blur(10px);
    }

    .astral-page-transition__label {
        position: relative;
        color: #eff7ff;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .30em;
        text-transform: uppercase;
    }

    .astral-page-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    @media (max-width: 720px) {
        .game-nav-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .game-nav-actions {
            justify-content: space-between;
        }
    }
</style>
</head>
<body>
    <div class="game-root " data-astral-page>
            <nav class="game-nav-shell">
            <div class="game-nav-bar">
                <a class="game-nav-brand" href="http://127.0.0.1:8000" data-page-link>
                    <span class="game-nav-brand__dot"></span>
                    Astral Empires
                </a>

                <div class="game-nav-actions">
                    <span class="game-nav-label">Language</span>
                    <div class="game-nav-lang" role="group" aria-label="Language">
                        <a class="game-nav-lang__btn active" href="http://127.0.0.1:8000/new-game/configure?lang=en" data-page-link>EN</a>
                        <a class="game-nav-lang__btn " href="http://127.0.0.1:8000/new-game/configure?lang=ro" data-page-link>RO</a>
                        <a class="game-nav-lang__btn " href="http://127.0.0.1:8000/new-game/configure?lang=ru" data-page-link>RU</a>
                    </div>
                </div>
            </div>
        </nav>

    <main class="game-main ">
        <div class="configure-page">
    <div class="container">
        <div class="glass rounded-4 p-4 p-md-5">
            <h2 class="text-info neon mb-4">Configure Empire</h2>

            <form method="POST" action="http://127.0.0.1:8000/new-game/configure">
                <input type="hidden" name="_token" value="LTiIvTd9wQ3mcsaE53zgvgRLzPVgREBDLGS18fmf">
                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div class="configure-card p-3 p-md-4">
                            <h5 class="text-warning mb-3">Passive Bonuses</h5>

                                                                                            <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="checkbox" name="passives[]" value="econ_boost" id="p_econ_boost" >
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="p_econ_boost">
                                                                                            <img src="http://127.0.0.1:8000/assets/img_model_main/configure/icon_1.png" class="bonus-icon" alt="Efficient Economy" data-bs-toggle="tooltip" data-bs-placement="top" title="Efficient Economy">
                                                                                        <div class="bonus-text">
                                                <span class="fw-bold">Efficient Economy</span>
                                                <span class="text-secondary small">— +10% Energy &amp; Minerals income.</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                                                                            <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="checkbox" name="passives[]" value="science_boost" id="p_science_boost" >
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="p_science_boost">
                                                                                            <img src="http://127.0.0.1:8000/assets/img_model_main/configure/icon_2.png" class="bonus-icon" alt="Research Focus" data-bs-toggle="tooltip" data-bs-placement="top" title="Research Focus">
                                                                                        <div class="bonus-text">
                                                <span class="fw-bold">Research Focus</span>
                                                <span class="text-secondary small">— +15% Science income.</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                                                                            <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="checkbox" name="passives[]" value="unity_boost" id="p_unity_boost" >
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="p_unity_boost">
                                                                                            <img src="http://127.0.0.1:8000/assets/img_model_main/configure/icon_3.png" class="bonus-icon" alt="Cultural Cohesion" data-bs-toggle="tooltip" data-bs-placement="top" title="Cultural Cohesion">
                                                                                        <div class="bonus-text">
                                                <span class="fw-bold">Cultural Cohesion</span>
                                                <span class="text-secondary small">— +2 Unity income.</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                                                                            <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="checkbox" name="passives[]" value="influence_boost" id="p_influence_boost" >       
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="p_influence_boost">
                                                                                            <img src="http://127.0.0.1:8000/assets/img_model_main/configure/icon_4.png" class="bonus-icon" alt="Political Leverage" data-bs-toggle="tooltip" data-bs-placement="top" title="Political Leverage">
                                                                                        <div class="bonus-text">
                                                <span class="fw-bold">Political Leverage</span>
                                                <span class="text-secondary small">— +1 Influence income.</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                                                                            <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="checkbox" name="passives[]" value="growth_boost" id="p_growth_boost" >
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="p_growth_boost">
                                                                                            <img src="http://127.0.0.1:8000/assets/img_model_main/configure/icon_5.png" class="bonus-icon" alt="Population Growth" data-bs-toggle="tooltip" data-bs-placement="top" title="Population Growth">
                                                                                        <div class="bonus-text">
                                                <span class="fw-bold">Population Growth</span>
                                                <span class="text-secondary small">— +10% population growth (prototype: +happiness).</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                            <div class="text-secondary small mt-2">Choose up to 2.</div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="configure-card p-3 p-md-4">
                            <h5 class="text-warning mb-3">Active Abilities</h5>

                                                                                            <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="radio" name="active" value="deep_scan" id="a_deep_scan" checked>
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="a_deep_scan">
                                                                                            <img src="http://127.0.0.1:8000/assets/img_model_main/configure/icon_6.png" class="bonus-icon" alt="Deep Scan" data-bs-toggle="tooltip" data-bs-placement="top" title="Deep Scan">
                                                                                        <div class="bonus-text">
                                                <span class="fw-bold">Deep Scan</span>
                                                <span class="text-secondary small">— Instantly discover all adjacent systems (cost: 10 Energy).</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                                                                            <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="radio" name="active" value="emergency_power" id="a_emergency_power" >
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="a_emergency_power">
                                                                                            <img src="http://127.0.0.1:8000/assets/img_model_main/configure/icon_7.png" class="bonus-icon" alt="Emergency Power" data-bs-toggle="tooltip" data-bs-placement="top" title="Emergency Power">
                                                                                        <div class="bonus-text">
                                                <span class="fw-bold">Emergency Power</span>
                                                <span class="text-secondary small">— Gain +30 Energy (cooldown 3 turns).</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                                                                            <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="radio" name="active" value="war_protocol" id="a_war_protocol" >
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="a_war_protocol">
                                                                                            <img src="http://127.0.0.1:8000/assets/img_model_main/configure/icon_8.png" class="bonus-icon" alt="War Protocol" data-bs-toggle="tooltip" data-bs-placement="top" title="War Protocol">
                                                                                        <div class="bonus-text">
                                                <span class="fw-bold">War Protocol</span>
                                                <span class="text-secondary small">— +15% combat power for next battle this turn.</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                            <div class="text-secondary small mt-2">Choose 1.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="configure-card p-3 p-md-4">
                            <h5 class="text-warning mb-3">Galaxy Setup</h5>

                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label text-light">Galaxy size</label>
                                    <select class="form-select bg-dark text-light border border-info border-opacity-25" name="galaxy_size">
                                                                                    <option value="small" >Small</option>
                                                                                    <option value="medium" selected>Medium</option>
                                                                                    <option value="large" >Large</option>
                                                                            </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label text-light">AI opponents</label>
                                    <select class="form-select bg-dark text-light border border-info border-opacity-25" name="ai_count">
                                                                                    <option value="1" >1</option>
                                                                                    <option value="2" selected>2</option>
                                                                                    <option value="3" >3</option>
                                                                            </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a class="btn btn-outline-light" href="http://127.0.0.1:8000/new-game/race">← Back</a>
                    <button class="btn btn-outline-info btn-neon ms-auto">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </main>

    <div class="astral-page-transition" data-page-transition>
        <div class="astral-page-transition__glow"></div>
        <div class="astral-page-transition__label">Loading</div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
      try { new bootstrap.Tooltip(el, { boundary: document.body }); } catch (e) {}
    });
  });
</script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.querySelector('[data-page-transition]');

        const showTransition = () => {
            overlay?.classList.add('is-visible');
        };

        const hideTransition = () => {
            requestAnimationFrame(() => overlay?.classList.remove('is-visible'));
        };

        hideTransition();
        window.AstralPageTransition = { show: showTransition, hide: hideTransition };

        document.querySelectorAll('a[data-page-link]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }
                event.preventDefault();
                showTransition();
                setTimeout(() => window.location.href = href, 340);
            });
        });

        document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
            form.addEventListener('submit', () => showTransition());
        });
    });
</script>
</body>
</html>
```

## ***http_rest_api/new_game/post_storeConfigure.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/new-game/configure
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/new-game/configure" \
     -H "Content-Type: application/json" \
     -d '{ "player_name": "Name", "ai_count": 2, "galaxy_size": "medium" }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000/new-game/generate'" />

        <title>Redirecting to http://127.0.0.1:8000/new-game/generate</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000/new-game/generate">http://127.0.0.1:8000/new-game/generate</a>.
    </body>
</html>
```

## ***http_rest_api/new_game/get_generating.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/new-game/generate
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/new-game/generate"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stellaris Galaxy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html, body { height: 100%; background: #050510; }
        .game-root { min-height: 100vh; background: radial-gradient(1200px 700px at 50% 20%, rgba(0,160,255,.10), transparent 60%), #050510; }
        .glass { backdrop-filter: blur(10px); background: rgba(0,0,0,.55); border: 1px solid rgba(0,170,255,.25); }
        .neon { text-shadow: 0 0 18px rgba(0,170,255,.55); }
        .btn-neon { border-color: rgba(0,170,255,.55); }
        .btn-neon:hover { box-shadow: 0 0 18px rgba(0,170,255,.35); }
        .menu-video { position: fixed; inset: 0; object-fit: cover; width: 100%; height: 100%; filter: contrast(1.05) saturate(1.05) brightness(0.75); }
        .menu-overlay { position: fixed; inset: 0; background: radial-gradient(900px 500px at 50% 20%, rgba(0,170,255,.12), transparent 60%), rgba(0,0,0,.55); } 
    </style>

    <style>
    .game-root {
        min-height: 100vh;
        background:
            radial-gradient(circle at 18% 18%, rgba(117, 193, 255, .14), transparent 30%),
            radial-gradient(circle at 82% 22%, rgba(255, 191, 96, .10), transparent 24%),
            linear-gradient(180deg, rgba(5, 9, 17, .34), rgba(3, 6, 12, .92)),
            url('http://127.0.0.1:8000/assets/img_model_main/main_menu/frozenMain_4k.png') center / cover no-repeat fixed;
        position: relative;
        overflow: hidden;
    }

    .generation-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .generation-page::before,
    .generation-page::after {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    .generation-page::before {
        background:
            linear-gradient(rgba(255, 255, 255, .025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .02) 1px, transparent 1px);
        background-size: 62px 62px;
        mask-image: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, .84) 20%, #000 70%, transparent 100%);
        opacity: .28;
    }

    .generation-page::after {
        background: radial-gradient(circle at 50% 50%, transparent 46%, rgba(0, 0, 0, .42) 100%);
    }

    .generation-card {
        position: relative;
        width: min(100%, 760px);
        padding: clamp(28px, 4vw, 44px);
        border: 1px solid rgba(153, 218, 255, .2);
        border-radius: 30px;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .015)),
            rgba(5, 10, 22, .62);
        backdrop-filter: blur(18px);
        box-shadow: 0 24px 80px rgba(0, 0, 0, .42);
        overflow: hidden;
    }

    .generation-card::before {
        content: '';
        position: absolute;
        inset: 1px;
        border-radius: inherit;
        border: 1px solid rgba(255, 255, 255, .04);
        pointer-events: none;
    }

    .generation-card__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid rgba(144, 211, 255, .22);
        background: rgba(255, 255, 255, .04);
        color: #8ed8ff;
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .generation-card__eyebrow::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #8ed8ff;
        box-shadow: 0 0 18px rgba(142, 216, 255, .8);
    }

    .generation-title {
        margin: 20px 0 10px;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #f5fbff;
        text-shadow: 0 0 24px rgba(74, 183, 255, .18);
    }

    .generation-copy {
        margin: 0;
        max-width: 640px;
        color: rgba(228, 238, 255, .74);
        font-size: 1rem;
        line-height: 1.7;
    }

    .generation-actions {
        margin-top: 28px;
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    .generation-button,
    .generation-back {
        min-width: 170px;
        padding: 14px 20px;
        border-radius: 18px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease, background .25s ease;
    }

    .generation-button {
        border: 1px solid rgba(143, 215, 255, .34);
        background: linear-gradient(180deg, rgba(118, 200, 255, .18), rgba(255, 255, 255, .04));
        color: #f7fbff;
        box-shadow: 0 16px 40px rgba(0, 0, 0, .28);
    }

    .generation-button:hover,
    .generation-button:focus-visible {
        border-color: rgba(143, 215, 255, .62);
        box-shadow: 0 20px 48px rgba(0, 0, 0, .34), 0 0 28px rgba(96, 186, 255, .18);
        transform: translateY(-3px);
        outline: none;
    }

    .generation-back {
        border: 1px solid rgba(255, 255, 255, .12);
        background: rgba(255, 255, 255, .04);
        color: rgba(236, 242, 255, .88);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .generation-back:hover,
    .generation-back:focus-visible {
        border-color: rgba(255, 255, 255, .26);
        color: #fff;
        transform: translateY(-3px);
        outline: none;
    }

    .generation-status {
        margin-top: 28px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .generation-status__item {
        padding: 14px 16px;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 18px;
        background: rgba(255, 255, 255, .035);
    }

    .generation-status__label {
        display: block;
        margin-bottom: 6px;
        color: rgba(214, 228, 255, .56);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .generation-status__value {
        display: block;
        color: #f4f8ff;
        font-size: .96rem;
        font-weight: 700;
        letter-spacing: .06em;
    }

    .generation-loading {
        position: fixed;
        inset: 0;
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity .45s ease, visibility .45s ease;
        background: rgba(2, 5, 10, .78);
    }

    .generation-loading__video,
    .generation-loading__shade,
    .generation-loading__noise {
        position: absolute;
        inset: 0;
    }

    .generation-loading__video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transform: scale(1.03);
        transition: opacity .7s ease, transform 1.4s ease;
        filter: contrast(1.06) saturate(1.05) brightness(.72);
    }

    .generation-loading__video.is-active {
        opacity: 1;
        transform: scale(1);
    }

    .generation-loading__shade {
        background:
            radial-gradient(circle at 50% 42%, rgba(120, 205, 255, .16), transparent 26%),
            linear-gradient(180deg, rgba(4, 7, 14, .14), rgba(4, 7, 14, .84));
    }

    .generation-loading__noise {
        background-image:
            radial-gradient(rgba(255, 255, 255, .06) .6px, transparent .6px),
            radial-gradient(rgba(255, 255, 255, .024) .5px, transparent .5px);
        background-position: 0 0, 13px 17px;
        background-size: 28px 28px, 34px 34px;
        mix-blend-mode: soft-light;
        opacity: .14;
    }

    .generation-loading__content {
        position: relative;
        z-index: 1;
        width: min(100% - 32px, 660px);
        padding: clamp(24px, 4vw, 40px);
        border-radius: 28px;
        border: 1px solid rgba(155, 220, 255, .18);
        background: rgba(4, 10, 20, .32);
        backdrop-filter: blur(14px);
        box-shadow: 0 24px 90px rgba(0, 0, 0, .46);
        text-align: center;
    }

    .generation-loading__title {
        margin: 0;
        font-size: clamp(1.8rem, 3vw, 2.6rem);
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: #f7fbff;
    }

    .generation-loading__copy {
        margin: 14px auto 0;
        max-width: 480px;
        color: rgba(228, 238, 255, .72);
        line-height: 1.7;
        letter-spacing: .04em;
        text-transform: uppercase;
        font-size: .92rem;
    }

    .generation-loading__bar {
        margin-top: 24px;
        height: 10px;
        border-radius: 999px;
        overflow: hidden;
        background: rgba(255, 255, 255, .08);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .04);
    }

    .generation-loading__bar > span {
        display: block;
        width: 36%;
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, rgba(143, 215, 255, .24), rgba(143, 215, 255, .92), rgba(255, 222, 168, .72));
        animation: generationProgress 1.25s ease-in-out infinite;
    }

    .generation-loading__steps {
        margin-top: 18px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px 14px;
        color: rgba(221, 233, 249, .62);
        font-size: .76rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    body.generate-loading-active .generation-loading {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    body.generate-loading-active .generation-card {
        opacity: 0;
        transform: translateY(12px) scale(.985);
        transition: opacity .35s ease, transform .35s ease;
    }

    @keyframes  generationProgress {
        0% {
            transform: translateX(-105%);
        }
        100% {
            transform: translateX(260%);
        }
    }

    @media (max-width: 767.98px) {
        .generation-status {
            grid-template-columns: 1fr;
        }

        .generation-actions {
            flex-direction: column;
        }

        .generation-button,
        .generation-back {
            width: 100%;
        }
    }
</style>
<style>
    .game-nav-shell {
        position: fixed;
        inset: 0 0 auto 0;
        z-index: 1100;
        padding: 10px 12px;
        pointer-events: none;
    }

    .game-nav-bar {
        pointer-events: auto;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 14px;
        border-radius: 22px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: linear-gradient(180deg, rgba(7, 14, 28, .82), rgba(4, 9, 18, .72));
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(0, 0, 0, .24);
    }

    .game-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f1f7ff;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        text-decoration: none;
    }

    .game-nav-brand__dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8fd7ff;
        box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .game-nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .game-nav-label {
        color: rgba(220, 235, 255, .58);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .game-nav-lang {
        display: inline-flex;
        gap: 8px;
    }

    .game-nav-lang__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 13px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #d8e7ff;
        font-weight: 700;
        letter-spacing: .08em;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .game-nav-lang__btn:hover,
    .game-nav-lang__btn.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .42);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);
        color: #f4fbff;
    }

    .game-main {
        min-height: 100vh;
        padding-top: 82px;
    }

    .game-main--navless {
        padding-top: 0;
    }

    .astral-page-transition {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
        transition: opacity .46s ease, visibility .46s ease;
    }

    .astral-page-transition__glow {
        position: absolute;
        width: 42vmin;
        height: 42vmin;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(143, 215, 255, .22), transparent 68%);
        filter: blur(10px);
    }

    .astral-page-transition__label {
        position: relative;
        color: #eff7ff;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .30em;
        text-transform: uppercase;
    }

    .astral-page-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    @media (max-width: 720px) {
        .game-nav-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .game-nav-actions {
            justify-content: space-between;
        }
    }
</style>
</head>
<body>
    <div class="game-root game-root--navless" data-astral-page>

    <main class="game-main game-main--navless">
        <div class="generation-page">
    <div class="generation-card" id="generationCard">
        <div class="generation-card__eyebrow">Galaxy Preparation</div>
        <h1 class="generation-title">Generating Galaxy...</h1>
        <p class="generation-copy">Build the strategic map, initialize star systems, assemble starting empires, and prepare a seamless handoff into the campaign.</p>

        <form method="POST" action="http://127.0.0.1:8000/new-game/generate/run" class="generation-actions" id="generationForm">
            <input type="hidden" name="_token" value="gbiVS45ljCpTTXy9rApMLQA7Dcuq9Bqsqf3QHHX3">            <button class="generation-button" id="generationButton">Generate</button>
            <a class="generation-back" href="http://127.0.0.1:8000/new-game/difficulty">Back</a>
        </form>

        <div class="generation-status">
            <div class="generation-status__item">
                <span class="generation-status__label">Background</span>
                <span class="generation-status__value">Procedural star layout</span>
            </div>
            <div class="generation-status__item">
                <span class="generation-status__label">Mode</span>
                <span class="generation-status__value">Turn-based initialization</span>
            </div>
            <div class="generation-status__item">
                <span class="generation-status__label">Output</span>
                <span class="generation-status__value">Campaign-ready session</span>
            </div>
        </div>
    </div>
</div>

<div class="generation-loading" id="generationLoading" aria-hidden="true">
    <video class="generation-loading__video is-active" id="loadingVideoA" muted playsinline preload="auto">
        <source src="http://127.0.0.1:8000/assets/img_model_main/main_menu/loadingFrame.mp4" type="video/mp4">
    </video>
    <video class="generation-loading__video" id="loadingVideoB" muted playsinline preload="auto">
        <source src="http://127.0.0.1:8000/assets/img_model_main/main_menu/loadingFrame.mp4" type="video/mp4">
    </video>
    <div class="generation-loading__shade"></div>
    <div class="generation-loading__noise"></div>

    <div class="generation-loading__content">
        <h2 class="generation-loading__title">Generating Galaxy</h2>
        <p class="generation-loading__copy">Synchronizing systems, assigning worlds, and preparing the campaign entry point.</p>
        <div class="generation-loading__bar"><span></span></div>
        <div class="generation-loading__steps">
            <span>Starfields</span>
            <span>Empires</span>
            <span>Homeworlds</span>
            <span>Routes</span>
        </div>
    </div>
</div>
    </main>

    <div class="astral-page-transition" data-page-transition>
        <div class="astral-page-transition__glow"></div>
        <div class="astral-page-transition__label">Loading</div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
      try { new bootstrap.Tooltip(el, { boundary: document.body }); } catch (e) {}
    });
  });
</script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('generationForm');
        const button = document.getElementById('generationButton');
        const videos = [
            document.getElementById('loadingVideoA'),
            document.getElementById('loadingVideoB')
        ];

        let currentVideoIndex = 0;
        let crossfading = false;
        let rafId = null;

        const playVideo = async (video) => {
            try {
                await video.play();
            } catch (error) {
            }
        };

        const monitorLoop = () => {
            const active = videos[currentVideoIndex];
            const inactiveIndex = currentVideoIndex === 0 ? 1 : 0;
            const inactive = videos[inactiveIndex];

            if (active.duration && Number.isFinite(active.duration)) {
                const remaining = active.duration - active.currentTime;
                if (!crossfading && remaining <= 0.75) {
                    crossfading = true;
                    inactive.currentTime = 0;
                    playVideo(inactive).then(() => {
                        inactive.classList.add('is-active');
                        active.classList.remove('is-active');
                        window.setTimeout(() => {
                            active.pause();
                            currentVideoIndex = inactiveIndex;
                            crossfading = false;
                        }, 520);
                    });
                }
            }

            rafId = window.requestAnimationFrame(monitorLoop);
        };

        form.addEventListener('submit', (event) => {
            if (button.dataset.locked === 'true') {
                return;
            }

            event.preventDefault();
            button.dataset.locked = 'true';
            button.setAttribute('disabled', 'disabled');
            document.body.classList.add('generate-loading-active');

            videos.forEach((video, index) => {
                video.pause();
                video.currentTime = 0;
                video.classList.toggle('is-active', index === 0);
            });

            currentVideoIndex = 0;
            crossfading = false;
            playVideo(videos[0]);

            if (rafId) {
                window.cancelAnimationFrame(rafId);
            }
            rafId = window.requestAnimationFrame(monitorLoop);

            window.setTimeout(() => {
                form.submit();
            }, 280);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.querySelector('[data-page-transition]');

        const showTransition = () => {
            overlay?.classList.add('is-visible');
        };

        const hideTransition = () => {
            requestAnimationFrame(() => overlay?.classList.remove('is-visible'));
        };

        hideTransition();
        window.AstralPageTransition = { show: showTransition, hide: hideTransition };

        document.querySelectorAll('a[data-page-link]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }
                event.preventDefault();
                showTransition();
                setTimeout(() => window.location.href = href, 340);
            });
        });

        document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
            form.addEventListener('submit', () => showTransition());
        });
    });
</script>
</body>
</html>
```

## ***http_rest_api/new_game/post_storeGenerate.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/new-game/generate/run
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/new-game/generate/run" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000/game/session/1'" />

        <title>Redirecting to http://127.0.0.1:8000/game/session/1</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000/game/session/1">http://127.0.0.1:8000/game/session/1</a>.
    </body>
</html>
```

## Rute Joc

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/game/session/{session}` | GameController@galaxy | `game.galaxy` | Vizualizare galaxie |
| POST | `/game/session/{session}/end-turn` | GameController@endTurn | `game.endTurn` | Încheiere tur |
| GET | `/game/session/{session}/system/{system}` | GameController@system | `game.system` | Detalii sistem stelar |
| POST | `/game/session/{session}/research` | GameController@selectResearch | `game.research.select` | Selectare cercetare |
| POST | `/game/session/{session}/planet/{planet}/build` | GameController@build | `game.planet.build` | Construire planetă |
| POST | `/game/session/{session}/fleet/{fleet}/move` | GameController@orderFleetMove | `game.fleet.move` | Mutare flotă |
| POST | `/game/session/{session}/fleet/{fleet}/survey` | GameController@orderFleetSurvey | `game.fleet.survey` | Explorare planetă/sistem |
| POST | `/game/session/{session}/system/{system}/claim` | GameController@claimSystem | `game.system.claim` | Reclamă sistem stelar |
| POST | `/game/session/{session}/diplomacy/{other}/contact` | GameController@diplomacyContact | `game.diplomacy.contact` | Contactare rasă |
| POST | `/game/session/{session}/diplomacy/{other}/war` | GameController@diplomacyWar | `game.diplomacy.war` | Declarare război |
| POST | `/game/session/{session}/diplomacy/{other}/peace` | GameController@diplomacyPeace | `game.diplomacy.peace` | Realizare pace |
| POST | `/game/session/{session}/encounter/{encounter}/peace` | GameController@encounterPeace | `game.encounter.peace` | Întâlnire pace |
| POST | `/game/session/{session}/encounter/{encounter}/war` | GameController@encounterWar | `game.encounter.war` | Întâlnire război |

## ***http_rest_api/game/get_galaxy.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/game/session/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/game/session/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_endTurn.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/end-turn
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/end-turn" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/get_system.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/game/session/1/system/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/game/session/1/system/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_selectResearch.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/research
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/research" \
     -H "Content-Type: application/json" \
     -d '{ "research_key": "Data" }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_build.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/planet/1/build
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/planet/1/build" \
     -H "Content-Type: application/json" \
     -d '{ "building_key": "Data", "slot_index": 1 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_orderFleetMove.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/fleet/1/move
```

**Git Bash Terminal**

***Input***

```bash
#!/bin/bash

curl -X POST "http://127.0.0.1:8000/game/session/1/fleet/1/move" \
     -H "Content-Type: application/json" \
     -d '{ "target_star_system_id": 1 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_orderFleetSurvey.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/fleet/1/survey
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/fleet/1/survey" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_claimSystem.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/system/1/claim
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/system/1/claim" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_diplomacyContact.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/diplomacy/1/contact
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/diplomacy/1/contact" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_diplomacyWar.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/diplomacy/1/war
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/diplomacy/1/war" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_diplomacyPeace.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/game/session/1/diplomacy/1/peace
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/diplomacy/1/peace" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_encounterPeace.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/encounter/1/peace
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/encounter/1/peace" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game/post_encounterWar.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/session/1/encounter/1/war
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/session/1/encounter/1/war" \
     -H "Content-Type: application/json" \
     -d '{}'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## Rute API Joc

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/game/api/session/{session}/galaxy` | GameApiController@galaxy | `game.api.galaxy` | API: date galaxie |
| GET | `/game/api/session/{session}/system/{system}` | GameApiController@system | `game.api.system` | API: date sistem |
| GET | `/game/api/session/{session}/planet/{planet}` | GameApiController@planet | `game.api.planet` | API: date planetă |
| POST | `/game/api/session/{session}/galaxy/move-fleets` | GameApiController@moveFleets | `game.api.galaxy.moveFleets` | Mutare flote (API) |

## ***http_rest_api/game_api/get_galaxy.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/game/api/session/1/galaxy
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/game/api/session/1/galaxy"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game_api/get_system.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/game/api/session/1/system/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/game/api/session/1/system/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game_api/get_planet.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/game/api/session/1/planet/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/game/api/session/1/planet/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/game_api/post_moveFleets.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/game/api/session/1/galaxy/move-fleets
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/game/api/session/1/galaxy/move-fleets" \
     -H "Content-Type: application/json" \
     -d '{ "fleet_id": 1, "target_star_system_id": 2 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## Rute Admin

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/admin` | AdminDashboardController@index | `admin.dashboard` | Panou administrare |

## ***http_rest_api/admin/get_dashboard.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
      <div>
        <div class="muted" style="text-transform:uppercase;letter-spacing:.16em;font-weight:700;">Administration</div>
        <h1 style="margin:8px 0 0;letter-spacing:.08em;text-transform:uppercase;">Project Control</h1>
      </div>
      <a class="btn" href="http://127.0.0.1:8000" data-page-link>Back to Menu</a>
    </div>

    <p class="muted" style="margin:0 0 18px;max-width:760px;line-height:1.7;">
      Access the project CRUD sections for galaxies, systems, planets, hyperlanes, and races. All administrative tools now follow the same translucent sci-fi styling as the redesigned game interface.
    </p>

    <div class="grid grid-2">
      <a class="card" href="http://127.0.0.1:8000/admin/galaxies" data-page-link>
        <strong>Galaxies</strong>
        <div class="muted" style="margin-top:8px;">Manage procedural seeds, galaxy size, notes, and structural configuration.</div>
      </a>
      <a class="card" href="http://127.0.0.1:8000/admin/star-systems" data-page-link>
        <strong>Star Systems</strong>
        <div class="muted" style="margin-top:8px;">Edit coordinates, star appearance, previews, and system metadata.</div>
      </a>
      <a class="card" href="http://127.0.0.1:8000/admin/planets" data-page-link>
        <strong>Planets</strong>
        <div class="muted" style="margin-top:8px;">Create and tune world data, rings, orbit values, and planet properties.</div>
      </a>
      <a class="card" href="http://127.0.0.1:8000/admin/hyperlanes" data-page-link>
        <strong>Hyperlanes</strong>
        <div class="muted" style="margin-top:8px;">Connect systems and control the navigational backbone of the galaxy.</div>
      </a>
      <a class="card" href="http://127.0.0.1:8000/admin/races" data-page-link>
        <strong>Races</strong>
        <div class="muted" style="margin-top:8px;">Maintain playable factions, colors, traits, and homeworld references.</div>
      </a>
    </div>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

### Rute Resurse Admin

| Resursă | Controller | Descriere |
|----------|------------|-----------|
| galaxies | AdminGalaxyController | CRUD galaxii |
| star-systems | AdminStarSystemController | CRUD sisteme stelare |
| planets | AdminPlanetController | CRUD planete |
| hyperlanes | AdminHyperlaneController | CRUD hyperlane |
| races | AdminRaceController | CRUD rase |

## ***http_rest_api/admin/galaxies/get_index.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/galaxies
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/galaxies"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD: Galaxies</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Galaxies</h1>
      <a class="btn" href="http://127.0.0.1:8000/admin/galaxies/create">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
      <th>Seed</th>
      <th>Size</th>
      <th>Arms</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
                  <tr>
            <td>1</td>
            <td>Galaxy</td>
        <td>623011549</td>
        <td>240</td>
        <td>4</td>
            <td style="white-space:nowrap">
              <a class="btn" href="http://127.0.0.1:8000/admin/galaxies/1/edit">Edit</a>
              <form method="post" action="http://127.0.0.1:8000/admin/galaxies/1" style="display:inline-block" onsubmit="return confirm('Delete this item?')">   
                <input type="hidden" name="_token" value="sqW62gdtRDNDDqJVN4CbLBZZyyFLijzzXBHqf8yJ">                <input type="hidden" name="_method" value="DELETE">                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
              </tbody>
    </table>

    <div style="margin-top:12px">

    </div>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/galaxies/get_create.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/galaxies
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/galaxies"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD: Galaxies</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Galaxies</h1>
      <a class="btn" href="http://127.0.0.1:8000/admin/galaxies/create">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
      <th>Seed</th>
      <th>Size</th>
      <th>Arms</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
                  <tr>
            <td>1</td>
            <td>Galaxy</td>
        <td>623011549</td>
        <td>240</td>
        <td>4</td>
            <td style="white-space:nowrap">
              <a class="btn" href="http://127.0.0.1:8000/admin/galaxies/1/edit">Edit</a>
              <form method="post" action="http://127.0.0.1:8000/admin/galaxies/1" style="display:inline-block" onsubmit="return confirm('Delete this item?')">   
                <input type="hidden" name="_token" value="mZ3r1Ec7VQonjGsdaJtLoioafyoAsiUdo8LrTiGO">                <input type="hidden" name="_method" value="DELETE">                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
              </tbody>
    </table>

    <div style="margin-top:12px">

    </div>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/galaxies/post_store.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/admin/galaxies
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/admin/galaxies" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Новая галактика", "seed": 1, "size": 300, "arms": 4, "notes": "Примечания" }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000/admin/galaxies/2/edit'" />

        <title>Redirecting to http://127.0.0.1:8000/admin/galaxies/2/edit</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000/admin/galaxies/2/edit">http://127.0.0.1:8000/admin/galaxies/2/edit</a>.
    </body>
</html>
```

## ***http_rest_api/admin/galaxies/get_show.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/galaxies/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/galaxies/1"
```

***Output***

```html
<!doctype html>
<html>

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>🧨 Route [galaxy.show] not defined.</title>

</head>

<body>

</body>

</html>
```

## ***http_rest_api/admin/galaxies/get_edit.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/galaxies/1/edit
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/galaxies/1/edit"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Galaxy</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card" style="max-width:1250px">
    <h1 style="margin:0 0 14px 0;">Edit Galaxy</h1>

    <form method="post" action="http://127.0.0.1:8000/admin/galaxies/1">
      <input type="hidden" name="_token" value="twd5ZJZpG97RxZ6Bv6UTem0FiiFEIW7OAM3bTZqa">      <input type="hidden" name="_method" value="PUT">
      <div style="display:grid;grid-template-columns:.95fr 1.05fr;gap:18px;align-items:start;">
        <div>
          <div class="grid grid-2">
            <div class="field">
              <label>Name</label>
              <input type="text" name="name" value="Galaxy" required>
                          </div>

            <div class="field">
              <label>Seed</label>
              <input id="seedInput" type="number" name="seed" value="623011549">
                          </div>

            <div class="field">
              <label>Size (systems)</label>
              <input id="sizeInput" type="number" name="size" value="240" required>
                          </div>

            <div class="field">
              <label>Arms</label>
              <input id="armsInput" type="number" name="arms" value="4" required>
                          </div>

            <div class="field" style="grid-column:1 / -1;">
              <label>Notes</label>
              <textarea name="notes"></textarea>
                          </div>
          </div>

          <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
            <button class="btn" type="submit">Save</button>
            <a class="btn" href="http://127.0.0.1:8000/admin/galaxies">← Back</a>
          </div>
        </div>

        <div>
          <div class="card" style="padding:14px;border:1px solid rgba(255,255,255,.12);border-radius:16px;background:rgba(255,255,255,.03);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
              <strong>Galaxy Preview</strong>
              <span class="muted">interactive preview</span>
            </div>

            <div id="galaxyPreview3D" style="width:100%;height:560px;border-radius:14px;overflow:hidden;background:
              radial-gradient(circle at center, rgba(55,85,160,.20), rgba(0,0,0,.20) 45%, rgba(0,0,0,.60) 100%);
              border:1px solid rgba(255,255,255,.08);"></div>

            <div class="muted" style="margin-top:10px;">
              You can rotate, zoom in, and zoom out with the mouse.
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script type="importmap">
  {
    "imports": {
      "three": "https://unpkg.com/three@0.152.2/build/three.module.js",
      "three/addons/": "https://unpkg.com/three@0.152.2/examples/jsm/"
    }
  }
  </script>

  <script type="module">
    import * as THREE from 'three';
    import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

    const container = document.getElementById('galaxyPreview3D');
    const seedInput = document.getElementById('seedInput');
    const sizeInput = document.getElementById('sizeInput');
    const armsInput = document.getElementById('armsInput');

    if (!container || !seedInput || !sizeInput || !armsInput) {
      console.error('Galaxy preview elements not found');
    } else {
      const scene = new THREE.Scene();

      const width = container.clientWidth || 800;
      const height = container.clientHeight || 560;

      const camera = new THREE.PerspectiveCamera(55, width / height, 0.1, 3000);
      camera.position.set(0, 140, 220);

      const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
      renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
      renderer.setSize(width, height);
      renderer.outputColorSpace = THREE.SRGBColorSpace;
      container.appendChild(renderer.domElement);

      const controls = new OrbitControls(camera, renderer.domElement);
      controls.enableDamping = true;
      controls.dampingFactor = 0.06;
      controls.minDistance = 60;
      controls.maxDistance = 600;
      controls.target.set(0, 0, 0);

      scene.add(new THREE.AmbientLight(0xffffff, 0.9));

      const dirLight = new THREE.DirectionalLight(0xffffff, 0.9);
      dirLight.position.set(50, 80, 40);
      scene.add(dirLight);

      const galaxyRoot = new THREE.Group();
      scene.add(galaxyRoot);

      let starsPoints = null;
      let coreMesh = null;
      let buildToken = 0;

      function mulberry32(seed) {
        let t = seed >>> 0;
        return function () {
          t += 0x6D2B79F5;
          let r = Math.imul(t ^ (t >>> 15), 1 | t);
          r ^= r + Math.imul(r ^ (r >>> 7), 61 | r);
          return ((r ^ (r >>> 14)) >>> 0) / 4294967296;
        };
      }

      function clearGalaxy() {
        while (galaxyRoot.children.length) {
          const child = galaxyRoot.children[0];
          galaxyRoot.remove(child);

          if (child.geometry) child.geometry.dispose();
          if (child.material) {
            if (Array.isArray(child.material)) {
              child.material.forEach((m) => m.dispose && m.dispose());
            } else if (child.material.dispose) {
              child.material.dispose();
            }
          }
        }

        starsPoints = null;
        coreMesh = null;
      }

      function buildGalaxyPreview() {
        const token = ++buildToken;
        clearGalaxy();

        const seed = parseInt(seedInput.value || '1', 10) || 1;
        const size = Math.max(20, parseInt(sizeInput.value || '100', 10) || 100);
        const arms = Math.max(2, parseInt(armsInput.value || '4', 10) || 4);

        const random = mulberry32(seed);
        const starCount = Math.min(5000, Math.max(600, size * 18));
        const radiusMax = Math.max(35, size * 0.65);

        const positions = new Float32Array(starCount * 3);
        const colors = new Float32Array(starCount * 3);

        for (let i = 0; i < starCount; i++) {
          const t = i / starCount;
          const arm = i % arms;
          const dist = Math.pow(random(), 0.72) * radiusMax;

          const armAngle = (arm / arms) * Math.PI * 2;
          const twist = dist * 0.07;
          const jitter = (random() - 0.5) * 0.8;
          const angle = armAngle + twist + jitter;

          const thickness = (random() - 0.5) * (4 + dist * 0.02);
          const x = Math.cos(angle) * dist + (random() - 0.5) * 2.2;
          const z = Math.sin(angle) * dist + (random() - 0.5) * 2.2;
          const y = thickness * 0.35;

          positions[i * 3 + 0] = x;
          positions[i * 3 + 1] = y;
          positions[i * 3 + 2] = z;

          const glow = 0.65 + random() * 0.35;
          colors[i * 3 + 0] = glow;
          colors[i * 3 + 1] = 0.78 + random() * 0.2;
          colors[i * 3 + 2] = 1.0;
        }

        if (token !== buildToken) return;

        const starsGeometry = new THREE.BufferGeometry();
        starsGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        starsGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

        const starsMaterial = new THREE.PointsMaterial({
          size: 1.8,
          transparent: true,
          opacity: 0.95,
          vertexColors: true,
          depthWrite: false,
          blending: THREE.AdditiveBlending
        });

        starsPoints = new THREE.Points(starsGeometry, starsMaterial);
        galaxyRoot.add(starsPoints);

        const coreGeometry = new THREE.SphereGeometry(Math.max(4, radiusMax * 0.08), 24, 24);
        const coreMaterial = new THREE.MeshBasicMaterial({
          color: 0xbfd8ff,
          transparent: true,
          opacity: 0.95
        });

        coreMesh = new THREE.Mesh(coreGeometry, coreMaterial);
        galaxyRoot.add(coreMesh);

        galaxyRoot.rotation.x = -0.35;
      }

      function animate() {
        requestAnimationFrame(animate);

        if (starsPoints) {
          starsPoints.rotation.y += 0.0008;
        }

        if (coreMesh) {
          coreMesh.rotation.y += 0.002;
        }

        controls.update();
        renderer.render(scene, camera);
      }

      function onResize() {
        const w = container.clientWidth || 800;
        const h = container.clientHeight || 560;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setSize(w, h);
      }

      window.addEventListener('resize', onResize);

      seedInput.addEventListener('input', buildGalaxyPreview);
      sizeInput.addEventListener('input', buildGalaxyPreview);
      armsInput.addEventListener('input', buildGalaxyPreview);

      buildGalaxyPreview();
      animate();
    }
  </script>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/galaxies/put_update.sh***

**Postman API Platform**

***Request HTTP***

```
PUT http://127.0.0.1:8000/admin/galaxies/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PUT "http://127.0.0.1:8000/admin/galaxies/1" \
     -H "Content-Type: application/json" \
     -d '{ "name": "New galaxy", "seed": 2, "size": 600, "arms": 8, "notes": "Notes" }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000/admin/galaxies/1/edit'" />

        <title>Redirecting to http://127.0.0.1:8000/admin/galaxies/1/edit</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000/admin/galaxies/1/edit">http://127.0.0.1:8000/admin/galaxies/1/edit</a>.
    </body>
</html>
```

## ***http_rest_api/admin/galaxies/patch_update.sh***

**Postman API Platform**

***Request HTTP***

```
PATCH http://127.0.0.1:8000/admin/galaxies/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PATCH "http://127.0.0.1:8000/admin/galaxies/1" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Nouvelle galaxie", "seed": 3, "size": 900, "arms": 12, "notes": "Remarques" }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000'" />

        <title>Redirecting to http://127.0.0.1:8000</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a>.
    </body>
</html>
```

## ***http_rest_api/admin/galaxies/del_destroy.sh***

**Postman API Platform**

***Request HTTP***

```
DELETE http://127.0.0.1:8000/admin/galaxies/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X DELETE "http://127.0.0.1:8000/admin/galaxies/1"
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000/admin/galaxies'" />

        <title>Redirecting to http://127.0.0.1:8000/admin/galaxies</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000/admin/galaxies">http://127.0.0.1:8000/admin/galaxies</a>.
    </body>
</html>
```

## ***http_rest_api/admin/star_systems/get_index.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/star-systems
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/star-systems"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD: Star Systems</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Star Systems</h1>
      <a class="btn" href="http://127.0.0.1:8000/admin/star-systems/create">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Galaxy</th>
          <th>Name</th>
          <th>X</th><th>Y</th><th>Z</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
              </tbody>
    </table>

    <div style="margin-top:12px">

    </div>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/star_systems/get_create.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/star-systems
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/star-systems"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD: Star Systems</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Star Systems</h1>
      <a class="btn" href="http://127.0.0.1:8000/admin/star-systems/create">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Galaxy</th>
          <th>Name</th>
          <th>X</th><th>Y</th><th>Z</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
              </tbody>
    </table>

    <div style="margin-top:12px">

    </div>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/star_systems/post_store.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/admin/star-systems
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/admin/star-systems" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 1, "name": "Имя", "x": 0.0, "y": 25.0, "z": 50.0, "color_hex": "#ffdd99", "temperature": 5800, "base_scale": 1.0, "owner_player_id": 1, "threat_level": 1 }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000'" />

        <title>Redirecting to http://127.0.0.1:8000</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a>.
    </body>
</html>
```

## ***http_rest_api/admin/star_systems/get_show.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/star-systems/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/star-systems/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/star_systems/get_edit.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/star-systems/1/edit
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/star-systems/1/edit"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/star_systems/put_update.sh***

**Postman API Platform**

***Request HTTP***

```
PUT http://127.0.0.1:8000/admin/star-systems/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PUT "http://127.0.0.1:8000/admin/star-systems/1" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 2, "name": "Name", "x": 25.0, "y": 50.0, "z": 75.0, "color_hex": "#ffdd99", "temperature": 11600, "base_scale": 2.0, "owner_player_id": 2, "threat_level": 2 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/star_systems/patch_update.sh***

**Postman API Platform**

***Request HTTP***

```
PATCH http://127.0.0.1:8000/admin/star-systems/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PATCH "http://127.0.0.1:8000/admin/star-systems/1" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 2, "name": "Nom", "x": 50.0, "y": 75.0, "z": 100.0, "color_hex": "#ffdd99", "temperature": 16800, "base_scale": 3.0, "owner_player_id": 3, "threat_level": 3 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/star_systems/del_destroy.sh***

**Postman API Platform**

***Request HTTP***

```
DELETE http://127.0.0.1:8000/admin/star-systems/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X DELETE "http://127.0.0.1:8000/admin/star-systems/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/planets/get_index.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/planets
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/planets"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD: Planets</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Planets</h1>
      <a class="btn" href="http://127.0.0.1:8000/admin/planets/create">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>System</th>
          <th>Name</th>
          <th>Type</th>
          <th>Orbit</th>
          <th>Radius</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
              </tbody>
    </table>

    <div style="margin-top:12px">

    </div>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/planets/get_create.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/planets
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/planets"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD: Planets</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Planets</h1>
      <a class="btn" href="http://127.0.0.1:8000/admin/planets/create">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>System</th>
          <th>Name</th>
          <th>Type</th>
          <th>Orbit</th>
          <th>Radius</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
              </tbody>
    </table>

    <div style="margin-top:12px">

    </div>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/planets/post_store.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/admin/planets
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/admin/planets" \
     -H "Content-Type: application/json" \
     -d '{ "star_system_id": 1, "name": "Имя", "type": "rock", "orbit_radius": 10.0, "radius": 1.0, "axial_tilt": 1.0, "rotation_speed": 1.0, "has_rings": false, "meta_json": ["Данные"], "size_slots": 10, "population": 10, "happiness": 1.0, "specialization": "balanced", "is_capital": false, "base_yields": ["Данные"] }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000'" />

        <title>Redirecting to http://127.0.0.1:8000</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a>.
    </body>
</html>
```

## ***http_rest_api/admin/planets/get_show.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/planets/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/planets/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/planets/get_edit.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/planets/1/edit
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/planets/1/edit"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/planets/put_update.sh***

**Postman API Platform**

***Request HTTP***

```
PUT http://127.0.0.1:8000/admin/planets/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PUT "http://127.0.0.1:8000/admin/planets/1" \
     -H "Content-Type: application/json" \
     -d '{ "star_system_id": 2, "name": "Name", "type": "desert", "orbit_radius": 20.0, "radius": 2.0, "axial_tilt": 2.0, "rotation_speed": 2.0, "has_rings": true, "meta_json": ["Data"], "size_slots": 20, "population": 20, "happiness": 2.0, "specialization": "balanced", "is_capital": true, "base_yields": ["Data"] }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/planets/patch_update.sh***

**Postman API Platform**

***Request HTTP***

```
PATCH http://127.0.0.1:8000/admin/planets/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PATCH "http://127.0.0.1:8000/admin/planets/1" \
     -H "Content-Type: application/json" \
     -d '{ "star_system_id": 3, "name": "Nom", "type": "ocean", "orbit_radius": 30.0, "radius": 3.0, "axial_tilt": 3.0, "rotation_speed": 3.0, "has_rings": false, "meta_json": ["Données"], "size_slots": 30, "population": 30, "happiness": 3.0, "specialization": "balanced", "is_capital": false, "base_yields": ["Données"] }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/planets/del_destroy.sh***

**Postman API Platform**

***Request HTTP***

```
DELETE http://127.0.0.1:8000/admin/planets/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X DELETE "http://127.0.0.1:8000/admin/planets/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/hyperlanes/get_index.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/hyperplanes
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/hyperplanes"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/hyperlanes/get_create.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/hyperplanes
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/hyperplanes"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/hyperlanes/post_store.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/admin/hyperplanes
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/admin/hyperplanes" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 1, "from_star_system_id": 1, "to_star_system_id": 2 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/hyperlanes/get_show.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/hyperplanes/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/hyperplanes/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/hyperlanes/get_show.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/hyperplanes/1/edit
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/hyperplanes/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/hyperlanes/put_update.sh***

**Postman API Platform**

***Request HTTP***

```
PUT http://127.0.0.1:8000/admin/hyperplanes/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PUT "http://127.0.0.1:8000/admin/hyperplanes/1" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 2, "from_star_system_id": 2, "to_star_system_id": 3 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/hyperlanes/patch_update.sh***

**Postman API Platform**

***Request HTTP***

```
PATCH http://127.0.0.1:8000/admin/hyperplanes/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PATCH "http://127.0.0.1:8000/admin/hyperplanes/1" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 3, "from_star_system_id": 3, "to_star_system_id": 4 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/hyperlanes/del_destroy.sh***

**Postman API Platform**

***Request HTTP***

```
DELETE http://127.0.0.1:8000/admin/hyperplanes/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X DELETE "http://127.0.0.1:8000/admin/hyperplanes/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/races/get_index.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/races
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/races"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD: Races</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Races</h1>
      <a class="btn" href="http://127.0.0.1:8000/admin/races/create">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Color</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
                  <tr>
            <td colspan="4" style="text-align:center">No races yet</td>
          </tr>
              </tbody>
    </table>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/races/get_create.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/races
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/races"
```

***Output***

```html
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD: Races</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  </head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="http://127.0.0.1:8000" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="http://127.0.0.1:8000" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/new-game/difficulty" data-page-link>New Game</a>
          <a class="app-nav__link" href="http://127.0.0.1:8000/admin" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Races</h1>
      <a class="btn" href="http://127.0.0.1:8000/admin/races/create">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Color</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
                  <tr>
            <td colspan="4" style="text-align:center">No races yet</td>
          </tr>
              </tbody>
    </table>
  </div>
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const overlay = document.querySelector('[data-page-transition]');
      const showTransition = () => overlay?.classList.add('is-visible');
      const hideTransition = () => requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

      hideTransition();

      document.querySelectorAll('a[data-page-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
          const href = link.getAttribute('href');
          if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
          }
          event.preventDefault();
          showTransition();
          setTimeout(() => window.location.href = href, 320);
        });
      });

      document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
        form.addEventListener('submit', () => showTransition());
      });
    });
  </script>

  </body>
</html>
```

## ***http_rest_api/admin/races/post_store.sh***

**Postman API Platform**

***Request HTTP***

```
POST http://127.0.0.1:8000/admin/races
```

**Git Bash Terminal**

***Input***

```bash
curl -X POST "http://127.0.0.1:8000/admin/races" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Имя", "description": "Описание", "color_hex": "#00aaff", "traits_json": ["Данные"], "home_star_system_id": 1 }'
```

***Output***

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000'" />

        <title>Redirecting to http://127.0.0.1:8000</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a>.
    </body>
</html>
```

## ***http_rest_api/admin/races/get_show.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/races/1
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/races/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/races/get_edit.sh***

**Postman API Platform**

***Request HTTP***

```
GET http://127.0.0.1:8000/admin/races/1/edit
```

**Git Bash Terminal**

***Input***

```bash
curl "http://127.0.0.1:8000/admin/races/1/edit"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/races/put_update.sh***

**Postman API Platform**

***Request HTTP***

```
PUT http://127.0.0.1:8000/admin/races/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PUT "http://127.0.0.1:8000/admin/races/1" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Name", "description": "Description", "color_hex": "#00aaff", "traits_json": ["Data"], "home_star_system_id": 2 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/races/patch_update.sh***

**Postman API Platform**

***Request HTTP***

```
PATCH http://127.0.0.1:8000/admin/races/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X PATCH "http://127.0.0.1:8000/admin/races/1" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Nom", "description": "Description", "color_hex": "#00aaff", "traits_json": ["Données"], "home_star_system_id": 3 }'
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

## ***http_rest_api/admin/races/del_destroy.sh***

**Postman API Platform**

***Request HTTP***

```
DELETE http://127.0.0.1:8000/admin/races/1
```

**Git Bash Terminal**

***Input***

```bash
curl -X DELETE "http://127.0.0.1:8000/admin/races/1"
```

***Output***

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        404                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```
