<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: un cactus con un escudo. Descubre. Autoriza. Ejecuta.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Licencia: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP es un plugin de Cacti que permite a los clientes de IA leer tus datos de
Cacti mediante operaciones con nombre y filtradas por permisos denominadas
capacidades (*abilities*). Las sirve de dos formas desde el propio plugin: un
punto de conexión MCP (`mcp.php`, Streamable HTTP) y una API HTTP de estilo AIP
(`api.php`). Cacti mantiene el control de la autorización y la ejecución. Un
cliente nunca consulta la base de datos directamente; solo puede invocar una
capacidad que un administrador haya expuesto y que los ámbitos de Cacti del
propietario del token permitan.

Los autores de plugins pueden registrar sus propias capacidades de solo lectura
a través del hook `abilities_register`, y aparecen ante los clientes MCP como
herramientas sin necesidad de escribir código de protocolo.

**Estado: prelanzamiento, versión 0.1.0.** No existe ninguna versión etiquetada.

Disponible actualmente:

- Capacidades integradas de solo lectura para las versiones del sistema y el
  inventario de dispositivos.
- Tokens de acceso personal (`cmcp_pat_...`) como única credencial.
- La consola Gestión > MCP: exponer u ocultar capacidades, crear y revocar
  tokens, y consultar el registro de auditoría.
- Gestión > Mis tokens MCP: los usuarios gestionan sus propios tokens, consultan
  su actividad y ven qué herramientas pueden utilizar sus tokens.
- MCP sobre Streamable HTTP, revisiones de protocolo `2026-07-28` y
  `2025-11-25`, únicamente herramientas.

Aún no disponible:

- Inicio de sesión con OAuth 2.1. Los conectores alojados que no pueden enviar un
  token personal, como los conectores personalizados de ChatGPT y claude.ai, no
  pueden conectarse hasta que exista. Está previsto como Plan 2; ese plan aún no
  está redactado.
- Capacidades de escritura. Solo pueden registrarse capacidades de solo lectura.

