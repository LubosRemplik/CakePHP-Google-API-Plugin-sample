<?php
echo $this->Html->tag('h2', 'Cakephp Google API plugin');
echo $this->Html->para(null, sprintf(
	'Check if you have set client_id, client secret, scope, redirect in your 
	bootstrap.php. You can get client_id, client_secret at %s. If you have all 
	configured correctly, please %s',
	$this->Html->link('https://code.google.com/apis/console/'),
	$this->Html->link('Connect with Google', '/auth/google')
));
if (!empty($info)) {
	echo $this->Html->tag('h3', 'Info');
	$para = '';
	foreach ($info as $key => $value) {
		$para .= sprintf('%s: %s<br />', $key, $value);
	}
	echo $this->Html->para('info', $para);
	$calendarId = $info['email'];
	echo $this->Html->tag('h3', 'Events');
	echo $this->Html->link('add event', array('action' => 'addEvent', $calendarId));
	if (!empty($events)) {
		$para = '';
		foreach ($events as $id => $summary) {
			$para .= sprintf(
				'%s %s<br />', $summary,
				$this->Html->link(
					'delete event', 
					array('action' => 'deleteEvent', $calendarId, $id)
				)
			);
		}
		echo $this->Html->para('events', $para);
	}
	echo $this->Html->tag('h3', 'Files');
	echo $this->Html->link('add file', array('action' => 'addFile'));
	if (!empty($files)) {
		$para = '';
		foreach ($files as $id => $title) {
			$para .= sprintf(
				'%s %s<br />', $title,
				$this->Html->link('delete file', array('action' => 'deleteFile', $id))
			);
		}
		echo $this->Html->para('files', $para);
	}
}
