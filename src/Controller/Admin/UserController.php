<?php

namespace App\Controller\Admin;

use App\Helpers\JsonHelper;
use App\Exception\ExceptionApi;
use App\Manager\Admin\UserManager;
use App\Repository\Admin\UserRepository;
use App\Utils\TypeVariable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route(path="/api/private/admin/user")
 */
class UserController extends AbstractController
{
    private $userRepository;
    private $userManager;
    public function __construct(
        UserRepository $userRepository,
        UserManager $userManager
    )
    {
        $this->userRepository = $userRepository;
        $this->userManager = $userManager;
    }

    /**
     * @Route("/", name="index_user_admin", methods={"GET"},
     * options={"description"="Liste des utilisateurs admin", "permission"="USER:ADMIN:LIST"})
     */
    public function index(Request $request)
    {
       
    }

    /**
     * @Route("/new", name="new_user_admin", methods={"POST"}, 
     * options={"description"="Ajouter un nouveau utilisateur", "permission"="USER:ADMIN:NEW"})
     */
    public function new(Request $request)
    {
   
    }

  


    /**
     * @Route("/show", name="show_user_admin", methods={"GET"}, 
     * options={"description"="Détails d'un utilisateur", "permission"="USER:ADMIN:SHOW"})
     */
    public function show(Request $request)
    {
      
    }

    /**
     * @Route("/{uuid}/edit", name="edit_user_admin", methods={"POST"}, 
     * options={"description"="Modifier un utilisateur", "permission"="USER:ADMIN:EDIT"})
     */
    public function edit(Request $request, $uuid)
    {
       
    }

    /**
     * @Route("/{uuid}/delete", name="delete_user", methods={"DELETE"},
     * options={"description"="Supprimer un utilisateur", "permission"="USER:ADMIN:DELETE"})
     */
    public function delete($uuid)
    {
       
    }
}