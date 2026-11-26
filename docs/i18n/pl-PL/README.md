<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kaktus z tarczą. Odkrywaj. Autoryzuj. Wykonuj.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Licencja: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP to wtyczka do systemu Cacti, która umożliwia klientom AI odczytywanie danych Cacti za pośrednictwem nazwanych operacji filtrowanych według uprawnień, zwanych zdolnościami (abilities). Wtyczka udostępnia je bezpośrednio na dwa sposoby: przez punkt końcowy MCP (`mcp.php`, Streamable HTTP) oraz interfejs HTTP API w stylu AIP (`api.php`). Cacti zachowuje pełną kontrolę nad autoryzacją i wykonywaniem operacji. Klient nigdy nie odpytuje bezpośrednio bazy danych — może wywołać wyłącznie zdolność udostępnioną przez administratora i dozwoloną przez uprawnienia (realms) właściciela tokenu w Cacti.

Autorzy wtyczek mogą rejestrować własne zdolności tylko do odczytu za pomocą punktu zaczepienia `abilities_register`, dzięki czemu są one widoczne dla klientów MCP jako narzędzia bez konieczności pisania kodu obsługi protokołu.

**Status: wersja wstępna (pre-release), 0.1.0.** Brak otagowanego wydania.

Obecnie dostępne funkcje:

- Wbudowane zdolności tylko do odczytu do pobierania wersji systemu oraz spisu urządzeń.
- Osobiste tokeny dostępu (`cmcp_pat_...`) jako jedyny mechanizm uwierzytelniania.
- Konsola Management > MCP: udostępnianie i ukrywanie zdolności, tworzenie oraz unieważnianie tokenów, przeglądanie dziennika audytu.
- Management > My MCP Tokens: zarządzanie własnymi tokenami przez użytkowników, podgląd aktywności oraz lista narzędzi dostępnych dla ich tokenów.
- MCP przez Streamable HTTP, wersje protokołu `2026-07-28` oraz `2025-11-25`, wyłącznie obsługa narzędzi (tools).

Funkcje jeszcze niedostępne:

- Logowanie przez OAuth 2.1. Hostowane konektory, które nie mogą wysyłać osobistego tokenu — takie jak niestandardowe konektory ChatGPT i claude.ai — nie mogą się połączyć do czasu wdrożenia tej funkcji. Jest ona zaplanowana jako Plan 2; sam plan nie został jeszcze napisany.
- Zdolności zapisu. Rejestrować można wyłącznie zdolności tylko do odczytu.

Projekt architektury znajduje się w [specyfikacji punktu końcowego](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md), a kolejność prac wdrożeniowych w pliku [docs/plan.md](../../plan.md).

## Wbudowane zdolności

| ID | Argumenty | Wymagane uprawnienie Cacti (realm) |
| --- | --- | --- |
| `cacti-get-system-info` | brak | 15 |
| `cacti-list-devices` | opcjonalnie `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | wymagany `name`, np. `devices/12` | 3 |

Każde wywołanie wymaga również posiadania przez właściciela tokenu uprawnienia **MCP and Abilities API**, zakresu `abilities:read` (każdy token osobisty go zawiera) oraz udostępnienia danej zdolności. Karta Abilities w konsoli pokazuje uprawnienie (realm) wymagane przez każdą wbudowaną zdolność.

- `cacti-list-devices` zwraca strony zawierające maksymalnie 100 urządzeń (domyślnie 50) oraz `nextPageToken`. Token strony zachowuje ważność wyłącznie dla tych samych wartości `filter` i `orderBy`. Parametr `filter` to wyrażenie AIP-160 złożone z porównań połączonych operatorem `AND`, na przykład `state = "DOWN" AND disabled = false`. Dostępne pola filtrowania to `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId` oraz `state`. Parametr `orderBy` przyjmuje wartości `displayName`, `hostname` lub `name`, z opcjonalnym sufiksem `desc`.
- Zapytania o urządzenia przechodzą przez funkcję `get_allowed_devices()` w Cacti, dzięki czemu użytkownik widzi wyłącznie te urządzenia, które Cacti normalnie by mu wyświetliło.
- Pola urządzeń nie zawierają ciągów społeczności SNMP (community strings), haseł ani innych danych uwierzytelniających.

## Instalacja

Wymaga systemu Cacti w wersji 1.2.31 lub nowszej, PHP 8.2 lub nowszego oraz głównego pollera. Uwierzytelnianie w Cacti musi być włączone; gdy jest wyłączone, wtyczka odmawia uwierzytelniania.

Katalog wtyczki musi nosić nazwę `mcp`, a nie `plugin_mcp`. Identyfikator (slug) wtyczki, nazwy uprawnień (realms), domena tłumaczeń oraz adresy URL używają nazwy `mcp`.

Z kopii kodu źródłowego:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Do czasu pojawienia się otagowanych wydań można pobrać artefakt `mcp-plugin` z pomyślnego [uruchomienia CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml). Zawiera on pliki `mcp.tar.gz` oraz `SHA256SUMS`. Należy zweryfikować sumę kontrolną, a następnie rozpakować `mcp.tar.gz` wewnątrz katalogu `plugins/` systemu Cacti, tak aby utworzyć katalog `plugins/mcp/`. Automatyczne archiwa źródeł serwisu GitHub mają inną nazwę katalogu najwyższego poziomu. Archiwum pomija katalogi `docs/` (w tym poniższe zrzuty ekranu), `tests/` oraz `.github/`, dlatego odnośniki z pliku README kierujące do `docs/` działają w serwisie GitHub, ale nie w zainstalowanej kopii.

Następnie:

1. W sekcji Plugin Management zainstaluj i włącz wtyczkę **Cacti MCP**. Administrator wykonujący instalację otrzymuje uprawnienie **MCP Administration** automatycznie.
2. W sekcji Settings > MCP ustaw pole **Public Cacti URL** na adres używany przez klientów, na przykład `https://cacti.example.com/cacti`. Protokół HTTPS jest wymagany z wyjątkiem adresów `localhost`, `127.0.0.1` oraz `[::1]`. Dopóki wartość ta nie zostanie ustawiona, `mcp.php` zwraca kod HTTP 400 wraz z błędem JSON-RPC, w którym pole `data` zawiera `FAILED_PRECONDITION` oraz `PUBLIC_URL_REQUIRED`. Skrypt `api.php` nie odczytuje tego ustawienia.

   ![Settings > MCP z widocznym polem Public Cacti URL](../../images/settings-public-url.png)

