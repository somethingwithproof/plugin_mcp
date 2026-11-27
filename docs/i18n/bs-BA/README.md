<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kaktus sa štitom. Otkrij. Autorizuj. Izvrši.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Licenca: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP je Cacti dodatak koji omogućava AI klijentima da čitaju vaše Cacti podatke kroz
imenovane operacije filtrirane prema dozvolama, nazvane mogućnosti (abilities). Poslužuje ih
na dva načina direktno iz samog dodatka: preko MCP krajnje tačke (`mcp.php`, Streamable HTTP)
i HTTP API-ja u AIP stilu (`api.php`). Cacti ostaje odgovoran za autorizaciju i izvršavanje.
Klijent nikada ne postavlja direktne upite bazi podataka; može pozvati samo onu mogućnost koju
je administrator izložio i koju dopuštaju Cacti oblasti ovlaštenja vlasnika tokena.

Autori dodataka mogu registrovati vlastite mogućnosti samo za čitanje putem hooka
`abilities_register`, nakon čega se one MCP klijentima prikazuju kao alati bez ikakvog
protokolarnog koda.

**Status: predizdanje, verzija 0.1.0.** Još nema označenog izdanja.

Dostupno danas:

- Devet ugrađenih mogućnosti samo za čitanje koje obuhvataju verzije sistema, uređaje,
  lokacije, pollere, stabla grafikona, grafikone, izvore podataka i ograničeni,
  redigovani kraj Cacti dnevnika.
- Lični pristupni tokeni (`cmcp_pat_...`) kao jedini akreditiv.
- Konzola Upravljanje > MCP: izlaganje ili sakrivanje mogućnosti, kreiranje i opoziv
  tokena, te pregled zapisnika revizije.
- Upravljanje > Moji MCP tokeni: korisnici upravljaju vlastitim tokenima, pregledaju
  svoju aktivnost i vide koje alate njihovi tokeni mogu koristiti.
- MCP preko Streamable HTTP-a, revizije protokola `2026-07-28` i `2025-11-25`,
  isključivo alati.

Još nije dostupno:

- OAuth 2.1 prijava. Hostovani konektori koji ne mogu poslati lični token, kao što su
  prilagođeni konektori za ChatGPT i claude.ai, ne mogu se povezati dok ova podrška ne
  bude dostupna. Predviđena je kao Plan 2; taj plan još nije napisan.
- Mogućnosti za pisanje. Mogu se registrovati samo mogućnosti samo za čitanje.

