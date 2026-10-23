# Redirecionamentos

Endereços exatos: origem → destino. A origem é um caminho a partir da raiz do site ou um URL deste site. O destino é um caminho ou um URL HTTP(S) completo. Uma regra sem parâmetros de consulta também corresponde a pedidos que os incluam; o destino é utilizado tal como foi introduzido. As regras aplicam-se aos pedidos GET/HEAD que chegam ao WHMCS.

Predefinição: 14 dias. Contados desde a última alteração da página publicada ou das suas traduções ativas; caso nunca tenha sido alterada, desde a criação. Defina 0 para não haver atraso. As regras automáticas utilizam HTTP 301.

Os endereços das páginas de substituição redirecionam automaticamente para as páginas do sistema que substituem. Se uma substituição tiver vários destinos, é utilizado o primeiro configurado. Estes redirecionamentos funcionam sempre que as substituições estiverem ativadas, independentemente das regras do Gestor de Redirecionamentos.

Introduza um caminho válido começado por / ou um URL HTTP(S) completo. A origem tem de pertencer a este site; os fragmentos # não são suportados.

## HTTP

As regras aceitam os códigos HTTP `301`, `302`, `303`, `307` e `308` e só se aplicam a pedidos `GET`/`HEAD` que chegam ao WHMCS. A origem corresponde exatamente ao caminho e aos parâmetros de consulta, se indicados; os parâmetros do destino substituem os anteriores. O gestor guarda regras em `zm_pb_redirects`, mas não cria a tabela durante um pedido: use **Base de dados do módulo**. As colunas URL existentes têm o limite de 128 bytes.

As regras manuais têm prioridade sobre as automáticas. Alterar o slug de uma página publicada pode criar um `301` automático para cada idioma ativo após a espera configurada; publicar um rascunho não o cria. Renomeações posteriores atualizam os destinos antigos. Uma regra com parâmetros de consulta tem prioridade sobre uma regra só para o caminho. O URL de origem deve pertencer a este site e não conter fragmento `#`.

## Instruções

- Origem
- Destino
- Ativado
- Desativado
