<?php
echo $this->Form->create('Event');
echo $this->Form->inputs(array(
	'summary',
	'start_date' => array(
		'type' => 'date'
	),
	'end_date' => array(
		'type' => 'date'
	)
));
echo $this->Form->end('Save');
