# zmchel WHMCS Multimodule: instruções

**Antes de usar o módulo, gere salts exclusivos e coloque-os em `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` e `ZM_PB_NONCE_SALT`.

**Antes do primeiro uso, abra Configurações do módulo → Idiomas suportados e ative os idiomas necessários.**

O módulo foi desenvolvido e testado no **WHMCS 8.13.1 a 8.13.7**. A compatibilidade com PHP foi verificada nas versões **7.4 a 8.5**. O suporte ao Apache é completo. Ele também pode funcionar com Nginx, mas o roteamento de idiomas na página inicial pode exigir configuração adicional.

**O zmchel WHMCS Multimodule é gratuito.** Reúne um editor visual de páginas, conteúdo multilíngue, menus, gerenciador de mídia, campos de SEO, sitemaps XML, redirecionamentos, regras de reescrita e importação/exportação.

## Configurações do módulo

Escolha os idiomas que o módulo pode usar. Desativar um idioma não exclui seu conteúdo.

- **Configurações do módulo → Idiomas suportados → Ativar**
- **Banco de Dados do módulo → Corrigir Itens selecionados**
- **Regras de reescrita → Verificar regras → Adicionar ou atualizar regras**

O Nginx não lê .htaccess, portanto estas regras não funcionam nele. Configure regras equivalentes no nginx.

## Gerenciador de páginas

- **Adicionar página → Nome da página → Slug da página → Salvar**
- **Editor de páginas → Configurações de conteúdo → Configurações de metadados → Configurações do sitemap da página → Salvar tudo**
- **Gerenciador de páginas → Visitar**
- **Sitemap → Gerar sitemaps**

Somente letras latinas, hífens e números são permitidos.

Usuários autenticados: somente usuários autenticados podem acessar a página; Visitantes: somente visitantes podem acessá-la; Misto: todos podem acessá-la, com a visibilidade controlada pelos blocos da página.

A geração automática é executada após o cron do WHMCS quando uma atualização é necessária. A geração manual começa imediatamente.

## Guias por seção

- [Gerenciador de páginas](docs/pages_manager.md)
- [Editor de páginas](docs/pages_editor.md)
- [Gerenciador de Mídia](docs/media_manager.md)
- [Menus](docs/menu_manager.md)
- [Gerenciador de idiomas](docs/langs_manager.md)
- [Redirecionamentos](docs/redirects_manager.md)
- [Sitemaps](docs/sitemap_manager.md)
- [Regras de reescrita](docs/rewrite_manager.md)
- [Configurações do módulo](docs/module_settings.md)
- [Banco de Dados do módulo](docs/module_db.md)

## Materiais adicionais

- [Paginação](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Dados estruturados](docs/module_structured_data.md)
- [Importação e exportação](docs/module_settings_transfer.md)
