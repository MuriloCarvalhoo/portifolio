<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Profession;
use App\Models\Title;
use App\Models\TitleGenre;
use App\Models\TypeTitle;
use Illuminate\Http\Request;
use League\Csv\Reader;


class ImportController extends Controller
{
    public function title()
    {

        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '18G');
        ini_set('max_execution_time', 0);

        $filename = public_path('archive/title.basics.tsv');
        $csv = Reader::createFromPath($filename);
        $csv->setDelimiter("\t");
        $records = $csv->getRecords();

        foreach ($records as $key => $record) {

            if ($key == 0) {
                continue;
            }else{

                //verificar se o $record[8] existe
                if (!isset($record[8])) {

                    $array = explode("\t", $record[2]);

                    $recordIncorrect = $record;

                    $record[0] = $recordIncorrect[0];
                    $record[1] = $recordIncorrect[1];
                    $record[2] = $array[0];
                    $record[3] = $array[1];
                    $record[4] = $recordIncorrect[3];
                    $record[5] = $recordIncorrect[4];
                    $record[6] = $recordIncorrect[5];
                    $record[7] = $recordIncorrect[6];
                    $record[8] = $recordIncorrect[7];
                }

                $genresSaveToId = [];

                if(isset($record[8])){
                    $genres = explode(",", $record[8]);

                    foreach ($genres as $genre) {
                        $genre = Genre::updateOrCreate(
                            ['name' => $genre],
                            ['name' => $genre]
                        );

                        $genresSaveToId[] = $genre->id;
                    }    
                }

                $typeTitle = TypeTitle::updateOrCreate(
                    ['name' => $record[1]],
                    ['name' => $record[1]]
                );

                $title = Title::updateOrCreate(
                    ['tconst' => $record[0]],
                    [
                    'tconst' => $record[0],
                    'type_id' => $typeTitle->id,
                    'primary' => $record[2],
                    'original' => $record[3],
                    'isAdult' => $record[4] ?? 0,
                    'start_year' => $record[5],
                    'end_year' => $record[6],
                    'runtime_minutes' => $record[7],
                ]);

                if($genresSaveToId != null){
                    $title->genres()->sync($genresSaveToId);
                }
            }
        }

        return redirect('/')->with('success', 'Dados importados com sucesso!');
    }

    public function actor()
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '18G');
        ini_set('max_execution_time', 0);

        $filename = public_path('archive/name.basics.tsv');
        $csv = Reader::createFromPath($filename);
        $csv->setDelimiter("\t");
        $records = $csv->getRecords();

        foreach ($records as $key => $record) {

            if ($key == 0) {
                continue;
            }else{
                $professionsSaveToId = [];
                $knowsSaveToId = [];

                if(isset($record[4])){
                    $professions = explode(",", $record[4]);

                    foreach ($professions as $profession) {
                        $profession = Profession::updateOrCreate(
                            ['name' => $profession],
                            ['name' => $profession]
                        );

                        if($profession != null){
                            $professionsSaveToId[] = $profession->id;
                        }
                    }    
                }

                if(isset($record[5])){
                    $knows = explode(",", $record[5]);

                    foreach ($knows as $know) {

                        $knowGet = Title::where('tconst', $know)->first();

                        if($knowGet != null){
                            $knowsSaveToId[] = $knowGet->id;
                        }
                    }    
                }

                $actor = Actor::updateOrCreate(
                    ['nconst' => $record[0]],
                    [
                    'nconst' => $record[0],
                    'name' => $record[1],
                    'birth_year' => $record[2],
                    'death_year' => $record[3],
                ]);

                if($professionsSaveToId != null){
                    $actor->professions()->sync($professionsSaveToId);
                }

                if($knowsSaveToId != null){
                    $actor->titles()->sync($knowsSaveToId);
                }
            }
        }

        return redirect('/')->with('success', 'Dados importados com sucesso!');
    }

    public function titleRantings()
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '18G');
        ini_set('max_execution_time', 0);

        $filename = public_path('archive/title.ratings.tsv');
        $csv = Reader::createFromPath($filename);
        $csv->setDelimiter("\t");
        $records = $csv->getRecords();

        foreach ($records as $key => $record) {

            if ($key == 0) {
                continue;
            }else{
                $title = Title::where('tconst', $record[0])->first();

                if($title != null){
                    $title->ratings()->updateOrCreate(
                        ['title_id' => $title->id],
                        [
                        'title_id' => $title->id,
                        'tconst' => $record[0],
                        'average_rating' => $record[1],
                        'num_votes' => $record[2],
                    ]);
                }
            }
        }

        return redirect('/')->with('success', 'Dados importados com sucesso!');
    }
}
