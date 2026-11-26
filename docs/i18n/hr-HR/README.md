<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kaktus sa štitom. Otkrij. Ovlasti. Izvrši.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Licencija: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP je priključak za sustav Cacti koji AI klijentima omogućuje čitanje podataka iz
sustava Cacti putem imenovanih operacija filtriranih prema ovlastima, koje se nazivaju
sposobnosti (abilities). Priključak ih poslužuje na dva načina izravno iz sebe: putem
krajnje točke MCP (`mcp.php`, Streamable HTTP) te putem HTTP API-ja u stilu AIP
(`api.php`). Sustav Cacti zadržava nadzor nad autorizacijom i izvršavanjem. Klijent nikada
ne upućuje izravne upite bazi podataka; smije pozvati jedino sposobnost koju je
administrator izložio i koju dopuštaju područja ovlasti vlasnika tokena u sustavu Cacti.

Autori priključaka mogu registrirati vlastite sposobnosti samo za čitanje putem kuke
`abilities_register`, nakon čega se MCP klijentima prikazuju kao alati bez ikakva
protokolnog koda.

**Status: predizdanje, inačica 0.1.0.** Još nema označenog izdanja.

Danas dostupno:

- Ugrađene sposobnosti samo za čitanje za inačice sustava i popis uređaja.
- Osobni pristupni tokeni (`cmcp_pat_...`) kao jedina vjerodajnica.
- Konzola Upravljanje > MCP: izlaganje ili skrivanje sposobnosti, izrada i opoziv tokena
  te pregled revizijskog dnevnika.
- Upravljanje > Moji MCP tokeni: korisnici upravljaju vlastitim tokenima, pregledavaju
  svoju aktivnost i provjeravaju koje alate njihovi tokeni smiju rabiti.
- MCP putem protokola Streamable HTTP, revizije `2026-07-28` i `2025-11-25`, isključivo
  alati.

Još nije dostupno:

- Prijava putem OAuth 2.1. Udomljeni poveznici koji ne mogu poslati osobni token, poput
  prilagođenih poveznika za ChatGPT i claude.ai, ne mogu se povezati dok ta podrška ne
  bude izrađena. Planirana je kao Plan 2; taj plan još nije napisan.
- Sposobnosti za pisanje. Registrirati se mogu samo sposobnosti samo za čitanje.

