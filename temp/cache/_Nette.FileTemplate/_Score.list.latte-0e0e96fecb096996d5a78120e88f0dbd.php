<?php //netteCache[01]000389a:2:{s:4:"time";s:21:"0.03078700 1364204148";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:67:"C:\xampp\htdocs\TwitterBootstrapTest\app\templates\Score\list.latte";i:2;i:1364204146;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\xampp\htdocs\TwitterBootstrapTest\app\templates\Score\list.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '4gqnznxmtm')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbb0f7feda36_content')) { function _lbb0f7feda36_content($_l, $_args) { extract($_args)
?><div class="alert alert-info">
    Na server byla nahrána nová mapa ostrova, takže původní výsledky byly smazány. Teď se jede naostro :)
</div>

<?php if (isset($scores)): ?><table class="table">
    <tr>
        <th>Uživatel</th>
        <th>Počet uzlů</th>
        <th>Kdy</th>
<?php if ($user->isInRole('admin')): ?>        <th>Operace</th>
<?php endif ?>
    </tr>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($scores) as $score): ?>
    <tr class="<?php if (!$score->valid): ?>error invalid-result<?php endif ?>">
        <td><span class="badge <?php if ($iterator->isFirst()): ?>badge-success<?php endif ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($iterator->getCounter(), ENT_NOQUOTES) ?>
</span> <a href="<?php echo htmlSpecialChars($_control->link("User:profile", array('id'=>$score->user_id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($score->name, ENT_NOQUOTES) ?></a></td>
        <td><?php echo Nette\Templating\Helpers::escapeHtml($score->min_nodes_count, ENT_NOQUOTES) ?></td>
        <td><?php echo Nette\Templating\Helpers::escapeHtml($template->date($score->date, 'j. m. Y, H:i:s'), ENT_NOQUOTES) ?></td>
<?php if ($user->isInRole('admin')): ?>        <td class="text-center">
<?php if ($score->valid): ?>
                <a class="btn btn-mini btn-warning" href="<?php echo htmlSpecialChars($_control->link("changeValidity!", array('id'=>$score->score_id))) ?>
">Invalidate</a>
<?php else: ?>
                <a class="btn btn-mini" href="<?php echo htmlSpecialChars($_control->link("changeValidity!", array('id'=>$score->score_id))) ?>
">Validate</a>
<?php endif ?>
            <a class="btn btn-mini btn-danger" href="<?php echo htmlSpecialChars($_control->link("delete!", array('id'=>$score->score_id))) ?>
">Smazat</a>
            <a class="btn btn-mini" href="<?php echo htmlSpecialChars($_control->link("displayScore", array('id'=>$score->score_id))) ?>
">Uzly</a>
        </td>
<?php endif ?>
    </tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</table>
<?php endif ?>

<hr />
<div class="text-center">
    <div class="lead well">
        <?php echo Nette\Templating\Helpers::escapeHtml($baseUri, ENT_NOQUOTES) ?>/commit/%token%/%apiversion%
        <hr />
        <a href="<?php echo htmlSpecialChars($basePath) ?>/files/ScoreCommit.zip" class="btn btn-large btn-success">Stáhnout knihovnu</a>
    </div>
    
</div>
<?php
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