# zmchel WHMCS Multimodule: instruções

**O zmchel WHMCS Multimodule é gratuito.** Reúne um editor visual de páginas, conteúdo multilíngue, menus, gerenciador de mídia, campos de SEO, sitemaps XML, redirecionamentos, regras de reescrita e importação/exportação.

## Antes do primeiro uso

**Antes do primeiro uso, abra Configurações do módulo → Idiomas suportados e ative os idiomas necessários.**

A cada ativação, o módulo gera automaticamente novos salts e os grava em `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Confira se os três valores salt estão preenchidos.

## Compatibilidade e funcionamento testados

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Compatibilidade com servidores web

O suporte ao Apache é completo. Ele também pode funcionar com Nginx, mas o roteamento de idiomas na página inicial pode exigir configuração adicional.

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
