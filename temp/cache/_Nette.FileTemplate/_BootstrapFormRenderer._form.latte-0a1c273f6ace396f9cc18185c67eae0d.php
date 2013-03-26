<?php //netteCache[01]000413a:2:{s:4:"time";s:21:"0.09909500 1363797507";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:91:"C:\xampp\htdocs\TwitterBootstrapTest\app\components\Kdyby\BootstrapFormRenderer\@form.latte";i:2;i:1363708128;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\xampp\htdocs\TwitterBootstrapTest\app\components\Kdyby\BootstrapFormRenderer\@form.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'cjqrfkze3l')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block form
//
if (!function_exists($_l->blocks['form'][] = '_lbc80c9267a0_form')) { function _lbc80c9267a0_form($_l, $_args) { extract($_args)
;$form = $__form = $_form = Kdyby\BootstrapFormRenderer\Latte\FormMacros::renderFormPart($form, array(), get_defined_vars()) ?>

<?php call_user_func(reset($_l->blocks['errors']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['body']), $_l, get_defined_vars()) ; Nette\Latte\Macros\FormMacros::renderFormEnd($__form) ;
}}

//
// block errors
//
if (!function_exists($_l->blocks['errors'][] = '_lbd3a3f79f4e_errors')) { function _lbd3a3f79f4e_errors($_l, $_args) { extract($_args)
;$iterations = 0; foreach ($renderer->findErrors() as $error): ?><div class="alert alert-error">
    <a class="close" data-dismiss="alert">×</a><?php echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ?>

</div>
<?php $iterations++; endforeach ;
}}

//
// block body
//
if (!function_exists($_l->blocks['body'][] = '_lb3065cc5b82_body')) { function _lb3065cc5b82_body($_l, $_args) { extract($_args)
;$iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($renderer->findGroups()) as $group): ?>

<?php call_user_func(reset($_l->blocks['group']), $_l, get_defined_vars()) ; $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>


<?php call_user_func(reset($_l->blocks['controls']), $_l, array('controls' => $renderer->findControls()) + get_defined_vars()) ;
}}

//
// block group
//
if (!function_exists($_l->blocks['group'][] = '_lb5b17ab036f_group')) { function _lb5b17ab036f_group($_l, $_args) { extract($_args)
?>    <fieldset<?php echo $group->attrs->attributes() ?>>
<?php if ($group->label): ?>        <legend><?php echo Nette\Templating\Helpers::escapeHtml($group->label, ENT_NOQUOTES) ?></legend>
<?php endif ;if ($group->description): ?>        <p><?php echo Nette\Templating\Helpers::escapeHtml($group->description, ENT_NOQUOTES) ?></p>
<?php endif ?>

<?php $controls = $group->controls ;if (isset($group->template) && $group->template): Nette\Latte\Macros\CoreMacros::includeTemplate("$group->template", array('group' => $group, 'controls' => $controls, 'form' => $form, '_form' => $form) + $template->getParameters(), $_l->templates['cjqrfkze3l'])->render() ?>

<?php else: call_user_func(reset($_l->blocks['controls']), $_l, get_defined_vars())  ?>

<?php endif ?>
    </fieldset>
<?php
}}

//
// block controls
//
if (!function_exists($_l->blocks['controls'][] = '_lb224bcc2bbb_controls')) { function _lb224bcc2bbb_controls($_l, $_args) { extract($_args)
;$iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($controls) as $control): if ($renderer->isSubmitButton($control)): ?>
                <?php if ($iterator->first): echo '<div class="form-actions">' ;endif ?>

<?php $_input = (is_object($renderer->getControlName($control)) ? $renderer->getControlName($control) : $_form[$renderer->getControlName($control)]); echo $_input->getControl()->addAttributes(array()) ?>
                <?php if (!$renderer->isSubmitButton($iterator->nextValue)): echo "</div>" ;endif ?>

<?php continue ;endif ;$attrs = array('input' => array(), 'label' => array()) ?>

<?php call_user_func(reset($_l->blocks['control']), $_l, get_defined_vars())  ?>

            <?php if ($renderer->isSubmitButton($iterator->nextValue)): echo '<div class="form-actions">' ;endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;
}}

