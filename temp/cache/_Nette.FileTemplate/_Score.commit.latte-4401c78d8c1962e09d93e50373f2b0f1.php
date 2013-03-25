<?php //netteCache[01]000391a:2:{s:4:"time";s:21:"0.19328400 1364203601";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:69:"C:\xampp\htdocs\TwitterBootstrapTest\app\templates\Score\commit.latte";i:2;i:1364201849;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\xampp\htdocs\TwitterBootstrapTest\app\templates\Score\commit.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ru2743ndop')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbe4294a45a0_content')) { function _lbe4294a45a0_content($_l, $_args) { extract($_args)
?><div class="container-fluid">
  <div class="row-fluid">
        <div class="form-signin span10 offset1">
        <h2 class="form-signin-heading">Přidat výsledek</h2>
          <div class="well lead text-center">
                  Tip pro jednodušší zpracování - knihovna přímo do aplikace!
                  <a class="btn btn-large btn-success" href="<?php echo htmlSpecialChars($_control->link("Help:")) ?>">Knihovna</a>
          </div>
        
<?php if (isset($uncoveredEdges)): ?>        <div class="alert alert-error">
            <h4>Nepokryté hrany</h4>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($uncoveredEdges) as $key=>$edge): ?>
                <?php echo Nette\Templating\Helpers::escapeHtml($key, ENT_NOQUOTES) ;if (!$iterator->isLast()): ?>
,<?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
        </div>
<?php endif ;$_ctrl = $_control->getComponent("commitScoreForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
        
        </div>
       
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