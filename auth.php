<?php
//require_once('../../config.php'); // Moodle config.
global $user, $CFG;
$user = JFactory::getUser();
$document = JFactory::getDocument();

  if($user->id >0)
        {  
        $uid=$user->id;
        $db = JFactory::getDbo();
        function my_curl_request($url, $postdata){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HEADER, 'content-type: text/plain;');
                curl_setopt($ch, CURLOPT_TRANSFERTEXT, 0);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXY, false);
                curl_setopt($ch, CURLOPT_SSLVERSION, 1);

                $result = @curl_exec($ch);
                if ($result === false) 
                {
                    echo 'Curl error: ' . curl_error($ch);
                    exit;
                }
                curl_close($ch);

                return $result;
    }

        $authusername = substr(str_shuffle(md5(microtime())), 0, 12);
        $authpassword = substr(str_shuffle(md5(microtime())), 0, 12);
        $plugin = JPluginHelper::getPlugin('content', 'joomla_chat');
        $pluginParams = new JRegistry($plugin->params);
        $param = $pluginParams->get('chatkey');
        //'100-2c1cbdb38a0f9d76c981d7'
        $postdata = array('authuser' => $authusername, 'authpass' => $authpassword, 'licensekey' =>$param);
        $postdata = json_encode($postdata);
        $rid = my_curl_request("https://c.vidya.io", $postdata); // REMOVE HTTP.

        if (empty($rid) or strlen($rid) > 32)
            {
            echo "Chat server is unavailable!";
            exit;
            }
        setcookie('auth_user', $authusername, 0, '/');
        setcookie('auth_pass', $authpassword, 0, '/');
        setcookie('path', $rid, 0, '/');
        $baseurl = JURI::base( true );
        $imageurl=$baseurl."/plugins/content/joomla_chat/images/quality-support.png" ;
        setcookie('imageurl', $imageurl, 0, '/');
       ?>
            <script type="text/javascript">
                <?php echo "path='".$_COOKIE['path']."';"; ?>
                <?php echo "auth_user='".$_COOKIE['auth_user']."';"; ?>
                <?php echo "auth_pass='".$_COOKIE['auth_pass']."';"; ?>
                <?php echo "imageurl='".$_COOKIE['imageurl']."';"; ?>

            </script>



<?php }?>
