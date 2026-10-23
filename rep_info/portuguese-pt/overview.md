# Multimódulo gratuito para WHMCS

**Antes de utilizar o módulo, gere salts exclusivos e coloque-os em `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` e `ZM_PB_NONCE_SALT`.

**Antes da primeira utilização, abra Definições do módulo → Idiomas suportados e ative os idiomas necessários.**

O módulo foi desenvolvido e testado com **WHMCS 8.13.1 a 8.13.7**. A compatibilidade com PHP foi verificada da versão **7.4 à 8.5**. O suporte para Apache é completo. Também pode funcionar com Nginx, mas o encaminhamento por idioma na página inicial poderá exigir configuração adicional.

**O zmchel WHMCS Multimodule é gratuito.** Inclui um editor visual de páginas, conteúdos multilingues, menus, gestor de multimédia, campos SEO, mapas do site XML, redirecionamentos, regras de reescrita e importação/exportação. Consulte as [instruções](instruction.md).

## Desenvolvimento futuro

- Adicionar páginas aninhadas e categorias de páginas.
- Dividir o módulo atual em componentes.
- Criar um gestor de permissões para a administração.
- Aumentar os idiomas predefinidos em `supported_langs.php`.
- Criar um editor de código para os ficheiros `.tpl` do módulo e os temas de cliente do WHMCS.
- Criar um gestor de ficheiros de idioma do módulo, de outros módulos e do WHMCS.
- Melhorar o gestor de multimédia e criar um gestor SEO mais completo.
- Gerar mapas do site multilingues e uma página de mapa do site HTML.
- Adicionar estatísticas de utilização ao gestor de páginas.
- Adicionar minificação de JS/CSS/HTML, cache de páginas e otimização de tabelas.
- Criar um sistema de atualizações adequado.

Estas são **ideias para o futuro, não um plano fixo**.

## Sugerir uma ideia

[Envie a sua sugestão](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) com o assunto «Предложение по мультимодулю».

## Fazer uma pergunta

[Envie a sua pergunta por e-mail](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) com o assunto «Задать вопрос по модулю».
