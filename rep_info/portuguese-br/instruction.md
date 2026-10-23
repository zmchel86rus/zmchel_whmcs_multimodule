# zmchel WHMCS Multimodule: instruções

**Antes de usar o módulo, gere salts exclusivos e coloque-os em `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` e `ZM_PB_NONCE_SALT`.

**Antes do primeiro uso, abra Configurações do módulo → Idiomas suportados e ative os idiomas necessários.**

Desenvolvido e testado no **WHMCS 8.13.1–8.13.7**; compatibilidade com PHP verificada nas versões **7.4–8.5**. O Apache é totalmente compatível. O módulo também pode funcionar com Nginx, mas o roteamento de idiomas na página inicial pode exigir configuração adicional. **O módulo é gratuito.**

## Gerenciador de idiomas (em desenvolvimento)

Na administração do WHMCS, abra o Gerenciador de idiomas e selecione uma seção (idiomas do cliente ou do administrador do WHMCS, este módulo ou outro) e um idioma. Compare o original ou a referência com a tradução, edite uma linha e salve; também é possível exportar e importar as chaves existentes em JSON. Novos idiomas usam a referência até serem traduzidos. O gerenciador ativa e desativa arquivos de idioma e corrige nomes antigos; altere primeiro o idioma padrão no WHMCS.

→ [Gerenciador de idiomas](../english/docs/language-manager.md) (English)

## Acesso e páginas

No painel do WHMCS, abra **Addons → zmchel WHMCS Multimodule**. A lista de páginas permite criar, localizar, editar e excluir páginas. O *slug* é a parte do endereço após o domínio, como `contact` em `/contact/`. Exporte as configurações antes de mudar URLs, redirecionamentos ou regras do servidor.

Ao criar uma página, informe um nome interno e um slug com letras latinas, números e hífens, sem domínio ou `.php`. Escolha o acesso: visitantes, clientes conectados ou misto. Selecione o status (rascunho, publicado, adiado ou lixeira), o tipo (página, artigo ou página do sistema) e os idiomas. O idioma padrão do WHMCS precisa existir em `supported_langs.php`; ele é incluído automaticamente.

Depois de salvar, abra a página e edite as **configurações principais**, o **conteúdo**, os **metadados** e as opções do **sitemap**. Cada formulário tem seu próprio botão Salvar; «Salvar tudo» processa todos. Confira as mensagens de sucesso e visite a página pública. Excluir move a página primeiro para a lixeira; a exclusão definitiva é feita ali.

## Conteúdo e idiomas

Na guia Conteúdo, selecione um idioma e arraste blocos GrapesJS para a área de edição. Altere textos, imagens e opções do bloco selecionado e salve aquele idioma. Há seções, colunas, tabelas, FAQ, acordeões, formulários de contato, listas, paginação, áreas para visitantes/clientes e código personalizado. Copie a estrutura ou o conteúdo para outro idioma e traduza os textos antes de publicar.

Com URLs amigáveis e roteamento por idioma, o idioma padrão usa `/contact/`; os demais usam um prefixo, como `/pt/contact/` para português de Portugal e `/pt-BR/contact/` para português do Brasil. Nos blocos Link e Botão, ative a opção de incluir o idioma atual somente para páginas traduzidas do site. Deixe-a desligada para links externos, arquivos, `mailto:`, `tel:` e rotas WHMCS sem tradução. Teste os links em vários idiomas.

## SEO, mídia e menus

Para cada idioma, preencha o título, a descrição, a imagem social, a URL canônica, as regras de robots e o tipo Schema na guia Metadados. Uma página publicada que não seja do sistema pode aparecer no sitemap XML. No Gerenciador de mídia, envie imagens, informe um texto alternativo útil e confira a qualidade após a otimização.

No Gerenciador de menus, crie um menu, adicione páginas ou links personalizados, ordene os itens e defina local e visibilidade. Cada local aceita apenas um menu. Para substituir uma página WHMCS, publique primeiro a nova página, configure a substituição na lista e teste a URL original do WHMCS como visitante e como cliente conectado.

## Ferramentas do site

No Gerenciador de redirecionamentos, defina origem e destino: `301` para uma mudança permanente, `302` para uma temporária. O Gerenciador de reescrita controla as regras das URLs amigáveis. Gere sitemaps na guia Sitemap e confira `sitemap_index.xml`. As configurações do módulo também controlam menus, Smarty, manutenção e importação/exportação. Um JSON exportado não substitui um backup completo do WHMCS.

O formulário de contato pode enviar um ticket WHMCS ou e-mail. Configure campos, destinatário ou departamento de suporte, consentimentos e CAPTCHA, e faça um envio real de teste. Se faltarem tabelas do módulo, use a guia Banco de dados do módulo.

## Documentação adicional (English)

[Menus](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Paginação](../english/docs/pagination.md) · [Sitemaps](../english/docs/sitemaps.md) · [Redirecionamentos](../english/docs/redirects.md) · [Dados estruturados](../english/docs/structured-data.md) · [Importação e exportação](../english/docs/transfer.md).
