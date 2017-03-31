<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/new")
     */
    public function newAction()
    {
        $contact = new Contact();

        $form = $this->createForm('AppBundle\Form\ContactType', $contact, ['action' => $this->generateUrl('app_contact_create')]);

        return $this->render('AppBundle:Contact:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/create")
     */
    public function createAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('app_contact_showall');
        }
        return $this->render('AppBundle:Contact:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/update/{id}")
     */
    public function updateAction(Request $request, $id)
    {
        $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Contact not found');
        }

        $form = $this->createForm('AppBundle\Form\ContactType', $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('app_contact_showall');
        }
        return $this->render('AppBundle:Contact:update.html.twig', ['form' => $form->createView(), 'id' => $id]);
    }

    /**
     * @Route("/delete/{id}")
     */
    public function deleteAction($id)
    {
        $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Contact not found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();

        return $this->redirectToRoute('app_contact_showall');
    }

    /**
     * @Route("/show/{id}")
     */
    public function showAction(Request $request, $id)
    {
        $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Contact not found');
        }
        return $this->render('AppBundle:Contact:show.html.twig', ['contact' => $contact]);
    }

    /**
     * @Route("/showAll")
     */
    public function showAllAction()
    {
        $contacts = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Contact')
            ->findBy([], ['surname' => 'asc']);

        return $this->render('AppBundle:Contact:show_all.html.twig', ['contacts' => $contacts]);
    }

}