3. Nadaj uprawnienie **MCP and Abilities API** każdemu użytkownikowi, który ma posiadać token. Żaden użytkownik nie otrzymuje go automatycznie.
4. Upewnij się, że serwer WWW przekazuje nagłówek `Authorization` oraz informację o ścieżce (path info) do PHP (zob. niżej).
5. Otwórz Management > MCP i udostępnij zdolności, które mają być widoczne dla klientów.

**Aktualizacja z kompilacji deweloperskiej.** Wtyczka jest w wersji wstępnej, a struktura jej tabel zmieniała się w trakcie prac bez mechanizmu migracji. W przypadku wcześniejszej instalacji należy wtyczkę odinstalować i zainstalować ponownie. Ponowna instalacja zachowuje już istniejące tabele, dlatego najpierw należy usunąć stare tabele `plugin_mcp_token`, `plugin_mcp_audit` oraz `plugin_mcp_ability` (a także odpowiadające im tabele z kompilacji sprzed zmiany nazwy). Jeśli potrzebna jest ich historia, należy wcześniej wykonać kopię zapasową; tokeny z tych kompilacji są unieważniane podczas odinstalowywania i nie są przenoszone.

### Serwer WWW

Konfiguracje serwera Apache, które usuwają nagłówek `Authorization` przed przekazaniem żądania do PHP, wymagają poniższego wpisu w odpowiednim hoście wirtualnym lub katalogu, a następnie przeładowania konfiguracji:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Serwer Apache z modułem `mod_php` obsługuje trasy `api.php` bez dodatkowej konfiguracji ścieżek.

Trasy `api.php` znajdują się w ścieżce po nazwie skryptu (`/plugins/mcp/api.php/v1/abilities`), dlatego serwer nginx musi dopasowywać identyfikatory URI, w których po `.php` następuje dalsza część ścieżki, wydzielać informację o ścieżce (path info) i przekazywać ją do PHP. Blok `location ~ \.php$` nigdy nie dopasowuje takich adresów URL, przez co nginx odpowiada własną stroną błędu HTML 404. Poniższy wzorzec `location` oraz dwie linie odpowiedzialne za `path-info` zostały zweryfikowane z PHP-FPM; pozostałe linie to standardowy szablon konfiguracji:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Dostosuj wiersze `include` oraz `fastcgi_pass` do bloku, który już obsługuje system Cacti. Nie dodawaj do tego bloku dyrektywy `try_files $fastcgi_script_name =404;`: czyści ona zmienną `$fastcgi_path_info`, w wyniku czego `api.php` zwraca błąd 404 `UNKNOWN_PATH`. Jeśli Twoja konfiguracja wymaga dyrektywy `try_files`, zapisz najpierw tę wartość za pomocą `set $path_info $fastcgi_path_info;` i przekaż ją przez `fastcgi_param PATH_INFO $path_info;`.

Skrypt `mcp.php` nie korzysta z tras w ścieżce i ich nie wymaga.

## Konsola

