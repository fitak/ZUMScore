<?php //netteCache[01]000386a:2:{s:4:"time";s:21:"0.61661700 1364051577";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:64:"C:\xampp\htdocs\TwitterBootstrapTest\app\templates\@layout.latte";i:2;i:1364051536;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\xampp\htdocs\TwitterBootstrapTest\app\templates\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'msdz21j6o4')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbbbdf86ad09_content')) { function _lbbbdf86ad09_content($_l, $_args) { extract($_args)
;
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
<!DOCTYPE html>
<html>
  <head>
    <title>ZUM Score</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="<?php echo htmlSpecialChars($baseUri) ?>/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo htmlSpecialChars($baseUri) ?>/css/additional.css" rel="stylesheet" />
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="<?php echo htmlSpecialChars($baseUri) ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen" />
    <script src="<?php echo htmlSpecialChars($baseUri) ?>/js/main.js" type="text/javascript"></script>
    <script src="<?php echo htmlSpecialChars($baseUri) ?>/js/main.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  </head>
  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="<?php echo htmlSpecialChars($baseUri) ?>">ZUM Score</a>
            <ul class="nav">
              <li<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent('Score:list') ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><a href="<?php echo htmlSpecialChars($_control->link("Score:list")) ?>">Výsledky</a></li>
              
<?php if ($user->isLoggedIn()): ?>              <li<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent('Token:') ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><a href="<?php echo htmlSpecialChars($_control->link("Token:")) ?>">Token</a></li>
<?php endif ?>
              
<?php if ($user->isLoggedIn()): ?>              <li<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent('Score:commit') ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><a href="<?php echo htmlSpecialChars($_control->link("Score:commit")) ?>"><i class="icon-arrow-up"></i> Commit</a></li>
<?php endif ?>
              
              <li<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent('Help:') ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><a href="<?php echo htmlSpecialChars($_control->link("Help:")) ?>">Nápověda</a></li>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  GitHub
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="https://github.com/janzal/ZUMScore">Repozitář</a></li>
                    <li><a href="https://github.com/janzal/ZUMScore/issues">Issue tracker</a></li>
                </ul>
              </li>
              
            </ul>
            
<?php if ($user->isLoggedIn()): ?>            <div class="navbar-form pull-right">
                <div class="btn-group">
                  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user icon"></i> <?php if ($user->isInRole('admin')): ?><i class="icon-star icon-white"></i>
<?php endif ?>
                    <?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->name, ENT_NOQUOTES) ?>

                    <span class="caret"></span>
                  </a>
                    
                  <ul class="dropdown-menu">
                      <li>
                          <a href="<?php echo htmlSpecialChars($_control->link("User:profile", array('id'=>$user->getId()))) ?>">Profil</a>
                      </li>
                      <li>
                          <a href="<?php echo htmlSpecialChars($_control->link("User:password")) ?>">Změna hesla</a>
                      </li>
                      <li>
                          <a href="<?php echo htmlSpecialChars($_control->link("Sign:out")) ?>">Odhlásit</a>
                      </li>
                  </ul>
                </div>            

            </div>
<?php endif ?>
          
<?php if ((!$user->isLoggedIn())): ?>            <div class="navbar-form pull-right">
                <a href="<?php echo htmlSpecialChars($_control->link("Sign:in")) ?>" class="btn btn-primary">Přihlásit</a>
                <a href="<?php echo htmlSpecialChars($_control->link("Sign:activate")) ?>" class="btn">Aktivovat účet</a>
            </div>
<?php endif ?>
          
        </div>
      </div>
    </div>

    <div class="container">
<?php if (isset($flashes)): ?>        <div id="flash-messages">
<?php $iterations = 0; foreach ($flashes as $flash): ?>            <div class="alert alert-<?php echo htmlSpecialChars($flash->type) ?>">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?>

            </div>
<?php $iterations++; endforeach ?>
        </div>
<?php endif ?>
        
      <?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>


      <footer class="footer">
        <p>&copy; BI-ZUM 2013</p>
      </footer>

    </div> <!-- /container -->

    
    
    <script src="<?php echo htmlSpecialChars($baseUri) ?>/js/jquery.js"></script>
    <script src="<?php echo htmlSpecialChars($baseUri) ?>/js/netteForms.js"></script>
    <script src="<?php echo htmlSpecialChars($baseUri) ?>/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>