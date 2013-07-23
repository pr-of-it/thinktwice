<div class="services">
  <ul class="auth-services clear">
  <?php
	foreach ($services as $name => $service) {
		echo '<li class="auth-service '.$service->id.'">';
		$html = '<span class="auth-icon '.$service->id.'"><i></i></span>';
		$html .= '<span class="auth-title">'.'Войти через '.$service->title.'</span>';
        $params = array();
        if ( !empty($_GET['code']) )
            $params['code'] = $_GET['code'];
        if ( !empty($_GET['email']) )
            $params['email'] = $_GET['email'];

        $html = CHtml::link($html, array_merge( array($action, 'service' => $name), $params), array(
			'class' => 'auth-link '.$service->id,
		));
		echo $html;
		echo '</li>';
	}
  ?>
  </ul>
</div>