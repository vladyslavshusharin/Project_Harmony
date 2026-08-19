<?php

class Database{
    public $conn;
    
    public function __construct($host,$user,$pass,$db){
        try{
            $this->conn = new mysqli($host,$user,$pass,$db);

            if($this->conn->connect_error){
                throw new Exception("Error! connection failed" . $this->conn->connect_error);
            }else{
                
            }

        }catch(Exception $e){
            die("Error code " . $e->getMessage());
        }//konec catch


    }//konec constructoru

    public function query($query, $params = []){
        try{
            $stmt = $this->conn->prepare($query);


            if(!$stmt){
                throw new Exception("Chyba dotazu na DB" . $this->conn->error);
            }
            if(!empty($params)){
                $data_types = str_repeat("s", count($params));
                //Lepší verze pro více informací naráz
                $stmt->bind_param($data_types, ...$params);
            }

            if(!$stmt->execute()){
                throw new Exception("Nepovedlo se spustit příkaz z jiného souboru" . $stmt->error);
            }

            if (stripos(trim($query), 'SELECT') === 0) {
                //stripos - Hledá bez důrazu na diakritiku nějaký string
                //Když najde SELECT na nulté pozici (Úplně na začátku) tak poznáme že je to SELECT příkaz
                $result = $stmt->get_result();
                $stmt->close();
                return $result;
            } else {
                // Pro UPDATE, INSERT, DELETE vrátíme true
                $affected = $stmt->affected_rows;
                $stmt->close();
                //Vetší než jedna je zde použito protože update může působit na více řádků naráz
                //To stejné platí pro insert a pro delete
                return $affected > 0;
            }


        }catch(Exception $e){
            echo "Vyjímka" . $e->getMessage();
            return false;
        }
    }//konec query

    public function getInsertId() {
        return $this->conn->insert_id;
    }


    public function __destruct(){
        if($this->conn){
            $this->conn->close();
        }
    }

}//konec database


?>