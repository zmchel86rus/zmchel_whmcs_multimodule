# Gerenciador de páginas

## Acesso e páginas

No painel do WHMCS, abra **Addons → zmchel WHMCS Multimodule**. A lista de páginas permite criar, localizar, editar e excluir páginas. O *slug* é a parte do endereço após o domínio, como `contact` em `/contact/`. Exporte as configurações antes de mudar URLs, redirecionamentos ou regras do servidor.

Ao criar uma página, informe um nome interno e um slug com letras latinas, números e hífens, sem domínio ou `.php`. Escolha o acesso: visitantes, clientes conectados ou misto. Selecione o status (rascunho, publicado, adiado ou lixeira), o tipo (página, artigo ou página do sistema) e os idiomas. O idioma padrão do WHMCS precisa existir em `supported_langs.php`; ele é incluído automaticamente.

Depois de salvar, abra a página e edite as **configurações principais**, o **conteúdo**, os **metadados** e as opções do **sitemap**. Cada formulário tem seu próprio botão Salvar; «Salvar tudo» processa todos. Confira as mensagens de sucesso e visite a página pública. Excluir move a página primeiro para a lixeira; a exclusão definitiva é feita ali.

## URL

Filtre a lista por nome, acesso, tipo, status ou idioma. **Visitar** abre a URL pública. **Excluir** primeiro move a página para a lixeira; a exclusão definitiva é feita nela. Se a página não abrir, confira o status de publicação, o idioma ativo e o tipo de acesso.

## WHMCS

Para substituir uma página do WHMCS, selecione o endereço existente do sistema e uma página publicada do módulo. Escolha substituição completa, adição antes ou depois do conteúdo padrão, ou apenas meta/SEO. Salve e teste a URL original do WHMCS como visitante e como cliente autenticado.

## Instruções

- Adicionar página
- **Nome da página** — Nome interno da página
- **Slug da página** — Somente letras latinas, hífens e números são permitidos.
- **Tipo de acesso** — Usuários autenticados: somente usuários autenticados podem acessar a página; Visitantes: somente visitantes podem acessá-la; Misto: todos podem acessá-la, com a visibilidade controlada pelos blocos da página.
- **Tipo de página** — As páginas do sistema são excluídas do sitemap e não ficam disponíveis para usuários comuns.
- **Idiomas da página** — O idioma padrão está sempre incluído, independentemente da seleção.
- A substituição completa substitui o conteúdo exibido e os metadados.\ Adicionar antes insere conteúdo antes do conteúdo existente da página.\ Adicionar depois insere conteúdo depois do conteúdo existente da página.\ Somente metadados/SEO substitui os metadados da página.
- Navegação na lista de páginas