Dizajn se nalazi u
[specifikaciji dizajna krajnje točke](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
a redoslijed izgradnje u [docs/plan.md](../../plan.md).

## Ugrađene sposobnosti

| ID | Argumenti | Potrebno područje sustava Cacti |
| --- | --- | --- |
| `cacti-get-system-info` | nema | 15 |
| `cacti-list-devices` | neobvezni `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | obvezni `name`, primjerice `devices/12` | 3 |

Svaki poziv zahtijeva i područje **MCP i Abilities API** za vlasnika tokena, doseg
`abilities:read` (ima ga svaki osobni token) te izloženu sposobnost. Kartica Sposobnosti u
konzoli pokazuje koje je područje potrebno za svaku ugrađenu sposobnost.

- `cacti-list-devices` vraća stranice do 100 uređaja (zadano 50) i `nextPageToken`. Token
  stranice vrijedi jedino za isti `filter` i `orderBy`. `filter` je izraz AIP-160 sastavljen
  od usporedbi povezanih operatorom `AND`, primjerice `state = "DOWN" AND disabled = false`.
  Polja za filtriranje jesu `displayName`, `hostname`, `disabled`, `site`, `poller`,
  `deviceTemplate`, `externalId` i `state`. `orderBy` prihvaća `displayName`, `hostname`
  ili `name`, svako neobvezno praćeno ključnom riječi `desc`.
- Upiti za uređaje prolaze kroz funkciju `get_allowed_devices()` sustava Cacti, pa korisnik
  vidi samo uređaje koje bi mu i sam Cacti prikazao.
- Polja uređaja ne obuhvaćaju SNMP community nizove, pristupne fraze ni druge vjerodajnice.

## Instalacija

Zahtijeva Cacti 1.2.31 ili noviji, PHP 8.2 ili noviji te glavni poller. Autentifikacija
sustava Cacti mora biti uključena; priključak odbija autentifikaciju kada je isključena.

Direktorij priključka mora se zvati `mcp`, a ne `plugin_mcp`. Kratki naziv priključka,
nazivi područja, domena prijevoda i URL-ovi rabe `mcp`.

Iz izvornog repozitorija:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Dok ne postoje označena izdanja, možete preuzeti artefakt `mcp-plugin` iz uspješnog
[pokretanja CI-ja](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
Sadrži `mcp.tar.gz` i `SHA256SUMS`. Provjerite kontrolni zbroj, a zatim raspakirajte
`mcp.tar.gz` unutar direktorija `plugins/` sustava Cacti tako da nastane `plugins/mcp/`.
Automatske izvorne arhive na servisu GitHub rabe drukčiji naziv vršnog direktorija. Arhiva
izostavlja `docs/` (uključujući snimke zaslona u nastavku), `tests/` i `.github/`, pa
poveznice iz datoteke README prema `docs/` rade na servisu GitHub, ali ne i u instaliranoj
kopiji.

Zatim:

1. U Upravljanju priključcima instalirajte i uključite **Cacti MCP**. Administrator koji
   provodi instalaciju automatski dobiva područje **Administracija MCP-a**.
2. U Postavke > MCP postavite **Javni URL sustava Cacti** na adresu kojom se klijenti
   koriste, primjerice `https://cacti.example.com/cacti`. HTTPS je obvezan osim za
   `localhost`, `127.0.0.1` i `[::1]`. Dok to nije postavljeno, `mcp.php` odgovara kodom
   HTTP 400 s JSON-RPC pogreškom čije polje `data` sadrži `FAILED_PRECONDITION` i
   `PUBLIC_URL_REQUIRED`. `api.php` ne čita tu postavku.

   ![Postavke > MCP s poljem Javni URL sustava Cacti](../../images/settings-public-url.png)

3. Dodijelite područje **MCP i Abilities API** svakom korisniku koji će imati token. Nijedan
   ga korisnik ne dobiva automatski.
4. Provjerite prosljeđuje li web poslužitelj zaglavlje `Authorization` i podatke o putanji
   (path info) PHP-u (vidi u nastavku).
5. Otvorite Upravljanje > MCP i izložite sposobnosti koje želite učiniti vidljivima
   klijentima.

**Nadogradnja s razvojne inačice.** Priključak je predizdanje te su se njegove tablice
mijenjale tijekom razvoja bez migracija. Ako ste instalirali raniju inačicu, deinstalirajte
je i ponovno instalirajte. Ponovna instalacija zadržava postojeće tablice, stoga prvo
uklonite stare tablice `plugin_mcp_token`, `plugin_mcp_audit` i `plugin_mcp_ability` (te
odgovarajuće tablice iz inačica nastalih prije preimenovanja). Izradite sigurnosnu pohranu
ako vam je potrebna povijest; tokeni iz tih inačica opozivaju se pri deinstalaciji i ne
prenose se.

### Web poslužitelj

Konfiguracije poslužitelja Apache koje uklanjaju zaglavlje `Authorization` prije PHP-a
zahtijevaju sljedeći redak u odgovarajućem virtualnom poslužitelju ili direktoriju, nakon
čega je potrebno ponovno učitavanje:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache s modulom `mod_php` poslužuje rute datoteke `api.php` bez dodatnog konfiguriranja
putanje.

Rute datoteke `api.php` nalaze se u putanji iza naziva skripte
(`/plugins/mcp/api.php/v1/abilities`), stoga nginx mora podudarati URI-je u kojima iza
`.php` slijedi ostatak putanje, izdvojiti path info i proslijediti ga PHP-u. Blok
`location ~ \.php$` nikada ne podudara takve URL-ove; nginx vraća vlastiti HTML 404 odgovor.
Uzorak lokacije i dva retka za path-info u nastavku provjereni su s PHP-FPM-om, dok su
preostali retci uobičajeni predložak:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Prilagodite retke `include` i `fastcgi_pass` bloku koji već poslužuje Cacti. Nemojte dodavati
`try_files $fastcgi_script_name =404;` u taj blok: ta naredba briše `$fastcgi_path_info`, pa
`api.php` potom odgovara s 404 `UNKNOWN_PATH`. Ako vaša konfiguracija zahtijeva `try_files`,
najprije spremite vrijednost naredbom `set $path_info $fastcgi_path_info;` i proslijedite
`fastcgi_param PATH_INFO $path_info;`.

`mcp.php` nema rute u putanji i ne treba ovu konfiguraciju.

## Konzola

Upravljanje > MCP ima tri kartice. Potrebno vam je područje **Administracija MCP-a**. Snimke
zaslona ovdje i u nastavku potječu iz razvojne inačice sustava Cacti s oglednim podatcima.

- **Sposobnosti** prikazuje popis svih registriranih sposobnosti s pripadajućim priključkom,
  kategorijom, potrebnim područjem i statusom izloženosti. Odaberite retke i kliknite Izloži
  ili Sakrij; promjenu potvrđujete prije primjene. Ugrađene sposobnosti `cacti-*` zadano su
  izložene. Sposobnosti ostalih priključaka u početku su skrivene, pa instalacija priključka
  nikada ništa ne objavljuje bez odluke administratora. Izloženost samo sužava pristup:
  korisnik i dalje mora imati područje koje sposobnost zahtijeva.

  ![Kartica Sposobnosti s popisom ugrađenih sposobnosti, njihovih područja i statusa izloženosti](../../images/console-abilities.png)
- **Tokeni** prikazuje popis tokena s vlasnikom, autorom, vremenom izrade, istekom,
  posljednjom upotrebom i statusom (Aktivan, Istekao, Opozvan). Odaberite retke i izaberite
  Opozovi kako biste ih opozvali. Opozvani tokeni više se ne mogu upotrijebiti. Radnja Izradi
  token stvara novi token.

  ![Kartica Tokeni s popisom tokena, vlasnikom, istekom, posljednjom upotrebom i statusom iznad obrasca Izradi token](../../images/console-tokens.png)
- **Revizija** prikazuje revizijske unose počevši od najnovijih te omogućuje filtriranje po
  korisniku, sposobnosti i ishodu.

  ![Kartica Revizija s popisom poziva, korisnikom, tokenom, sposobnošću, ishodom i filtrima](../../images/console-audit.png)

## Tokeni

Osobni token čita Cacti kao njegov vlasnik. Ima oblik `cmcp_pat_` praćen sa 64 mala
heksadekadska znaka i nosi jedini doseg `abilities:read`. Što token može vidjeti određuju
područja sustava Cacti i ovlasti za uređaje njegova vlasnika, a ne sam token. Vlasnik mora
biti omogućen korisnik s područjem **MCP i Abilities API**.

Tokeni se uvijek izrađuju za određenog korisnika, imaju rok valjanosti i mogu se opozvati:

- **Konzola.** Upravljanje > MCP > Tokeni > Izradi token. Rok valjanosti iznosi od 1 do 365
  dana, a zadano je 90 dana. Poslužitelj generira token i prikazuje ga samo jednom na
  stranici odgovora, stoga ga odmah spremite u svoj upravitelj tajni. Možete izraditi token
  za sebe. Za izradu tokena drugom korisniku potrebno je i područje Korisnici/Grupe, jer
  token čita Cacti u ime tog korisnika.
- **Moji MCP tokeni.** Svaki korisnik s područjem MCP i Abilities API može upravljati
  vlastitim tokenima; vidi u nastavku.
- **Naredbeni redak.** `tokens.php` izvršava se isključivo iz naredbenog retka, pod
  korisničkim računom operacijskog sustava koji može administrirati Cacti. Token preuzima iz
  varijable okruženja kako se vrijednost nikada ne bi pojavila u naredbenom retku niti na
  popisu procesa. Rok valjanosti iznosi od 1 do 365 dana, a zadano je 30 dana. Izrada i
  opoziv tokena putem naredbenog retka bilježe se u reviziji jednako kao i putem konzole, s
  vlasnikom tokena kao izvršiteljem jer CLI nema Cacti korisnika, pa revizijski unos ne
  označava da radnja dolazi iz naredbenog retka. Naredba `--list` ispisuje svaki token u
  formatu JSON (ID, vlasnik, dosezi, vremenske oznake, zastavica opoziva), ali nikada
  vrijednost tokena; `--help` prikazuje upute za upotrebu.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Tokeni se ne mogu izraditi za gostujući račun, za onemogućene korisnike niti za korisnike
bez područja **MCP i Abilities API**, bilo iz konzole, naredbenog retka ili stranice Moji
MCP tokeni. Cacti pohranjuje postavku gosta kao korisničko ime ili ID korisnika, a
priključak razrješava oba zapisa. Token čiji vlasnik postane gostujući račun prestaje raditi
pri sljedećem zahtjevu.

### Moji MCP tokeni

Upravljanje > Moji MCP tokeni (`plugins/mcp/mcp_tokens.php`) ne zahtijeva administratorsko
područje: obuhvaćeno je područjem **MCP i Abilities API**, a stavka izbornika prikazuje se
samo korisnicima koji ga imaju. Stranica uvijek djeluje na prijavljenog korisnika. Izbornik
sustava Cacti dio je konzole, pa korisnik bez pristupa konzoli stranici pristupa izravno
njezinom adresom.

![Kartica Moji tokeni s popisom tokena prijavljenog korisnika i obrascem za izradu](../../images/my-tokens.png)

- **Tokeni** prikazuje vaše tokene, izrađuje novi (1 do 365 dana, zadano 90, prikazan jednom
  u odgovoru) te opoziva vaše vlastite tokene. Ne možete vidjeti ni opozvati tuđe tokene.
- **Aktivnost** prikazuje radnje koje ste izvršili, od najnovijih prema starijima: pozive
  upućene vašim tokenima i promjene tokena koje ste napravili.
- **Raspoloživi alati** prikazuje sposobnosti koje vaš token trenutačno može rabiti, uz ID,
  naziv i opis svake sposobnosti. Popis prati vaše ovlasti u sustavu Cacti i postavke
  izloženosti koje je odabrao administrator.

  ![Popis raspoloživih alata s ID-om, nazivom i opisom svake sposobnosti](../../images/my-tools.png)

Instalacija provedena prije uvođenja ove stranice ima popis datoteka područja bez
`mcp_tokens.php`. Taj se popis registrira pri instalaciji, a ne ažurira se uključivanjem ni
isključivanjem priključka. Deinstalirajte i ponovno instalirajte priključak, a zatim ponovno
dodijelite područja, jer Cacti uklanja dodijeljena područja pri deinstalaciji priključka.

Baza podataka pohranjuje samo sažetak SHA-256 tokena, stoga izgubljeni token nije moguće
vratiti; opozovite ga i izradite novi. Rotacija se provodi na isti način: izradite novi
token, prebacite klijent na njega, a zatim opozovite stari. Istekao token, opozvan token,
onemogućen vlasnik ili izgubljeno područje dovode do odbijanja pri sljedećem zahtjevu. Tokeni
se prihvaćaju jedino u zaglavlju `Authorization: Bearer`; token u upitnom nizu ili tijelu
zahtjeva odbija se.

## Povezivanje klijenta

Upotrijebite krajnju točku MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php` s
tokenom u zaglavlju `Authorization: Bearer`. Pohranite token u varijablu okruženja ili
upravitelj tajni te se na njega pozovite iz konfiguracije klijenta umjesto da njegovu
vrijednost upisujete u datoteku.

### Claude Code

Spremite krajnju točku u projektnu datoteku `.mcp.json` koja se poziva na token po nazivu
varijable. Claude Code proširuje `${VAR}` u poljima `url` i `headers`, pa datoteka ne sadrži
tajnu i sigurna je za spremanje u repozitorij. Izvezite `CACTI_MCP_TOKEN` u okruženju iz
kojeg pokrećete Claude Code.

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

Možete ga dodati i iz naredbenog retka:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Uz dvostruke navodnike vaša ljuska najprije proširuje `$CACTI_MCP_TOKEN`, pa se vrijednost
tokena zapisuje u konfiguracijsku datoteku za odabrani `--scope` (`local`, `user` ili
`project`; zadano `local`). Nemojte rabiti taj oblik s `--scope project` i držite datoteku
izvan sustava za nadzor inačica. Prednost dajte gornjoj referenci u `.mcp.json`. Claude Code
pojedine varijable vjerodajnica (poput `ANTHROPIC_AUTH_TOKEN`) čita kao prazne u udaljenim
poljima `url` i `headers`; `CACTI_MCP_TOKEN` nije jedna od njih. Izvor:
[dokumentacija za Claude Code MCP](https://code.claude.com/docs/en/mcp).

### GitHub Copilot u alatu VS Code

Upotrijebite `.mcp.json` u korijenu radnog prostora (ili korisničku datoteku
`~/.copilot/mcp-config.json`). Ove izvorne datoteke za Copilot rabe vršni objekt `mcpServers`
i reference varijabli okruženja `${NAME}` u vrijednostima zaglavlja:

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

Izvezite `CACTI_MCP_TOKEN` u okruženju iz kojeg se pokreće VS Code. Izvorne datoteke za
Copilot ne podržavaju upite `inputs`. Vođeno postavljanje u alatu VS Code odbija vrijednosti
`${...}`, stoga zaglavlje `Authorization` dodajte uređivanjem datoteke, a ne putem vođenog
postupka. Vođeno postavljanje nudi datoteku u korijenu radnog prostora samo kada je uključena
eksperimentalna postavka `chat.mcp.workspaceRootConfig.enabled`. Pogledajte
[referencu za konfiguriranje MCP-a u alatu VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Naslijeđeno: `.vscode/mcp.json`.** VS Code navodi da nove konfiguracije za Copilot ne smiju
rabiti `.vscode/mcp.json` niti profilski `mcp.json`; oni pripadaju zastarjelom okruženju
Local harness koje će biti uklonjeno u veljači 2027. Ako ga još rabite, format kojim upravlja
uređivač prima vršni ključ `servers` i može zatražiti unos tokena:

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

### Klijenti koji podržavaju samo stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) neobvezni je prilagodnik koji se
izvršava kao lokalni stdio MCP poslužitelj i poziva HTTP API priključka. Upotrijebite ga za
klijent koji se ne može povezati na udaljeni HTTP poslužitelj. Zahtijeva isti osobni token i
komunicira s `api.php`.

### Ponašanje MCP-a

Krajnja točka poslužuje isključivo alate: svaka izložena i dopuštena sposobnost alat je
imenovan svojim ID-om, s vlastitim ulaznim i izlaznim shemama te bilješkama samo za čitanje
(`openWorldHint` ima vrijednost `false`). Obrađuje metode `initialize`, `server/discover`,
`ping`, `tools/list` i `tools/call`. Ne održava sesiju, ne šalje zaglavlje `Mcp-Session-Id`
(a primljeno zanemaruje) i ne prihvaća skupne JSON-RPC zahtjeve (batches). Poruka bez polja
`id` predstavlja obavijest i vraća HTTP 202 bez tijela. Dopuštena je isključivo metoda `POST`.

- **Revizije.** Zahtjev koji u `params._meta` nosi `io.modelcontextprotocol/protocolVersion`
  mora navesti `2026-07-28`; sve ostalo vraća pogrešku `-32022`. Takvi zahtjevi moraju nositi
  i podudarna zaglavlja `Mcp-Protocol-Version`, `Mcp-Method` te (za `tools/call`) `Mcp-Name`,
  inače odgovor nosi pogrešku `-32020`. Ostali se zahtjevi obrađuju kao `2025-11-25`:
  `initialize` odgovara tom revizijom, a na svakoj drugoj metodi zaglavlje
  `Mcp-Protocol-Version`, ako je poslano, mora biti `2025-11-25`, `2025-06-18` ili
  `2025-03-26`.
- **Pogreške alata.** Pogreška sposobnosti, uključujući argumente koji ne odgovaraju shemi
  ili vrijednost polja `arguments` koja nije JSON objekt, vraća se kao rezultat alata s
  `isError: true` i AIP-193 pogreškom u polju `structuredContent`, a ne kao pogreška
  protokola.
- **Pogreške protokola.** Neuspjesi koji nisu pogreške alata vraćaju se kao JSON-RPC objekti
  pogreške (kod `-32000` sa statusom i razlogom u `data` ili standardni kodovi): nedostatak
  Javnog URL-a sustava Cacti, odbijeno zaglavlje `Origin`, zahtjev kada je priključak
  onemogućen ili na udaljenom polleru te neočekivane poslužiteljske pogreške (`-32603`, pri
  čemu se pojedinost zapisuje u dnevnik sustava Cacti, a ne u odgovor). Provjere zahtjeva
  koje se izvode prve (405, 413, 415) i pogreške autentifikacije (401 `INVALID_TOKEN`, 403
  `REALM_REQUIRED`) zadržavaju tijelo AIP-193 opisano u odjeljku HTTP API.

## HTTP API

Osnovni URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Ugovor API-ja nalazi se
u datoteci [openapi.json](../../../openapi.json).

| Metoda i putanja | Namjena |
| --- | --- |
| `GET /v1/abilities` | Popis dopuštenih sposobnosti. Parametri upita: `pageSize`, `pageToken` i `filter` oblika `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Čitanje jedne sposobnosti. |
| `POST /v1/abilities/{id}:execute` | Izvršavanje sposobnosti. Tijelo je točno `{"arguments": {...}}`. Odgovor je `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Pogreške slijede AIP-193: objekt `error` s poljima `code`, `message`, `status` i `details`
koji sadrži `ErrorInfo` s domenom `cacti.net` i stabilnim poljem `reason`. Problemi s
argumentima dodaju pojedinost `BadRequest` koja imenuje polje. Tijela zahtjeva ograničena su
na 64 KB, a rezultati na 1 MB. Obje krajnje točke odgovaraju samo na glavnom polleru i
vraćaju `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) kada je priključak onemogućen ili poslužitelj
nije glavni poller.

