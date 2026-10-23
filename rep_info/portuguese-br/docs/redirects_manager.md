# Redirecionamentos

Endereços exatos: origem → destino. A origem é um caminho a partir da raiz do site ou uma URL deste site. O destino é um caminho ou uma URL HTTP(S) completa. Uma regra sem parâmetros de consulta também corresponde a requisições que os contenham; o destino é usado exatamente como informado. As regras se aplicam às requisições GET/HEAD que chegam ao WHMCS.

Padrão: 14 dias. Contados desde a última alteração da página publicada ou de suas traduções ativas; caso nunca tenham sido alteradas, desde a criação. Defina 0 para não haver espera. As regras automáticas usam HTTP 301.

Os endereços das páginas de substituição redirecionam automaticamente para as páginas do sistema que elas substituem. Se uma substituição tiver vários destinos, será usado o primeiro configurado. Esses redirecionamentos funcionam sempre que as substituições estiverem ativadas, independentemente das regras do Gerenciador de Redirecionamentos.

Insira um caminho válido que comece com / ou uma URL HTTP(S) completa. A origem deve pertencer a este site; fragmentos # não são suportados.

## HTTP

As regras aceitam os códigos HTTP `301`, `302`, `303`, `307` e `308` e só se aplicam a requisições `GET`/`HEAD` que chegam ao WHMCS. A origem é comparada exatamente pelo caminho e pelos parâmetros de consulta, se informados; os parâmetros do destino substituem os antigos. O gerenciador grava regras em `zm_pb_redirects`, mas não cria a tabela durante uma requisição: use **Banco de dados do módulo**. As colunas de URL existentes têm limite de 128 bytes.

Regras manuais têm prioridade sobre as automáticas. Alterar o slug de uma página publicada pode criar um `301` automático para cada idioma ativo após o atraso configurado; publicar um rascunho não cria. Renomeações posteriores atualizam os destinos antigos. Uma regra com parâmetros de consulta tem prioridade sobre uma regra só para o caminho. A URL de origem deve pertencer a este site e não conter fragmento `#`.

## Instruções

- Origem
- Destino
- Ativado
- Desativado
