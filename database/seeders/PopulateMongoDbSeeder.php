<?php

namespace Database\Seeders;

use App\Models\Mongo\TitleMongo;
use App\Models\Title;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Termwind\Components\Dd;

class PopulateMongoDbSeeder extends Seeder
{
    public function run(): void
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '18G');
        ini_set('max_execution_time', 0);

        Title::with(
            'genres',
            'actors',
            'actors.professions',
            'titleRatings'

        )->chunk(1000, function (Collection $titles) {
            foreach ($titles as $title) {
                $actors = [];
                $genres = null;
                $professions = null;

                $genres = $title->genres->pluck('name');

                if($genres && $genres->count() > 0) {
                    $genres = implode(',', $genres->toArray());
                }else{
                    $genres = null;
                }

                if($title->actors && $title->actors->count() > 0) {
                    foreach($title->actors as $actor) {
                        $professions= $actor->professions->pluck('name');

                        if($actor->professions && $actor->professions->count() > 0) {
                            $professions = implode(',', $professions->toArray());
                        }else{
                            $professions = null;
                        }

                        $actors[] = [
                            'name' => $actor->name ?? null,
                            'birth_year' => $actor->birth_year ?? null,
                            'death_year' => $actor->death_year ?? null,
                            'professions' => $professions ?? null,
                            'created_at' => $actor->created_at ?? null,
                            'updated_at' => $actor->updated_at ?? null,
                            'deleted_at' => $actor->deleted_at ?? null,
                        ];
                    }
                }

                TitleMongo::create([
                    'tconst' => $title->tconst ?? null,
                    'type_id' => $title->type_id ?? null,
                    'primary' => $title->primary ?? null,
                    'original' => $title->original ?? null,
                    'is_adult' => $title->is_adult ?? null,
                    'start_year' => $title->start_year ?? null,
                    'end_year' => $title->end_year ?? null,
                    'runtime_minutes' => $title->runtime_minutes ?? null,
                    'created_at' => $title->created_at ?? null,
                    'updated_at' => $title->updated_at ?? null,
                    'deleted_at' => $title->deleted_at ?? null,
                    'genres' => $genres,
                    'actors' => $actors,
                    'title_ratings' => [
                        'average_rating' => $title->titleRatings->average_rating ?? null,
                        'num_votes' => $title->titleRatings->num_votes ?? null,
                    ],
                ]);

                unset($actors);
                unset($genres);
                unset($professions);
            }
        });

        dd('Finalizou');
    }
}
