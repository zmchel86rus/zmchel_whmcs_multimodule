# Menus

Crie um menu, adicione páginas ou ligações personalizadas e ordene os itens arrastando-os. Escolha um item principal para o submenu e defina etiquetas por idioma, visibilidade para visitantes ou clientes e dispositivos. Atribua uma posição; cada posição pode ter apenas um menu. Para ligações internas, escolha se o URL deve seguir o idioma atual. Verifique o menu público no computador e no telemóvel.

Em cada item, pode definir título, descrição, classes CSS, `rel`, ícone e abertura num novo separador; as páginas publicadas também podem ser adicionadas automaticamente. Escolha separadamente para computador e telemóvel se o menu complementa ou substitui a navegação do WHMCS. A ligação de uma página do módulo é recalculada segundo o slug, idioma e modo de URL atuais; um rótulo vazio usa o título traduzido ou o nome da página. Visitar uma página não altera o idioma do perfil do cliente. O servidor rejeita esquemas de URL inseguros e HTML nos rótulos.

## WHMCS

Ative as posições de menu WHMCS pretendidas nas definições do módulo. Cada posição aceita um menu, mas o mesmo menu pode ser atribuído a várias posições. A vista de computador começa aos 768 px de largura; em ecrãs mais estreitos usa-se a vista móvel. Uma posição desativada não altera o menu padrão do WHMCS.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Nas rotas de sistema do WHMCS sem encaminhamento linguístico do módulo, os rótulos do menu usam o idioma guardado do cliente; as páginas do módulo usam o idioma do URL. Se o idioma predefinido tiver rota própria, também recebe prefixo. O URL simples é `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Uma ligação personalizada pode ficar sem localização, como `clientarea.php`. Ocultar um elemento pai oculta todo o ramo.

O URL de um item de página é recalculado a partir do slug atual e da tradução publicada. Se a tradução não existir, usa-se a versão publicada no idioma predefinido. Uma ligação personalizada pode manter o URL introduzido; endereços externos, mailto, tel e âncoras não recebem prefixo de idioma. Rascunhos, páginas eliminadas e páginas sem permissão de acesso não aparecem.

## zm_pb_menus

Os dados ficam nas tabelas `zm_pb_menus`, `zm_pb_menu_items` e `zm_pb_menu_locations`. Crie ou repare estas tabelas em Base de dados do módulo. A árvore admite até 10 níveis e 300 itens; ao eliminar um elemento principal, os seus subelementos sobem um nível.

## Instruções

- Criar menu
- Adicione páginas, artigos ou ligações personalizadas.
- Arraste os itens para alterar a ordem. Defina os níveis através do seletor de item principal ou dos botões de movimentação.
- Utilizar o idioma da página atual
- Utilizar o URL introduzido sem alterações
- Etiquetas noutros idiomas
- Visível para
- Dispositivos
- Cada localização só pode ter um menu. Ao selecionar uma localização, a respetiva atribuição é transferida de outro menu para este.
- Os itens de nível superior tornam-se colunas e os itens aninhados tornam-se ligações. Utilize o URL # para um título sem ligação.
- As tabelas dos menus ainda não foram criadas. Adicione-as na Base de Dados do módulo.