El diseño se encuentra en la
[especificación de diseño del punto de conexión](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
y la secuencia de compilación está en [docs/plan.md](../../plan.md).

## Capacidades integradas

| ID | Argumentos | Ámbito de Cacti necesario |
| --- | --- | --- |
| `cacti-get-system-info` | ninguno | 15 |
| `cacti-list-devices` | opcionales `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | obligatorio `name`, como `devices/12` | 3 |

Cada llamada también necesita el ámbito **API de MCP y Capacidades** para el
propietario del token, el alcance (`scope`) `abilities:read` (todos los tokens
personales lo tienen) y una capacidad expuesta. La pestaña Capacidades de la
consola muestra el ámbito que necesita cada capacidad integrada.

- `cacti-list-devices` devuelve páginas de hasta 100 dispositivos (50 por
  defecto) y un `nextPageToken`. Un token de página solo es válido para los
  mismos `filter` y `orderBy`. `filter` es una expresión AIP-160 de
  comparaciones unidas por `AND`, por ejemplo `state = "DOWN" AND disabled = false`.
  Los campos de filtro son `displayName`, `hostname`, `disabled`, `site`,
  `poller`, `deviceTemplate`, `externalId` y `state`. `orderBy` admite
  `displayName`, `hostname` o `name`, cada uno opcionalmente seguido de `desc`.
- Las consultas de dispositivos pasan por `get_allowed_devices()` de Cacti, por
  lo que un usuario solo ve los dispositivos que Cacti le mostraría.
- Los campos de los dispositivos excluyen las cadenas de comunidad SNMP, frases
  de paso y otras credenciales.

## Instalación

Requiere Cacti 1.2.31 o posterior, PHP 8.2 o posterior y el poller principal.
La autenticación de Cacti debe estar habilitada; el plugin rechaza autenticar
cuando está desactivada.

El directorio del plugin debe llamarse `mcp`, no `plugin_mcp`. El identificador
del plugin (*slug*), los nombres de los ámbitos, el dominio de traducción y las
URL utilizan todos `mcp`.

Desde una copia del código fuente:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Hasta que existan versiones etiquetadas, puedes descargar en su lugar el
artefacto `mcp-plugin` de una
[ejecución de CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
correcta. Contiene `mcp.tar.gz` y `SHA256SUMS`. Verifica la suma de
comprobación y, a continuación, extrae `mcp.tar.gz` dentro del directorio
`plugins/` de Cacti para que el resultado sea `plugins/mcp/`. Los archivos de
código fuente automáticos de GitHub utilizan un nombre distinto para el
directorio de nivel superior. El archivo omite `docs/` (incluidas las capturas
de pantalla siguientes), `tests/` y `.github/`, por lo que los enlaces del
README hacia `docs/` funcionan en GitHub, pero no en una copia instalada.

A continuación:

1. En Gestión de plugins, instala y habilita **Cacti MCP**. El administrador que
   realiza la instalación recibe automáticamente el ámbito **Administración de MCP**.
2. En Configuración > MCP, establece **URL pública de Cacti** en la dirección
   que utilizan los clientes, por ejemplo `https://cacti.example.com/cacti`. Se
   requiere HTTPS excepto para `localhost`, `127.0.0.1` y `[::1]`. Hasta que no
   se configure, `mcp.php` responde con HTTP 400 y un error JSON-RPC cuyo campo
   `data` es `FAILED_PRECONDITION` y `PUBLIC_URL_REQUIRED`. `api.php` no lo lee.

   ![Configuración > MCP mostrando el campo URL pública de Cacti](../../images/settings-public-url.png)

3. Concede el ámbito **API de MCP y Capacidades** a cada usuario que vaya a ser
   propietario de un token. Ningún usuario lo recibe automáticamente.
4. Asegúrate de que el servidor web pasa la cabecera `Authorization` y la
   información de ruta (*path info*) a PHP (consulta más abajo).
5. Abre Gestión > MCP y expone las capacidades que quieras que vean los clientes.

**Actualización desde una compilación de desarrollo.** El plugin está en fase de
prelanzamiento y sus tablas cambiaron durante el desarrollo sin migraciones. Si
instalaste una compilación anterior, desinstálala e instálala de nuevo. La
reinstalación conserva las tablas que ya existen, así que elimina primero las
tablas antiguas `plugin_mcp_token`, `plugin_mcp_audit` y `plugin_mcp_ability`
(y las tablas equivalentes de compilaciones anteriores al cambio de nombre). Haz
una copia de seguridad si necesitas su historial; los tokens de esas
compilaciones se revocan al desinstalar y no se transfieren.

### Servidor web

Las configuraciones de Apache que eliminan `Authorization` antes de llegar a PHP
necesitan esto en el host virtual o directorio correspondiente, seguido de una
recarga:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache con `mod_php` sirvió las rutas de `api.php` sin ninguna configuración
adicional de rutas.

Las rutas de `api.php` residen en la ruta posterior al nombre del script
(`/plugins/mcp/api.php/v1/abilities`), por lo que nginx debe coincidir con los
URI en los que `.php` va seguido de más ruta, separar la información de ruta y
pasarla a PHP. Un bloque `location ~ \.php$` nunca coincide con estas URL; nginx
responde con su propio 404 en HTML. El patrón de ubicación y las dos líneas de
información de ruta siguientes se verificaron con PHP-FPM; el resto de las
líneas son configuración estándar:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Ajusta las líneas `include` y `fastcgi_pass` para que coincidan con el bloque que
ya sirve Cacti. No añadas `try_files $fastcgi_script_name =404;` a este bloque:
borra `$fastcgi_path_info` y `api.php` responde entonces con 404 `UNKNOWN_PATH`.
Si tu configuración necesita `try_files`, guarda antes el valor con
`set $path_info $fastcgi_path_info;` y pasa `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` no tiene rutas de acceso (*path routes*) y no las necesita.

## Consola

Gestión > MCP tiene tres pestañas. Necesitas el ámbito **Administración de MCP**.
Las capturas de pantalla de aquí y de más abajo corresponden a una compilación
de desarrollo de Cacti con datos de ejemplo.

- **Capacidades** enumera cada capacidad registrada con su plugin, categoría, el
  ámbito que necesita y si está expuesta. Selecciona filas y elige Exponer u
  Ocultar; confirmarás antes de que se aplique el cambio. Las capacidades
  integradas `cacti-*` están expuestas por defecto. Las capacidades de otros
  plugins empiezan ocultas, de modo que instalar un plugin nunca publica nada
  hasta que un administrador lo decida. La exposición solo restringe el acceso:
  un usuario sigue necesitando el ámbito de la capacidad.

  ![Pestaña Capacidades listando las capacidades integradas con sus ámbitos y estado de exposición](../../images/console-abilities.png)
- **Tokens** enumera los tokens con propietario, creador, creación, caducidad,
  último uso y estado (Activo, Caducado, Revocado). Selecciona filas y elige
  Revocar para revocarlas. Los tokens revocados no pueden volver a usarse. Crear
  token genera uno nuevo.

  ![Pestaña Tokens listando los tokens con propietario, caducidad, último uso y estado, encima del formulario Crear token](../../images/console-tokens.png)
- **Auditoría** enumera las filas de auditoría, de la más reciente a la más
  antigua, y filtra por usuario, capacidad y resultado.

  ![Pestaña Auditoría listando llamadas con usuario, token, capacidad y resultado, con filtros](../../images/console-audit.png)

## Tokens

Un token personal lee Cacti como su propietario. Tiene la forma `cmcp_pat_`
seguida de 64 caracteres hexadecimales en minúsculas y lleva el único alcance
`abilities:read`. Lo que puede ver lo deciden los ámbitos de Cacti y los permisos
de dispositivos de su propietario, no el token. El propietario debe ser un
usuario habilitado que posea el ámbito **API de MCP y Capacidades**.

Los tokens siempre se crean para un usuario, caducan y pueden revocarse:

- **Consola.** Gestión > MCP > Tokens > Crear token. La duración es de 1 a 365
  días y el valor por defecto es 90. El servidor genera el token y lo muestra una
  sola vez en la página de respuesta, así que cópialo en tu gestor de secretos
  de inmediato. Puedes crear un token para ti mismo. Crear uno para otro usuario
  también requiere el ámbito Usuarios/Grupos, porque el token lee Cacti como ese
  usuario.
- **Mis tokens MCP.** Cualquier usuario con el ámbito API de MCP y Capacidades
  puede gestionar sus propios tokens; consulta más abajo.
- **Línea de comandos.** `tokens.php` solo se ejecuta desde la CLI, como una
  cuenta del sistema operativo que pueda administrar Cacti. Toma el token del
  entorno para que el valor nunca aparezca en una línea de comandos ni en la
  lista de procesos. La duración es de 1 a 365 días y el valor por defecto es
  30. Crear y revocar un token a través de la CLI se audita igual que en la
  consola, con el propietario del token como actor porque la CLI no tiene
  usuario de Cacti, por lo que la fila de auditoría no marca la acción como
  procedente de la CLI. `--list` imprime cada token en formato JSON (ID,
  propietario, alcances, marcas de tiempo, indicador de revocado) y nunca el
  valor del token; `--help` muestra el uso.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

No se pueden crear tokens para la cuenta de invitado (*guest*), para usuarios
deshabilitados ni para usuarios sin el ámbito **API de MCP y Capacidades**, ni
desde la consola, ni desde la línea de comandos ni desde Mis tokens MCP. Cacti
almacena el ajuste de invitado como un nombre de usuario o un ID de usuario, y
el plugin resuelve ambos. Un token cuyo propietario pasa a ser la cuenta de
invitado deja de funcionar en su siguiente petición.

### Mis tokens MCP

Gestión > Mis tokens MCP (`plugins/mcp/mcp_tokens.php`) no necesita ningún ámbito
de administración: está cubierto por el ámbito **API de MCP y Capacidades**, y la
entrada del menú solo aparece para los usuarios que lo poseen. La página siempre
actúa sobre el usuario con sesión iniciada. El menú de Cacti forma parte de la
consola, por lo que un usuario sin acceso a la consola accede a la página
mediante su dirección.

![Pestaña Mis tokens listando los tokens del usuario con sesión iniciada y el formulario de creación](../../images/my-tokens.png)

- **Tokens** enumera tus tokens, crea uno (de 1 a 365 días, 90 por defecto,
  mostrado una sola vez en la respuesta) y revoca los tuyos. No puedes ver ni
  revocar los de ninguna otra persona.
- **Actividad** enumera las acciones que realizaste, de la más reciente a la más
  antigua: llamadas efectuadas con tus tokens y cambios de tokens que hiciste.
- **Herramientas disponibles** enumera las capacidades que un token tuyo puede
  usar en este momento, con el ID, nombre y descripción de cada capacidad. Sigue
  tus permisos de Cacti y la configuración de exposición elegida por un
  administrador.

  ![Lista Herramientas disponibles mostrando el ID, nombre y descripción de cada capacidad](../../images/my-tools.png)

Una instalación realizada antes de que existiera esta página tiene una lista de
archivos de ámbito sin `mcp_tokens.php`. La instalación registra la lista; no se
actualiza al habilitar o deshabilitar el plugin. Desinstala y vuelve a instalar
el plugin y, a continuación, vuelve a conceder los ámbitos, ya que Cacti elimina
las concesiones de ámbitos cuando se desinstala un plugin.

La base de datos almacena únicamente el hash SHA-256 del token, por lo que un
token perdido no se puede recuperar; revócalo y crea otro. La rotación es igual:
crea un token nuevo, cambia el cliente y luego revoca el antiguo. Un token
caducado, un token revocado, un propietario deshabilitado o un ámbito perdido
fallan en la siguiente petición. Los tokens solo se aceptan en la cabecera
`Authorization: Bearer`; no se acepta un token en la cadena de consulta ni en el
cuerpo.

## Conectar un cliente

Utiliza el punto de conexión MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, con el
token en una cabecera `Authorization: Bearer`. Guarda el token en una variable de
entorno o en un gestor de secretos y haz referencia a él desde la configuración del cliente en lugar de
escribir su valor directamente en un archivo.

### Claude Code

Coloca el punto de conexión en un archivo `.mcp.json` del proyecto que haga referencia al token por su nombre.
Claude Code expande `${VAR}` en `url` y `headers`, por lo que el archivo no contiene ningún secreto y
es seguro confirmarlo en el repositorio. Exporta `CACTI_MCP_TOKEN` en el entorno desde el que inicies Claude Code.

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

También puedes añadirlo desde la línea de comandos:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Con comillas dobles, tu shell expande primero `$CACTI_MCP_TOKEN`, por lo que el valor del token
se escribe en el archivo de configuración para el `--scope` elegido (`local`, `user` o
`project`; por defecto `local`). No uses esa forma con `--scope project` y mantén
el archivo fuera del control de versiones. Es preferible usar la referencia en `.mcp.json` indicada arriba. Claude Code
lee algunas variables de credenciales (como `ANTHROPIC_AUTH_TOKEN`) como vacías en `url` y
`headers` remotos; `CACTI_MCP_TOKEN` no es una de ellas. Fuente:
[documentación de MCP de Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot en VS Code

Usa un archivo `.mcp.json` en la raíz del espacio de trabajo (o el archivo de usuario `~/.copilot/mcp-config.json`).
Estos archivos nativos de Copilot utilizan un objeto `mcpServers` de nivel superior y referencias a variables
de entorno `${NAME}` en los valores de las cabeceras:

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

Exporta `CACTI_MCP_TOKEN` en el entorno desde el que inicies VS Code. Los archivos nativos de Copilot
no admiten solicitudes `inputs`. La configuración guiada de VS Code rechaza los valores `${...}`,
así que añade la cabecera `Authorization` editando el archivo directamente, no mediante el
flujo guiado. La configuración guiada ofrece el archivo en la raíz del espacio de trabajo
únicamente cuando el ajuste experimental `chat.mcp.workspaceRootConfig.enabled` está activado. Consulta la
[referencia de configuración de MCP en VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Heredado: `.vscode/mcp.json`.** VS Code indica que las nuevas configuraciones de Copilot no deben
usar `.vscode/mcp.json` ni el archivo `mcp.json` del perfil; pertenecen al entorno local obsoleto
(Local harness), que se eliminará en febrero de 2027. Si todavía lo usas, el
formato gestionado por el editor emplea una clave `servers` de nivel superior y puede solicitar el token:

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

### Clientes que solo usan stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) es un adaptador opcional
que se ejecuta como un servidor MCP local por stdio y llama a la API HTTP del plugin. Úsalo para un
cliente que no pueda conectarse a un servidor HTTP remoto. Necesita el mismo token
personal y se comunica con `api.php`.

### Comportamiento de MCP

El punto de conexión sirve únicamente herramientas: cada capacidad expuesta y permitida es una herramienta identificada por
su ID, con sus esquemas de entrada y salida y anotaciones de solo lectura
(`openWorldHint` es `false`). Gestiona `initialize`, `server/discover`, `ping`,
`tools/list` y `tools/call`. No mantiene sesión, no envía `Mcp-Session-Id`
(e ignora el que reciba) y no acepta lotes JSON-RPC. Un mensaje
sin `id` es una notificación y recibe un código HTTP 202 sin cuerpo. Solo se permite `POST`.

- **Revisiones.** Una petición que incluya `io.modelcontextprotocol/protocolVersion` en
  `params._meta` debe indicar `2026-07-28`; cualquier otro valor devuelve el error `-32022`. Dichas
  peticiones también deben incluir las cabeceras coincidentes `Mcp-Protocol-Version`, `Mcp-Method` y (para
  `tools/call`) `Mcp-Name`, o la respuesta será el error `-32020`. El resto de las peticiones
  se tratan como `2025-11-25`: `initialize` responde con esa revisión y, en cualquier
  otro método, una cabecera `Mcp-Protocol-Version`, si se envía, debe ser `2025-11-25`,
  `2025-06-18` o `2025-03-26`.
- **Errores de herramienta.** Un error de capacidad, incluidos los argumentos que no coinciden con el
  esquema o un valor de `arguments` que no sea un objeto JSON, se devuelve como un resultado de
  herramienta con `isError: true` y el error AIP-193 en `structuredContent`, no como un
  error de protocolo.
- **Errores de protocolo.** Los fallos que no son errores de herramienta son objetos de error JSON-RPC
  (código `-32000` con el estado y el motivo en `data`, o los códigos estándar): la falta
  de la URL pública de Cacti (Public Cacti URL), un `Origin` rechazado, una petición con el plugin deshabilitado
  o en un poller remoto, y errores inesperados del servidor (`-32603`, con el detalle
  escrito en el registro de Cacti y no en la respuesta). Las comprobaciones de petición que se ejecutan primero (405,
  413, 415) y los fallos de autenticación (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  mantienen el cuerpo AIP-193 descrito en la sección API HTTP.

## API HTTP

URL base: `https://cacti.example.com/cacti/plugins/mcp/api.php`. El contrato se encuentra
en [openapi.json](../../../openapi.json).

| Método y ruta | Propósito |
| --- | --- |
| `GET /v1/abilities` | Lista las capacidades permitidas. Parámetros de consulta: `pageSize`, `pageToken` y `filter` de la forma `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Lee una capacidad. |
| `POST /v1/abilities/{id}:execute` | La ejecuta. El cuerpo es exactamente `{"arguments": {...}}`. La respuesta es `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Los errores siguen AIP-193: un objeto `error` con `code`, `message`, `status` y
`details` que contiene un `ErrorInfo` con el dominio `cacti.net` y un `reason` estable.
Los problemas con los argumentos añaden un detalle `BadRequest` que indica el nombre del campo. Los cuerpos de las peticiones están
limitados a 64 KB y los resultados a 1 MB. Ambos puntos de conexión responden únicamente en el poller
principal y devuelven `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) cuando el plugin está deshabilitado
o el servidor no es el poller principal.

| HTTP | Valores de `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (también envía `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (envía `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Escribir una capacidad (autores de plugins)

Un plugin de Cacti habilitado registra capacidades desde una función que adjunta al
gancho `abilities_register`, normalmente en su función `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

La función recibe un `AbilitiesRegistrar` con ámbito limitado al plugin. Su valor de
retorno se ignora.

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

Las reglas, todas ellas aplicadas en el momento del registro:

- **IDs.** Un ID coincide con `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, tiene como máximo 64
  caracteres y debe comenzar con el slug del plugin y un guion: `acme-` en el ejemplo anterior.
  El slug es el nombre del directorio del plugin, por lo que un directorio como `my_plugin` no puede
  registrar nada. Un directorio de plugin llamado `cacti` es rechazado; ese
  espacio de nombres pertenece a las capacidades integradas.
- **Definición.** Exactamente estas claves: `label`, `description` (hasta 4096 bytes),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. La categoría debe existir previamente: usa una integrada (`inventory`,
  `system`) o registra la tuya propia con `registerCategory()`, cuyo ID es único entre
  todos los plugins y coincide con `^[a-z][a-z0-9-]{0,31}$`.
- **Solo de solo lectura.** `annotations` debe ser exactamente `readOnly: true`,
  `destructive: false`, `idempotent: true`. Cualquier otro valor lanza una excepción.
- **Esquemas.** `input_schema` y `output_schema` deben tener cada uno un `type` `object` en el nivel
  superior. El dialecto es reducido y falla de forma segura (fail-closed). Los objetos deben estar cerrados
  (`additionalProperties: false`, con `properties` presente); otros tipos son
  `integer` y `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean` y `array` (que necesita `items` y
  `maxItems`). Un tipo puede hacerse
  anulable como `['string', 'null']`. Las cadenas de argumentos tienen por defecto un máximo de
  4096 caracteres; las cadenas de resultado solo están limitadas por un `maxLength` declarado
  y el límite de tamaño del resultado. Se pueden registrar como máximo 256 capacidades.
- **`permission(int $userId): bool`.** Debe devolver exactamente `true` para permitir el acceso. El
  ID de usuario es el del propietario del token; nunca leas el estado de la sesión.
- **`execute(int $userId, stdClass $args): array`.** `$args` ya está validado
  contra `input_schema`. Aplica tú mismo los permisos a nivel de objeto. Devuelve un
  array asociativo que coincida exactamente con `output_schema`; una lista, un campo adicional
  o más de 1 MB de JSON se convierte en un error `INVALID_RESULT`. Lanza
  `AbilitiesError` para un fallo visible por el cliente, como `NOT_FOUND`.
- **Objetos vacíos.** PHP codifica `[]` como un array JSON. Dondequiera que el esquema de salida
  declare un `object`, a cualquier profundidad, el registro trata `[]` como el objeto vacío
  y envía `{}`; `new stdClass()` también funciona. Una lista no vacía nunca cuenta como un
  objeto y falla con `INVALID_RESULT`. Un mapa `properties` vacío en un esquema
  puede ser `[]` o `new stdClass()`; ambos se publican como `{}`.
- **Aislamiento de fallos.** Cada plugin se registra en una copia temporal que se conserva
  únicamente si tu función termina normalmente. Si lanza una excepción, ninguna de tus capacidades
  se registra y el fallo queda registrado en el log.

Las capacidades de los plugins comienzan ocultas. El administrador las expone en la
pestaña Abilities de la consola, y la columna Required Realm muestra «Set by the plugin»
para ellas.

## Modelo de seguridad

- **Solo Bearer.** `api.php` y `mcp.php` aceptan un token personal en la cabecera
  `Authorization` y nada más. Descartan las cookies, `$_POST` y
  `$_REQUEST` antes de que Cacti se cargue y destruyen la sesión que Cacti inicia, de modo que un inicio de sesión en el navegador
  nunca concede acceso a la API.
- **Solución temporal para CSRF.** La protección CSRF de Cacti rechaza un POST JSON que no incluya un token CSRF de Cacti,
  algo que ningún cliente MCP puede enviar. Solo para estos dos endpoints, el complemento
  renombra el método de la petición antes de que Cacti se cargue y lo restaura después, de modo que la
  protección los omite. Esto es seguro porque CSRF protege las peticiones que un navegador
  autentica con cookies, y estos endpoints no aceptan ninguna identidad mediante cookies: una
  página entre sitios (cross-site) no puede adjuntar el token Bearer. Las páginas de la consola mantienen la protección CSRF
  completa. Esta solución es temporal, hasta que Cacti ofrezca una exención
  soportada; véase `lib/bootstrap.php`.
- **Comprobación de origen.** En `mcp.php`, si la petición incluye una cabecera `Origin`, esta debe coincidir
  exactamente con el esquema, el host y el puerto de la URL pública de Cacti; de lo contrario, la petición se
  rechaza con `ORIGIN_NOT_ALLOWED`. Se permite una petición sin cabecera `Origin`, que es como
  se conectan los clientes que no son navegadores. Esto impide que una página web utilice el
  endpoint desde el navegador de un visitante. `api.php` no aplica esta comprobación.
- **Solo de lectura.** El registro rechaza cualquier capacidad que no sea de solo lectura,
  no destructiva e idempotente.
- **Se aplican tanto la exposición como los realms.** Una capacidad debe estar expuesta y el propietario
  del token debe poseer su realm. Si no se puede leer la tabla de exposición, todas las capacidades
  quedan ocultas en lugar de recurrir a valores predeterminados.
- **Ocultas, desconocidas y sin permisos tienen el mismo aspecto.** Un cliente no puede distinguir una
  capacidad que no existe de una que está oculta o que su usuario no puede
  usar: el descubrimiento la omite y la ejecución devuelve `NOT_FOUND`
  (`ABILITY_NOT_FOUND`).
- **Tokens.** Se almacenan como hashes SHA-256, se muestran una sola vez, siempre caducan, son revocables y se
  rechazan cuando el propietario está deshabilitado o pierde el realm.
- **Auditoría.** `plugin_mcp_audit` registra el ID de petición, el ID de token, el ID de usuario, la capacidad,
  el resultado (`started`, `succeeded`, `failed`, `denied`, `rejected`) y las marcas de tiempo.
  Nunca registra argumentos, resultados ni valores de tokens. Una capacidad se ejecuta solo después de
  escribir su fila `started`; si la tabla de auditoría no está disponible, la llamada falla
  con `UNAVAILABLE` y no se ejecuta. Una llamada rechazada antes de ejecutarse genera una sola fila: `denied`
  para una capacidad desconocida, oculta o sin permisos, y `rejected` para argumentos que no cumplen el
  esquema. La creación y revocación de tokens desde la consola, My MCP Tokens y la CLI se
  registran como `mcp-token-create` y `mcp-token-revoke` con resultado `succeeded`, y la
  revocación se registra únicamente para un token que estaba activo. El descubrimiento y las llamadas cuyo
  campo `arguments` no sea un objeto JSON no se registran.
- **Registro de fallos.** Un fallo inesperado, `INVALID_RESULT` o una tabla de auditoría no disponible
  escribe una línea en el registro de Cacti con la categoría `MCP`: el ID de la capacidad, un motivo
  fijo y la clase de la excepción. Los mensajes, los argumentos y los tokens nunca se registran.
- **Solo en el poller principal.** Ambos endpoints, ambas páginas de la consola y `tokens.php` rechazan
  actuar en cualquier otro lugar.

## Ciclo de vida

Deshabilitar el complemento bloquea ambos endpoints. Desinstalarlo revoca todos los tokens y
conserva las tres tablas (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) para su retención; volver a instalarlo no reactiva un token
revocado. Realice copias de seguridad de las tablas junto con la base de datos de Cacti y aplique una política de retención
de auditoría fuera del complemento.

## Desarrollo y pruebas

Las pruebas son scripts PHP simples que se ejecutan sin Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI ejecuta el linter de PHP y los scripts de `tests/` (cada uno figura en
`.github/workflows/ci.yml`) en PHP 8.2 a 8.5, y luego compila el archivo instalable `mcp/` y su suma de comprobación. Las pruebas que interactúan con Cacti utilizan
fixtures en la frontera de los helpers de Cacti; no ejecutan una instalación completa de Cacti.

### Pruebas de integración

`tests/integration/run.sh 1.2.31` o `tests/integration/run.sh develop` instala el
complemento en un Cacti real dentro de contenedores y ejecuta comprobaciones en vivo contra él. Requiere Docker
con Compose v2.23.1 o posterior, git y openssl. `KEEP=1` deja la pila en ejecución para depuración. CI las ejecuta
cada noche y bajo demanda, no en los pull requests.

## Localización

Cacti MCP incluye catálogos GNU gettext compilados en `locales/po/` y `locales/LC_MESSAGES/`
y archivos README traducidos en `docs/i18n/` para inglés más 47 idiomas (19 idiomas principales de nivel 1, 15 africanos, 10 asiáticos, además de bosnio, croata y serbio), utilizando el dominio de texto `mcp` (`locales/po/mcp.pot`).
Cacti carga automáticamente el catálogo correspondiente cuando el soporte de idiomas está habilitado.

## Contribución

Los pull requests van dirigidos a `develop`. Mantenga el código de producción compatible con PHP 8.2 y
utilice el estilo de Cacti: tabulaciones, cadenas entre comillas simples y los helpers de base de datos y
permisos de Cacti. Añada pruebas para cualquier cambio en la validación, la autorización o el comportamiento del protocolo,
y firme los commits con `git commit -s`. Coordine los cambios en la API HTTP
con [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licencia

Copyright (C) 2026 Thomas Vincent. Publicado bajo la Licencia Pública General de GNU (GNU General Public
License), versión 2 o posterior. Véase [LICENSE](../../../LICENSE).
