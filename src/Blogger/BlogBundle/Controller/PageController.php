<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Entity\Enquiry;
// Importa el nuevo espacio de nombres
use Blogger\BlogBundle\Form\EnquiryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller {
	public function indexAction() {
		//return $this->render('BloggerBlogBundle:Page:index.html.twig');

		return $this->render('BloggerBlogBundle:Page:index.html.twig');}

	public function aboutAction() {
		return $this->render('BloggerBlogBundle:Page:about.html.twig');
	}

	public function contactAction() {
		$enquiry = new Enquiry();

		$form = $this->createForm(new EnquiryType(), $enquiry);

		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			// (deprecate) $form->bindRequest($request);
			$form->bind($this->getRequest());

			if ($form->isValid()) {
				$message = \Swift_Message::newInstance()
					->setSubject('Contact enquiry from symblog')
					->setFrom('enquiries@symblog.co.uk')
					->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
				                         ->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
				$this->get('mailer')->send($message);

				$this->get('session')->getFlashBag()->add('notice', 'Your changes were saved!');

				$this->get('session')->getFlashBag()->add('notice', 'saludos ');

				// esta opcion esta obsoleta $this->addFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
				// cambio 3
				// realiza alguna acción, como enviar un correo electrónico

				// Redirige - Esto es importante para prevenir que el usuario
				// reenvíe el formulario si actualiza la página
				return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
			}

		}

		return $this->render('BloggerBlogBundle:Page:contact.html.twig', array('form' => $form->createView()));
	}

}