//
// block control
//
if (!function_exists($_l->blocks['control'][] = '_lbc66616eec9_control')) { function _lbc66616eec9_control($_l, $_args) { extract($_args)
;if ($_l->ifs[] = ($control->getOption('pairContainer'))): ?>            <div<?php echo $control->getOption('pairContainer')->attributes() ?>>
<?php endif ;$name = $renderer->getControlName($control);
                    $description = $renderer->getControlDescription($control);
                    $error = $renderer->getControlError($control) ?>

<?php if ($controlTemplate = $renderer->getControlTemplate($control)): Nette\Latte\Macros\CoreMacros::includeTemplate("$controlTemplate", array('name' => $name, 'description' => $description, 'error' => $error, 'form' => $form, '_form' => $form, 'attrs' => $attrs) + $template->getParameters(), $_l->templates['cjqrfkze3l'])->render() ?>

<?php elseif ($renderer->isSubmitButton($control)): ?>

                    <?php echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($form[$name]->getControl(), $attrs['input']), ENT_NOQUOTES) ?>


<?php elseif ($renderer->isButton($control)): ?>

                    <div class="controls">
						<?php echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($form[$name]->getControl(), $attrs['input']), ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($description, ENT_NOQUOTES) ?>

                    </div>

<?php elseif ($renderer->isCheckbox($control)): ?>

<?php $label = $renderer::mergeAttrs($form[$name]->getLabel(), $attrs['label']) ;if ($_l->ifs[] = (!$renderer->controlHasClass($control, 'inline'))): ?>                    <div class="controls">
<?php endif ?>
                        <?php echo $label->startTag() ;echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($form[$name]->getControl(), $attrs['input']), ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($renderer->getLabelBody($control), ENT_NOQUOTES) ;echo $label->endTag() ;echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($description, ENT_NOQUOTES) ?>

<?php if (array_pop($_l->ifs)): ?>                    </div>
<?php endif ?>

<?php elseif ($renderer->isRadioList($control)): ?>

                    <?php echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($form[$name]->getLabel(), $attrs['label']), ENT_NOQUOTES) ?>


                    <div class="controls">
<?php $iterations = 0; foreach ($renderer->getRadioListItems($control) as $item): ?>

                            <?php echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($item->html, $attrs['input']), ENT_NOQUOTES) ?>

                        <?php $iterations++; endforeach ;echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($description, ENT_NOQUOTES) ?>

                    </div>

<?php elseif ($renderer->isCheckboxList($control)): ?>

                    <?php echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($form[$name]->getLabel(), $attrs['label']), ENT_NOQUOTES) ?>


                    <div class="controls">
<?php $iterations = 0; foreach ($renderer->getCheckboxListItems($control) as $item): ?>

                            <?php echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($item->html, $attrs['input']), ENT_NOQUOTES) ?>

                        <?php $iterations++; endforeach ;echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($description, ENT_NOQUOTES) ?>

                    </div>

<?php else: ?>

                    <?php echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($form[$name]->getLabel(), $attrs['label']), ENT_NOQUOTES) ?>


                    <div class="controls">
<?php $prepend = $control->getOption('input-prepend'); $append = $control->getOption('input-append') ;if ($_l->ifs[] = ($prepend || $append)): ?>
                        <div<?php if ($_l->tmp = array_filter(array($prepend? 'input-prepend':null, $append? 'input-append':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>
<?php endif ?>
                            <?php echo Nette\Templating\Helpers::escapeHtml($prepend, ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($renderer::mergeAttrs($form[$name]->getControl(), $attrs['input']), ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($append, ENT_NOQUOTES) ?>

<?php if (array_pop($_l->ifs)): ?>                        </div>
<?php endif ?>
                        <?php echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($description, ENT_NOQUOTES) ?>

                    </div>

<?php endif ;if (array_pop($_l->ifs)): ?>            </div>
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>

<?php if (!isset($mode)): call_user_func(reset($_l->blocks['form']), $_l, array('form' => $form, 'renderer' => $renderer) + get_defined_vars()) ;endif ;