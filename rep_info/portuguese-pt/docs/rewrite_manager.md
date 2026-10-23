# Regras de reescrita

## WHMCS

Regras para URLs com idiomas, incluindo páginas sob /ru/, /en/ e outros prefixos. Os idiomas são definidos em supported_langs.php; as regras são inseridas em .htaccess antes das regras do WHMCS.

O Nginx não lê .htaccess, pelo que estas regras não funcionam nesse servidor. Configure regras equivalentes no nginx.

Foi detetada uma configuração nginx → Apache. Estas regras só funcionam para pedidos encaminhados para o Apache; o nginx não lê .htaccess.

Depois de adicionar ou eliminar uma regra, clique em “Adicionar ou atualizar regras” para aplicar as alterações a .htaccess.

## .htaccess

Abra o gestor e compare as regras com o `.htaccess` principal do site. Para uma regra personalizada, guarde o padrão de URL, o destino e as flags; depois clique em **Adicionar ou atualizar regras** para escrever o bloco antes das regras WHMCS. Verifique novamente o estado e abra uma página publicada no idioma predefinido e noutro idioma. Um padrão demasiado amplo pode afetar outras páginas. Na configuração Nginx → Apache, as regras valem apenas para pedidos encaminhados ao Apache.

## Instruções

- Verificar regras
- Adicionar ou atualizar regras
- Remover todas as regras de .htaccess
- Padrão do URL
- Destino
- Sinalizadores
