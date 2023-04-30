<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Profession;
use App\Models\Title;
use App\Models\TitleGenre;
use App\Models\TitleRatings;
use App\Models\TypeTitle;
use Illuminate\Http\Request;
use League\Csv\Reader;

class TitleRantingsSeeder extends Seeder
{
    public function run(): void
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
                    TitleRatings::updateOrCreate(
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
    }
}