Dizajn se nalazi u
[specifikaciji dizajna krajnje tačke](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
a redoslijed izrade u [docs/plan.md](../../plan.md).

## Ugrađene mogućnosti

| ID | Kategorija | Argumenti | Potrebna Cacti oblast |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | nema | 15 |
| `cacti-list-devices` | `inventory` | opcionalni `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | obavezni `name`, na primjer `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | opcionalni `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | opcionalni `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | opcionalni `pageSize`, `pageToken`, `filter`, `orderBy` | 7 ili 4 |
| `cacti-list-graphs` | `inventory` | opcionalni `pageSize`, `pageToken`, `filter`, `orderBy` | 7 ili 5 |
| `cacti-list-data-sources` | `inventory` | opcionalni `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | opcionalni `lines` (1 do 200, podrazumijevano 50), `severity`, `search` | 19 ili 18 |

Svaki poziv također zahtijeva oblast **MCP i Abilities API** za vlasnika tokena,
opseg `abilities:read` (koji svaki lični token posjeduje) i izloženu mogućnost.
Kartica Mogućnosti na konzoli prikazuje primarnu oblast koju zahtijeva svaka ugrađena mogućnost.

Svih šest `cacti-list-*` mogućnosti vraća stranice do 100 stavki (podrazumijevano 50) i
`nextPageToken`. Token stranice važi samo za isti `filter` i `orderBy`. `filter` je
AIP-160 izraz poređenja (`=`, `!=`, `<`, `<=`, `>`, `>=`) povezanih operatorom `AND`,
na primjer `state = "DOWN" AND disabled = false`. `orderBy` prima zarezom odvojenu
listu polja za sortiranje, pri čemu svako polje opcionalno može biti praćeno sa `asc` ili `desc`.

| Mogućnost | Polja za filtriranje | Polja za sortiranje |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

Ograničavanje dozvola i izuzimanje tajni:

- `cacti-list-devices` i `cacti-get-device` izvršavaju upite kroz Cacti funkciju
  `get_allowed_devices()` i izuzimaju SNMP community nizove, pristupne fraze i druge akreditive.
- `cacti-list-trees` izvršava upite kroz `get_allowed_trees()` (i filtrira pomoću
  `is_tree_allowed()` kada je dostupno); `cacti-list-graphs` izvršava upite kroz
  `get_allowed_graphs()` (i filtrira pomoću `is_graph_allowed()` kada je dostupno).
- `cacti-list-data-sources` ograničava redove na uređaje dozvoljene pozivaocu iz
  `get_allowed_devices()` (i `is_device_allowed()` kada je dostupno) te vraća samo
  metapodatke bez postavljanja upita tabeli `data_input_data` ili izlaganja tajnih ulaznih vrijednosti.
- `cacti-list-pollers` izuzima akreditive baze podataka (`dbpass`, `dbuser`) te kolone za
  TLS ključeve i certifikate (`dbsslkey`, `dbsslcert`, `dbsslca`).
- `cacti-get-clog` čita do posljednjih 1 MiB konfigurisanog Cacti dnevnika (skraćujući
  pojedinačne redove duže od 2048 bajtova), filtrira prema `severity` (`ALL`, `DEBUG`,
  `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`, `ALERT`, `EMERGENCY`, `FATAL`,
  `STATS`, `POLLER`, `SYSTEM`; podrazumijevano `ALL`) i neosjetljivo na veličinu slova
  prema `search` (do 256 znakova), te vraća `lines`, `count` i `truncated`. Svaki red se
  rediguje radi uklanjanja ličnih tokena, bearer/basic zaglavlja, lozinki, tajni, SNMP
  community nizova, ključeva, `dbpass`, `dbsslkey` i URL korisničkih podataka prije nego što
  se pokrenu filteri `severity` i `search`, kako `search` ne bi mogao poslužiti kao orakl za
  tajne. Redakcija u slučaju greške zatvara pristup sa `[redacted]`, a nečitljiv dnevnik
  vraća `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`).

## Instalacija

Zahtijeva Cacti 1.2.31 ili noviji, PHP 8.2 ili noviji i glavni poller. Cacti
autentifikacija mora biti uključena; dodatak odbija autentifikaciju kada je ona isključena.

Direktorij dodatka mora se zvati `mcp`, a ne `plugin_mcp`. Kratki naziv dodatka, nazivi
oblasti, domena prijevoda i URL adrese koriste `mcp`.

Iz izvornog koda:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Dok ne postoje označena izdanja, možete umjesto toga preuzeti artefakt `mcp-plugin` iz
uspješnog
[CI pokretanja](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
On sadrži `mcp.tar.gz` i `SHA256SUMS`. Provjerite kontrolnu sumu, a zatim raspakujte
`mcp.tar.gz` unutar Cacti direktorija `plugins/` tako da rezultat bude `plugins/mcp/`.
Automatske izvorne arhive na GitHubu koriste drugačiji naziv glavnog direktorija. Arhiva
izostavlja `docs/` (uključujući snimke ekrana ispod), `tests/` i `.github/`, pa linkovi u
README datoteci prema `docs/` rade na GitHubu, ali ne i u instaliranoj kopiji.

Zatim:

1. U Upravljanju dodacima instalirajte i omogućite **Cacti MCP**. Administrator koji vrši
   instalaciju automatski dobija oblast **MCP administracija**.
2. Pod Postavke > MCP postavite **Javni Cacti URL** na adresu koju koriste klijenti, na
   primjer `https://cacti.example.com/cacti`. HTTPS je obavezan osim za `localhost`,
   `127.0.0.1` i `[::1]`. Dok ovo nije postavljeno, `mcp.php` odgovara statusom HTTP 400
   sa JSON-RPC greškom čije polje `data` sadrži `FAILED_PRECONDITION` i
   `PUBLIC_URL_REQUIRED`. `api.php` ne čita ovu postavku.

   ![Postavke > MCP sa poljem Javni Cacti URL](../../images/settings-public-url.png)

3. Dodijelite oblast **MCP i Abilities API** svakom korisniku koji će imati token. Nijedan
   korisnik je ne dobija automatski.
4. Provjerite da web server prosljeđuje zaglavlje `Authorization` i informacije o putanji
   (path info) PHP-u (vidi ispod).
5. Otvorite Upravljanje > MCP i izložite mogućnosti koje želite da klijenti vide.

**Nadogradnja sa razvojne verzije.** Dodatak je u fazi predizdanja, a njegove tabele su se
mijenjale tokom razvoja bez migracija. Ako ste instalirali raniju verziju, deinstalirajte je
i instalirajte ponovo. Ponovna instalacija zadržava već postojeće tabele, pa prvo obrišite
stare tabele `plugin_mcp_token`, `plugin_mcp_audit` i `plugin_mcp_ability` (kao i
odgovarajuće tabele iz verzija nastalih prije preimenovanja). Napravite njihovu sigurnosnu
kopiju ako vam je potrebna historija; tokeni iz tih verzija se opozivaju prilikom
deinstalacije i ne prenose se dalje.

### Web server

Apache konfiguracije koje uklanjaju zaglavlje `Authorization` prije PHP-a zahtijevaju
sljedeću liniju u odgovarajućem virtualnom hostu ili direktoriju, nakon čega slijedi
ponovno učitavanje konfiguracije:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache sa `mod_php` poslužuje rute datoteke `api.php` bez dodatne konfiguracije putanje.

Rute datoteke `api.php` nalaze se u putanji nakon naziva skripte
(`/plugins/mcp/api.php/v1/abilities`), pa nginx mora podudarati URI-jeve kod kojih nakon
`.php` slijedi nastavak putanje, izdvojiti path info i proslijediti ga PHP-u. Blok
`location ~ \.php$` nikada ne podudara ovakve URL-ove; nginx tada vraća vlastitu HTML 404
stranicu. Obrazac lokacije i dvije path-info linije ispod provjereni su sa PHP-FPM-om, dok
su ostale linije standardna osnova:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Prilagodite linije `include` i `fastcgi_pass` tako da odgovaraju bloku koji već poslužuje
Cacti. Nemojte dodavati `try_files $fastcgi_script_name =404;` u ovaj blok: time se briše
`$fastcgi_path_info`, pa `api.php` zatim vraća 404 `UNKNOWN_PATH`. Ako vaša konfiguracija
zahtijeva `try_files`, prvo sačuvajte vrijednost pomoću
`set $path_info $fastcgi_path_info;` i proslijedite `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` nema rute u putanji i ne zahtijeva ovu postavku.

## Konzola

Upravljanje > MCP ima tri kartice. Potrebna vam je oblast **MCP administracija**. Snimci
ekrana ovdje i u nastavku potiču iz razvojne verzije Cacti sistema sa primjernim podacima.

- **Mogućnosti** prikazuje spisak svih registrovanih mogućnosti sa njihovim dodatkom,
  kategorijom, potrebnom oblašću i informacijom da li su izložene. Označite redove i
  izaberite Izloži ili Sakrij; izmjenu potvrđujete prije nego što se primijeni. Ugrađene
  `cacti-*` mogućnosti izložene su podrazumijevano. Mogućnosti drugih dodataka počinju kao
  sakrivene, tako da instalacija dodatka nikada ništa ne objavljuje dok administrator tako
  ne odluči. Izloženost samo sužava pristup: korisniku je i dalje potrebna oblast te
  mogućnosti.

  ![Kartica Mogućnosti sa spiskom ugrađenih mogućnosti, njihovih oblasti i statusa izloženosti](../../images/console-abilities.png)
- **Tokeni** prikazuje spisak tokena sa vlasnikom, kreatorom, vremenom kreiranja, rokom
  isteka, zadnjim korištenjem i stanjem (Aktivan, Istekao, Opozvan). Označite redove i
  izaberite Opozovi da biste ih opozvali. Opozvani tokeni se ne mogu ponovo koristiti.
  Opcija Kreiraj token pravi novi token.

  ![Kartica Tokeni sa spiskom tokena, vlasnikom, rokom isteka, zadnjim korištenjem i stanjem iznad obrasca Kreiraj token](../../images/console-tokens.png)
- **Revizija** prikazuje zapise revizije od najnovijeg ka najstarijem i omogućava
  filtriranje po korisniku, mogućnosti i ishodu.

  ![Kartica Revizija sa spiskom poziva, korisnikom, tokenom, mogućnošću, ishodom i filterima](../../images/console-audit.png)

## Tokeni

Lični token čita Cacti kao njegov vlasnik. Ima oblik `cmcp_pat_` nakon kojeg slijede 64
mala heksadecimalna znaka i nosi jedini opseg `abilities:read`. Šta token može vidjeti
određuju Cacti oblasti i dozvole za uređaje njegovog vlasnika, a ne sam token. Vlasnik mora
biti omogućen korisnik koji ima oblast **MCP i Abilities API**.

Tokeni se uvijek kreiraju za određenog korisnika, imaju rok isteka i mogu se opozvati:

- **Konzola.** Upravljanje > MCP > Tokeni > Kreiraj token. Trajanje je od 1 do 365 dana,
  a podrazumijevano je 90. Server generiše token i prikazuje ga samo jednom na stranici
  odgovora, pa ga odmah kopirajte u svoj upravitelj tajni. Možete kreirati token za sebe.
  Za kreiranje tokena za drugog korisnika potrebna je i oblast Korisnici/Grupe, jer token
  čita Cacti u ime tog korisnika.
- **Moji MCP tokeni.** Svaki korisnik sa oblašću MCP i Abilities API može upravljati
  vlastitim tokenima; vidi ispod.
- **Komandna linija.** `tokens.php` pokreće se samo iz CLI-ja, pod OS nalogom koji može
  administrirati Cacti. Preuzima token iz varijable okruženja kako se vrijednost nikada ne bi
  pojavila u komandnoj liniji ili na spisku procesa. Trajanje je od 1 do 365 dana, a
  podrazumijevano je 30. Kreiranje i opoziv tokena preko CLI-ja bilježe se u reviziji isto
  kao i putem konzole, sa vlasnikom tokena kao akterom jer CLI nema Cacti korisnika, pa
  zapis revizije ne označava da akcija potiče iz CLI-ja. `--list` ispisuje sve tokene kao
  JSON (ID, vlasnik, opsezi, vremenske oznake, oznaka opoziva), ali nikada vrijednost
  tokena; `--help` prikazuje uputstvo za upotrebu.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Tokeni se ne mogu kreirati za gostujući nalog, za onemogućene korisnike niti za korisnike
bez oblasti **MCP i Abilities API**, ni preko konzole, ni preko komandne linije, ni na
stranici Moji MCP tokeni. Cacti čuva postavku gosta kao korisničko ime ili ID korisnika, a
dodatak razrješava oba oblika. Token čiji vlasnik postane gostujući nalog prestaje raditi pri
sljedećem zahtjevu.

### Moji MCP tokeni

Upravljanje > Moji MCP tokeni (`plugins/mcp/mcp_tokens.php`) ne zahtijeva administratorsku
oblast: pokriveno je oblašću **MCP i Abilities API**, a stavka menija se prikazuje samo
korisnicima koji je imaju. Stranica uvijek djeluje na trenutno prijavljenog korisnika. Cacti
meni je dio konzole, pa korisnik bez pristupa konzoli otvara stranicu putem njene adrese.

![Kartica Moji tokeni sa spiskom tokena prijavljenog korisnika i obrascem za kreiranje](../../images/my-tokens.png)

- **Tokeni** prikazuje vaše tokene, kreira novi (od 1 do 365 dana, podrazumijevano 90,
  prikazan jednom u odgovoru) i opoziva vaše vlastite tokene. Ne možete vidjeti ni opozvati
  tuđe tokene.
- **Aktivnost** prikazuje radnje koje ste izvršili, od najnovije ka najstarijoj: pozive
  izvršene vašim tokenima i promjene tokena koje ste napravili.
- **Dostupni alati** prikazuje mogućnosti koje vaš token trenutno može koristiti, sa ID-om,
  nazivom i opisom svake mogućnosti. Spisak prati vaše Cacti dozvole i postavke izloženosti
  koje je administrator izabrao.

  ![Spisak dostupnih alata sa ID-om, nazivom i opisom svake mogućnosti](../../images/my-tools.png)

Instalacija napravljena prije postojanja ove stranice ima spisak datoteka oblasti bez
`mcp_tokens.php`. Instalacija registruje taj spisak; on se ne ažurira omogućavanjem ili
onemogućavanjem dodatka. Deinstalirajte i ponovo instalirajte dodatak, a zatim ponovo
dodijelite oblasti, jer Cacti uklanja dodijeljene oblasti prilikom deinstalacije dodatka.

Baza podataka čuva samo SHA-256 sažetak tokena, pa se izgubljeni token ne može povratiti;
opozovite ga i kreirajte drugi. Rotacija se radi na isti način: kreirajte novi token,
prebacite klijent na njega, a zatim opozovite stari. Istekao token, opozvan token,
onemogućen vlasnik ili izgubljena oblast dovode do neuspjeha pri sljedećem zahtjevu. Tokeni
se prihvataju isključivo u zaglavlju `Authorization: Bearer`; token u upitnom nizu ili
tijelu zahtjeva se ne prihvata.

## Povezivanje klijenta

Koristite MCP krajnju tačku `https://cacti.example.com/cacti/plugins/mcp/mcp.php` sa tokenom
u zaglavlju `Authorization: Bearer`. Čuvajte token u varijabli okruženja ili upravitelju
tajni i pozovite ga iz konfiguracije klijenta umjesto da njegovu vrijednost upisujete u
datoteku.

### Claude Code

Stavite krajnju tačku u projektnu datoteku `.mcp.json` koja navodi token po imenu varijable.
Claude Code proširuje `${VAR}` u poljima `url` i `headers`, pa datoteka ne sadrži tajnu i
sigurna je za dodavanje u verzionisanje. Izvezite `CACTI_MCP_TOKEN` u okruženju iz kojeg
pokrećete Claude Code.

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

Možete ga dodati i iz komandne linije:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Uz dvostruke navodnike, vaš shell prvo proširuje `$CACTI_MCP_TOKEN`, pa se vrijednost tokena
upisuje u konfiguracijsku datoteku za izabrani `--scope` (`local`, `user` ili `project`;
podrazumijevano `local`). Ne koristite taj oblik sa `--scope project` i držite tu datoteku
izvan kontrole verzija. Radije koristite referencu u `.mcp.json` iznad. Claude Code čita neke
varijable akreditiva (kao što je `ANTHROPIC_AUTH_TOKEN`) kao prazne u udaljenim `url` i
`headers` poljima; `CACTI_MCP_TOKEN` nije jedna od njih. Izvor:
[Claude Code MCP dokumentacija](https://code.claude.com/docs/en/mcp).

### GitHub Copilot u VS Codeu

Koristite `.mcp.json` u korijenu radnog prostora (ili korisničku datoteku
`~/.copilot/mcp-config.json`). Ove izvorne Copilot datoteke koriste objekt najvišeg nivoa
`mcpServers` i reference varijabli okruženja `${NAME}` u vrijednostima zaglavlja:

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

Izvezite `CACTI_MCP_TOKEN` u okruženju koje pokreće VS Code. Izvorne Copilot datoteke ne
podržavaju upite `inputs`. Vođeno postavljanje u VS Codeu odbija vrijednosti `${...}`, pa
dodajte zaglavlje `Authorization` uređivanjem datoteke, a ne kroz vođeni postupak. Vođeno
postavljanje nudi datoteku u korijenu radnog prostora samo kada je uključena eksperimentalna
postavka `chat.mcp.workspaceRootConfig.enabled`. Pogledajte
[referencu za MCP konfiguraciju u VS Codeu](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Zastarjelo: `.vscode/mcp.json`.** VS Code navodi da nove Copilot konfiguracije ne trebaju
koristiti `.vscode/mcp.json` niti profilski `mcp.json`; oni pripadaju zastarjelom Local
harnessu koji će biti uklonjen u februaru 2027. Ako ga još koristite, format kojim upravlja
uređivač koristi ključ najvišeg nivoa `servers` i može zatražiti unos tokena:

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

### Klijenti koji govore samo stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) je opcionalni adapter koji se
pokreće kao lokalni stdio MCP server i poziva HTTP API ovog dodatka. Koristite ga za klijent
koji se ne može povezati na udaljeni HTTP server. Zahtijeva isti lični token i komunicira sa
`api.php`.

### Ponašanje MCP-a

Krajnja tačka poslužuje isključivo alate: svaka izložena i dozvoljena mogućnost predstavlja
alat nazvan po svom ID-u, sa svojim ulaznim i izlaznim šemama i napomenama samo za čitanje
(`openWorldHint` je `false`). Obrađuje `initialize`, `server/discover`, `ping`, `tools/list`
i `tools/call`. Ne čuva sesiju, ne šalje `Mcp-Session-Id` (i ignoriše ga ako ga primi) i ne
prihvata JSON-RPC pakete (batches). Poruka bez polja `id` je obavještenje i dobija HTTP 202
bez tijela. Dozvoljen je samo `POST`.

- **Revizije.** Zahtjev koji sadrži `io.modelcontextprotocol/protocolVersion` u
  `params._meta` mora navesti `2026-07-28`; sve ostalo dobija grešku `-32022`. Takvi
  zahtjevi moraju imati i odgovarajuća zaglavlja `Mcp-Protocol-Version`, `Mcp-Method` i (za
  `tools/call`) `Mcp-Name`, inače je odgovor greška `-32020`. Ostali zahtjevi se tretiraju
  kao `2025-11-25`: `initialize` odgovara tom revizijom, a kod svake druge metode zaglavlje
  `Mcp-Protocol-Version`, ako je poslano, mora biti `2025-11-25`, `2025-06-18` ili
  `2025-03-26`.
- **Greške alata.** Greška mogućnosti, uključujući argumente koji ne odgovaraju šemi ili
  vrijednost polja `arguments` koja nije JSON objekt, vraća se kao rezultat alata sa
  `isError: true` i AIP-193 greškom u `structuredContent`, a ne kao greška protokola.
- **Greške protokola.** Neuspjesi koji nisu greške alata vraćaju se kao JSON-RPC objekti
  greške (kod `-32000` sa statusom i razlogom u `data`, ili standardni kodovi): nedostajući
  Javni Cacti URL, odbijeno zaglavlje `Origin`, zahtjev kada je dodatak onemogućen ili na
  udaljenom polleru, te neočekivane serverske greške (`-32603`, pri čemu se detalj upisuje u
  Cacti zapisnik, a ne u odgovor). Provjere zahtjeva koje se izvršavaju prve (405, 413, 415)
  i greške autentifikacije (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) zadržavaju AIP-193
  tijelo opisano u odjeljku HTTP API.

## HTTP API

Osnovni URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Ugovor API-ja nalazi se
u datoteci [openapi.json](../../../openapi.json).

| Metoda i putanja | Svrha |
| --- | --- |
| `GET /v1/abilities` | Spisak dozvoljenih mogućnosti. Upitni parametri: `pageSize`, `pageToken` i `filter` oblika `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Čitanje jedne mogućnosti. |
| `POST /v1/abilities/{id}:execute` | Izvršavanje mogućnosti. Tijelo je tačno `{"arguments": {...}}`. Odgovor je `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Greške prate AIP-193: objekt `error` sa poljima `code`, `message`, `status` i `details` koji
nosi `ErrorInfo` sa domenom `cacti.net` i stabilnim poljem `reason`. Problemi sa argumentima
dodaju detalj `BadRequest` koji navodi naziv polja. Tijela zahtjeva ograničena su na 64 KB,
a rezultati na 1 MB. Obje krajnje tačke odgovaraju samo na glavnom polleru i vraćaju
`UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) kada je dodatak onemogućen ili kada server nije glavni
poller.

| HTTP | Vrijednosti polja `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (također šalje `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (šalje `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Pisanje mogućnosti (za autore dodataka)

Omogućen Cacti dodatak registruje mogućnosti iz funkcije koju povezuje na hook
`abilities_register`, obično unutar svoje funkcije `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Funkcija prima instancu `AbilitiesRegistrar` ograničenu na taj dodatak. Njena povratna
vrijednost se ignoriše.

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

Pravila koja se sva provjeravaju pri registraciji:

- **ID-ovi.** ID mora odgovarati izrazu `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, imati najviše
  64 znaka i počinjati kratkim nazivom dodatka i crticom: `acme-` u primjeru iznad. Kratki
  naziv je naziv direktorija dodatka, pa direktorij kao što je `my_plugin` ne može ništa
  registrovati. Direktorij dodatka nazvan `cacti` se odbija; taj imenski prostor pripada
  ugrađenim mogućnostima.
- **Definicija.** Tačno ovi ključevi: `label`, `description` (do 4096 bajtova), `category`,
  `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Kategorija već
  mora postojati: koristite ugrađenu (`inventory`, `system`) ili registrujte vlastitu pomoću
  `registerCategory()`, čiji ID mora biti jedinstven u svim dodacima i odgovarati izrazu
  `^[a-z][a-z0-9-]{0,31}$`.
- **Samo za čitanje.** Polje `annotations` mora biti tačno `readOnly: true`,
  `destructive: false`, `idempotent: true`. Sve ostalo baca izuzetak.
- **Šeme.** `input_schema` i `output_schema` moraju na najvišem nivou imati `type`
  postavljen na `object`. Dijalekt je mali i odbija nepoznate konstrukcije. Objekti moraju
  biti zatvoreni (`additionalProperties: false`, uz prisutno polje `properties`); ostali
  tipovi su `integer` i `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`,
  `enum`, `pattern`), `boolean` i `array` (koji zahtijeva `items` i `maxItems`). Tip može
  dopuštati `null` kao `['string', 'null']`. Nizovi znakova u argumentima podrazumijevano su
  ograničeni na najviše 4096 znakova; nizovi u rezultatu ograničeni su samo deklarisanim
  `maxLength` i ograničenjem veličine rezultata. Može se registrovati najviše 256
  mogućnosti.
- **`permission(int $userId): bool`.** Mora vratiti tačno `true` da bi dozvolila pristup.
  Korisnički ID pripada vlasniku tokena; nikada ne čitajte stanje sesije.
- **`execute(int $userId, stdClass $args): array`.** `$args` je već provjeren u odnosu na
  `input_schema`. Dozvole na nivou objekta provodite sami. Vratite asocijativni niz koji
  tačno odgovara `output_schema`; lista, dodatno polje ili više od 1 MB JSON-a postaje
  greška `INVALID_RESULT`. Bacite `AbilitiesError` za grešku vidljivu klijentu, kao što je
  `NOT_FOUND`.
- **Prazni objekti.** PHP kodira `[]` kao JSON niz. Gdje god izlazna šema deklariše `object`,
  na bilo kojoj dubini, registar tretira `[]` kao prazan objekt i šalje `{}`; `new stdClass()`
  također radi. Neprazna lista nikada se ne računa kao objekt i završava greškom
  `INVALID_RESULT`. Prazna mapa `properties` u šemi može biti `[]` ili `new stdClass()`; obje
  se objavljuju kao `{}`.
- **Izolacija grešaka.** Svaki dodatak vrši registraciju u privremenu kopiju koja se zadržava
  samo ako vaša funkcija završi normalno. Ako baci izuzetak, nijedna vaša mogućnost se ne
  registruje, a greška se bilježi u zapisnik.

Mogućnosti iz dodataka počinju kao sakrivene. Administrator ih izlaže na kartici Mogućnosti u
konzoli, a u koloni Potrebna oblast za njih stoji "Postavlja dodatak".

## Sigurnosni model

- **Samo Bearer.** `api.php` i `mcp.php` prihvataju lični token u zaglavlju `Authorization` i
  ništa drugo. Odbacuju kolačiće, `$_POST` i `$_REQUEST` prije nego što se Cacti učita i
  uništavaju sesiju koju Cacti pokrene, tako da prijava u pregledniku nikada ne daje pristup
  API-ju.
- **Zaobilazno rješenje za CSRF.** Cacti CSRF zaštita odbija JSON POST zahtjev bez Cacti CSRF
  tokena, koji nijedan MCP klijent ne može poslati. Samo za ove dvije krajnje tačke, dodatak
  preimenuje metodu zahtjeva prije učitavanja Cactija i vraća je nakon toga, pa zaštita
  preskače ove zahtjeve. Ovo je sigurno jer CSRF štiti zahtjeve koje preglednik autentifikuje
  kolačićima, a ove krajnje tačke ne prihvataju identitet iz kolačića: stranica sa drugog
  domena ne može priložiti Bearer token. Stranice konzole zadržavaju potpunu CSRF zaštitu.
  Ovo rješenje je privremeno, dok Cacti ne ponudi podržano izuzeće; vidi `lib/bootstrap.php`.
- **Provjera zaglavlja Origin.** Na `mcp.php`, ako zahtjev ima zaglavlje `Origin`, ono mora
  tačno odgovarati šemi, hostu i portu Javnog Cacti URL-a, inače se zahtjev odbija sa
  `ORIGIN_NOT_ALLOWED`. Zahtjev bez zaglavlja `Origin`, što je način na koji se povezuju
  klijenti izvan preglednika, dozvoljen je. Time se sprečava da web stranica upravlja krajnjom
  tačkom iz preglednika posjetioca. `api.php` ne primjenjuje ovu provjeru.
- **Samo za čitanje.** Registracija odbija svaku mogućnost koja nije samo za čitanje,
  nedestruktivna i idempotentna.
- **Primjenjuju se i izloženost i oblasti.** Mogućnost mora biti izložena, a vlasnik tokena
  mora imati njenu oblast. Ako se tabela izloženosti ne može pročitati, svaka mogućnost je
  sakrivena umjesto povratka na podrazumijevane postavke.
- **Sakriveno, nepoznato i nedozvoljeno izgledaju isto.** Klijent ne može razlikovati
  mogućnost koja ne postoji od one koja je sakrivena ili koju njegov korisnik ne smije
  koristiti: otkrivanje je izostavlja, a izvršavanje vraća `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Tokeni.** Čuvaju se kao SHA-256 sažeci, prikazuju se jednom, uvijek imaju rok isteka,
  mogu se opozvati i odbijaju se kada je vlasnik onemogućen ili izgubi oblast.
- **Revizija.** Tabela `plugin_mcp_audit` bilježi ID zahtjeva, ID tokena, ID korisnika,
  mogućnost, ishod (`started`, `succeeded`, `failed`, `denied`, `rejected`) i vremenske
  oznake. Nikada ne bilježi argumente, rezultate ni vrijednosti tokena. Mogućnost se izvršava
  tek nakon što se upiše njen red `started`; ako tabela revizije nije dostupna, poziv ne
  uspijeva sa `UNAVAILABLE` i ne izvršava se. Poziv odbijen prije izvršavanja predstavlja
  jedan red: `denied` za nepoznatu, sakrivenu ili nedozvoljenu mogućnost, `rejected` za
  argumente koji ne prolaze šemu. Kreiranje i opoziv tokena iz konzole, stranice Moji MCP
  tokeni i CLI-ja bilježe se kao `mcp-token-create` i `mcp-token-revoke` sa ishodom
  `succeeded`, a opoziv se bilježi samo za token koji je bio aktivan. Otkrivanje i poziv čije
  polje `arguments` nije JSON objekt ne bilježe se u reviziju.
- **Zapisnik grešaka.** Neočekivana greška, `INVALID_RESULT` ili nedostupna tabela revizije
  upisuje jednu liniju u Cacti zapisnik pod oznakom `MCP`: ID mogućnosti, fiksni razlog i
  klasu izuzetka. Poruke, argumenti i tokeni se nikada ne upisuju u zapisnik.
- **Samo glavni poller.** Obje krajnje tačke, obje stranice konzole i `tokens.php` odbijaju
  raditi na bilo kojem drugom serveru.

## Životni ciklus

Onemogućavanje dodatka blokira obje krajnje tačke. Deinstalacija opoziva sve tokene i
zadržava tri tabele (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) radi
čuvanja evidencije; ponovna instalacija ne aktivira ponovo opozvani token. Pravite sigurnosnu
kopiju tabela zajedno sa Cacti bazom podataka i primijenite politiku čuvanja revizijskih
zapisa izvan dodatka.

## Razvoj i testovi

Skup testova uključuje obične PHP skripte u `tests/` uz PHPUnit jedinične testove u
`tests/Unit/` i PHPStan statičku analizu (nivo 6), pri čemu se sve izvršava bez
Cacti instalacije:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI se izvršava na verzijama PHP 8.2 do 8.5: posao `test` provjerava PHP sintaksu (`php -l`)
i pokreće 13 običnih PHP testnih skripti navedenih u `.github/workflows/ci.yml`, posao
`quality` pokreće `composer phpstan` i `composer test`, a posao `package` pravi
instalabilnu arhivu `mcp/` (isključujući datoteke za razvoj i testiranje navedene u
`.gitattributes`) i njen `SHA256SUMS`. Testovi koji dodiruju Cacti koriste zamjenske
podatke na granici Cacti pomoćnih funkcija; oni ne testiraju potpunu Cacti instalaciju.

### Integracijski testovi

Komanda `tests/integration/run.sh 1.2.31` ili `tests/integration/run.sh develop` instalira
dodatak u pravi Cacti unutar kontejnera i pokreće žive provjere protiv njega. Zahtijeva
Docker sa Compose v2.23.1 ili novijim, git i openssl. `KEEP=1` ostavlja okruženje pokrenutim
radi otklanjanja grešaka. CI ga pokreće svake noći i na zahtjev, a ne na pull zahtjevima.

## Lokalizacija

Cacti MCP isporučuje kompajlirane GNU gettext kataloge u `locales/po/` i
`locales/LC_MESSAGES/` te lokalizovane README datoteke u `docs/i18n/` za engleski plus 47
lokaliteta (19 Broad Tier 1, 15 afričkih, 10 azijskih, plus bosanski, hrvatski i srpski),
koristeći tekstualnu domenu `mcp` (`locales/po/mcp.pot`). Cacti automatski učitava
odgovarajući katalog kada je podrška za jezike uključena.

## Doprinos

Pull zahtjevi idu na granu `develop`. Održavajte produkcijski kod kompatibilnim sa PHP 8.2 i
koristite Cacti stil: tabulatore, jednostruke navodnike za nizove te Cacti pomoćnike za bazu
podataka i dozvole. Dodajte testove za izmijenjenu validaciju, autorizaciju ili ponašanje
protokola i potpišite commite pomoću `git commit -s`. Promjene HTTP API-ja uskladite sa
projektom [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licenca

Autorska prava (C) 2026 Thomas Vincent. Objavljeno pod licencom GNU General Public License,
verzija 2 ili novija. Pogledajte [LICENSE](../../../LICENSE).
