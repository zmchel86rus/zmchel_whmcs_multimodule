# Smarty

- **Mipangilio ya moduli → Kusanya vigeu vya Smarty → Tumia vigeu vya Smarty vilivyokusanywa → Kihariri cha kurasa.**

## Katalogi ya vigeu

Washa ukusanyaji na matumizi ya vigeu vya Smarty kwenye mipangilio ya moduli, kisha fungua kurasa husika za tovuti na upakie upya kihariri. Katalogi huhifadhi majina, aina na muundo wa vigeu, lakini haihifadhi thamani halisi au taarifa binafsi. Ikiwa kigeu hakionekani, tembelea tena ukurasa unaokitumia.

## Kihariri na mipaka

Fungua bloku ya Smarty kwenye kihariri cha kurasa na uchague vigeu kutoka katalogi. Tumia masharti na mizunguko inayoruhusiwa; ongeza `|escape` unapoonyesha maandishi yanayobadilika. PHP, SQL, miito ya mbinu, kuingiza faili na `nofilter` haviruhusiwi. Hifadhi ukurasa na ukague matokeo ya umma.

## resources/available_vars/

Katalogi ni mwongozo tu wa vigeu vilivyoonekana kwenye ukurasa: haivifanyi vipatikane kwenye ukurasa mwingine. Msimbo hukaguliwa wakati wa kuhifadhi na kabla ya kuonyesha; bloku hupata nakala iliyotengwa ya thamani zinazoruhusiwa. Masharti, `foreach`, `assign` ya ndani na vigeuzi kama `escape`, `default`, `count` na `date_format` vinaruhusiwa. Thamani za matokeo hu-escape kiotomatiki; andika HTML unayotaka kwenye kiolezo. Data ikikosekana au msimbo ukishindwa, bloku hubaki tupu na kosa huandikwa kwenye logi ya PHP.

Katalogi katika `resources/available_vars/` huhifadhi majina, aina, muundo na mifano iliyobuniwa, si thamani halisi. Inaonyesha mahali kigezo kilipoonekana, lakini haikifanyi kipatikane kwenye ukurasa mwingine. Bofya mara mbili bloku ya Smarty kufungua kihariri. `Ctrl+Space` hutafuta vigezo, `Ctrl+S` hutumia msimbo na `F11` hufungua skrini nzima. Msimbo huendeshwa pekee; data ikikosekana, bloku hubaki tupu na onyo huandikwa kwenye logi ya PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Maelekezo

- **Kusanya vigeu vya Smarty** — Washa au zima ukusanyaji wa vigeu vya Smarty.
- **Tumia vigeu vya Smarty vilivyokusanywa** — Washa au zima matumizi ya vigeu vya Smarty vilivyokusanywa katika kihariri cha kurasa.
- Kigeu cha Smarty (PHP)
- Smarty: PHP, mbinu za vitu, miito tuli na nofilter haviruhusiwi.
- Kiolezo cha Smarty ni kikubwa mno.
- Smarty
- Kihariri cha Smarty

