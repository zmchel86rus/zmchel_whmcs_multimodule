# zmchel WHMCS Multimodule: instruções

**Antes de utilizar o módulo, gere salts exclusivos e coloque-os em `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` e `ZM_PB_NONCE_SALT`.

**Antes da primeira utilização, abra Definições do módulo → Idiomas suportados e ative os idiomas necessários.**

O módulo foi desenvolvido e testado com **WHMCS 8.13.1 a 8.13.7**. A compatibilidade com PHP foi verificada da versão **7.4 à 8.5**. O suporte para Apache é completo. Também pode funcionar com Nginx, mas o encaminhamento por idioma na página inicial poderá exigir configuração adicional.

**O zmchel WHMCS Multimodule é gratuito.** Inclui um editor visual de páginas, conteúdos multilingues, menus, gestor de multimédia, campos SEO, mapas do site XML, redirecionamentos, regras de reescrita e importação/exportação.

## Definições do módulo

Escolha os idiomas que o módulo pode utilizar. Desativar um idioma não elimina o seu conteúdo.

- **Definições do módulo → Idiomas suportados → Ativar**
- **Base de dados do módulo → Corrigir Itens selecionados**
- **Regras de reescrita → Verificar regras → Adicionar ou atualizar regras**

O Nginx não lê .htaccess, pelo que estas regras não funcionam nesse servidor. Configure regras equivalentes no nginx.

## Gestor de páginas

- **Adicionar página → Nome da página → Slug da página → Guardar**
- **Editor de páginas → Definições de conteúdo → Definições de metadados → Definições do sitemap da página → Guardar tudo**
- **Gestor de páginas → Visitar**
- **Sitemap → Gerar sitemaps**

Só são permitidas letras latinas, hífenes e algarismos.

Utilizadores autenticados: só os utilizadores autenticados podem aceder à página; Visitantes: só os visitantes podem aceder; Misto: todos podem aceder, sendo a visibilidade controlada pelos blocos dentro da página.

A geração automática é executada após o cron do WHMCS quando é necessária uma atualização. A geração manual começa imediatamente.

## Guias por secção

- [Gestor de páginas](docs/pages_manager.md)
- [Editor de páginas](docs/pages_editor.md)
- [Gestor Multimédia](docs/media_manager.md)
- [Menus](docs/menu_manager.md)
- [Gestor de idiomas](docs/langs_manager.md)
- [Redirecionamentos](docs/redirects_manager.md)
- [Mapas do site](docs/sitemap_manager.md)
- [Regras de reescrita](docs/rewrite_manager.md)
- [Definições do módulo](docs/module_settings.md)
- [Base de dados do módulo](docs/module_db.md)

## Materiais adicionais

- [Paginação](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Dados estruturados](docs/module_structured_data.md)
- [Importação e exportação](docs/module_settings_transfer.md)
