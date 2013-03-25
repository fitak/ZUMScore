<?php //netteCache[01]000391a:2:{s:4:"time";s:21:"0.07353200 1364209204";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:69:"C:\xampp\htdocs\TwitterBootstrapTest\app\templates\Help\default.latte";i:2;i:1364209182;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\xampp\htdocs\TwitterBootstrapTest\app\templates\Help\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '5hasox1222')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9a36c02170_content')) { function _lb9a36c02170_content($_l, $_args) { extract($_args)
?><div class="container">
    <h1>Nápověda</h1>
    <p class="lead">
        Použití je více než snadné! Stačí k tomu pár kroků
    </p>
    
    <ol>
        <li>Aktivujte si účet a přihlašte se</li>
        <li><a href="<?php echo htmlSpecialChars($basePath) ?>/files/ScoreCommit.zip" class="btn btn-success">Stáhnout knihovnu</a> nebo <a class="btn" href="<?php echo htmlSpecialChars($_control->link("Score:commit")) ?>
">Online commit</a></li>
        <li>Přidejte jí do projektu (i s obsahem lib) v NetBeans -> je to v Properties někde :)</li>
        <li>Vygenerujte si na této stránce token pro komunikaci</li>
        <li>Pro odeslání výsledku použijte následující kód<br />
           <pre>
                import cz.cvut.fit.zum.utils.ScoreCommit.*;
                ...
                ScoreCommiter sc = new ScoreCommiter(
                                        new Token(" /* vygenerovany token */ "),
                                        " /* adresa sluzby, je na uvodni strance */ ");
                Score s = new Score();
                s.addNode(nodeId); // pridejte nalezene uzly
                ...
                sc.commitScore(new Score()); // commit - muste vterinku pockat a v konzoli se vypise JSON odpoved</pre>
        
        </li>
        <li>A to je vse :)</li>
    </ol>
</div><?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 