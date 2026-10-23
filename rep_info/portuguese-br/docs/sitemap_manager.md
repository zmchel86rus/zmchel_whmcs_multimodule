# Sitemaps

A geração automática é executada após o cron do WHMCS quando uma atualização é necessária. A geração manual começa imediatamente.

São incluídas as páginas e publicações ativas disponíveis para visitantes, incluindo suas versões de idioma publicadas. As substituições usam as URLs públicas das páginas que substituem.

Se nenhuma opção for selecionada, o sitemap será atualizado diariamente.

Quando ativado, /html-sitemap exibe o sitemap como uma página HTML comum; sitemap.xml não é afetado.

## XML

O XML inclui links recíprocos para idiomas ativos e `x-default` para o endereço do idioma padrão. Origens de redirecionamentos ficam fora de `loc` e das alternativas de idioma; um conteúdo de fallback é marcado com seu idioma real. Os arquivos de páginas e posts declaram o namespace XHTML.

O hook `AfterCronJob` compara o intervalo `ZM_PB_SITEMAP_UPDFREQ` com a data da última geração bem-sucedida `ZM_PB_SITEMAP_LASTUPD`; com o sitemap desligado, a geração manual também fica indisponível. As versões de idioma são escolhidas por `lang_active`, não por `lang_status`. Partes adicionais recebem os sufixos `_2`, `_3` e seguintes. Se a geração falhar, os arquivos anteriores são restaurados e a data de sucesso não muda. Confira permissão de escrita na raiz, em `resources/` e `inc/editable_consts.php`; repare tabelas separadamente no banco do módulo.

A geração automática depende do cron do WHMCS e do intervalo configurado; o botão inicia a geração imediatamente. Entram apenas páginas e posts publicados, acessíveis a visitantes, com suas traduções ativas. Se uma página substitui uma página do sistema, usa-se o URL público da página do sistema, não o slug da substituta. Arquivos acima de 50.000 URLs ou 50 MB são divididos. O índice preserva outros sitemaps válidos.

O módulo grava `sitemap_index.xml`, `sitemap_pages.xml` e `sitemap_posts.xml` na raiz do site; categorias vazias não geram arquivo. Ele não cria um `sitemap.xml` combinado. Depois de alterar páginas ou idiomas, gere os mapas novamente e abra o índice no navegador. Se houver erro, confira a permissão de escrita na raiz; o horário da última geração bem-sucedida não muda.

## Instruções

- Gerar sitemaps
- Arquivos na raiz do site
- Última geração bem-sucedida
- Próxima atualização a partir de
- **Frequência de atualização** — Se estiver vazio, o padrão será “mensal”.
- **Prioridade de atualização** — Se estiver vazio, o padrão será “0.5”.
