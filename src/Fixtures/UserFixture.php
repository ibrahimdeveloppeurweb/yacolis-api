<?php

namespace App\Fixtures;

use App\Entity\Extra\Role;
use App\Entity\Admin\User;
use App\Entity\Admin\Admin;
use App\Helpers\RouteHelper;
use App\Entity\Extra\Setting;
use App\Entity\Extra\SettingSms;
use App\Entity\Extra\SettingMail;
use App\Entity\Extra\SettingTemplate;
use Doctrine\Persistence\ObjectManager;
use App\Repository\Admin\PathRepository;
use App\Repository\Admin\UserRepository;
use App\Repository\Extra\CountryRepository;
use App\Repository\Extra\PathRepository as ExtraPathRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;
    private $userRepository;
    private $pathRepository;
    private $countryRepository;
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository,
        ExtraPathRepository $pathRepository,
        // CountryRepository $countryRepository
    )
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->pathRepository = $pathRepository;
        // $this->countryRepository = $countryRepository;
    }

    public function load(ObjectManager $manager)
    {
        $check = $this->userRepository->findOneBy(['isFirst' => true]);
        $pathsRow = $this->pathRepository->findAll();
        // $country = $this->countryRepository->findOneByIsoCode3('CIV');
        // if (!$check && $country) {   
            if (!$check) {    
            //ROLE
            $role = new Role();
            $role
                ->setNom('Accès super administrateur')
                ->setDescription('Accès super administrateur')
                ->setCreatedAt(new \DateTime('now'))
            ;
            $paths = RouteHelper::ADMIN_ROUTE($pathsRow);
            foreach ($paths as $path) {
                $path->addRole($role);
                $manager->persist($path);
            }
            $manager->persist($role);

            //ADMIN
            $admin = new Admin();
            $admin
                ->setNom('Cisse')
                ->setPrenom('Ibrahim')
                ->setTelephone('2250555568405')
                ->setCreatedAt(new \DateTime('now'))
            ;
            $manager->persist($admin);
    
            //USER
            $user = new User();                 
            $user
                ->setUsername('cisseibrahim1995@gmail.com')
                ->setPassword($this->passwordEncoder->encodePassword($user, 'ibrahim@55'))
                ->setEmail('cisseibrahim1995@gmail.com')
                ->setIsFirst(true)
                ->setType(User::TYPE['ADMIN'])
                ->setAdmin($admin)
                ->setIsEnabled(true)
                ->setCreatedAt(new \DateTime('now'))
            ;
            $manager->persist($user);

            $role->addUser($user);
            $manager->persist($role);

            // $setting = new Setting();
            // $setting
            //     ->setNom('SIMAU')
            //     ->setCountry($country)
            //     ->setContact('2250000000000')
            //     ->setEmail('a.simau@simau.net')
            //     ->setSender('SIMAU-ZENAPI')            
            //     ->setTemplate(new SettingTemplate())
            // ;
            // $manager->persist($setting);
            
            // $this->setting($setting, $manager);
            $manager->flush();
        }
    }

    // public function setting($setting, $manager){
    //     $sms = new SettingSms();
    //     $sms
    //         ->setAkwaba('Felicitation Z_NOM votre mot de passe est et votre le login est Z_LOGIN, vous devez changer le mot de passe à votre première connexion.')
    //         ->setFacture("Z_NOM, Z_DEPOSANT a déposé  la somme de Z_MONTANT le Z_DATE pour le Z_TITRE il vous reste Z_RESTE comme impayé")
    //         ->setReversement("Z_NOM votre reversement du mois de Z_MOIS a été effectue il vous reste la somme de Z_RESTE comme impayé")
    //         ->setPaiement("Bonjour Z_NOM; Z_TITRE; Mnt: Z_MONTANT; Reste: Z_RESTE; Date: Z_DATE;")
    //         ->setContrat("Z_NOM, Z_LOCATIVE; Loyer: Z_LOYERS; Debut: Z_DEBUT_CONTRAT; Fin: Z_FIN_CONTRAT; Facture d'entrée: Z_FACTURE_ENTRE. Merci de nous faire confiance.")
    //         ->setTicket("Vous avez émis une reclamation le Z_DATE concernant Z_MOTIF, le numéro du ticket est Z_TICKET_ID")
    //         ->setAnniversaire("Bonjour Z_NOM, votre agence Z_AGENCY vous souhaites un joyeux anniversaire.")
    //         ->setAvis("Bonjour Z_NOM, Z_TITRE. Vous devez régler la somme de Z_MONTANT")            
    //     ;
    //     $manager->persist($sms);

    //     $mail = new SettingMail();
    //     $mail
    //         ->setAkwaba('Felicitation Z_NOM votre mot de passe est et votre le login est Z_LOGIN, vous devez changer le mot de passe à votre première connexion.')
    //         ->setFacture("Z_NOM, Z_DEPOSANT a déposé  la somme de Z_MONTANT le Z_DATE pour le Z_TITRE il vous reste Z_RESTE comme impayé")
    //         ->setReversement("Z_NOM votre reversement du mois de Z_MOIS a été effectue il vous reste la somme de Z_RESTE comme impayé")
    //         ->setPaiement("Bonjour Z_NOM; Z_TITRE; Mnt: Z_MONTANT;Date: Z_DATE; Impayé: Z_RESTE;. Merci de nous faire confiance.")
    //         ->setContrat("Z_NOM, Z_LOCATIVE; Loyer: Z_LOYERS; Debut: Z_DEBUT_CONTRAT; Fin: Z_FIN_CONTRAT; Facture d'entrée: Z_FACTURE_ENTRE. Merci de nous faire confiance.")
    //         ->setTicket("Vous avez émis une reclamation le Z_DATE concernant Z_MOTIF, le numéro du ticket est Z_TICKET_ID")
    //         ->setAnniversaire("Joyeux anniversaire Z_NOM de l'agence Z_AGENCY")
    //         ->setAvis("Bonjour Z_NOM, Z_TITRE. Vous devez régler la somme de Z_MONTANT")
    //     ;
    //     $manager->persist($mail);

    //     $setting
    //         ->setSms($sms)
    //         ->setMail($mail)
    //     ;
    //     $manager->persist($setting);
    // }
}