Widok Management > MCP zawiera trzy karty. Dostęp do niego wymaga uprawnienia **MCP Administration**. Zrzuty ekranu zamieszczone tutaj i poniżej pochodzą z kompilacji deweloperskiej Cacti z przykładowymi danymi.

- **Abilities** zawiera listę wszystkich zarejestrowanych zdolności wraz z ich wtyczką, kategorią, wymaganym uprawnieniem (realm) oraz stanem udostępnienia. Zaznacz wiersze i wybierz Expose (Udostępnij) lub Hide (Ukryj); zmiana wymaga potwierdzenia przed zastosowaniem. Wbudowane zdolności `cacti-*` są domyślnie udostępnione. Zdolności z innych wtyczek są początkowo ukryte, dzięki czemu instalacja wtyczki nigdy niczego nie publikuje bez decyzji administratora. Udostępnienie stanowi jedynie dodatkowy warunek dostępu — użytkownik nadal musi posiadać uprawnienie przypisane do danej zdolności.

  ![Karta Abilities wyświetlająca listę wbudowanych zdolności wraz z ich uprawnieniami i stanem udostępnienia](../../images/console-abilities.png)
- **Tokens** wyświetla listę tokenów wraz z właścicielem, twórcą, datą utworzenia, datą wygaśnięcia, ostatnim użyciem oraz stanem (Active — aktywny, Expired — wygasły, Revoked — unieważniony). Zaznacz wiersze i wybierz Revoke, aby unieważnić tokeny. Unieważnionych tokenów nie można użyć ponownie. Przycisk Create Token służy do utworzenia nowego tokenu.

  ![Karta Tokens wyświetlająca listę tokenów z właścicielem, datą wygaśnięcia, ostatnim użyciem i stanem nad formularzem Create Token](../../images/console-tokens.png)
- **Audit** wyświetla wpisy audytu od najnowszych oraz umożliwia filtrowanie według użytkownika, zdolności i wyniku.

  ![Karta Audit wyświetlająca listę wywołań z użytkownikiem, tokenem, zdolnością i wynikiem wraz z filtrami](../../images/console-audit.png)

## Tokeny

Token osobisty odczytuje dane z Cacti w imieniu swojego właściciela. Ma postać prefiksu `cmcp_pat_` oraz 64 małych znaków szesnastkowych i posiada pojedynczy zakres `abilities:read`. Zakres widocznych dla niego danych zależy od uprawnień (realms) w Cacti oraz uprawnień do urządzeń jego właściciela, a nie od samego tokenu. Właściciel musi być aktywnym użytkownikiem posiadającym uprawnienie **MCP and Abilities API**.

Tokeny są zawsze tworzone dla konkretnego użytkownika, mają określony czas ważności i mogą zostać unieważnione:

- **Konsola.** Management > MCP > Tokens > Create Token. Czas ważności wynosi od 1 do 365 dni i domyślnie wynosi 90 dni. Token jest generowany po stronie serwera i wyświetlany jednorazowo na stronie odpowiedzi, dlatego należy go natychmiast skopiować do menedżera haseł lub sekretów. Możesz utworzyć token dla siebie. Utworzenie tokenu dla innego użytkownika wymaga dodatkowo uprawnienia Users/Groups, ponieważ token odczytuje dane Cacti jako ten użytkownik.
- **My MCP Tokens.** Każdy użytkownik posiadający uprawnienie MCP and Abilities API może zarządzać własnymi tokenami; szczegóły poniżej.
- **Wiersz poleceń.** Skrypt `tokens.php` działa wyłącznie w trybie CLI, z poziomu konta systemowego mającego uprawnienia do administrowania Cacti. Pobiera token ze zmiennej środowiskowej, dzięki czemu jego wartość nigdy nie pojawia się w wierszu poleceń ani na liście procesów. Czas ważności wynosi od 1 do 365 dni i domyślnie wynosi 30 dni. Tworzenie i unieważnianie tokenów przez CLI podlega audytowi tak samo jak w konsoli — jako sprawca zapisywany jest właściciel tokenu, ponieważ sesja CLI nie ma przypisanego użytkownika Cacti, dlatego wpis audytu nie oznacza działania jako pochodzącego z CLI. Flaga `--list` wypisuje wszystkie tokeny w formacie JSON (ID, właściciel, zakresy, znaczniki czasu, flaga unieważnienia) bez wartości samego tokenu; flaga `--help` wyświetla pomoc dotyczącą użycia.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Tokenów nie można utworzyć dla konta gościa (guest), dla wyłączonych użytkowników ani dla użytkowników bez uprawnienia **MCP and Abilities API** — ani z poziomu konsoli, ani z wiersza poleceń, ani przez My MCP Tokens. Cacti przechowuje ustawienie konta gościa jako nazwę użytkownika lub jego ID, a wtyczka rozpoznaje oba formaty. Token, którego właściciel stanie się kontem gościa, przestaje działać przy kolejnym żądaniu.

