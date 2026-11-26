<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: um cacto com um escudo. Descobrir. Autorizar. Executar.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Licença: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

O Cacti MCP é um plugin do Cacti que permite a clientes de IA ler os dados do seu Cacti por meio de operações nomeadas e filtradas por permissão chamadas de habilidades (*abilities*). Ele as disponibiliza de duas formas a partir do próprio plugin: um endpoint MCP (`mcp.php`, Streamable HTTP) e uma API HTTP no estilo AIP (`api.php`). O Cacti permanece responsável pela autorização e execução. Um cliente nunca consulta o banco de dados; ele só pode chamar uma habilidade que um administrador tenha exposto e que os *realms* do Cacti do proprietário do token permitam.

Autores de plugins podem registrar suas próprias habilidades somente leitura por meio do hook `abilities_register`, e elas aparecem para os clientes MCP como ferramentas (*tools*) sem necessidade de código de protocolo.

**Status: pré-lançamento, versão 0.1.0.** Não há nenhuma versão com tag lançada.

Disponível hoje:

- Habilidades integradas somente leitura para versões do sistema e inventário de dispositivos.
- Tokens de acesso pessoal (`cmcp_pat_...`) como única credencial.
- Console em Management > MCP: expor ou ocultar habilidades, criar e revogar tokens, ler o log de auditoria.
- Management > My MCP Tokens: usuários gerenciam os próprios tokens, visualizam suas atividades e veem quais ferramentas seus tokens podem usar.
- MCP sobre Streamable HTTP, revisões de protocolo `2026-07-28` e `2025-11-25`, apenas ferramentas (*tools*).

Ainda não disponível:

- Login com OAuth 2.1. Conectores hospedados que não conseguem enviar um token pessoal, como conectores personalizados do ChatGPT e do claude.ai, não podem se conectar até que isso exista. Está planejado como Plano 2; esse plano ainda não foi escrito.
- Habilidades de escrita. Apenas habilidades somente leitura podem ser registradas.

O design está na [especificação de design do endpoint](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md), e a sequência de construção está em [docs/plan.md](../../plan.md).

## Habilidades integradas

| ID | Argumentos | Realm do Cacti necessário |
| --- | --- | --- |
| `cacti-get-system-info` | nenhum | 15 |
| `cacti-list-devices` | opcionais `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | obrigatório `name`, como `devices/12` | 3 |

Toda chamada também exige o realm **MCP and Abilities API** para o proprietário do token, o escopo `abilities:read` (todo token pessoal possui esse escopo) e uma habilidade exposta. A aba Abilities do console mostra o realm necessário para cada habilidade integrada.

- `cacti-list-devices` retorna páginas de até 100 dispositivos (padrão 50) e um `nextPageToken`. Um token de página é válido apenas para os mesmos `filter` e `orderBy`. `filter` é uma expressão AIP-160 de comparações unidas por `AND`, por exemplo `state = "DOWN" AND disabled = false`. Os campos de filtro são `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId` e `state`. `orderBy` aceita `displayName`, `hostname` ou `name`, cada um opcionalmente seguido por `desc`.
- As consultas de dispositivos passam pela função `get_allowed_devices()` do Cacti, de modo que o usuário vê apenas os dispositivos que o Cacti lhe mostraria.
- Os campos dos dispositivos excluem strings de comunidade SNMP, frases secretas e outras credenciais.

## Instalação

Requer Cacti 1.2.31 ou posterior, PHP 8.2 ou posterior e o poller principal. A autenticação do Cacti deve estar habilitada; o plugin se recusa a autenticar quando ela está desativada.

O diretório do plugin deve se chamar `mcp`, e não `plugin_mcp`. O slug do plugin, os nomes de realms, o domínio de tradução e as URLs usam todos `mcp`.

A partir de um checkout do código-fonte:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Enquanto não existirem versões com tag, você pode baixar o artefato `mcp-plugin` de uma [execução de CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) bem-sucedida. Ele contém `mcp.tar.gz` e `SHA256SUMS`. Verifique o checksum e, em seguida, extraia `mcp.tar.gz` dentro do diretório `plugins/` do Cacti para que o resultado seja `plugins/mcp/`. Os arquivos de código-fonte automáticos do GitHub usam um nome de diretório de nível superior diferente. O pacote omite `docs/` (incluindo as capturas de tela abaixo), `tests/` e `.github/`, portanto os links do README para `docs/` funcionam no GitHub, mas não em uma cópia instalada.

Em seguida:

1. Em Plugin Management, instale e habilite o **Cacti MCP**. O administrador que realizar a instalação recebe o realm **MCP Administration** automaticamente.
2. Em Settings > MCP, defina **Public Cacti URL** com o endereço usado pelos clientes, por exemplo `https://cacti.example.com/cacti`. HTTPS é obrigatório, exceto para `localhost`, `127.0.0.1` e `[::1]`. Enquanto isso não for configurado, `mcp.php` responde com HTTP 400 e um erro JSON-RPC cujo `data` é `FAILED_PRECONDITION` e `PUBLIC_URL_REQUIRED`. `api.php` não lê essa configuração.

   ![Settings > MCP mostrando o campo Public Cacti URL](../../images/settings-public-url.png)

