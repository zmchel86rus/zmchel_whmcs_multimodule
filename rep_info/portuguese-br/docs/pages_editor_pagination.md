# Paginação

Clique no bloco que contém a lista. Pressione Esc para cancelar. A paginação deve ficar fora do bloco selecionado.

Para Smarty, informe a variável que contém a lista completa. Sem uma variável, os elementos HTML do contêiner são divididos em páginas; se necessário, informe a classe das linhas ou a tag tr. Os links preservam count, sort e os filtros. Listas independentes são suportadas.

O seletor da quantidade de itens pode ser arrastado para dentro da paginação ou para outros blocos da página. Ele continua vinculado a esta paginação.

Selecione um bloco Smarty com uma lista. A pesquisa e a paginação devem estar vinculadas ao mesmo bloco.

Informe a variável que contém a lista completa. A pesquisa verifica qualquer um dos campos informados, e os filtros são aplicados em conjunto. As condições são aplicadas antes do cálculo das páginas; aplicar ou redefinir os filtros retorna à primeira página. Se já houver paginação, será utilizada a variável correspondente.

## Links e origem da lista

Coloque a paginação fora do bloco da lista e selecione esse bloco como destino. Para uma lista Smarty, informe a variável com todos os itens; caso contrário, os elementos HTML do contêiner serão divididos. Escolha o formato dos links pela configuração do módulo, `/page/2/` ou `?page=2`. O formato de caminho exige regras de rewrite. Listas independentes usam parâmetros separados; os links preservam idioma, filtros e ordenação.

## Tamanho da página, SEO e filtros

Defina o número de itens e, se necessário, ative o seletor 10/25/50/100/250. Mudar esse tamanho retorna a lista à primeira página. Noindex se aplica somente a partir da segunda página; confira título e URL canônica. Vincule os filtros à mesma lista e teste a segunda página e um resultado filtrado no site público.

## page / count / pager

Para uma lista Smarty, informe a variável com todos os itens e mantenha o laço `{foreach}`: o módulo divide a lista, então não acrescente outro `array_slice`. Sem variável, os elementos HTML do contêiner são divididos; você pode definir uma classe de linha ou a tag `tr`, enquanto `thead` e `tfoot` permanecem. Configure separadamente para computador e celular o número de botões ao redor da página atual. Em rotas PHP diretas, use `?page=2`; `/page/2/` exige regras rewrite. As páginas seguintes têm canonical próprio e podem receber `noindex`.

Com várias listas independentes, a primeira usa `page`, `count` e `sort`; as demais usam parâmetros com o ID do bloco. Na rota `/page/N/`, `pager` indica a qual lista o número pertence. No bloco Smarty, `$zm_pagination` fornece `total`, `page`, `pages`, `count` e `offset`. `count` é limitado a 10–250. Se a lista estiver vazia ou couber em uma página, o painel de paginação fica oculto.

## YYYY-MM-DD

Os filtros operam na mesma lista da paginação. A busca textual pode verificar vários campos separados por vírgulas; o intervalo de datas usa `YYYY-MM-DD` e inclui todo o último dia.

## Flex / Grid

Escolha Flex ou Grid e ajuste larguras e colunas por dispositivo. Aplicar ou limpar um filtro volta à primeira página. O seletor de quantidade pode ser movido sem perder o vínculo; um painel duplicado controla a mesma lista.

## Instruções

- Seleção da quantidade: 10, 25, 50, 100, 250
- Não indexar as páginas a partir da segunda
- Formato dos links
- Quantidade padrão de itens
