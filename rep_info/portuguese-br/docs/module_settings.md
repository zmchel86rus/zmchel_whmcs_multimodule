# Configurações do módulo

## WHMCS

Escolha os idiomas que o módulo pode usar. Desativar um idioma não exclui seu conteúdo. Se você usa URLs amigáveis no Apache, atualize as regras no gerenciador de reescrita após alterar os idiomas.

- [Importação e exportação](module_settings_transfer.md)

## Instruções

- **URLs amigáveis** — Ativar URLs amigáveis, incluindo URLs do sistema.
- **Roteamento de idioma** — Ativar ou desativar as rotas de idioma. Quando ativadas, as páginas ficam disponíveis em /de/, /en/, /es/ e outros prefixos de idiomas suportados. Quando desativadas, uma única URL da página exibe o conteúdo no idioma configurado pelo usuário.
- **Rota do idioma padrão** — Adiciona um prefixo ao idioma padrão e redireciona para ele as páginas do módulo sem prefixo.
- **Modo de manutenção (módulo)** — Ativar ou desativar o modo de manutenção do módulo. Esse modo menos restritivo permite executar os hooks do WHMCS e outros componentes, ao contrário do modo de manutenção do sistema.
- **Coletar variáveis Smarty** — Ativar ou desativar a coleta de variáveis Smarty.
- **Usar variáveis Smarty coletadas** — Ativar ou desativar o uso das variáveis Smarty coletadas no editor de páginas.
- **Substituições de páginas** — Ativar ou desativar as substituições de páginas.
- **Frequência de atualização** — Se nenhuma opção for selecionada, o sitemap será atualizado diariamente.
- **Sitemap HTML** — Quando ativado, /html-sitemap exibe o sitemap como uma página HTML comum; sitemap.xml não é afetado.
- **Cabeçalho do site** — HTML personalizado para a seção \<head>, incluindo \<script> e \<style>.
- **Rodapé do site** — HTML personalizado antes de \</body>, incluindo \<script> e \<style>.
- **Editar robots.txt**