3. Conceda o realm **MCP and Abilities API** a cada usuário que será proprietário de um token. Nenhum usuário o recebe automaticamente.
4. Certifique-se de que o servidor web repasse o cabeçalho `Authorization` e as informações de caminho (*path info*) para o PHP (veja abaixo).
5. Abra Management > MCP e exponha as habilidades que deseja que os clientes vejam.

**Atualizando a partir de um build de desenvolvimento.** O plugin é um pré-lançamento, e suas tabelas mudaram durante o desenvolvimento sem migrações. Se você instalou um build anterior, desinstale-o e instale novamente. A reinstalação mantém tabelas já existentes, portanto remova primeiro as tabelas antigas `plugin_mcp_token`, `plugin_mcp_audit` e `plugin_mcp_ability` (e as tabelas equivalentes de builds feitos antes da renomeação). Faça backup delas se precisar do histórico; os tokens desses builds são revogados na desinstalação e não são preservados.

### Servidor web

Configurações do Apache que removem `Authorization` antes do PHP precisam disto no virtual host ou diretório correspondente, seguido de um recarregamento:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

O Apache com `mod_php` atendeu às rotas de `api.php` sem nenhuma configuração extra de caminho.

As rotas de `api.php` ficam no caminho após o nome do script (`/plugins/mcp/api.php/v1/abilities`), portanto o nginx precisa corresponder a URIs em que `.php` é seguido por mais caminho, separar o *path info* e passá-lo ao PHP. Um bloco `location ~ \.php$` nunca corresponde a essas URLs; o nginx responde com seu próprio 404 em HTML. O padrão de location e as duas linhas de *path info* abaixo foram verificados com PHP-FPM; as demais linhas são configuração padrão:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Ajuste as linhas `include` e `fastcgi_pass` para corresponderem ao bloco que já atende o Cacti. Não adicione `try_files $fastcgi_script_name =404;` a este bloco: isso limpa `$fastcgi_path_info`, e `api.php` passa a responder 404 `UNKNOWN_PATH`. Se sua configuração precisar de `try_files`, salve o valor antes com `set $path_info $fastcgi_path_info;` e passe `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` não tem rotas de caminho e não precisa delas.

## Console

Management > MCP possui três abas. Você precisa do realm **MCP Administration**. As capturas de tela aqui e abaixo são de um build de desenvolvimento do Cacti com dados de exemplo.

- **Abilities** lista cada habilidade registrada com seu plugin, categoria, o realm necessário e se está exposta. Selecione linhas e escolha Expose ou Hide; você confirma antes de a alteração ser aplicada. As habilidades integradas `cacti-*` ficam expostas por padrão. Habilidades de outros plugins começam ocultas, para que instalar um plugin nunca publique nada até que um administrador decida fazê-lo. A exposição apenas restringe o acesso: o usuário ainda precisa do realm da habilidade.

  ![Aba Abilities listando as habilidades integradas com seus realms e estado de exposição](../../images/console-abilities.png)
