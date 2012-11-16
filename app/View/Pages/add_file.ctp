<?php
echo $this->Form->create('Drive', array('type' => 'file'));
echo $this->Form->inputs(array(
	'file' => array(
		'type' => 'file'
	),
));
echo $this->Form->end('Save');
