# Editor de páginas

- [Paginação](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Dados estruturados](module_structured_data.md)

## Conteúdo e idiomas

No separador Conteúdo, escolha um idioma e arraste blocos GrapesJS para a área de edição. Edite texto, imagens e opções do bloco selecionado e guarde esse idioma. Existem secções, colunas, tabelas, FAQ, acordeões, formulários de contacto, listas, paginação, áreas para visitantes/clientes e código personalizado. Copie a estrutura ou o conteúdo para outro idioma e traduza o texto antes de publicar.

Com URLs amigáveis e encaminhamento por idioma, o idioma predefinido usa `/contact/` apenas quando a sua rota opcional está desativada; os restantes usam um prefixo, como `/pt/contact/` para português de Portugal e `/pt-BR/contact/` para português do Brasil. Nos blocos Ligação e Botão, ative a inclusão do idioma atual apenas para páginas traduzidas do site. Desative-a para endereços externos, ficheiros, `mailto:`, `tel:` e rotas WHMCS sem versões traduzidas. Verifique as ligações em vários idiomas.

## WHMCS

Nas definições básicas, verifique nome, slug, tipo, estado, acesso e idiomas. O idioma predefinido do WHMCS deve estar ativo no módulo; uma página publicada precisa de conteúdo no idioma apresentado.

## SEO

Preencha título e descrição para cada idioma e verifique canonical, robots, Open Graph, trilho de navegação e Schema. No separador do mapa do site, defina frequência e prioridade para uma página pública que não seja de sistema. Guarde e verifique o URL público e o XML.

## Formulário de contacto

Adicione o bloco **Formulário de contacto**. Escolha um **ticket WHMCS** e departamento de suporte ou **e-mail** e destinatário; preencha título, descrição, assunto e texto do botão. Defina nome, tipo, obrigatoriedade e validação para cada campo. Um ticket de visitante exige campos com os papéis de nome e e-mail do remetente. Escreva uma opção por linha na lista, por exemplo `sales : Vendas`. Crie um campo separado para cada consentimento e use o CAPTCHA configurado no WHMCS. Guarde e envie um teste real como visitante; verifique ticket ou entrega, erros e limpeza do formulário. O indicador verde do editor não confirma a entrega; configure SMTP no WHMCS se `mail()` falhar.

## Instruções

- Contentor de disposição flex aninhado. Arraste outros blocos para o interior.
- Contentor CSS Grid aninhado. Arraste outros blocos para o interior.
- Carrossel Bootstrap aninhado. Arraste blocos para o interior; cada um torna-se um diapositivo.
- Todos os blocos abaixo deste bloco são apresentados apenas a utilizadores autenticados. Funciona apenas quando o tipo de acesso da página é Misto.
- Todos os blocos abaixo deste bloco são apresentados apenas a visitantes. Funciona apenas quando o tipo de acesso da página é Misto.
- **Título da página**
- **Meta descrição**
- **URL canónico**
- **Robots** — index, follow / noindex, nofollow. Controla a indexação.
- **Tipo de Schema** — Quando desativado, a marcação JSON do Schema.org não é apresentada nesta página.
