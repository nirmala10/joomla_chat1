

<?php
   global $user;
   $user = JFactory::getUser();
   $document = JFactory::getDocument();
   if($user->id >0){
           $doc = JFactory::getDocument();
           JHtml::script('plugins/content/joomla_chat/bundle/jquery/jquery-1.11.0.min.js');
           $doc->addScript('plugins/content/joomla_chat/bundle/jquery/jquery-ui.min.js');
           $doc->addScript('plugins/content/joomla_chat/index.js');//
           $doc->addScript("plugins/content/joomla_chat/bundle/io/build/iolib.min.js" );
           $doc->addScript( "plugins/content/joomla_chat/build/chat.min.js" );//
           $sid = session_id();
           include (JPATH_ROOT.'/plugins/content/joomla_chat/auth.php');
  }
    
      ?>
        <script type="text/javascript">
            <?php echo "name='".$user->name."';"; ?>
            <?php echo "id='".$user->id."';"; ?>
            <?php echo "sid='".$sid."';";?>
           
        </script>
   <div id = "stickycontainer"> </div>
    



