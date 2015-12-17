<?php
// src/Blogger/BlogBundle/Entity/Enquiry.php

namespace Blogger\BlogBundle\Entity;
use Symfony\Component\Validator\Constraints\Email;

//  (deprecate)  use Symfony\Component\Validator\Constraints\MaxLength;
//   (deprecate) use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Enquiry {
	protected $name;

	protected $email;

	protected $subject;

	protected $body;

	public static function loadValidatorMetadata(ClassMetadata $metadata) {
		$metadata->addPropertyConstraint('name', new NotBlank());

		//$metadata->addPropertyConstraint('email', new Email());
		$metadata->addPropertyConstraint('email', new Email(array('message' => 'symblog does not like invalid emails. Give me a real one!',
				)));

		$metadata->addPropertyConstraint('subject', new NotBlank());
		//$metadata->addPropertyConstraint('subject', new MaxLength(50));
		$metadata->addPropertyConstraint('subject', new Length(array('max' => 50)));
		$metadata->addPropertyConstraint('body', new Length(array('min'    => 5)));
		//$metadata->addPropertyConstraint('body', new MinLength(50));
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getSubject() {
		return $this->subject;
	}

	public function setSubject($subject) {
		$this->subject = $subject;
	}

	public function getBody() {
		return $this->body;
	}

	public function setBody($body) {
		$this->body = $body;
	}
}