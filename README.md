# Setare Mediu de Dezvoltare

Pentru dezvoltarea și testarea proiectului, folosim următoarele unelte:

- **Visual Studio Code (VS Code)** – editorul de cod principal.
- **Postman** – pentru testarea API-urilor.
- **Extensie Postman pentru VS Code** – permite rularea cererilor Postman direct din VS Code, fără a deschide aplicația Postman separată.

## Instrucțiuni

1. Instalează [Visual Studio Code](https://code.visualstudio.com/).
2. Instalează [Postman](https://www.postman.com/downloads/).
3. În VS Code, mergi la secțiunea **Extensions** și caută „Postman”. Instalează extensia oficială **Postman**.
4. Conectează-ți contul Postman în extensie și importă workspace-ul proiectului:

   [Group Project API Test Workspace](https://lunar-firefly-684466.postman.co/workspace/Group-Project-API-Test~e468838b-ce98-4a7b-aac2-b274faabf6f2/)

5. Poți acum să rulezi cererile API direct din VS Code sau Postman pentru a testa proiectul.

> Recomandare: Folosește VS Code împreună cu extensia Postman pentru o integrare rapidă între cod și testarea API-ului.

---

# Documentația Rutelor

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/` | MenuController@menu | `menu` | Meniul principal |
| GET | `/continue` | MenuController@continue | `continue` | Continuă jocul |
| POST | `/continue/{session}/load` | MenuController@load | `continue.load` | Încarcă o sesiune existentă |
| GET | `/settings` | MenuController@settings | `settings` | Setările jocului |

## Rute Joc Nou

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/new-game/difficulty` | NewGameController@difficulty | `newgame.difficulty` | Selectează dificultatea |
| POST | `/new-game/difficulty` | NewGameController@storeDifficulty | `newgame.difficulty.store` | Salvează dificultatea |
| GET | `/new-game/race` | NewGameController@race | `newgame.race` | Selectează rasa jucătorului |
| POST | `/new-game/race` | NewGameController@storeRace | `newgame.race.store` | Salvează rasa |
| GET | `/new-game/configure` | NewGameController@configure | `newgame.configure` | Configurează setările jocului |
| POST | `/new-game/configure` | NewGameController@storeConfigure | `newgame.configure.store` | Salvează configurația |
| GET | `/new-game/generate` | NewGameController@generating | `newgame.generate` | Afișează generarea lumii |
| POST | `/new-game/generate/run` | NewGameController@runGenerate | `newgame.generate.run` | Generează lumea jocului |

## Rute Joc

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/game/session/{session}` | GameController@galaxy | `game.galaxy` | Vizualizare galaxie |
| POST | `/game/session/{session}/end-turn` | GameController@endTurn | `game.endTurn` | Încheie turul curent |
| GET | `/game/session/{session}/system/{system}` | GameController@system | `game.system` | Detalii sistem stelar |
| POST | `/game/session/{session}/research` | GameController@selectResearch | `game.research.select` | Selectează cercetarea |
| POST | `/game/session/{session}/planet/{planet}/build` | GameController@build | `game.planet.build` | Construiește pe planetă |
| POST | `/game/session/{session}/fleet/{fleet}/move` | GameController@orderFleetMove | `game.fleet.move` | Muta flota |
| POST | `/game/session/{session}/fleet/{fleet}/survey` | GameController@orderFleetSurvey | `game.fleet.survey` | Explorare planetă/sistem |
| POST | `/game/session/{session}/system/{system}/claim` | GameController@claimSystem | `game.system.claim` | Reclamă sistem stelar |
| POST | `/game/session/{session}/diplomacy/{other}/contact` | GameController@diplomacyContact | `game.diplomacy.contact` | Contactează o altă rasă |
| POST | `/game/session/{session}/diplomacy/{other}/war` | GameController@diplomacyWar | `game.diplomacy.war` | Declară război |
| POST | `/game/session/{session}/diplomacy/{other}/peace` | GameController@diplomacyPeace | `game.diplomacy.peace` | Face pace |
| POST | `/game/session/{session}/encounter/{encounter}/peace` | GameController@encounterPeace | `game.encounter.peace` | Pace cu întâlnirea |
| POST | `/game/session/{session}/encounter/{encounter}/war` | GameController@encounterWar | `game.encounter.war` | Război cu întâlnirea |

## Rute API Joc

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/game/api/session/{session}/galaxy` | GameApiController@galaxy | `game.api.galaxy` | API: date galaxie |
| GET | `/game/api/session/{session}/system/{system}` | GameApiController@system | `game.api.system` | API: date sistem |
| GET | `/game/api/session/{session}/planet/{planet}` | GameApiController@planet | `game.api.planet` | API: date planetă |
| POST | `/game/api/session/{session}/galaxy/move-fleets` | GameApiController@moveFleets | `game.api.galaxy.moveFleets` | Mută flote prin API |

## Rute Admin

| Metodă HTTP | Path | Acțiune Controller | Nume Rută | Descriere |
|-------------|------|-----------------|------------|-------------|
| GET | `/admin` | AdminDashboardController@index | `admin.dashboard` | Panoul de administrare |

### Rute Resurse Admin

| Resursă | Controller | Descriere |
|----------|------------|-----------|
| galaxies | AdminGalaxyController | CRUD pentru galaxii |
| star-systems | AdminStarSystemController | CRUD pentru sisteme stelare |
| planets | AdminPlanetController | CRUD pentru planete |
| hyperlanes | AdminHyperlaneController | CRUD pentru hyperlane-uri |
| races | AdminRaceController | CRUD pentru rase |

## Test API în Postman

Poți testa endpoint-urile API direct în Postman. Deschide linkul următor pentru a accesa workspace-ul cu cererile preconfigurate:

[Deschide Workspace Postman](https://lunar-firefly-684466.postman.co/workspace/Group-Project-API-Test~e468838b-ce98-4a7b-aac2-b274faabf6f2/)

> Acest link deschide workspace-ul Postman. Poți rula cererile pentru a testa endpoint-urile API ale proiectului tău de joc.