- **Tokens** lista os tokens com proprietário, criador, criação, expiração, último uso e estado (Active, Expired, Revoked). Selecione linhas e escolha Revoke para revogá-los. Tokens revogados não podem ser usados novamente. Create Token cria um novo.

  ![Aba Tokens listando tokens com proprietário, expiração, último uso e estado, acima do formulário Create Token](../../images/console-tokens.png)
- **Audit** lista os registros de auditoria, do mais recente para o mais antigo, e filtra por usuário, habilidade e resultado.

  ![Aba Audit listando chamadas com usuário, token, habilidade e resultado, com filtros](../../images/console-audit.png)

## Tokens

Um token pessoal lê o Cacti como seu proprietário. Ele tem o formato `cmcp_pat_` seguido por 64 caracteres hexadecimais minúsculos e carrega o único escopo `abilities:read`. O que ele pode ver é decidido pelos realms do Cacti e pelas permissões de dispositivos do proprietário, e não pelo token. O proprietário deve ser um usuário habilitado que possua o realm **MCP and Abilities API**.

Os tokens são sempre criados para um usuário, expiram e podem ser revogados:

- **Console.** Management > MCP > Tokens > Create Token. A validade é de 1 a 365 dias, com padrão de 90. O token é gerado pelo servidor e exibido uma única vez na página de resposta, portanto copie-o para o seu gerenciador de segredos imediatamente. Você pode criar um token para si mesmo. Criar um para outro usuário também exige o realm Users/Groups, pois o token lê o Cacti como esse usuário.
- **My MCP Tokens.** Qualquer usuário com o realm MCP and Abilities API pode gerenciar os próprios tokens; veja abaixo.
- **Linha de comando.** `tokens.php` é executado apenas pela CLI, por uma conta do sistema operacional que possa administrar o Cacti. Ele obtém o token a partir do ambiente para que o valor nunca apareça na linha de comando nem na lista de processos. A validade é de 1 a 365 dias, com padrão de 30. Criar e revogar um token pela CLI é auditado como no console, tendo o proprietário do token como ator porque a CLI não possui um usuário do Cacti, de modo que o registro de auditoria não marca a ação como vinda da CLI. `--list` imprime todos os tokens em JSON (ID, proprietário, escopos, timestamps, flag de revogação) e nunca o valor do token; `--help` mostra o uso.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Não é possível criar tokens para a conta de convidado (*guest*), para usuários desabilitados ou para usuários sem o realm **MCP and Abilities API**, seja pelo console, pela linha de comando ou por My MCP Tokens. O Cacti armazena a configuração de convidado como nome de usuário ou ID de usuário, e o plugin resolve ambos. Um token cujo proprietário passe a ser a conta de convidado deixa de funcionar na próxima requisição.

### Meus Tokens MCP

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) não exige nenhum realm de administração: é coberto pelo realm **MCP and Abilities API**, e o item de menu aparece apenas para usuários que o possuem. A página sempre atua sobre o usuário autenticado. O menu do Cacti faz parte do console, portanto um usuário sem acesso ao console acessa a página pelo seu endereço.

![Aba My Tokens listando os tokens do usuário autenticado e o formulário de criação](../../images/my-tokens.png)

- **Tokens** lista seus tokens, cria um novo (1 a 365 dias, padrão 90, exibido uma única vez na resposta) e revoga os seus próprios. Você não pode ver nem revogar os de outra pessoa.
- **Activity** lista as ações que você realizou, da mais recente para a mais antiga: chamadas feitas com seus tokens e alterações de tokens que você efetuou.
- **Available Tools** lista as habilidades que um token seu pode usar no momento, com o ID, o nome e a descrição de cada habilidade. Ela segue suas permissões do Cacti e as configurações de exposição escolhidas por um administrador.

  ![Lista Available Tools mostrando o ID, o nome e a descrição de cada habilidade](../../images/my-tools.png)

Uma instalação feita antes de esta página existir possui uma lista de arquivos de realm sem `mcp_tokens.php`. A instalação registra a lista; ela não é atualizada ao habilitar ou desabilitar o plugin. Desinstale e instale o plugin novamente e, em seguida, conceda os realms de novo, pois o Cacti remove as concessões de realm quando um plugin é desinstalado.

