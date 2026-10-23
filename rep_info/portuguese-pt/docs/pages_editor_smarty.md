# Smarty

- **Definições do módulo → Recolher variáveis Smarty → Utilizar variáveis Smarty recolhidas → Editor de páginas.**

## Catálogo de variáveis

Ative a recolha e utilização de variáveis Smarty nas definições do módulo. Depois, visite as páginas relevantes do site e atualize o editor. O catálogo guarda nomes, tipos e estrutura das variáveis, mas não valores reais nem dados pessoais. Se faltar uma variável, volte a visitar a página onde é usada.

## Editor e limites

Abra o bloco Smarty no editor de páginas e escolha as variáveis do catálogo. Use as condições e os ciclos permitidos; adicione `|escape` ao apresentar texto dinâmico. PHP, SQL, chamadas de métodos, inclusão de ficheiros e `nofilter` não são permitidos. Guarde a página e verifique o resultado público.

## resources/available_vars/

O catálogo apenas indica variáveis observadas numa página: não as disponibiliza noutra. O código é validado ao guardar e antes de aparecer; o bloco recebe uma cópia isolada dos valores permitidos. São permitidas condições, `foreach`, `assign` local e modificadores como `escape`, `default`, `count` e `date_format`. Os valores de saída são escapados automaticamente; escreva o HTML pretendido no modelo. Se faltarem dados ou o código falhar, o bloco fica vazio e o erro é registado no log PHP.

O catálogo em `resources/available_vars/` guarda nomes, tipos, estrutura e exemplos artificiais, não valores reais. Mostra onde uma variável foi observada sem a disponibilizar noutra página. Abra o editor com duplo clique no bloco Smarty. `Ctrl+Space` procura variáveis, `Ctrl+S` aplica o código e `F11` abre o ecrã inteiro. O código é executado isoladamente; sem os dados necessários, o bloco fica vazio e o aviso vai para o registo PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instruções

- **Recolher variáveis Smarty** — Ativar ou desativar a recolha de variáveis Smarty.
- **Utilizar variáveis Smarty recolhidas** — Ativar ou desativar a utilização das variáveis Smarty recolhidas no editor de páginas.
- Variável Smarty (PHP)
- Smarty: PHP, métodos de objetos, chamadas estáticas e nofilter não são permitidos.
- O modelo Smarty é demasiado grande.
- Smarty
- Editor Smarty

