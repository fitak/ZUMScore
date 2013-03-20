<?php //netteCache[01]000389a:2:{s:4:"time";s:21:"0.42798200 1363739276";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:67:"C:\xampp\htdocs\TwitterBootstrapTest\app\templates\Score\list.latte";i:2;i:1363739272;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\xampp\htdocs\TwitterBootstrapTest\app\templates\Score\list.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'umx04nrk6g')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9841c9625d_content')) { function _lb9841c9625d_content($_l, $_args) { extract($_args)
;if (isset($scores)): ?><table class="table">
    <tr>
        <th>Uživatel</th>
        <th>Výsledek</th>
        <th>Kdy</th>
    </tr>
<?php $iterations = 0; foreach ($scores as $score): ?>    <tr>
        <td><?php echo Nette\Templating\Helpers::escapeHtml($score->ref("user_id")->name, ENT_NOQUOTES) ?></td>
        <td><?php echo Nette\Templating\Helpers::escapeHtml($score->result, ENT_NOQUOTES) ?></td>
        <td><?php echo Nette\Templating\Helpers::escapeHtml($template->date($score->date, 'j. m. Y, H:i:s'), ENT_NOQUOTES) ?></td>
    </tr>
<?php $iterations++; endforeach ?>
</table>
<?php endif ?>

<hr />
<div class="text-center">
    

    <div class="lead well">
        <?php echo Nette\Templating\Helpers::escapeHtml($baseUri, ENT_NOQUOTES) ?>/commit/%token%/%score%
        <hr />
        <a href="<?php echo htmlSpecialChars($basePath) ?>/files/scoreCommiter.jar" class="btn btn-large btn-success">Stáhnout knihovnu</a>
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
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 