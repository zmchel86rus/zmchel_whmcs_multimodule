# zmchel WHMCS Multimodule: instruções

**Antes de utilizar o módulo, gere salts exclusivos e coloque-os em `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` e `ZM_PB_NONCE_SALT`.

**Antes da primeira utilização, abra Definições do módulo → Idiomas suportados e ative os idiomas necessários.**

Desenvolvido e testado com **WHMCS 8.13.1–8.13.7**; compatibilidade PHP verificada nas versões **7.4–8.5**. O suporte para Apache é completo. Nginx também pode funcionar, mas o encaminhamento de idiomas na página inicial poderá exigir configuração adicional. **O módulo é gratuito.**

## Gestor de idiomas (em desenvolvimento)

Na administração do WHMCS, abra o Gestor de idiomas e escolha uma secção (idiomas do cliente ou da administração do WHMCS, este módulo ou outro) e um idioma. Compare o original ou a referência com a tradução, edite uma linha e guarde-a; também pode exportar e importar as chaves existentes em JSON. Os novos idiomas usam a referência até serem traduzidos. O gestor ativa e desativa ficheiros de idioma e corrige nomes antigos; altere primeiro o idioma predefinido no WHMCS.

→ [Gestor de idiomas](../english/docs/language-manager.md) (English)

## Acesso e páginas

Na administração do WHMCS, abra **Addons → zmchel WHMCS Multimodule**. A lista de páginas permite criar, procurar, editar e eliminar páginas. Um *slug* é a parte do endereço a seguir ao domínio, por exemplo `contact` em `/contact/`. Exporte as definições antes de alterar URLs, redirecionamentos ou regras do servidor.

Ao criar uma página, indique um nome interno e um slug com letras latinas, algarismos e hífenes, sem domínio nem `.php`. Escolha o acesso: visitantes, clientes autenticados ou misto. Selecione o estado (rascunho, publicado, adiado ou lixo), o tipo (página, artigo ou página do sistema) e os idiomas. O idioma predefinido do WHMCS tem de existir em `supported_langs.php`; é acrescentado automaticamente.

Depois de guardar, abra a página e edite as **definições principais**, o **conteúdo**, os **metadados** e as definições do **mapa do site**. Cada formulário tem o seu botão Guardar; «Guardar tudo» processa todos. Confirme as mensagens de sucesso e visite a página pública. Eliminar coloca primeiro a página no lixo; a eliminação definitiva faz-se a partir daí.

## Conteúdo e idiomas

No separador Conteúdo, escolha um idioma e arraste blocos GrapesJS para a área de edição. Edite texto, imagens e opções do bloco selecionado e guarde esse idioma. Existem secções, colunas, tabelas, FAQ, acordeões, formulários de contacto, listas, paginação, áreas para visitantes/clientes e código personalizado. Copie a estrutura ou o conteúdo para outro idioma e traduza o texto antes de publicar.

Com URLs amigáveis e encaminhamento por idioma, o idioma predefinido usa `/contact/`; os restantes usam um prefixo, como `/pt/contact/` para português de Portugal e `/pt-BR/contact/` para português do Brasil. Nos blocos Ligação e Botão, ative a inclusão do idioma atual apenas para páginas traduzidas do site. Desative-a para endereços externos, ficheiros, `mailto:`, `tel:` e rotas WHMCS sem versões traduzidas. Verifique as ligações em vários idiomas.

## SEO, multimédia e menus

Em cada idioma, preencha o título, a descrição, a imagem social, o URL canónico, as regras de robots e o tipo Schema no separador Metadados. Uma página publicada que não seja de sistema pode constar do mapa do site XML. No Gestor de multimédia, carregue imagens, indique texto alternativo útil e verifique a qualidade após a otimização.

No Gestor de menus, crie um menu, adicione páginas ou ligações personalizadas, ordene os itens e defina a localização e visibilidade. Cada localização admite um único menu. Para substituir uma página WHMCS, publique primeiro a nova página, configure a substituição na lista e teste o URL original do WHMCS como visitante e como cliente autenticado.

## Ferramentas do site

No Gestor de redirecionamentos, defina origem e destino: `301` para alterações permanentes, `302` para temporárias. O Gestor de reescrita controla as regras das URLs amigáveis. Gere mapas do site no separador Mapa do site e verifique `sitemap_index.xml`. As definições do módulo também controlam menus, Smarty, manutenção e importação/exportação. Um ficheiro JSON exportado não substitui uma cópia de segurança completa do WHMCS.

O formulário de contacto pode enviar um ticket WHMCS ou uma mensagem de correio. Configure campos, destinatário ou departamento de suporte, consentimentos e CAPTCHA, e faça um envio real de teste. Se faltarem tabelas do módulo, use o separador Base de dados do módulo.

## Documentação adicional (English)

[Menus](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Paginação](../english/docs/pagination.md) · [Mapas do site](../english/docs/sitemaps.md) · [Redirecionamentos](../english/docs/redirects.md) · [Dados estruturados](../english/docs/structured-data.md) · [Importação e exportação](../english/docs/transfer.md).
