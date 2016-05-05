<?php

class PDOConnect
{
//    Есть подключение или нету
    public $isConnect;
//    Сохраняем детали соединения-Protected -чтобы други файлы не выходили...
    protected $datab;
//    Connect

    public function __construct($host,$dbname,$dbuser,$dbpass)
    {
        $this->isConnect=TRUE;
        try
        {
            $this->datab=new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$dbuser,$dbpass);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //Первоначальный атрибут для новой настройки
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        }
//       Если нету соединеине
        catch(PDOException $e)
        {
            throw new Exception($e->getMessage()."123");
        }
    }

    public function Disconnect()
    {
        $this->datab=NULL;
        $this->isConnect=FALSE;
    }

    public function  getRow($query,$params=[])
    {
        try
        {
            $result=$this->datab->prepare($query);
            $result->execute($params);
            return $result->fetch();
        }
        catch(PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function  getRows($query,$params=[])
    {
        try
        {
            $result=$this->datab->prepare($query);
            $result->execute($params);
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function insertRow($query,$params=[])
    {
        try
        {
            $result=$this->datab->prepare($query);
            $result->execute($params);
            return TRUE;
        }
        catch(PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function updateRow($query,$params=[])
    {
        $this->insertRow($query,$params);
    }

    public function deleteRow($query,$params=[])
    {
        $this->insertRow($query,$params);
    }
}
