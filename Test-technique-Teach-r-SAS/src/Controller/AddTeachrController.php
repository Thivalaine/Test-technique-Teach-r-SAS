<?php

namespace App\Controller;

use App\Entity\Teachr;
use App\Form\TeachrAddType;
use App\Repository\TeachrRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddTeachrController extends AbstractController
{
    public function index(TeachrRepository $teachrRepository): Response
    {
        $teachrs = $teachrRepository->findAll();

        return $this->render('teachr/teachr.html.twig', [
            'teachrs' => $teachrs
        ]);
    }

    public function addTeachr(Request $request, EntityManagerInterface $manager, TeachrRepository $teachrRepository): Response
    {
        $teachr = new Teachr();
        $form = $this->createForm(TeachrAddType::class, $teachr);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $manager->persist($teachr);
            $manager->flush();

            $this->addFlash('success', 'Le Teach\'r a bien été ajouté');

            $items = $teachrRepository->findAll();

            $datas = array();

            foreach($items as $key => $item)
            {
                $datas[$key]['name'] = $item->getName();
                $datas[$key]['preformation'] = "Formation";
                $datas[$key]['formation'] = $item->getFormation();
                $datas[$key]['predescription'] = "Description";
                $datas[$key]['description'] = $item->getDescription();
                $datas[$key]['image'] = $item->getImage();

            }

            if(file_put_contents("../../mobile/components/item.json",
                json_encode($datas)))
            {
                echo "fichier créer";
            }
            else
            {
                echo "echouer";
            }

            return $this->redirectToRoute('index');
        }

        return $this->render('teachr/add_teachr.html.twig', [
            'form' => $form->createView(),
            'editMode' => $teachr->getId() !== null,
        ]);
    }

    public function editTeachr(Teachr $teachr = null, Request $request, EntityManagerInterface $manager, TeachrRepository $teachrRepository)
    {
        if (!$teachr) {
            $teachr = new Teachr();
        }

        $form = $this->createForm(TeachrAddType::class, $teachr);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $manager->persist($teachr);
            $manager->flush();

            $items = $teachrRepository->findAll();

            $datas = array();

            foreach($items as $key => $item)
            {
                $datas[$key]['name'] = $item->getName();
                $datas[$key]['preformation'] = "Formation";
                $datas[$key]['formation'] = $item->getFormation();
                $datas[$key]['predescription'] = "Description";
                $datas[$key]['description'] = $item->getDescription();
                $datas[$key]['image'] = $item->getImage();

            }

            if(file_put_contents("../../mobile/components/item.json",
                json_encode($datas)))
            {
                echo "fichier créer";
            }
            else
            {
                echo "echouer";
            }

            return $this->redirectToRoute('index', ['id' => $teachr->getId()]);
        }

        return $this->render('teachr/add_teachr.html.twig', [
            'form' => $form->createView(),
            'editMode' => $teachr->getId() !== null,

        ]);
    }

    public function deleteTeachr(Teachr $teachr, TeachrRepository $teachrRepository, EntityManagerInterface $manager)
    {

        $manager->remove($teachr);
        $manager->flush();

        $items = $teachrRepository->findAll();

        $datas = array();

        foreach($items as $key => $item)
        {
            $datas[$key]['name'] = $item->getName();
            $datas[$key]['preformation'] = "Formation";
            $datas[$key]['formation'] = $item->getFormation();
            $datas[$key]['predescription'] = "Description";
            $datas[$key]['description'] = $item->getDescription();
            $datas[$key]['image'] = $item->getImage();

        }

        if(file_put_contents("../../mobile/components/item.json",
            json_encode($datas)))
        {
            echo "fichier créer";
        }
        else
        {
            echo "echouer";
        }

        return $this->redirectToRoute('index', ['id' => $teachr->getId()]);
    }
}
