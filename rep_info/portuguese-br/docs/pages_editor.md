# Editor de páginas

- [Paginação](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Dados estruturados](module_structured_data.md)

## Conteúdo e idiomas

Na guia Conteúdo, selecione um idioma e arraste blocos GrapesJS para a área de edição. Altere textos, imagens e opções do bloco selecionado e salve aquele idioma. Há seções, colunas, tabelas, FAQ, acordeões, formulários de contato, listas, paginação, áreas para visitantes/clientes e código personalizado. Copie a estrutura ou o conteúdo para outro idioma e traduza os textos antes de publicar.

Com URLs amigáveis e roteamento por idioma, o idioma padrão usa `/contact/` apenas quando sua rota opcional está desativada; os demais usam um prefixo, como `/pt/contact/` para português de Portugal e `/pt-BR/contact/` para português do Brasil. Nos blocos Link e Botão, ative a opção de incluir o idioma atual somente para páginas traduzidas do site. Deixe-a desligada para links externos, arquivos, `mailto:`, `tel:` e rotas WHMCS sem tradução. Teste os links em vários idiomas.

## WHMCS

Nas configurações básicas, confira nome, slug, tipo, status, acesso e idiomas. O idioma padrão do WHMCS deve estar ativado no módulo; uma página publicada precisa de conteúdo no idioma exibido.

## SEO

Preencha título e descrição para cada idioma e confira canonical, robots, Open Graph, trilha de navegação e Schema. Na aba do mapa do site, defina frequência e prioridade para uma página pública que não seja de sistema. Salve e confira a URL pública e o XML.

## Formulário de contato

Adicione o bloco **Formulário de contato**. Escolha um **ticket WHMCS** e departamento de suporte ou **e-mail** e destinatário; preencha título, descrição, assunto e texto do botão. Defina nome, tipo, obrigatoriedade e validação para cada campo. Ticket de visitante exige campos com os papéis de nome e e-mail do remetente. Coloque uma opção por linha na lista suspensa, por exemplo `sales : Vendas`. Crie um campo separado para cada consentimento e use o CAPTCHA configurado no WHMCS. Salve e envie um teste real como visitante; confira ticket ou entrega, erros e limpeza do formulário. O indicador verde do editor não confirma a entrega; configure SMTP no WHMCS se `mail()` falhar.

## Instruções

- Contêiner de layout flex aninhado. Arraste outros blocos para dentro dele.
- Contêiner CSS Grid aninhado. Arraste outros blocos para dentro dele.
- Carrossel Bootstrap aninhado. Arraste blocos para dentro dele; cada um se torna um slide.
- Todos os blocos abaixo deste bloco são exibidos apenas para usuários autenticados. Funciona somente quando o tipo de acesso da página é Misto.
- Todos os blocos abaixo deste bloco são exibidos apenas para visitantes. Funciona somente quando o tipo de acesso da página é Misto.
- **Título da página**
- **Meta descrição**
- **URL canônica**
- **Robots** — index, follow / noindex, nofollow. Controla a indexação.
- **Tipo de Schema** — Quando desativado, a marcação JSON do Schema.org não é exibida nesta página.
