<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    /**
     * @Route("/addAddress/{contactId}")
     */
    public function addAction(Request $request, $contactId)
    {
        $address = new Address();

        $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->find($contactId);

        $address->setContact($contact);

        $form = $this->createForm('AppBundle\Form\AddressType', $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('app_contact_showall');
        }
        return $this->render('AppBundle:Address:add.html.twig', ['form' => $form->createView()]);

    }

}
