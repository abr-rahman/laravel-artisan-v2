<?php
namespace App\Repositories;


interface RoleInterface{

    public function all();
    public function find($id);
    public function create(array $data, $permissions); // type hint /  type define / type cast
    public function update(array $data, $id);
    public function destroy($id);

}

?>
