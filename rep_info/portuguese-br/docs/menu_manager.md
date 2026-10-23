# Menus

Crie um menu, adicione páginas ou links personalizados e organize os itens arrastando-os. Escolha um item pai para o submenu e defina rótulos por idioma, visibilidade para visitantes ou clientes e dispositivos. Atribua uma posição; cada posição pode ter apenas um menu. Para links internos, escolha se a URL deve acompanhar o idioma atual. Confira o menu público no computador e no celular.

Em cada item, você pode definir título, descrição, classes CSS, `rel`, ícone e abertura em nova aba; páginas publicadas também podem ser adicionadas automaticamente. Escolha separadamente para computador e celular se o menu complementa ou substitui a navegação do WHMCS. O link de uma página do módulo é recalculado pelo slug, idioma e modo de URL atuais; um rótulo vazio usa o título traduzido ou o nome da página. A visita a uma página não altera o idioma do perfil do cliente. O servidor rejeita esquemas de URL inseguros e HTML nos rótulos.

## WHMCS

Ative os locais de menu do WHMCS desejados nas configurações do módulo. Cada local aceita um menu, mas o mesmo menu pode ser atribuído a vários locais. A visualização de desktop começa em 768 px de largura; em telas menores, usa-se a visualização móvel. Um local desativado deixa o menu padrão do WHMCS inalterado.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Nas rotas de sistema do WHMCS sem roteamento de idioma do módulo, os rótulos do menu usam o idioma salvo do cliente; as páginas do módulo usam o idioma da URL. Se o idioma padrão tiver rota própria, ele também recebe prefixo. A URL simples é `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Um link personalizado pode ficar sem localização, como `clientarea.php`. Ocultar um item pai oculta todo o ramo.

A URL de um item de página é recalculada com o slug atual e a tradução publicada. Se a tradução não existir, será usada a versão publicada no idioma padrão. Um link personalizado pode manter a URL informada; endereços externos, mailto, tel e âncoras não recebem prefixo de idioma. Rascunhos, páginas excluídas e páginas sem permissão de acesso não aparecem.

## zm_pb_menus

Os dados ficam nas tabelas `zm_pb_menus`, `zm_pb_menu_items` e `zm_pb_menu_locations`. Crie ou corrija essas tabelas em Banco de dados do módulo. A árvore aceita até 10 níveis e 300 itens; ao excluir um item pai, seus filhos sobem um nível.

## Instruções

- Criar menu
- Adicione páginas, publicações ou links personalizados.
- Arraste os itens para reordená-los. Defina a hierarquia pelo seletor de item pai ou pelos botões de movimentação.
- Usar o idioma da página atual
- Usar a URL informada sem alterações
- Rótulos em outros idiomas
- Visível para
- Dispositivos
- Cada posição pode ter apenas um menu. Ao selecionar uma posição, sua atribuição será transferida de outro menu para este.
- Os itens de nível superior se tornam colunas e os itens aninhados se tornam links. Use a URL # para um título sem link.
- As tabelas dos menus ainda não foram criadas. Adicione-as em Banco de Dados do módulo.

