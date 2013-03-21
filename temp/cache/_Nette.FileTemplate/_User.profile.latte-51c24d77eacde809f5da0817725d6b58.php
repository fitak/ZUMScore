<?php //netteCache[01]000391a:2:{s:4:"time";s:21:"0.04888300 1363891463";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:69:"C:\xampp\htdocs\TwitterBootstrapTest\app\templates\User\profile.latte";i:2;i:1363891458;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\xampp\htdocs\TwitterBootstrapTest\app\templates\User\profile.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'wbiv3qgt0b')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block profileContent
//
if (!function_exists($_l->blocks['profileContent'][] = '_lb14fbe3273f_profileContent')) { function _lb14fbe3273f_profileContent($_l, $_args) { extract($_args)
;if (isset($scores)): ?><table class="table">
            <tr>
                <th>Počet uzlů</th>
                <th>Kdy</th>
<?php if ($user->isInRole('admin') || $user->getId() == $userId): ?>                <th>Operace</th>
<?php endif ?>
            </tr>
<?php $iterations = 0; foreach ($scores as $score): ?>            <tr class="<?php if (!$score->ref("score_id")->valid): ?>
error<?php endif ?>">
                <td><?php echo Nette\Templating\Helpers::escapeHtml($score["count(*)"], ENT_NOQUOTES) ?></td>
                <td><?php echo Nette\Templating\Helpers::escapeHtml($template->date($score->ref("score_id")->date, 'j. m. Y, H:i:s'), ENT_NOQUOTES) ?></td>
<?php if ($user->isInRole('admin') || $user->getId() == $userId): ?>                <td>
                    <a class="btn btn-mini" href="<?php echo htmlSpecialChars($_control->link("Score:displayScore", array('id'=>$score->score_id))) ?>
">Uzly</a>
                </td>
<?php endif ?>
            </tr>
<?php $iterations++; endforeach ?>
</table>
<?php endif ;
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
call_user_func(reset($_l->blocks['profileContent']), $_l, get_defined_vars()) ; 