| HTTP | Vrijednosti polja `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (također šalje `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (šalje `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Izrada sposobnosti (autori priključaka)

Omogućeni priključak za Cacti registrira sposobnosti iz funkcije koju povezuje na kuku
`abilities_register`, obično unutar svoje funkcije `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Funkcija prima objekt `AbilitiesRegistrar` ograničen na taj priključak. Njezina povratna
vrijednost zanemaruje se.

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

Pravila koja se sva provode pri registraciji:

- **ID-ovi.** ID odgovara izrazu `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, dug je najviše 64
  znaka i mora započinjati kratkim nazivom priključka i crticom: `acme-` u gornjem primjeru.
  Kratki naziv odgovara nazivu direktorija priključka, pa direktorij poput `my_plugin` ne
  može registrirati ništa. Direktorij priključka nazvan `cacti` odbija se jer taj imenski
  prostor pripada ugrađenim sposobnostima.
- **Definicija.** Točno ovi ključevi: `label`, `description` (do 4096 bajtova), `category`,
  `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Kategorija mora
  već postojati: upotrijebite ugrađenu (`inventory`, `system`) ili registrirajte vlastitu
  metodom `registerCategory()`, čiji je ID jedinstven među svim priključcima i odgovara
  izrazu `^[a-z][a-z0-9-]{0,31}$`.
- **Isključivo za čitanje.** Polje `annotations` mora biti točno `readOnly: true`,
  `destructive: false`, `idempotent: true`. Sve ostalo baca iznimku.
- **Sheme.** `input_schema` i `output_schema` moraju na vršnoj razini imati `type` postavljen
  na `object`. Dijalekt je uzak i odbija nepoznato. Objekti moraju biti zatvoreni
  (`additionalProperties: false`, uz obvezno polje `properties`); ostali su tipovi `integer`
  i `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`),
  `boolean` i `array` (koji zahtijeva `items` i `maxItems`). Tip može dopuštati `null` zapisom
  `['string', 'null']`. Znakovni nizovi u argumentima zadano su ograničeni na najviše 4096
  znakova; nizovi u rezultatu ograničeni su samo deklariranim `maxLength` i ograničenjem
  veličine rezultata. Registrirati se može najviše 256 sposobnosti.
