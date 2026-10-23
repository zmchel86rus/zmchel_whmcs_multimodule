# Dados estruturados

- **Editor de páginas → Configurações de metadados → Tipo de Schema → Salvar.**

## O que o módulo marca

Menus e sumário podem gerar `SiteNavigationElement`, perguntas e respostas visíveis `FAQPage`, e uma trilha de navegação com vários itens `BreadcrumbList`. Blocos de layout, botões e filtros não recebem automaticamente um tipo de conteúdo. O tipo Schema escolhido para a página controla seu JSON-LD; quando desativado, essa marcação não é exibida.

## Verificação após publicar

Na página pública, confira o JSON-LD, a URL canônica, o idioma e o conteúdo realmente visível. Uma marcação válida não garante resultado enriquecido na busca.

## Schema.org

`SiteNavigationElement` usa links e títulos de menu realmente visíveis; o índice pode acrescentar `WebPageElement` para títulos que existem na página. `FAQPage` inclui apenas perguntas e respostas completas visíveis ao visitante: blocos ocultos e acordeões comuns ficam de fora. `BreadcrumbList` só é criado com pelo menos dois itens. Os dados da organização vêm do WHMCS; idiomas de contato aparecem em `ContactPoint.availableLanguage` no formato BCP 47. O módulo não inventa um tipo Schema para filtros, paginação, formulários ou HTML personalizado.

## Instruções

- **Tipo de Schema** — Quando desativado, a marcação JSON do Schema.org não é exibida nesta página.
- **Navegação estrutural** — Nome da página na navegação estrutural
- **URL canônica**
- **Título da página**
- **Meta descrição**
- **Título Open Graph** — Se estiver vazio, será usado o título da página.
- **Descrição Open Graph** — Se estiver vazia, será usada a meta descrição.
- **Imagem Open Graph** — Se estiver vazia, será usada a imagem da página.

