# Gestor de páginas

## Acesso e páginas

Na administração do WHMCS, abra **Addons → zmchel WHMCS Multimodule**. A lista de páginas permite criar, procurar, editar e eliminar páginas. Um *slug* é a parte do endereço a seguir ao domínio, por exemplo `contact` em `/contact/`. Exporte as definições antes de alterar URLs, redirecionamentos ou regras do servidor.

Ao criar uma página, indique um nome interno e um slug com letras latinas, algarismos e hífenes, sem domínio nem `.php`. Escolha o acesso: visitantes, clientes autenticados ou misto. Selecione o estado (rascunho, publicado, adiado ou lixo), o tipo (página, artigo ou página do sistema) e os idiomas. O idioma predefinido do WHMCS tem de existir em `supported_langs.php`; é acrescentado automaticamente.

Depois de guardar, abra a página e edite as **definições principais**, o **conteúdo**, os **metadados** e as definições do **mapa do site**. Cada formulário tem o seu botão Guardar; «Guardar tudo» processa todos. Confirme as mensagens de sucesso e visite a página pública. Eliminar coloca primeiro a página no lixo; a eliminação definitiva faz-se a partir daí.

## URL

Filtre a lista por nome, acesso, tipo, estado ou idioma. **Visitar** abre o URL público. **Eliminar** primeiro move a página para o lixo; a eliminação definitiva é feita aí. Se a página não abrir, verifique o estado de publicação, o idioma ativo e o tipo de acesso.

## WHMCS

Para substituir uma página do WHMCS, selecione o endereço existente do sistema e uma página publicada do módulo. Escolha substituição completa, adição antes ou depois do conteúdo normal ou apenas meta/SEO. Guarde e teste o URL original do WHMCS como visitante e cliente autenticado.

## Instruções

- Adicionar página
- **Nome da página** — Nome interno da página
- **Slug da página** — Só são permitidas letras latinas, hífenes e algarismos.
- **Tipo de acesso** — Utilizadores autenticados: só os utilizadores autenticados podem aceder à página; Visitantes: só os visitantes podem aceder; Misto: todos podem aceder, sendo a visibilidade controlada pelos blocos dentro da página.
- **Tipo de página** — As páginas do sistema são excluídas do sitemap e não estão disponíveis para utilizadores comuns.
- **Idiomas da página** — O idioma predefinido está sempre incluído, independentemente da seleção.
- A substituição completa substitui o conteúdo apresentado e os metadados.\ Adicionar antes coloca conteúdo antes do conteúdo existente da página.\ Adicionar depois coloca conteúdo depois do conteúdo existente da página.\ Apenas metadados/SEO substitui os metadados da página.
- Navegação na lista de páginas
