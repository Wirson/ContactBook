<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Email;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class EmailController extends Controller
{
    /**
     * @Route("/addEmail/{contactId}")
     */
    public function addAction(Request $request, $contactId)
    {
        $email = new Email();

        $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->find($contactId);

        $email->setContact($contact);

        $form = $this->createForm('AppBundle\Form\EmailType', $email);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($email);
            $em->flush();

            return $this->redirectToRoute('app_contact_showall');
        }
        return $this->render('AppBundle:Email:add.html.twig', ['form' => $form->createView()]);

    }

}