- **`permission(int $userId): bool`.** Mora vratiti točno `true` za dopuštenje. Korisnički
  ID pripada vlasniku tokena; nikada ne čitajte stanje sesije.
- **`execute(int $userId, stdClass $args): array`.** `$args` je već provjeren prema
  `input_schema`. Ovlasti na razini objekta provodite sami. Vratite asocijativno polje koje
  točno odgovara `output_schema`; popis, dodatno polje ili više od 1 MB JSON-a postaje
  pogreška `INVALID_RESULT`. Bacite `AbilitiesError` za neuspjeh vidljiv klijentu, primjerice
  `NOT_FOUND`.
- **Prazni objekti.** PHP kodira `[]` kao JSON polje. Gdje god izlazna shema definira
  `object`, na bilo kojoj dubini, registar tumači `[]` kao prazan objekt i šalje `{}`;
  `new stdClass()` također radi. Neprazan popis nikada se ne smatra objektom i završava
  pogreškom `INVALID_RESULT`. Prazna mapa `properties` u shemi može biti `[]` ili
  `new stdClass()`; obje se objavljuju kao `{}`.
- **Izolacija pogrešaka.** Svaki priključak registrira se u privremenu kopiju koja se
  zadržava jedino ako vaša funkcija završi uobičajeno. Ako baci iznimku, nijedna vaša
  sposobnost ne registrira se, a neuspjeh se zapisuje u dnevnik.

