<?php

namespace App\Controller;

use App\Entity\Cidadao;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CidadaoController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET", "POST"})
     */

    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $mensagem = " ";
        $entityManager = $this->entityManager;

        if ($request->isMethod('POST') && $request->request->get('nome')) {
            // Processar o formulário
            $nome = $request->request->get('nome');

            if($nome !== null && $nome !== ''){

                $nis = $this->generateNis();

                $cidadao = new Cidadao();
                $cidadao->setNome($nome);
                $cidadao->setNis($nis);

                $entityManager->persist($cidadao);
                $entityManager->flush();

             

                $mensagem = "Cadastro realizado com sucesso \nNIS: $nis";
            }
            

            
        }

        return $this->render('cidadao/index.html.twig', [
            'mensagem' => $mensagem,
        ]);
    }


    /**
     * @Route("/pesquisa", name="pesquisa", methods={"GET"})
     */
    public function pesquisa(Request $request): Response
    {
        $nis = $request->query->get('nis');

        $entityManager = $this->entityManager;
        $cidadaoRepository = $entityManager->getRepository(Cidadao::class);
        $cidadao = $cidadaoRepository->findOneBy(['nis' => $nis]);

        return $this->render('cidadao/pesquisa.html.twig', [
            'cidadao' => $cidadao,
        ]);
    }


    private function generateNis(): string
    {
 

        do {
            // Gerar um novo NIS único
            $nis = rand(10000000000, 99999999999);
            // Verificar se o NIS já está em uso
            $existingCidadao = $this->entityManager->getRepository(Cidadao::class)->findOneBy(['nis' => $nis]);
                
                
        } while ($existingCidadao !== null);
    
            return $nis;
    } 
    
}
