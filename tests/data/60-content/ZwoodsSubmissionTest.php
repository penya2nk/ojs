<?php

/**
 * @file tests/data/60-content/ZwoodsSubmissionTest.php
 *
 * Copyright (c) 2014-2015 Simon Fraser University Library
 * Copyright (c) 2000-2015 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ZwoodsSubmissionTest
 * @ingroup tests_data
 *
 * @brief Data build suite: Create submission
 */

import('tests.ContentBaseTestCase');

class ZwoodsSubmissionTest extends ContentBaseTestCase {
	/**
	 * Create a submission.
	 */
	function testSubmission() {
		$this->register(array(
			'username' => 'zwoods',
			'firstName' => 'Zita',
			'lastName' => 'Woods',
			'affiliation' => 'CUNY',
			'country' => 'United States',
			'roles' => array('Author'),
		));

		$title = 'Finocchiaro: Arguments About Arguments';
		$this->createSubmission(array(
			'section' => 'Reviews',
			'title' => $title,
			'abstract' => 'None.',
		));

		$this->logOut();
		$this->findSubmissionAsEditor('dbarnes', null, $title);
		$this->sendToReview();
		$this->waitForElementPresent('//a[contains(text(), \'Review\')]/div[contains(text(), \'Initiated\')]');
		$this->assignReviewer('phudson', 'Paul Hudson');
		$this->assignReviewer('amccrae', 'Aisla McCrae');
		$this->recordEditorialDecision('Accept Submission');
		$this->waitForElementPresent('//a[contains(text(), \'Editorial\')]/div[contains(text(), \'Initiated\')]');
		$this->assignParticipant('Copyeditor', 'Sarah Vogt');
		$this->logOut();
	}
}