Sposobnosti priključaka u početku su skrivene. Administrator ih izlaže na kartici
Sposobnosti u konzoli, a u stupcu Potrebno područje za njih piše "Određuje priključak".

## Sigurnosni model

- **Isključivo Bearer.** `api.php` i `mcp.php` prihvaćaju osobni token u zaglavlju
  `Authorization` i ništa drugo. Uklanjaju kolačiće, `$_POST` i `$_REQUEST` prije učitavanja
  sustava Cacti i uništavaju sesiju koju Cacti pokrene, tako da prijava u pregledniku nikada
  ne daje pristup API-ju.
- **Zaobilazno rješenje za CSRF.** CSRF zaštita sustava Cacti odbija JSON POST zahtjev bez
  CSRF tokena sustava Cacti, koji nijedan MCP klijent ne može poslati. Samo za ove dvije
  krajnje točke priključak preimenuje metodu zahtjeva prije učitavanja sustava Cacti i vraća
  je nakon toga, pa ih zaštita preskače. To je sigurno jer CSRF štiti zahtjeve koje preglednik
  autentificira kolačićima, a ove krajnje točke ne prihvaćaju identitet putem kolačića:
  stranica s drugog ishodišta ne može priložiti Bearer token. Stranice konzole zadržavaju
  potpunu CSRF zaštitu. Rješenje je privremeno dok Cacti ne ponudi podržano izuzeće; vidi
  `lib/bootstrap.php`.
