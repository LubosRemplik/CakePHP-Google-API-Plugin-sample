<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $uses = array(
		'Google.Google',
		'Google.GoogleCalendarEvents',
		'Google.GoogleDriveFiles',
	);

	public function display() {
		// getting user info
		$info = $this->Google->getUserInfo();

		// list events of default calendar
		$data = $this->GoogleCalendarEvents->listItems($info['email'], array(
			'maxResults' => 10
		));
		$events = Hash::combine($data['items'], '{n}.id', '{n}.summary');

		// list files, which are not trashed
		$data = $this->GoogleDriveFiles->listItems(array('q' => 'trashed = false'));
		$files = Hash::combine($data['items'], '{n}.id', '{n}.title');

		$this->set(compact('info', 'events', 'files'));

		$this->render('home');
	}

	public function addEvent($calendarId) {
		if ($this->request->is('post')) {
			// preparing dates
			extract($this->request->data['Event']['start_date']);
			$startDate = sprintf('%s-%s-%s', $year, $month, $day);
			extract($this->request->data['Event']['end_date']);
			$endDate = sprintf('%s-%s-%s', $year, $month, $day);

			// preparing data
			$data = array(
				'summary' => $this->request->data['Event']['summary'],
				'start' => array(
					'date' => $startDate
				),
				'end' => array(
					'date' => $endDate
				),
			);

			// issue insert
			if($this->GoogleCalendarEvents->insert($calendarId, $data)) {
				Cache::clear();
				$this->Session->setFlash('Event added');
			}
			return $this->redirect(array('action' => 'display', 'home'));
		}
		$this->render();
	}

	public function deleteEvent($calendarId, $eventId) {
		$result = $this->GoogleCalendarEvents->delete($calendarId, $eventId);
		if (empty($result)) {
			Cache::clear();
			$this->Session->setFlash('Event deleted');
		}
		$this->redirect(array('action' => 'display', 'home'));
	}

	public function addFile() {
		if ($this->request->is('post')) {
			// preparing data
			$file = $this->request->data['Drive']['file'];

			// issue insert
			if($this->GoogleDriveFiles->insert($file)) {
				Cache::clear();
				$this->Session->setFlash('File added');
			}
			return $this->redirect(array('action' => 'display', 'home'));
		}
		$this->render();
	}

	public function deleteFile($fileId) {
		$result = $this->GoogleDriveFiles->delete($fileId);
		if (empty($result)) {
			Cache::clear();
			$this->Session->setFlash('File deleted');
		}
		$this->redirect(array('action' => 'display', 'home'));
	}
}