### My MCP Tokens

Sekcja Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) nie wymaga uprawnienia administracyjnego: jest objęta uprawnieniem **MCP and Abilities API**, a pozycja menu pojawia się wyłącznie dla użytkowników, którzy je posiadają. Strona zawsze działa w kontekście zalogowanego użytkownika. Menu Cacti jest częścią konsoli, więc użytkownik bez dostępu do konsoli może otworzyć tę stronę bezpośrednio pod jej adresem URL.

![Karta My Tokens wyświetlająca tokeny zalogowanego użytkownika oraz formularz tworzenia tokenu](../../images/my-tokens.png)

- **Tokens** wyświetla Twoje tokeny, pozwala utworzyć nowy token (ważny od 1 do 365 dni, domyślnie 90, wyświetlany jednorazowo w odpowiedzi) oraz unieważniać własne tokeny. Nie możesz przeglądać ani unieważniać tokenów innych użytkowników.
- **Activity** wyświetla wykonane przez Ciebie działania od najnowszych: wywołania z użyciem Twoich tokenów oraz dokonane zmiany tokenów.
- **Available Tools** wyświetla zdolności, z których Twój token może obecnie korzystać, wraz z identyfikatorem, nazwą i opisem każdej zdolności. Lista uwzględnia Twoje uprawnienia w Cacti oraz ustawienia udostępniania wybrane przez administratora.

  ![Lista Available Tools pokazująca identyfikator, nazwę i opis każdej zdolności](../../images/my-tools.png)

Instalacja wykonana przed dodaniem tej strony ma listę plików uprawnień (realm) bez `mcp_tokens.php`. Lista ta jest rejestrowana podczas instalacji i nie jest aktualizowana przy włączaniu ani wyłączaniu wtyczki. Odinstaluj i zainstaluj wtyczkę ponownie, a następnie nadaj uprawnienia od nowa, ponieważ Cacti usuwa przypisania uprawnień podczas odinstalowywania wtyczki.

Baza danych przechowuje wyłącznie skrót SHA-256 tokenu, więc utraconego tokenu nie można odzyskać — należy go unieważnić i utworzyć nowy. Rotacja przebiega analogicznie: utwórz nowy token, przełącz klienta, a następnie unieważnij stary token. Wygasły token, unieważniony token, wyłączony właściciel lub utracone uprawnienie powodują odrzucenie kolejnego żądania. Tokeny są akceptowane wyłącznie w nagłówku `Authorization: Bearer`; token przekazany w parametrach zapytania (query string) lub w treści żądania nie jest akceptowany.

## Podłączanie klienta

Użyj punktu końcowego MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, przekazując token w nagłówku `Authorization: Bearer`. Przechowuj token w zmiennej środowiskowej lub menedżerze sekretów i odwołuj się do niego z konfiguracji klienta zamiast wpisywać jego wartość bezpośrednio do pliku.

### Claude Code

Umieść punkt końcowy w pliku projektu `.mcp.json`, który odwołuje się do tokenu po nazwie. Narzędzie Claude Code rozwija `${VAR}` w polach `url` oraz `headers`, więc plik nie zawiera żadnych sekretów i można go bezpiecznie zatwierdzić w repozytorium. Wyeksportuj zmienną `CACTI_MCP_TOKEN` w środowisku uruchamiającym Claude Code.

```json
{
  "mcpServers": {
    "cacti": {
      "type": "http",
      "url": "https://cacti.example.com/cacti/plugins/mcp/mcp.php",
      "headers": {
        "Authorization": "Bearer ${CACTI_MCP_TOKEN}"
      }
    }
  }
}
```

