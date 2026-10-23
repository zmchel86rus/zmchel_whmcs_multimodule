# Definições do módulo

## WHMCS

Escolha os idiomas que o módulo pode utilizar. Desativar um idioma não elimina o seu conteúdo. Se utilizar URLs amigáveis no Apache, atualize as regras no gestor de reescrita depois de alterar os idiomas.

- [Importação e exportação](module_settings_transfer.md)

## Instruções

- **URLs amigáveis** — Ativar URLs amigáveis, incluindo URLs do sistema.
- **Encaminhamento por idioma** — Ativar ou desativar as rotas de idioma. Quando ativadas, as páginas ficam disponíveis em /de/, /en/, /es/ e outros prefixos de idiomas suportados. Quando desativadas, um único URL de página apresenta o conteúdo no idioma configurado pelo utilizador.
- **Rota do idioma predefinido** — Adiciona um prefixo ao idioma predefinido e redireciona para ele as páginas do módulo sem prefixo.
- **Modo de manutenção (módulo)** — Ativar ou desativar o modo de manutenção do módulo. Este modo menos restritivo permite a execução dos hooks do WHMCS e de outros componentes, ao contrário do modo de manutenção do sistema.
- **Recolher variáveis Smarty** — Ativar ou desativar a recolha de variáveis Smarty.
- **Utilizar variáveis Smarty recolhidas** — Ativar ou desativar a utilização das variáveis Smarty recolhidas no editor de páginas.
- **Substituições de páginas** — Ativar ou desativar as substituições de páginas.
- **Frequência de atualização** — Se nada estiver selecionado, o sitemap é atualizado diariamente.
- **Sitemap HTML** — Quando ativado, /html-sitemap apresenta o sitemap como uma página HTML normal; sitemap.xml não é afetado.
- **Cabeçalho do site** — HTML personalizado para a secção \<head>, incluindo \<script> e \<style>.
- **Rodapé do site** — HTML personalizado antes de \</body>, incluindo \<script> e \<style>.
- **Editar robots.txt**
