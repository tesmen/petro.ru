<?php

class Detail
{
    private $pos;
    private $podpos;
    private $oboznachenie;
    private $naimenovanie;
    private $kodMat;
    private $kei;
    private $kolvo;
    private $massaEdin;
    private $massaObsh;
    private $pokr;
    private $vz;
    private $mesto;

    const COLUMN_POS_ID = 1;
    const COLUMN_POD_POS_ID = 2;
    const COLUMN_OBOZNACH_ID = 3;
    const COLUMN_NAIMENOV_ID = 4;
    const COLUMN_KOD_TYPE_ID = 5;
    const COLUMN_KEI_ID = 6;
    const COLUMN_KOLVO_ID = 7;
    const COLUMN_SINGLE_MASS_ID = 8;
    const COLUMN_COMMON_MASS_ID = 9;
    const COLUMN_POKR_ID = 11;
    const COLUMN_VZ_ID = 13;
    const COLUMN_MESTO_ID = 16;

    function __construct($data)
    {
        $this->pos = $data[self::COLUMN_POS_ID];
        $this->podpos = $data[self::COLUMN_POD_POS_ID];
        $this->oboznachenie = $data[self::COLUMN_OBOZNACH_ID];
        $this->naimenovanie = str_replace("\n", '', $data[self::COLUMN_NAIMENOV_ID]);
        $this->kodMat = $data[self::COLUMN_KOD_TYPE_ID];
        $this->kei = (String)$data[self::COLUMN_KEI_ID];
        $this->kolvo = $data[self::COLUMN_KOLVO_ID];
        $this->massaEdin = $data[self::COLUMN_SINGLE_MASS_ID];
        $this->massaObsh = $data[self::COLUMN_COMMON_MASS_ID];
        $this->pokr = $data[self::COLUMN_POKR_ID];
        $this->vz = $data[self::COLUMN_VZ_ID];
        $this->mesto = $data[self::COLUMN_MESTO_ID];
    }

    /**
     * @return mixed
     */
    public function getKei()
    {
        return $this->kei;
    }

    /**
     * @return mixed
     */
    public function getKodMat()
    {
        return $this->kodMat;
    }

    /**
     * @return mixed
     */
    public function getKolvo()
    {
        return $this->kolvo;
    }

    /**
     * @return mixed
     */
    public function getMassaEdin()
    {
        return $this->massaEdin;
    }

    /**
     * @return mixed
     */
    public function getMassaObsh()
    {
        return $this->massaObsh;
    }

    /**
     * @return mixed
     */
    public function getMesto()
    {
        return $this->mesto;
    }

    /**
     * @return mixed
     */
    public function getNaimenovanie()
    {
        return $this->naimenovanie;
    }

    /**
     * @return mixed
     */
    public function getOboznachenie()
    {
        return $this->oboznachenie;
    }

    /**
     * @return mixed
     */
    public function getPodpos()
    {
        return $this->podpos;
    }

    /**
     * @return mixed
     */
    public function getPokr()
    {
        return $this->pokr;
    }

    /**
     * @return mixed
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * @return mixed
     */
    public function getVz()
    {
        return $this->vz;
    }
}