# Importação e exportação

Um único arquivo JSON para todas as seções ou apenas as selecionadas, de até 32 MiB (os limites de upload do PHP também se aplicam). As páginas correspondentes são atualizadas pelo slug e pelo tipo de acesso; os menus, pelo nome. Os demais registros permanecem inalterados. Inclua as páginas ao importar menus para um novo site. As seções selecionadas que não estiverem no arquivo serão ignoradas.

Os arquivos CSS/JS são incluídos com as páginas; as imagens e outros arquivos enviados são incluídos com a biblioteca de mídia. O histórico de revisões, as variáveis Smarty coletadas e os dados confidenciais do WHMCS não são exportados. Gere novamente o sitemap após a importação e aplique as regras de reescrita no Gerenciador de Reescrita.

Páginas e publicações (traduções, conteúdo, SEO, configurações do sitemap, blocos CSS/JS)

Os registros correspondentes nas seções selecionadas serão atualizados a partir do arquivo. Continuar?

## JSON

A exportação pode incluir páginas e posts com traduções, conteúdo, SEO e CSS/JS; menus com hierarquia e posições; configurações, redirecionamentos, regras personalizadas e biblioteca de mídia com arquivos. Histórico de revisões, variáveis Smarty coletadas, contas e segredos do WHMCS e arquivos do tema ficam de fora. O JSON tem limite de 32 MiB; os limites PHP `upload_max_filesize` e `post_max_size` também se aplicam. Ao migrar menus para outro site, importe as páginas junto e resolva nomes de menu duplicados antes.

O arquivo exportado usa o formato `zmchel_whmcs_multimodule` (versão 1). Na importação, as URLs do site de origem são ajustadas ao `SystemURL` do site de destino, enquanto links externos permanecem. A importação não cria tabelas: prepare-as primeiro no Banco de dados do módulo. Há uma confirmação antes do início; os registros mudam em uma transação e arquivos substituídos são restaurados em caso de erro.

## Instruções

- Menus e posições
- Configurações do módulo, substituições, cabeçalho/rodapé, robots.txt
- Redirecionamentos
- Regras de reescrita personalizadas
- Biblioteca de mídia (arquivos e descrições)
