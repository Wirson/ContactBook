<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Phone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PhoneController extends Controller
{
    /**
     * @Route("addPhone/{contactId}")
     */
    public function addAction(Request $request, $contactId)
    {
        $phone = new Phone();

        $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->find($contactId);

        $phone->setContact($contact);

        $form = $this->createForm('AppBundle\Form\PhoneType', $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($phone);
            $em->flush();

            return $this->redirectToRoute('app_contact_showall');
        }
        return $this->render('AppBundle:Phone:add.html.twig', ['form' => $form->createView()]);

    }

}
