# Smarty

- **Configurações do módulo → Coletar variáveis Smarty → Usar variáveis Smarty coletadas → Editor de páginas.**

## Catálogo de variáveis

Ative a coleta e o uso de variáveis Smarty nas configurações do módulo. Depois, visite as páginas relevantes do site e atualize o editor. O catálogo guarda nomes, tipos e estrutura das variáveis, mas não valores reais nem dados pessoais. Se faltar uma variável, acesse novamente a página em que ela é usada.

## Editor e limites

Abra o bloco Smarty no editor de páginas e escolha as variáveis no catálogo. Use as condições e os laços permitidos; adicione `|escape` ao exibir texto dinâmico. PHP, SQL, chamadas de métodos, inclusão de arquivos e `nofilter` não são permitidos. Salve a página e confira o resultado público.

## resources/available_vars/

O catálogo apenas orienta sobre variáveis observadas em uma página: ele não as disponibiliza em outra. O código é validado ao salvar e antes de aparecer; o bloco recebe uma cópia isolada dos valores permitidos. São aceitos condições, `foreach`, `assign` local e modificadores como `escape`, `default`, `count` e `date_format`. Os valores de saída são escapados automaticamente; escreva o HTML desejado no modelo. Se faltarem dados ou o código falhar, o bloco ficará vazio e o erro será registrado no log PHP.

O catálogo em `resources/available_vars/` guarda nomes, tipos, estrutura e exemplos artificiais, não valores reais. Ele mostra onde uma variável foi observada, mas não a disponibiliza em outra página. Abra o editor com um clique duplo no bloco Smarty. `Ctrl+Space` procura variáveis, `Ctrl+S` aplica o código e `F11` abre a tela cheia. O código roda isoladamente; sem os dados necessários, o bloco fica vazio e o aviso vai para o log do PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instruções

- **Coletar variáveis Smarty** — Ativar ou desativar a coleta de variáveis Smarty.
- **Usar variáveis Smarty coletadas** — Ativar ou desativar o uso das variáveis Smarty coletadas no editor de páginas.
- Variável Smarty (PHP)
- Smarty: PHP, métodos de objetos, chamadas estáticas e nofilter são proibidos.
- O template Smarty é grande demais.
- Smarty
- Editor Smarty

