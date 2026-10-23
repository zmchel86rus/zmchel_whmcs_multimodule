# Regras de reescrita

## WHMCS

Regras para URLs de idiomas, incluindo páginas em /ru/, /en/ e outros prefixos. Os idiomas são definidos em supported_langs.php; as regras são inseridas em .htaccess antes das regras do WHMCS.

O Nginx não lê .htaccess, portanto estas regras não funcionam nele. Configure regras equivalentes no nginx.

Foi detectada uma configuração nginx → Apache. Estas regras funcionam apenas para requisições encaminhadas ao Apache; o nginx não lê .htaccess.

Após adicionar ou excluir uma regra, clique em “Adicionar ou atualizar regras” para aplicar as alterações em .htaccess.

## .htaccess

Abra o gerenciador e compare as regras com o `.htaccess` principal do site. Para uma regra personalizada, salve o padrão de URL, o destino e as flags; depois clique em **Adicionar ou atualizar regras** para gravar o bloco antes das regras do WHMCS. Confira o estado novamente e abra uma página publicada no idioma padrão e em outro idioma. Um padrão amplo demais pode afetar outras páginas. Na configuração Nginx → Apache, as regras valem apenas para requisições encaminhadas ao Apache.

## Instruções

- Verificar regras
- Adicionar ou atualizar regras
- Remover todas as regras de .htaccess
- Padrão da URL
- Destino
- Flags
