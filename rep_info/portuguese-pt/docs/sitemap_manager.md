# Mapas do site

A geração automática é executada após o cron do WHMCS quando é necessária uma atualização. A geração manual começa imediatamente.

São incluídas as páginas e os artigos ativos acessíveis a visitantes, incluindo as respetivas versões linguísticas publicadas. As substituições utilizam os URLs públicos das páginas que substituem.

Se nada estiver selecionado, o sitemap é atualizado diariamente.

Quando ativado, /html-sitemap apresenta o sitemap como uma página HTML normal; sitemap.xml não é afetado.

## XML

O XML inclui ligações recíprocas para idiomas ativos e `x-default` para o endereço do idioma predefinido. As origens dos redirecionamentos ficam fora de `loc` e das alternativas linguísticas; um conteúdo de reserva é marcado com a sua língua real. Os ficheiros de páginas e publicações declaram o espaço de nomes XHTML.

O hook `AfterCronJob` compara o intervalo `ZM_PB_SITEMAP_UPDFREQ` com a data da última geração bem-sucedida `ZM_PB_SITEMAP_LASTUPD`; com o mapa desligado, a geração manual também não está disponível. As versões linguísticas são escolhidas por `lang_active`, não por `lang_status`. As partes adicionais recebem os sufixos `_2`, `_3` e seguintes. Em caso de falha, os ficheiros anteriores são repostos e a data de sucesso não muda. Confirme escrita na raiz, em `resources/` e `inc/editable_consts.php`; repare as tabelas separadamente na base do módulo.

A geração automática depende do cron do WHMCS e do intervalo definido; o botão inicia-a imediatamente. Só são incluídas páginas e publicações disponíveis para visitantes, publicadas e com traduções ativas. Se uma página substituir uma página do sistema, utiliza-se o URL público da página do sistema, não o slug da substituta. Ficheiros acima de 50 000 URL ou 50 MB são divididos. O índice mantém outros mapas do site válidos.

O módulo grava `sitemap_index.xml`, `sitemap_pages.xml` e `sitemap_posts.xml` na raiz do site; categorias vazias não geram ficheiro. Não cria um `sitemap.xml` combinado. Após alterar páginas ou idiomas, gere os mapas novamente e abra o índice no navegador. Se houver erro, verifique a permissão de escrita na raiz; a data da última geração bem-sucedida não muda.

## Instruções

- Gerar sitemaps
- Ficheiros na raiz do site
- Última geração bem-sucedida
- Próxima atualização não antes de
- **Frequência de atualização** — Se estiver vazio, o valor predefinido é “mensal”.
- **Prioridade de atualização** — Se estiver vazio, o valor predefinido é “0.5”.