- **Provjera zaglavlja Origin.** Na `mcp.php`, ako zahtjev sadrži zaglavlje `Origin`, ono mora
  točno odgovarati shemi, poslužitelju i portu Javnog URL-a sustava Cacti, inače se zahtjev
  odbija s `ORIGIN_NOT_ALLOWED`. Zahtjev bez zaglavlja `Origin`, čime se povezuju klijenti
  izvan preglednika, dopušten je. Time se sprječava da web stranica upravlja krajnjom točkom
  iz preglednika posjetitelja. `api.php` ne primjenjuje ovu provjeru.
- **Isključivo za čitanje.** Registracija odbija svaku sposobnost koja nije samo za čitanje,
  nedestruktivna i idempotentna.
- **Primjenjuju se i izloženost i područja.** Sposobnost mora biti izložena, a vlasnik tokena
  mora imati njezino područje. Ako tablicu izloženosti nije moguće pročitati, svaka je
  sposobnost skrivena umjesto povratka na zadane postavke.
- **Skriveno, nepoznato i nedopušteno izgledaju jednako.** Klijent ne može razlikovati
  sposobnost koja ne postoji od one koja je skrivena ili koju njegov korisnik ne smije
  rabiti: otkrivanje je izostavlja, a izvršavanje vraća `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Tokeni.** Pohranjuju se kao sažetci SHA-256, prikazuju jednom, uvijek istječu, mogu se
  opozvati te se odbijaju kada je vlasnik onemogućen ili izgubi područje.
- **Revizija.** Tablica `plugin_mcp_audit` bilježi ID zahtjeva, ID tokena, ID korisnika,
  sposobnost, ishod (`started`, `succeeded`, `failed`, `denied`, `rejected`) i vremenske
  oznake. Nikada ne bilježi argumente, rezultate ni vrijednosti tokena. Sposobnost se
  izvršava tek nakon upisa retka `started`; ako revizijska tablica nije dostupna, poziv ne
  uspijeva s `UNAVAILABLE` i ne izvršava se. Poziv odbijen prije izvršavanja čini jedan redak:
  `denied` za nepoznatu, skrivenu ili nedopuštenu sposobnost, `rejected` za argumente koji ne
  prolaze shemu. Izrada i opoziv tokena iz konzole, stranice Moji MCP tokeni i naredbenog
  retka bilježe se kao `mcp-token-create` i `mcp-token-revoke` s ishodom `succeeded`, a
  opoziv se bilježi samo za token koji je bio aktivan. Otkrivanje i poziv čije polje
  `arguments` nije JSON objekt ne bilježe se.
- **Dnevnik pogrešaka.** Neočekivana pogreška, `INVALID_RESULT` ili nedostupna revizijska
  tablica zapisuje jedan redak u dnevnik sustava Cacti s oznakom `MCP`: ID sposobnosti,
  fiksni razlog i klasu iznimke. Poruke, argumenti i tokeni nikada se ne zapisuju u dnevnik.
- **Isključivo glavni poller.** Obje krajnje točke, obje stranice konzole i `tokens.php`
  odbijaju djelovati bilo gdje drugdje.

## Životni ciklus

Onemogućavanje priključka blokira obje krajnje točke. Deinstalacija opoziva sve tokene i
zadržava tri tablice (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) radi
pohrane i revizijskog traga; ponovna instalacija ne vraća opozvani token u aktivno stanje.
Izrađujte sigurnosne kopije tablica zajedno s bazom podataka sustava Cacti i primijenite
pravila čuvanja revizijskih zapisa izvan priključka.

## Razvoj i testovi

Testovi su obične PHP skripte koje se izvršavaju bez sustava Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI provjerava PHP sintaksu i pokreće skripte u `tests/` (svaka je navedena u
`.github/workflows/ci.yml`) na inačicama PHP 8.2 do 8.5, zatim izrađuje instalacijsku arhivu
`mcp/` i njezin kontrolni zbroj. Testovi koji dodiruju Cacti rabe testne pripravke na granici
pomoćnih funkcija sustava Cacti; ne ispituju cjelovitu instalaciju sustava Cacti.

### Integracijski testovi

Naredba `tests/integration/run.sh 1.2.31` ili `tests/integration/run.sh develop` instalira
priključak u stvarni Cacti unutar spremnika i provodi žive provjere nad njim. Zahtijeva
Docker s alatom Compose v2.23.1 ili novijim, git i openssl. `KEEP=1` ostavlja spremnike
pokrenutima radi otklanjanja pogrešaka. CI ih pokreće svake noći i na zahtjev, a ne na
zahtjevima za povlačenje.

## Lokalizacija

Cacti MCP isporučuje prevedene kataloge GNU gettext u `locales/po/` i `locales/LC_MESSAGES/`
te lokalizirane datoteke README u `docs/i18n/` za engleski uz 47 lokaliteta (19 Broad Tier 1,
15 afričkih, 10 azijskih te bosanski, hrvatski i srpski), rabeći tekstualnu domenu `mcp`
(`locales/po/mcp.pot`). Cacti automatski učitava odgovarajući katalog kada je podrška za
jezike uključena.

## Doprinos

Zahtjevi za povlačenje šalju se na granu `develop`. Održavajte produkcijski kod kompatibilnim
s PHP-om 8.2 i slijedite stil sustava Cacti: tabulatore, jednostruke navodnike za znakovne
nizove te pomoćnike sustava Cacti za bazu podataka i ovlasti. Dodajte testove za izmijenjenu
validaciju, autorizaciju ili ponašanje protokola i potpišite commite naredbom
`git commit -s`. Izmjene HTTP API-ja uskladite s projektom
[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licencija

Autorska prava (C) 2026 Thomas Vincent. Objavljeno pod licencijom GNU General Public License,
inačica 2 ili novija. Pogledajte [LICENSE](../../../LICENSE).
