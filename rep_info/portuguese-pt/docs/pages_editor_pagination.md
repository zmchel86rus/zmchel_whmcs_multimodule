# Paginação

Clique no bloco que contém a lista. Prima Esc para cancelar. A paginação deve ficar fora do bloco selecionado.

Para Smarty, indique a variável que contém a lista completa. Sem variável, os elementos HTML do contentor são divididos em páginas; se necessário, indique a classe das linhas ou a etiqueta tr. As ligações mantêm count, sort e os filtros. São suportadas listas independentes.

O seletor do número de elementos pode ser arrastado dentro da paginação ou para outros blocos da página. Continua associado a esta paginação.

Não indexar as páginas a partir da página 2

Selecione um bloco Smarty com uma lista. A pesquisa e a paginação devem estar associadas ao mesmo bloco.

Indique a variável que contém a lista completa. A pesquisa verifica qualquer um dos campos indicados e os filtros são aplicados em conjunto. As condições são aplicadas antes de calcular as páginas; aplicar ou repor os filtros regressa à primeira página. Se já existir paginação, será utilizada a respetiva variável.

## Ligações e origem da lista

Coloque a paginação fora do bloco da lista e selecione esse bloco como destino. Para uma lista Smarty, indique a variável com todos os itens; caso contrário, são divididos os elementos HTML do contentor. Escolha o formato das ligações pela definição do módulo, `/page/2/` ou `?page=2`. O formato de caminho exige regras rewrite. Listas independentes usam parâmetros separados; as ligações preservam idioma, filtros e ordenação.

## Tamanho da página, SEO e filtros

Defina o número de itens e, se necessário, ative o seletor 10/25/50/100/250. Alterar esse tamanho devolve a lista à primeira página. Noindex aplica-se apenas a partir da segunda página; verifique o título e o URL canónico. Associe os filtros à mesma lista e teste a segunda página e um resultado filtrado no site público.

## page / count / pager

Para uma lista Smarty, indique a variável com todos os elementos e mantenha o ciclo `{foreach}`: o módulo divide a lista, por isso não acrescente outro `array_slice`. Sem variável, dividem-se os elementos HTML do contentor; pode indicar uma classe de linha ou a etiqueta `tr`, mantendo `thead` e `tfoot`. Defina separadamente para computador e telemóvel o número de botões junto da página atual. Nas rotas PHP diretas, use `?page=2`; `/page/2/` exige regras rewrite. As páginas seguintes têm canonical próprio e podem receber `noindex`.

Com várias listas independentes, a primeira usa `page`, `count` e `sort`; as restantes usam parâmetros com o ID do bloco. Na rota `/page/N/`, `pager` indica a que lista pertence o número. No bloco Smarty, `$zm_pagination` fornece `total`, `page`, `pages`, `count` e `offset`. `count` é limitado a 10–250. Se a lista estiver vazia ou couber numa página, o painel de paginação fica oculto.

## YYYY-MM-DD

Os filtros operam na mesma lista da paginação. A pesquisa textual pode verificar vários campos separados por vírgulas; o intervalo de datas usa `YYYY-MM-DD` e inclui todo o último dia.

## Flex / Grid

Escolha Flex ou Grid e ajuste larguras e colunas por dispositivo. Aplicar ou limpar um filtro regressa à primeira página. O seletor da quantidade pode ser movido sem perder a ligação; um painel duplicado controla a mesma lista.

## Instruções

- Seleção da quantidade: 10, 25, 50, 100, 250
- Formato das ligações
- Número de elementos por predefinição
