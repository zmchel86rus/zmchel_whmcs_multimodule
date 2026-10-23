# Dados estruturados

- **Editor de páginas → Definições de metadados → Tipo de Schema → Guardar.**

## O que o módulo marca

Menus e índice podem gerar `SiteNavigationElement`, perguntas e respostas visíveis `FAQPage`, e um percurso de navegação com vários itens `BreadcrumbList`. Blocos de disposição, botões e filtros não recebem automaticamente um tipo de conteúdo. O tipo Schema escolhido para a página controla o seu JSON-LD; quando desativado, essa marcação não é apresentada.

## Verificação após publicar

Na página pública, verifique o JSON-LD, o URL canónico, o idioma e o conteúdo realmente visível. Uma marcação válida não garante resultados enriquecidos na pesquisa.

## Schema.org

`SiteNavigationElement` usa ligações e títulos de menu realmente visíveis; o índice pode acrescentar `WebPageElement` para títulos existentes na página. `FAQPage` inclui apenas perguntas e respostas completas visíveis ao visitante: blocos ocultos e acordeões comuns são excluídos. `BreadcrumbList` só é criado com pelo menos dois itens. Os dados da organização vêm do WHMCS; as línguas de contacto aparecem em `ContactPoint.availableLanguage` no formato BCP 47. O módulo não inventa um tipo Schema para filtros, paginação, formulários ou HTML personalizado.

## Instruções

- **Tipo de Schema** — Quando desativado, a marcação JSON do Schema.org não é apresentada nesta página.
- **Caminho de navegação** — Nome da página no caminho de navegação
- **URL canónico**
- **Título da página**
- **Meta descrição**
- **Título Open Graph** — Se estiver vazio, é utilizado o título da página.
- **Descrição Open Graph** — Se estiver vazia, é utilizada a meta descrição.
- **Imagem Open Graph** — Se estiver vazia, é utilizada a imagem da página.

