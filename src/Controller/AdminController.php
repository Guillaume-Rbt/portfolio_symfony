<?php

namespace App\Controller;

use App\Entity\Config;
use App\Entity\Project;
use App\Form\ConfigType;
use App\Form\ProjectType;
use App\Repository\ConfigRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Config\Framework\FormConfig;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function homeAdmin()
    {


        return $this->render('admin/index.html.twig', [
            'titlePage' => 'Administration'

        ]);
    }



    #[Route('/admin/general', name: 'admin_general')]
    #[Route('/admin/{id}/general', name: 'general_settings')]

    public function homeGeneral(Config $config = null, EntityManagerInterface $manager, ConfigRepository $configRepo, Request $request, SluggerInterface $slugger)
    {

        if (!$config) {

            if ($configRepo->findAll() === []) {
                $config = new Config();
            } else {
                return $this->redirectToRoute('general_settings', ['id' => 1]);
            }
        }

        $formConfig = $this->createForm(ConfigType::class, $config);
        $formConfig->handleRequest($request);
        if ($formConfig->isSubmitted() && $formConfig->isValid()) {

            if ($formConfig->get('photo')->getData() !== null && $config->getPhoto() == null) {
                $image = $formConfig->get('photo')->getData();
                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($imageName);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                if (in_array($image->guessExtension(), ["png", "jpg", "jpeg", "PNG"])) {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                    $config->setPhoto($newFilename);
                    $this->addFlash('success', "Projet bien enregistré");
                } else {
                    $this->addFlash('danger', "Fichier non valide");
                }
            } else if ($formConfig->get('photo')->getData() !== null && $config->getPhoto() !== null) {
                unlink($this->getParameter('images_directory') . '/' . $config->getPhoto());
                $image = $formConfig->get('photo')->getData();
                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($imageName);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                if (in_array($image->guessExtension(), ["png", "jpg", "jpeg", "PNG"])) {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                    $config->setPhoto($newFilename);
                    $this->addFlash('success', "Modifications bien enregistré");
                } else {
                    $this->addFlash('danger', "Fichier non valide");
                }
            }

            if ($formConfig->get('CV')->getData() !== null && $config->getCv() == null) {
                $file = $formConfig->get('CV')->getData();
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($fileName);
                $newDocname = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                if (in_array($file->guessExtension(), ["pdf"])) {
                    $file->move(
                        $this->getParameter('docs_directory'),
                        $newDocname
                    );
                    $config->setCv($newDocname);
                    $this->addFlash('success', "Projet bien enregistré");
                } else {
                    $this->addFlash('danger', "Le CV doit etre un pdf");
                }
            } else if($formConfig->get('CV')->getData() !== null && $config->getCv() !== null) {
                unlink($this->getParameter('docs_directory') . '/' . $config->getCv() );
                $file = $formConfig->get('CV')->getData();
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($fileName);
                $newDocname = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                if (in_array($file->guessExtension(), ["pdf"])) {
                    $file->move(
                        $this->getParameter('docs_directory'),
                        $newDocname
                    );
                    $config->setCv($newDocname);
                    $this->addFlash('success', "Projet bien enregistré");
                } else {
                    $this->addFlash('danger', "Le CV doit etre un pdf");
                }
            }

            $manager->persist($config);
            $manager->flush();
        }

        return $this->render('admin/general.html.twig', [
            'titlePage' => 'Informations générales',
            'formConfig' => $formConfig->createView(),
            'config' => $config
        ]);
    }

    #[Route("/admin/project/new", name: "add_project")]
    #[Route("/admin/project/{id}/edit", name: "edit_project")]
    public function add_project(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger, Project $project = null)
    {
        if (!$project) {
            $project = new Project();
            $theproject = null;
        }
        

        $formProject = $this->createForm(ProjectType::class, $project);
        $formProject->handleRequest($request);

        if ($formProject->isSubmitted() && $formProject->isValid()) {

            if ($formProject->get('image')->getData() !== null && $project->getImage() == null) {
                $image = $formProject->get('image')->getData();

                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($imageName);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                if (in_array($image->guessExtension(), ["png", "jpg", "jpeg", "PNG"])) {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                    $project->setImage($newFilename);
                    $this->addFlash('success', "Projet bien enregistré");
                } else {
                    $this->addFlash('danger', "Fichier non valide");
                    return $this->redirectToRoute('add_project');
                }
            } else if ($formProject->get('image')->getData() !== null && $project->getImage() !== null) {
                unlink($this->getParameter('images_directory') . '/' . $project->getImage());
                $image = $formProject->get('image')->getData();

                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($imageName);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                if (in_array($image->guessExtension(), ["png", "jpg", "jpeg", "PNG"])) {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                    $project->setImage($newFilename);
                    $this->addFlash('success', "Projet bien enregistré");
                } else {
                    $this->addFlash('danger', "Fichier non valide");
                    return $this->redirectToRoute('add_project');
                }
            }
            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('edit_project', ['id' => $project->getId()]);
        }
        return $this->render('admin/project_form.html.twig', [
            'titlePage' => 'Administration',
            'formProject' => $formProject = $formProject->createView(),
            'editMode' => $project->getId() !== null,
            "project" => $project
        ]);
    }

    #[Route("/admin/project", name: "admin_project")]
    public function admin_project(ProjectRepository $repository)
    {

        $projects = $repository->findAll();

        return $this->render('admin/projects.html.twig', [
            "projects" => $projects,
            "title" => "Liste des projets"
        ]);
    }

    #[Route("/admin/project/remove/{id}", name: "remove_project")]
    public function remove_project(Project $project, EntityManagerInterface $manager)
    {
        unlink('../public/uploads/images/' .  $project->getImage());
        $manager->remove($project);
        $manager->flush();

        return $this->redirectToRoute("admin_project");
    }
}
