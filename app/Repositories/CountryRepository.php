<?php 
    
namespace App\Repositories;

use App\Http\Traits\Upload;
use App\interfaces\BaseRepository;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;


class CountryRepository implements BaseRepository {

        use Upload;
        /**
         * Save the created model to storage.
         *
         * @param array $data
         * @return \Illuminate\Database\Eloquent\Model
         */
        public function create(array $data){

            
            if ($data['logo']) {
                $data['logo'] =$this->up([
                    'file'=>'logo',
                    'path'=>'countries',
                    'upload_type'=>'single',
                ]); 
            }

            $country= Country::create($data);
            return $country;
        }

        /**
         * Display the given model instance.
         *
         * @param mixed $model
         * @return \Illuminate\Database\Eloquent\Model
         */
        public function find($model){

        }

        /**
         * Update the given model in the storage.
         *
         * @param mixed $model
         * @param array $data
         * @return \Illuminate\Database\Eloquent\Model
         */
        public function update($country, array $data){

            if ($data['logo']) {
                $data['logo'] = $this->up([
                    'file'=>'logo',
                    'path'=>'countries',
                    'upload_type'=>'single',
                    'delete_file'=>$country->logo
                ]); 
            }
    
            $country->update($data);
            return $country;
        }

        /**
         * Delete the given model.
         *
         * @param mixed $model
         * @return void
         */
        public function delete($country){

            Storage::delete($country->logo);
            $country->delete();

        }
        

}