O banco de dados armazena apenas o hash SHA-256 do token, portanto um token perdido não pode ser recuperado; revogue-o e crie outro. A rotação funciona da mesma forma: crie um novo token, altere o cliente e, então, revogue o antigo. Um token expirado, um token revogado, um proprietário desabilitado ou um realm perdido falham na próxima requisição. Os tokens são aceitos apenas no cabeçalho `Authorization: Bearer`; um token na query string ou no corpo da requisição não é aceito.

## Conectar um cliente

Use o endpoint MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, com o
token em um cabeçalho `Authorization: Bearer`. Mantenha o token em uma variável de
ambiente ou gerenciador de segredos e referencie-o na configuração do cliente em vez
de gravar seu valor em um arquivo.

### Claude Code

Coloque o endpoint em um arquivo `.mcp.json` do projeto que referencie o token pelo nome.
O Claude Code expande `${VAR}` em `url` e `headers`, portanto o arquivo não contém nenhum segredo e
é seguro para fazer commit. Exporte `CACTI_MCP_TOKEN` no ambiente que inicia o Claude Code.

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

Você também pode adicioná-lo pela linha de comando:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Com aspas duplas, seu shell expande `$CACTI_MCP_TOKEN` primeiro, de modo que o valor do token
é gravado no arquivo de configuração para o `--scope` escolhido (`local`, `user` ou
`project`; padrão `local`). Não use essa forma com `--scope project` e mantenha
o arquivo fora do controle de versão. Prefira a referência em `.mcp.json` acima. O Claude Code
lê algumas variáveis de credenciais (como `ANTHROPIC_AUTH_TOKEN`) como vazias em
`url` e `headers` remotos; `CACTI_MCP_TOKEN` não é uma delas. Fonte:
[Documentação de MCP do Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot no VS Code

Use um arquivo `.mcp.json` na raiz do workspace (ou o arquivo do usuário `~/.copilot/mcp-config.json`).
Esses arquivos nativos do Copilot usam um objeto `mcpServers` de nível superior e referências de
variável de ambiente `${NAME}` nos valores dos cabeçalhos:

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

Exporte `CACTI_MCP_TOKEN` no ambiente que inicia o VS Code. Arquivos nativos do Copilot
não oferecem suporte a prompts `inputs`. A configuração guiada do VS Code rejeita valores `${...}`,
portanto adicione o cabeçalho `Authorization` editando o arquivo diretamente, e não pelo
fluxo guiado. A configuração guiada oferece o arquivo da raiz do workspace
apenas quando a configuração experimental `chat.mcp.workspaceRootConfig.enabled` está ativada. Consulte a
[Referência de configuração MCP do VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Legado: `.vscode/mcp.json`.** O VS Code informa que novas configurações do Copilot não devem
usar `.vscode/mcp.json` nem o `mcp.json` do perfil; eles pertencem ao harness
Local obsoleto, que será removido em fevereiro de 2027. Se você ainda o utiliza, o
formato gerenciado pelo editor recebe uma chave `servers` de nível superior e pode solicitar o token:

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

### Clientes que suportam apenas stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) é um adaptador opcional
que roda como um servidor MCP stdio local e chama a API HTTP do plugin. Use-o para um
cliente que não consegue se conectar a um servidor HTTP remoto. Ele precisa do mesmo token
pessoal e se comunica com `api.php`.

### Comportamento do MCP

O endpoint serve apenas ferramentas: cada ability exposta e permitida é uma ferramenta nomeada pelo
seu ID, com seus schemas de entrada e saída e anotações somente leitura
(`openWorldHint` é `false`). Ele trata `initialize`, `server/discover`, `ping`,
`tools/list` e `tools/call`. Ele não mantém sessão, não envia `Mcp-Session-Id`
(e ignora caso receba um) e não aceita lotes JSON-RPC. Uma mensagem
sem `id` é uma notificação e recebe HTTP 202 sem corpo. Apenas `POST` é
permitido.

- **Revisões.** Uma requisição que traz `io.modelcontextprotocol/protocolVersion` em
  `params._meta` deve informar `2026-07-28`; qualquer outro valor recebe o erro `-32022`. Essas
  requisições também devem incluir os cabeçalhos correspondentes `Mcp-Protocol-Version`, `Mcp-Method` e (para
  `tools/call`) `Mcp-Name`, ou a resposta será o erro `-32020`. Outras requisições
  são tratadas como `2025-11-25`: `initialize` responde com essa revisão e, em qualquer
  outro método, um cabeçalho `Mcp-Protocol-Version`, se enviado, deve ser `2025-11-25`,
  `2025-06-18` ou `2025-03-26`.
- **Erros de ferramenta.** Um erro de ability, incluindo argumentos que não correspondem ao
  schema ou um valor de `arguments` que não é um objeto JSON, retorna como um resultado de
  ferramenta com `isError: true` e o erro AIP-193 em `structuredContent`, não como um
  erro de protocolo.
- **Erros de protocolo.** Falhas que não são erros de ferramenta são objetos de erro JSON-RPC
  (código `-32000` com o status e o motivo em `data`, ou os códigos padrão): a
  ausência da Public Cacti URL, um `Origin` recusado, uma requisição com o plugin desativado
  ou em um poller remoto e erros inesperados do servidor (`-32603`, com o detalhe
  gravado no log do Cacti, e não na resposta). Verificações de requisição executadas primeiro (405,
  413, 415) e falhas de autenticação (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  mantêm o corpo AIP-193 descrito em API HTTP.

## API HTTP

URL base: `https://cacti.example.com/cacti/plugins/mcp/api.php`. O contrato está
em [openapi.json](../../../openapi.json).

| Método e caminho | Finalidade |
| --- | --- |
| `GET /v1/abilities` | Listar abilities permitidas. Parâmetros de consulta: `pageSize`, `pageToken` e `filter` no formato `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Ler uma ability. |
| `POST /v1/abilities/{id}:execute` | Executá-la. O corpo é exatamente `{"arguments": {...}}`. A resposta é `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Os erros seguem o AIP-193: um objeto `error` com `code`, `message`, `status` e
`details` que traz um `ErrorInfo` com domínio `cacti.net` e um `reason` estável.
Problemas nos argumentos adicionam um detalhe `BadRequest` nomeando o campo. Os corpos das requisições são
limitados a 64 KB e os resultados, a 1 MB. Ambos os endpoints respondem apenas no poller
principal e retornam `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) quando o plugin está desativado
ou o servidor não é o poller principal.

| HTTP | Valores de `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (também envia `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (envia `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Escrever uma ability (autores de plugins)

Um plugin do Cacti ativado registra abilities a partir de uma função anexada ao
hook `abilities_register`, geralmente em sua função `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

A função recebe um `AbilitiesRegistrar` com escopo restrito ao plugin. Seu valor de
retorno é ignorado.

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

As regras, todas aplicadas no momento do registro:

- **IDs.** Um ID corresponde a `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, tem no máximo 64
  caracteres e deve começar com o slug do plugin seguido de um hífen: `acme-` acima.
  O slug é o nome do diretório do plugin, portanto um diretório como `my_plugin` não pode
  registrar nada. Um diretório de plugin chamado `cacti` é recusado; esse
  namespace pertence aos itens integrados.
- **Definição.** Exatamente estas chaves: `label`, `description` (até 4096 bytes),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. A categoria já deve existir: use uma integrada (`inventory`,
  `system`) ou registre a sua própria com `registerCategory()`, cujo ID é único entre
  todos os plugins e corresponde a `^[a-z][a-z0-9-]{0,31}$`.
- **Apenas somente leitura.** `annotations` deve ser exatamente `readOnly: true`,
  `destructive: false`, `idempotent: true`. Qualquer outra coisa lança uma exceção.
- **Schemas.** `input_schema` e `output_schema` devem ter cada um `type` `object`
  no nível superior. O dialeto é restrito e adota falha fechada (fail-closed). Objetos devem ser fechados
  (`additionalProperties: false`, com `properties` presente); os outros tipos são
  `integer` e `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean` e `array` (que requer `items` e
  `maxItems`). Um tipo pode se tornar
  anulável como `['string', 'null']`. Strings de argumento têm por padrão no máximo
  4096 caracteres; strings de resultado são limitadas apenas por um `maxLength` declarado
  e pelo limite de tamanho do resultado. No máximo 256 abilities podem ser registradas.
- **`permission(int $userId): bool`.** Deve retornar exatamente `true` para permitir. O
  ID do usuário é o do proprietário do token; nunca leia o estado da sessão.
- **`execute(int $userId, stdClass $args): array`.** `$args` já foi validado
  contra `input_schema`. Aplique você mesmo as permissões em nível de objeto. Retorne um
  array associativo que corresponda exatamente a `output_schema`; uma lista, um campo extra
  ou mais de 1 MB de JSON se torna um erro `INVALID_RESULT`. Lance
  `AbilitiesError` para uma falha visível ao cliente, como `NOT_FOUND`.
- **Objetos vazios.** O PHP codifica `[]` como um array JSON. Onde quer que o schema de saída
  declare um `object`, em qualquer profundidade, o registro trata `[]` como o objeto vazio
  e envia `{}`; `new stdClass()` também funciona. Uma lista não vazia nunca conta como um
  objeto e falha com `INVALID_RESULT`. Um mapa `properties` vazio em um schema
  pode ser `[]` ou `new stdClass()`; ambos são publicados como `{}`.
- **Isolamento de falhas.** Cada plugin faz o registro em uma cópia temporária que é mantida
  apenas se a sua função retornar normalmente. Se ela lançar uma exceção, nenhuma de suas abilities
  é registrada e a falha é registrada no log.

As abilities de plugins começam ocultas. O administrador as expõe na
aba Abilities do console, e a coluna Required Realm exibe "Set by the plugin"
para elas.

## Modelo de segurança

- **Somente Bearer.** `api.php` e `mcp.php` aceitam um token pessoal no cabeçalho
  `Authorization` e nada mais. Eles descartam cookies, `$_POST` e
  `$_REQUEST` antes de o Cacti carregar e destroem a sessão iniciada pelo Cacti, de modo que um login pelo navegador
  nunca concede acesso à API.
- **Solução alternativa para CSRF.** A proteção CSRF do Cacti rejeita um POST JSON que não tenha um token CSRF
  do Cacti, o que nenhum cliente MCP pode enviar. Apenas para esses dois endpoints, o plugin
  renomeia o método da requisição antes de o Cacti carregar e o restaura depois, de modo que a
  proteção os ignora. Isso é seguro porque CSRF protege requisições que um navegador
  autentica com cookies, e esses endpoints não aceitam identidade por cookie: uma
  página entre sites não consegue anexar o token bearer. As páginas do console mantêm proteção CSRF
  completa. A solução alternativa é temporária, até que o Cacti ofereça uma isenção
  suportada; consulte `lib/bootstrap.php`.
- **Verificação de origem.** Em `mcp.php`, se a requisição tiver um cabeçalho `Origin`, ele deve
  corresponder exatamente ao esquema, host e porta da URL Pública do Cacti, caso contrário a requisição é
  recusada com `ORIGIN_NOT_ALLOWED`. Uma requisição sem cabeçalho `Origin`, que é como
  clientes fora de navegadores se conectam, é permitida. Isso impede que uma página web acione o
  endpoint a partir do navegador de um visitante. `api.php` não aplica essa verificação.
- **Somente leitura.** O registro rejeita qualquer habilidade que não seja somente leitura,
  não destrutiva e idempotente.
- **Exposição e realms se aplicam em conjunto.** Uma habilidade deve estar exposta e o proprietário do
  token deve possuir o respectivo realm. Se a tabela de exposição não puder ser lida, todas as habilidades
  ficam ocultas em vez de recorrer aos padrões.
- **Habilidades ocultas, desconhecidas e não permitidas parecem iguais.** Um cliente não consegue distinguir uma
  habilidade inexistente de uma que está oculta ou que seu usuário não tem permissão para
  usar: a descoberta a omite e a execução retorna `NOT_FOUND`
  (`ABILITY_NOT_FOUND`).
- **Tokens.** Armazenados como hashes SHA-256, exibidos uma única vez, sempre com expiração, revogáveis e
  rejeitados quando o proprietário é desativado ou perde o realm.
- **Auditoria.** `plugin_mcp_audit` registra ID da requisição, ID do token, ID do usuário, habilidade,
  resultado (`started`, `succeeded`, `failed`, `denied`, `rejected`) e carimbos de data/hora.
  Nunca registra argumentos, resultados ou valores de token. Uma habilidade só é executada após
  a gravação de sua linha `started`; se a tabela de auditoria estiver indisponível, a chamada falha
  com `UNAVAILABLE` e não é executada. Uma chamada recusada antes de executar gera uma única linha: `denied`
  para uma habilidade desconhecida, oculta ou não permitida, e `rejected` para argumentos que falham na validação do
  esquema. A criação e a revogação de tokens pelo console, por Meus Tokens MCP e pela CLI são
  registradas como `mcp-token-create` e `mcp-token-revoke` com resultado `succeeded`, e uma
  revogação só é registrada para um token que estava ativo. A descoberta e qualquer chamada cujo campo
  `arguments` não seja um objeto JSON não são registradas.
- **Log de falhas.** Uma falha inesperada, `INVALID_RESULT` ou uma tabela de auditoria
  indisponível grava uma linha no log do Cacti com a facilidade `MCP`: o ID da habilidade, um motivo
  fixo e a classe da exceção. Mensagens, argumentos e tokens nunca são registrados.
- **Apenas no poller principal.** Ambos os endpoints, ambas as páginas do console e `tokens.php` recusam-se a
  atuar em qualquer outro lugar.

## Ciclo de vida

Desativar o plugin bloqueia ambos os endpoints. Desinstalar revoga todos os tokens e
mantém as três tabelas (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) para retenção; reinstalar não reativa um token
revogado. Faça backup das tabelas junto com o banco de dados do Cacti e aplique uma política de retenção de auditoria
fora do plugin.

## Desenvolvimento e testes

Os testes são scripts PHP simples que executam sem o Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

O CI faz lint do PHP e executa os scripts em `tests/` (cada um listado em
`.github/workflows/ci.yml`) no PHP 8.2 ao 8.5, depois gera o pacote instalável `mcp/` e seu checksum. Os testes que interagem com o Cacti usam
fixtures na fronteira dos auxiliares do Cacti; eles não exercitam uma instalação completa do Cacti.

### Testes de integração

`tests/integration/run.sh 1.2.31` ou `tests/integration/run.sh develop` instala o
plugin em um Cacti real em contêineres e executa verificações ao vivo contra ele. Ele requer Docker
com Compose v2.23.1 ou posterior, git e openssl. `KEEP=1` mantém a pilha em execução para depuração. O CI o executa
todas as noites e sob demanda, não em pull requests.

## Localização

O Cacti MCP distribui catálogos GNU gettext compilados em `locales/po/` e `locales/LC_MESSAGES/`
e READMEs localizados em `docs/i18n/` para inglês mais 44 localidades (19 de nível Broad Tier 1,
15 africanas e 10 asiáticas), usando o domínio de texto `mcp` (`locales/po/mcp.pot`).
O Cacti carrega o catálogo correspondente automaticamente quando o suporte a idiomas está habilitado.

## Contribuição

Os pull requests devem ser direcionados para `develop`. Mantenha o código de produção compatível com o PHP 8.2 e
use o estilo do Cacti: tabulações, strings com aspas simples e os auxiliares de banco de dados e
permissão do Cacti. Adicione testes para alterações no comportamento de validação, autorização ou protocolo
e assine os commits com `git commit -s`. Coordene alterações na API HTTP
com [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licença

Copyright (C) 2026 Thomas Vincent. Distribuído sob a GNU General Public
License, versão 2 ou posterior. Consulte [LICENSE](../../../LICENSE).
