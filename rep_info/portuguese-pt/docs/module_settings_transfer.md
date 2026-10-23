# Importação e exportação

Um único ficheiro JSON para todas as secções ou para as selecionadas, até 32 MiB (também se aplicam os limites de carregamento do PHP). As páginas correspondentes são atualizadas pelo slug e tipo de acesso, e os menus pelo nome. Os restantes registos mantêm-se inalterados. Inclua as páginas ao importar menus para um novo site. As secções selecionadas que não constem do ficheiro são ignoradas.

Os ficheiros CSS/JS são incluídos com as páginas; as imagens e outros ficheiros carregados são incluídos com a biblioteca multimédia. O histórico de revisões, as variáveis Smarty recolhidas e os dados confidenciais do WHMCS não são exportados. Volte a gerar o sitemap após a importação e aplique as regras de reescrita no Gestor de Reescritas.

Páginas e artigos (traduções, conteúdo, SEO, definições do sitemap, blocos CSS/JS)

Os registos correspondentes nas secções selecionadas serão atualizados a partir do ficheiro. Continuar?

## JSON

A exportação pode incluir páginas e publicações com traduções, conteúdo, SEO e CSS/JS; menus com hierarquia e posições; definições, redirecionamentos, regras personalizadas e biblioteca multimédia com ficheiros. O histórico de revisões, as variáveis Smarty recolhidas, as contas e segredos do WHMCS e os ficheiros do tema ficam de fora. O JSON tem limite de 32 MiB; aplicam-se também `upload_max_filesize` e `post_max_size` do PHP. Ao transferir menus para outro site, importe também as páginas e resolva antes os nomes de menu duplicados.

O ficheiro exportado usa o formato `zmchel_whmcs_multimodule` (versão 1). Na importação, os URL do site de origem são ajustados ao `SystemURL` do site de destino, enquanto as ligações externas permanecem. A importação não cria tabelas: prepare-as primeiro na Base de dados do módulo. É pedida confirmação antes de começar; os registos mudam numa transação e os ficheiros substituídos são restaurados em caso de erro.

## Instruções

- Menus e localizações
- Definições do módulo, substituições, cabeçalho/rodapé, robots.txt
- Redirecionamentos
- Regras de reescrita personalizadas
- Biblioteca multimédia (ficheiros e descrições)
