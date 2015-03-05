
<?php
  // load jQuery, if not loaded before
  if(!JFactory::getApplication()->get('jquery')){
     JFactory::getApplication()->set('jquery',true);
     $document = JFactory::getDocument();
    JHtml::_('jquery.framework');
  }
?>


