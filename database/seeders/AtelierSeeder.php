<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Atelier;
use App\Models\Creneau;
use App\Models\User;

class AtelierSeeder extends Seeder
{
    public function run(): void
    {
        $chef = User::where('role', 'chef')->first();

        $ateliers = [
            [
                'titre' => 'Jollof Rice Sénégalais',
                'slug' => 'jollof-rice-senegalais',
                'description' => 'Apprenez à préparer le célèbre Jollof Rice, un plat emblématique de l\'Afrique de l\'Ouest. Riz parfumé aux tomates, oignons et épices, accompagné de poulet grillé.',
                'plat' => 'Jollof Rice',
                'origine_pays' => 'Sénégal',
                'prix' => 15000,
                'duree_minutes' => 120,
            ],
            [
                'titre' => 'Poulet DG Camerounais',
                'slug' => 'poulet-dg-camerounais',
                'description' => 'Le Poulet DG (Directeur Général) est un plat festif camerounais à base de poulet frit, plantains mûrs et légumes sautés. Un incontournable des grandes occasions.',
                'plat' => 'Poulet DG',
                'origine_pays' => 'Cameroun',
                'prix' => 18000,
                'duree_minutes' => 150,
            ],
            [
                'titre' => 'Pâte Rouge et Sauce Gboma',
                'slug' => 'pate-rouge-sauce-gboma',
                'description' => 'Découvrez la cuisine béninoise authentique avec la pâte rouge accompagnée de la sauce Gboma aux épinards, crabe et crevettes. Un voyage culinaire unique.',
                'plat' => 'Pâte Rouge & Gboma',
                'origine_pays' => 'Bénin',
                'prix' => 12000,
                'duree_minutes' => 90,
            ],
            [
                'titre' => 'Thieboudienne Royal',
                'slug' => 'thieboudienne-royal',
                'description' => 'Le plat national du Sénégal : du riz brisé cuit dans une sauce tomate riche avec du poisson frais, des légumes variés et du tamarin. Une explosion de saveurs.',
                'plat' => 'Thieboudienne',
                'origine_pays' => 'Sénégal',
                'prix' => 16000,
                'duree_minutes' => 130,
            ],
            [
                'titre' => 'Alloco et Poisson Braisé',
                'slug' => 'alloco-poisson-braise',
                'description' => 'Un classique ivoirien : des bananes plantains frites dorées accompagnées de poisson braisé aux épices et sa sauce pimentée maison. Simple et délicieux.',
                'plat' => 'Alloco & Poisson',
                'origine_pays' => "Côte d'Ivoire",
                'prix' => 13000,
                'duree_minutes' => 100,
            ],
            [
                'titre' => 'Fufu et Sauce Arachide',
                'slug' => 'fufu-sauce-arachide',
                'description' => 'Maîtrisez l\'art du fufu ghanéen accompagné d\'une onctueuse sauce à l\'arachide avec du poulet tendre et des épices traditionnelles.',
                'plat' => 'Fufu & Arachide',
                'origine_pays' => 'Ghana',
                'prix' => 14000,
                'duree_minutes' => 110,
            ],
            [
                'titre' => 'Ndolé aux Crevettes',
                'slug' => 'ndole-aux-crevettes',
                'description' => 'Le plat emblématique du Cameroun : des feuilles amères cuites avec des crevettes fumées, de la pâte d\'arachide et des épices. Un goût unique et authentique.',
                'plat' => 'Ndolé',
                'origine_pays' => 'Cameroun',
                'prix' => 17000,
                'duree_minutes' => 120,
            ],
            [
                'titre' => 'Amiwo Béninois',
                'slug' => 'amiwo-beninois',
                'description' => 'La pâte de maïs rouge à la tomate, spécialité béninoise servie avec du poulet frit croustillant et une sauce tomate épicée. Un plat de fête.',
                'plat' => 'Amiwo',
                'origine_pays' => 'Bénin',
                'prix' => 11000,
                'duree_minutes' => 90,
            ],
            [
                'titre' => 'Yassa Poulet',
                'slug' => 'yassa-poulet',
                'description' => 'Le Yassa est un plat sénégalais de poulet mariné au citron et aux oignons caramélisés, servi avec du riz blanc. Frais, acidulé et parfumé.',
                'plat' => 'Yassa',
                'origine_pays' => 'Sénégal',
                'prix' => 14500,
                'duree_minutes' => 110,
            ],
            [
                'titre' => 'Dèkounkoun Togolais',
                'slug' => 'dekounkoun-togolais',
                'description' => 'Un gâteau de haricots cuit à la vapeur dans des feuilles de bananier, spécialité togolaise riche en protéines et en saveurs traditionnelles.',
                'plat' => 'Dèkounkoun',
                'origine_pays' => 'Togo',
                'prix' => 10000,
                'duree_minutes' => 80,
            ],
            [
                'titre' => 'Suya Nigérian',
                'slug' => 'suya-nigerian',
                'description' => 'Les brochettes Suya sont un street food nigérian légendaire : viande de bœuf épicée au Yaji, grillée au charbon et servie avec des oignons et tomates fraîches.',
                'plat' => 'Suya',
                'origine_pays' => 'Nigeria',
                'prix' => 13500,
                'duree_minutes' => 100,
            ],
            [
                'titre' => 'Kedjenou de Pintade',
                'slug' => 'kedjenou-de-pintade',
                'description' => 'Un ragoût ivoirien mijoté lentement dans un canari en terre cuite avec de la pintade, des légumes et des épices. La cuisson douce révèle des saveurs profondes.',
                'plat' => 'Kedjenou',
                'origine_pays' => "Côte d'Ivoire",
                'prix' => 19000,
                'duree_minutes' => 140,
            ],
        ];

        foreach ($ateliers as $index => $data) {
            $atelier = Atelier::create(array_merge($data, [
                'max_participants' => 6,
                'statut' => 'actif',
            ]));

            // 3 créneaux par atelier avec dates futures
            Creneau::create([
                'atelier_id' => $atelier->id,
                'chef_id' => $chef?->id,
                'date' => now()->addDays(3 + $index)->format('Y-m-d'),
                'heure_debut' => '10:00',
                'heure_fin' => '12:00',
                'places_restantes' => rand(2, 6),
                'statut' => 'disponible',
            ]);

            Creneau::create([
                'atelier_id' => $atelier->id,
                'chef_id' => $chef?->id,
                'date' => now()->addDays(10 + $index)->format('Y-m-d'),
                'heure_debut' => '15:00',
                'heure_fin' => '17:00',
                'places_restantes' => rand(1, 6),
                'statut' => 'disponible',
            ]);

            Creneau::create([
                'atelier_id' => $atelier->id,
                'chef_id' => $chef?->id,
                'date' => now()->addDays(17 + $index)->format('Y-m-d'),
                'heure_debut' => '14:00',
                'heure_fin' => '16:00',
                'places_restantes' => 6,
                'statut' => 'disponible',
            ]);
        }
    }
}