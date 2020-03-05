<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use App\Entity\User;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    
    class RolesController extends AbstractController
    {
        /**
         * @Route("/roles_controller", name="roles_app")
         */
        public function role()
        {
            $rol=$this->getUser()->getRoles();

            if(in_array('ROLE_ADMIN', $rol)){
                $users=$this->getDoctrine()
                    ->getRepository(User::class)
                    ->findAll();
                return $this->render('mainLog.html.twig', ['users' => $users]);
            }
            elseif(in_array('ROLE_SUPER', $rol)){
                $user1=$this->getDoctrine()
                    ->getRepository(User::class)
                    ->findByRole('ROLE_SUPER');
                $user2=$this->getDoctrine()
                    ->getRepository(User::class)
                    ->findByRole('ROLE_USER');
                $users=array_merge($user1, $user2);
                return $this->render('mainLog.html.twig', ['users' => $users]);
            }
            elseif(in_array('ROLE_USER', $rol)){
                $users=$this->getDoctrine()
                    ->getRepository(User::class)
                    ->findByRole('ROLE_USER');
                return $this->render('mainLog.html.twig', ['users' => $users]);
            }
            else 
                return new Response("No tens asignat cap rol a aquest usuari");
            
        }
    }

?>