<?php

interface ICrudDAO {


    public function Create(array $obj):int;
   

    public function Update(array $obj):int;
    

    public function FindAll():array; 
    public function FindById(string $id):array;

    public function Destroy(int $id):int;
   
    
    


}