Możesz go również dodać z wiersza poleceń:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Przy użyciu podwójnych cudzysłowów powłoka najpierw rozwija zmienną `$CACTI_MCP_TOKEN`, przez co wartość tokenu zostaje zapisana w pliku konfiguracyjnym dla wybranego zakresu `--scope` (`local`, `user` lub `project`; domyślnie `local`). Nie używaj tej postaci z flagą `--scope project` i utrzymuj ten plik poza kontrolą wersji. Zalecane jest odwołanie w pliku `.mcp.json` opisane powyżej. Claude Code odczytuje niektóre zmienne poświadczeń (takie jak `ANTHROPIC_AUTH_TOKEN`) jako puste w zdalnych polach `url` i `headers`; `CACTI_MCP_TOKEN` do nich nie należy. Źródło: [dokumentacja MCP w Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot w VS Code

Użyj pliku `.mcp.json` w katalogu głównym obszaru roboczego (lub pliku użytkownika `~/.copilot/mcp-config.json`). Te natywne pliki Copilota używają obiektu najwyższego poziomu `mcpServers` oraz odwołań do zmiennych środowiskowych `${NAME}` w wartościach nagłówków:

```json
{
  "mcpServers": {
    "cacti": {
      "type": "http",
      "url": "https://cacti.example.com/cacti/plugins/mcp/mcp.php",
      "headers": {
        "Authorization": "Bearer ${CACTI_MCP_TOKEN}"
      }
    }
  }
}
```

Wyeksportuj zmienną `CACTI_MCP_TOKEN` w środowisku uruchamiającym VS Code. Natywne pliki Copilota nie obsługują zapytań `inputs`. Kreator konfiguracji w VS Code odrzuca wartości `${...}`, dlatego dodaj nagłówek `Authorization`, edytując plik ręcznie, a nie przez kreator. Kreator konfiguracji udostępnia plik w katalogu głównym obszaru roboczego tylko wtedy, gdy włączone jest eksperymentalne ustawienie `chat.mcp.workspaceRootConfig.enabled`. Zobacz [dokumentację konfiguracji MCP w VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Starszy format: `.vscode/mcp.json`.** Dokumentacja VS Code wskazuje, że nowe konfiguracje Copilota nie powinny używać pliku `.vscode/mcp.json` ani pliku `mcp.json` profilu; należą one do przestarzałego środowiska wykonawczego Local, które zostanie usunięte w lutym 2027 roku. Jeśli nadal z niego korzystasz, format zarządzany przez edytor przyjmuje klucz najwyższego poziomu `servers` i może wyświetlić monit o podanie tokenu:

```json
{
  "inputs": [
    {
      "type": "promptString",
      "id": "cacti-mcp-token",
      "description": "Cacti MCP token",
      "password": true
    }
  ],
  "servers": {
    "cacti": {
      "type": "http",
      "url": "https://cacti.example.com/cacti/plugins/mcp/mcp.php",
      "headers": {
        "Authorization": "Bearer ${input:cacti-mcp-token}"
      }
    }
  }
}
```

### Klienci obsługujący wyłącznie stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) to opcjonalny adapter działający jako lokalny serwer MCP stdio, który wywołuje interfejs HTTP API wtyczki. Użyj go w przypadku klienta, który nie potrafi połączyć się ze zdalnym serwerem HTTP. Wymaga on tego samego tokenu osobistego i komunikuje się z `api.php`.

### Zachowanie MCP

Punkt końcowy udostępnia wyłącznie narzędzia: każda udostępniona i dozwolona zdolność jest narzędziem o nazwie równej jej identyfikatorowi, wraz ze schematami wejścia i wyjścia oraz adnotacjami tylko do odczytu (`openWorldHint` ma wartość `false`). Obsługuje metody `initialize`, `server/discover`, `ping`, `tools/list` oraz `tools/call`. Nie utrzymuje sesji, nie wysyła nagłówka `Mcp-Session-Id` (i ignoruje otrzymany) oraz nie akceptuje żądań wsadowych JSON-RPC. Wiadomość bez pola `id` jest powiadomieniem i zwraca kod HTTP 202 bez treści. Dozwolona jest wyłącznie metoda `POST`.

- **Wersje protokołu.** Żądanie zawierające `io.modelcontextprotocol/protocolVersion` w `params._meta` musi wskazywać wersję `2026-07-28`; każda inna wartość zwraca błąd `-32022`. Takie żądania muszą również zawierać pasujące nagłówki `Mcp-Protocol-Version`, `Mcp-Method` oraz (dla `tools/call`) `Mcp-Name`, w przeciwnym razie odpowiedzią jest błąd `-32020`. Pozostałe żądania są traktowane jako wersja `2025-11-25`: `initialize` odpowiada tą wersją, a dla każdej innej metody ewentualny nagłówek `Mcp-Protocol-Version` musi mieć wartość `2025-11-25`, `2025-06-18` lub `2025-03-26`.
- **Błędy narzędzi.** Błąd zdolności, w tym argumenty niezgodne ze schematem lub wartość `arguments` niebędąca obiektem JSON, jest zwracany jako wynik narzędzia z `isError: true` i błędem AIP-193 w `structuredContent`, a nie jako błąd protokołu.
- **Błędy protokołu.** Awarie niebędące błędami narzędzi są obiektami błędów JSON-RPC (kod `-32000` ze statusem i przyczyną w `data` lub standardowe kody): brakujący adres Public Cacti URL, odrzucony nagłówek `Origin`, żądanie przy wyłączonej wtyczce lub na zdalnym pollerze oraz nieoczekiwane błędy serwera (`-32603`, ze szczegółami zapisanymi w dzienniku Cacti, a nie w odpowiedzi). Wykonywane jako pierwsze sprawdzenia żądania (405, 413, 415) oraz błędy uwierzytelniania (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) zachowują treść w formacie AIP-193 opisaną w sekcji HTTP API.

## HTTP API

Bazowy adres URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Kontrakt znajduje się w pliku [openapi.json](../../../openapi.json).

| Metoda i ścieżka | Przeznaczenie |
| --- | --- |
| `GET /v1/abilities` | Lista dozwolonych zdolności. Parametry zapytania: `pageSize`, `pageToken` oraz `filter` w postaci `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Odczyt jednej zdolności. |
| `POST /v1/abilities/{id}:execute` | Wykonanie zdolności. Treść żądania to dokładnie `{"arguments": {...}}`. Odpowiedź ma postać `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Błędy są zgodne ze standardem AIP-193: obiekt `error` z polami `code`, `message`, `status` oraz `details`, który zawiera element `ErrorInfo` z domeną `cacti.net` i stabilnym kodem `reason`. Problemy z argumentami dodają szczegół `BadRequest` wskazujący nazwę pola. Rozmiar treści żądania jest ograniczony do 64 KB, a wyników do 1 MB. Oba punkty końcowe odpowiadają wyłącznie na głównym pollerze i zwracają `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`), gdy wtyczka jest wyłączona lub serwer nie jest głównym pollerem.

| HTTP | Wartości `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (wysyła również `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (wysyła `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Tworzenie zdolności (autorzy wtyczek)

Włączona wtyczka Cacti rejestruje zdolności z poziomu funkcji podpiętej do punktu zaczepienia `abilities_register`, zwykle w swojej funkcji `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Funkcja otrzymuje obiekt `AbilitiesRegistrar` przypisany do zakresu wtyczki. Jej wartość zwracana jest ignorowana.

```php
function acme_abilities_register(AbilitiesRegistrar $registrar) : void {
	$registrar->registerCategory('acme-widgets', 'Widgets');

	$registrar->register('acme-get-widget-count', [
		'label'         => 'Get widget count',
		'description'   => 'Count the widgets the caller may see.',
		'category'      => 'acme-widgets',
		'input_schema'  => ['type' => 'object', 'properties' => new stdClass(), 'additionalProperties' => false],
		'output_schema' => [
			'type'                 => 'object',
			'properties'           => ['count' => ['type' => 'integer', 'minimum' => 0]],
			'required'             => ['count'],
			'additionalProperties' => false
		],
		'annotations' => ['readOnly' => true, 'destructive' => false, 'idempotent' => true],
		'permission'  => fn (int $userId) => is_realm_allowed(ACME_REALM_ID, $userId),
		'execute'     => fn (int $userId, stdClass $args) => ['count' => acme_count_widgets($userId)]
	]);
}
```

Zasady egzekwowane podczas rejestracji:

- **Identyfikatory.** Identyfikator pasuje do wzorca `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, ma maksymalnie 64 znaki i musi zaczynać się od sluga wtyczki oraz łącznika: `acme-` w powyższym przykładzie. Slug to nazwa katalogu wtyczki, więc katalog taki jak `my_plugin` nie może niczego zarejestrować. Katalog wtyczki o nazwie `cacti` zostanie odrzucony; ta przestrzeń nazw należy do wbudowanych zdolności.
- **Definicja.** Dokładnie następujące klucze: `label`, `description` (do 4096 bajtów), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Kategoria musi już istnieć: użyj wbudowanej (`inventory`, `system`) lub zarejestruj własną za pomocą `registerCategory()`, której identyfikator jest unikalny we wszystkich wtyczkach i pasuje do wzorca `^[a-z][a-z0-9-]{0,31}$`.
- **Wyłącznie do odczytu.** Pole `annotations` musi zawierać dokładnie `readOnly: true`, `destructive: false`, `idempotent: true`. Każda inna konfiguracja zgłasza wyjątek.
- **Schematy.** Zarówno `input_schema`, jak i `output_schema` muszą mieć na najwyższym poziomie `type` ustawiony na `object`. Dialekt jest niewielki i działa w trybie fail-closed. Obiekty muszą być zamknięte (`additionalProperties: false` wraz z obecnym polem `properties`); pozostałe typy to `integer` i `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean` oraz `array` (wymagający `items` i `maxItems`). Typ może dopuszczać wartość null w postaci `['string', 'null']`. Ciągi znaków w argumentach mają domyślnie maksymalnie 4096 znaków; ciągi wynikowe są ograniczone wyłącznie zadeklarowanym `maxLength` oraz limitem rozmiaru wyniku. Zarejestrować można maksymalnie 256 zdolności.
- **`permission(int $userId): bool`.** Musi zwrócić dokładnie `true`, aby zezwolić na wykonanie. Identyfikator użytkownika należy do właściciela tokenu; nigdy nie odczytuj stanu sesji.
- **`execute(int $userId, stdClass $args): array`.** Parametr `$args` jest już zweryfikowany względem `input_schema`. Uprawnienia na poziomie obiektów należy egzekwować samodzielnie. Zwróć tablicę asocjacyjną dokładnie zgodną z `output_schema`; lista, dodatkowe pole lub dane JSON przekraczające 1 MB powodują błąd `INVALID_RESULT`. W przypadku błędu widocznego dla klienta, takiego jak `NOT_FOUND`, zgłoś wyjątek `AbilitiesError`.
- **Puste obiekty.** PHP koduje `[]` jako tablicę JSON. Wszędzie tam, gdzie schemat wyjściowy deklaruje `object`, na dowolnej głębokości, rejestr traktuje `[]` jako pusty obiekt i wysyła `{}`; `new stdClass()` również działa. Niepusta lista nigdy nie jest uznawana za obiekt i kończy się błędem `INVALID_RESULT`. Pusta mapa `properties` w schemacie może mieć postać `[]` lub `new stdClass()`; obie są publikowane jako `{}`.
- **Izolacja błędów.** Każda wtyczka rejestruje się w kopii roboczej, która zostaje zachowana tylko wtedy, gdy funkcja zakończy się normalnie. Jeśli zgłosi wyjątek, żadna ze zdolności nie zostanie zarejestrowana, a błąd zostanie zapisany w dzienniku.

Zdolności pochodzące z wtyczek są początkowo ukryte. Administrator udostępnia je na karcie Abilities w konsoli, a w kolumnie Required Realm widnieje dla nich wartość "Set by the plugin".

## Model bezpieczeństwa

- **Wyłącznie uwierzytelnianie Bearer.** Punkty końcowe `api.php` oraz `mcp.php` akceptują
  wyłącznie osobisty token w nagłówku `Authorization`. Odrzucają pliki cookie, `$_POST`
  oraz `$_REQUEST` przed załadowaniem Cacti i niszczą sesję uruchamianą przez Cacti,
  dzięki czemu logowanie w przeglądarce nigdy nie nadaje dostępu do API.
- **Obejście mechanizmu CSRF.** Ochrona CSRF w Cacti odrzuca żądania JSON POST bez
  tokenu CSRF Cacti, którego żaden klient MCP nie może wysłać. Wyłącznie dla tych
  dwóch punktów końcowych wtyczka zmienia nazwę metody żądania przed załadowaniem
  Cacti i przywraca ją po jego załadowaniu, aby mechanizm ochronny je pominął. Jest
  to bezpieczne, ponieważ CSRF chroni żądania uwierzytelniane przez przeglądarkę za
  pomocą plików cookie, a te punkty końcowe nie akceptują tożsamości opartej na
  plikach cookie: strona z innej witryny (cross-site) nie może dołączyć tokenu
  bearer. Strony konsoli zachowują pełną ochronę CSRF. Obejście ma charakter
  tymczasowy, do czasu aż Cacti zapewni oficjalnie obsługiwane wyłączenie; zobacz
  `lib/bootstrap.php`.
- **Weryfikacja nagłówka Origin.** W przypadku `mcp.php`, jeśli żądanie zawiera
  nagłówek `Origin`, musi on dokładnie odpowiadać schematowi, hostowi oraz portowi
  publicznego adresu URL Cacti — w przeciwnym razie żądanie jest odrzucane z błędem
  `ORIGIN_NOT_ALLOWED`. Żądania bez nagłówka `Origin` (tak łączą się klienci
  niebędący przeglądarkami) są dozwolone. Uniemożliwia to stronie internetowej
  wywoływanie tego punktu końcowego z poziomu przeglądarki odwiedzającego. Punkt
  końcowy `api.php` nie stosuje tej weryfikacji.
- **Wyłącznie operacje tylko do odczytu.** Rejestracja odrzuca każdą funkcję
  (ability), która nie jest tylko do odczytu, niedestrukcyjna i idempotentna.
- **Obowiązują jednocześnie udostępnienie i uprawnienia (realmy).** Funkcja musi być
  udostępniona, a właściciel tokenu musi posiadać powiązany z nią realm. Jeśli nie
  można odczytać tabeli udostępniania, każda funkcja jest ukrywana zamiast powrotu
  do ustawień domyślnych.
- **Funkcje ukryte, nieznane oraz bez uprawnień wyglądają identycznie.** Klient nie
  jest w stanie odróżnić funkcji, która nie istnieje, od funkcji ukrytej lub takiej,
  do której użytkownik nie ma uprawnień: wykrywanie (discovery) ją pomija, a próba
  wykonania zwraca `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Tokeny.** Przechowywane jako skróty SHA-256, wyświetlane jednokrotnie, zawsze
  wygasające, z możliwością unieważnienia oraz odrzucane, gdy właściciel zostanie
  wyłączony lub utraci wymagany realm.
- **Audyt.** Tabela `plugin_mcp_audit` rejestruje identyfikator żądania,
  identyfikator tokenu, identyfikator użytkownika, funkcję, wynik (`started`,
  `succeeded`, `failed`, `denied`, `rejected`) oraz znaczniki czasu. Nigdy nie
  zapisuje argumentów, wyników ani wartości tokenów. Funkcja jest uruchamiana
  dopiero po zapisaniu wiersza `started`; jeśli tabela audytu jest niedostępna,
  wywołanie kończy się błędem `UNAVAILABLE` i nie zostaje uruchomione. Wywołanie
  odrzucone przed uruchomieniem generuje jeden wiersz: `denied` dla funkcji
  nieznanej, ukrytej lub bez uprawnień, `rejected` dla argumentów niespełniających
  schematu. Utworzenie i unieważnienie tokenu z poziomu konsoli, strony Moje tokeny
  MCP oraz CLI są rejestrowane jako `mcp-token-create` i `mcp-token-revoke` z
  wynikiem `succeeded`, przy czym unieważnienie jest rejestrowane wyłącznie dla
  tokenu, który był aktywny. Wykrywanie oraz wywołania, w których `arguments` nie
  jest obiektem JSON, nie są logowane.
- **Dziennik błędów.** Nieoczekiwany błąd, `INVALID_RESULT` lub niedostępna tabela
  audytu zapisuje jeden wiersz w dzienniku Cacti w kategorii (facility) `MCP`:
  identyfikator funkcji, stały powód oraz klasę wyjątku. Komunikaty, argumenty i
  tokeny nigdy nie są logowane.
- **Wyłącznie główny poller.** Oba punkty końcowe, obie strony konsoli oraz
  `tokens.php` odmawiają działania w każdym innym miejscu.

## Cykl życia

Wyłączenie wtyczki blokuje oba punkty końcowe. Odinstalowanie unieważnia każdy
token i zachowuje trzy tabele (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) w celach retencyjnych; ponowna instalacja nie reaktywuje
unieważnionego tokenu. Twórz kopie zapasowe tych tabel wraz z bazą danych Cacti i
stosuj politykę retencji audytu poza samą wtyczką.

## Rozwój i testy

Testy to zwykłe skrypty PHP działające bez Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI przeprowadza lintowanie kodu PHP i uruchamia skrypty w katalogu `tests/` (każdy
jest wymieniony w `.github/workflows/ci.yml`) w wersjach PHP od 8.2 do 8.5, a
następnie buduje instalowalne archiwum `mcp/` oraz jego sumę kontrolną. Testy
dotykające Cacti wykorzystują fikstury na granicy funkcji pomocniczych Cacti; nie
testują pełnej instalacji Cacti.

### Testy integracyjne

Skrypt `tests/integration/run.sh 1.2.31` lub `tests/integration/run.sh develop`
instaluje wtyczkę w rzeczywistym środowisku Cacti w kontenerach i przeprowadza na
nim testy na żywo. Wymaga Docker z Compose w wersji v2.23.1 lub nowszej, git oraz
openssl. Ustawienie `KEEP=1` pozostawia stos uruchomiony na potrzeby debugowania.
CI uruchamia je co noc oraz na żądanie, a nie dla pull requestów.

## Lokalizacja

Cacti MCP zawiera skompilowane katalogi GNU gettext w `locales/po/` oraz
`locales/LC_MESSAGES/`, a także zlokalizowane pliki README w `docs/i18n/` dla
języka angielskiego oraz 44 języków (19 z grupy Broad Tier 1, 15 afrykańskich i 10
azjatyckich), wykorzystując domenę tekstową `mcp` (`locales/po/mcp.pot`). Cacti
ładuje pasujący katalog automatycznie, gdy włączona jest obsługa języków.

## Współpraca

Pull requesty należy kierować do gałęzi `develop`. Kod produkcyjny musi być zgodny
z PHP 8.2 i stosować styl Cacti: tabulatory, ciągi znaków w pojedynczych
cudzysłowach oraz funkcje pomocnicze Cacti do obsługi bazy danych i uprawnień.
Dodawaj testy dla zmienionej walidacji, autoryzacji lub zachowania protokołu i
podpisuj commity za pomocą `git commit -s`. Zmiany w API HTTP koordynuj z projektem
[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licencja

Copyright (C) 2026 Thomas Vincent. Udostępniono na warunkach licencji GNU General
Public License w wersji 2 lub nowszej. Zobacz [LICENSE](../../../LICENSE).
