<?php

class OnAir24hModel extends Model {

    protected $k_id_24h_real;
    protected $k_id_onair;
    protected $d_start24h;
    protected $d_start_temp;
    protected $k_id_follow_up_24h;
    protected $d_fin24h;
    protected $n_comentario;
    protected $i_timestamp;
    protected $i_percent;
    protected $i_round;
    protected $i_state;
    protected $i_hours;
    protected $d_created_at;
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "on_air24h";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKId24hReal($k_id_24h_real) {
        $this->k_id_24h_real = $k_id_24h_real;
    }

    public function getKId24hReal() {
        return $this->k_id_24h_real;
    }

    public function setKIdOnair($k_id_onair) {
        $this->k_id_onair = $k_id_onair;
    }

    public function getKIdOnair() {
        return $this->k_id_onair;
    }

    public function setDStart24h($d_start24h) {
        $this->d_start24h = $d_start24h;
    }

    public function getDStart24h() {
        return $this->d_start24h;
    }

    public function setDStartTemp($d_start_temp) {
        $this->d_start_temp = $d_start_temp;
    }

    public function getDStartTemp() {
        return $this->d_start_temp;
    }

    public function setKIdFollowUp24h($k_id_follow_up_24h) {
        $this->k_id_follow_up_24h = $k_id_follow_up_24h;
    }

    public function getKIdFollowUp24h() {
        return $this->k_id_follow_up_24h;
    }

    public function setDFin24h($d_fin24h) {
        $this->d_fin24h = $d_fin24h;
    }

    public function getDFin24h() {
        return $this->d_fin24h;
    }

    public function setNComentario($n_comentario) {
        $this->n_comentario = $n_comentario;
    }

    public function getNComentario() {
        return $this->n_comentario;
    }

    public function setITimestamp($i_timestamp) {
        $this->i_timestamp = $i_timestamp;
    }

    public function getITimestamp() {
        return $this->i_timestamp;
    }

    public function setIPercent($i_percent) {
        $this->i_percent = $i_percent;
    }

    public function getIPercent() {
        return $this->i_percent;
    }

    public function setIRound($i_round) {
        $this->i_round = $i_round;
    }

    public function getIRound() {
        return $this->i_round;
    }

    public function setIState($i_state) {
        $this->i_state = $i_state;
    }

    public function getIState() {
        return $this->i_state;
    }

    public function setIHours($i_hours) {
        $this->i_hours = $i_hours;
    }

    public function getIHours() {
        return $this->i_hours;
    }

    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }

    public function getDCreatedAt() {
        return $this->d_created_at;
    }

    public function getLastDetail($tck, $round) {
        $onAir24HModel = new OnAir24hModel();
        $obj = $onAir24HModel
                ->where("k_id_onair", "=", $tck->k_id_onair)
                ->where("i_round", "=", $round)
                ->orderBy("d_start24h", "DESC")
                ->first();
        return $obj;
    }

    private function timer(&$obj, $field, $timeMath) {
//        echo $field;
        $timestamp = 0;
        $percent = 0;

        $time = Hash::getTimeStamp($obj->{$field});
        $today = Hash::getTimeStamp(date("Y-m-d H:i:s"));

        $date = date("H:i:s");
        $parts = explode(":", $date);
        $hour = $parts[0];
        $minute = $parts[1];
        $v = Hash::betweenHoras("06:00:00", "18:00:00");
        if (!$v) {
            $hrs = 0;
            if (floor($hour) < 6) {
                $hrs = floor($hour);
                //Detectamos si el día de hoy es igual o inferior al día del registro...                    
                if (date("d", $time / 1000) != date("d", $today / 1000)) {
                    $hrs += 6;
                }
            } else if (floor($hour) > 18) {
                $hrs = floor($hour) - 18;
            }
            $time += $hrs * (((1000 * 60) * 60));
        } else {
            if (date("d", $time / 1000) != date("d", $today / 1000)) {
                $hrs = 12;
                $time += $hrs * (((1000 * 60) * 60));
            }
        }

        $timeFinal = $time + ((1000 * 60) * 60) * $timeMath;
        //Milisegundos entre la fecha y hoy (tiempo que falta)...
        $timestamp = ($timeFinal - $today);

        //Obtenemos el porcentaje...
        $percent = round((($today - $time) / ($timeFinal - $time)) * 100);

        $obj->time = $time;
        $obj->i_timestamp = $timestamp;
        $obj->i_timetotal = $timeFinal;
        $obj->i_percent = $percent;
        $obj->today = $today;
    }

    public function updateTimeStamp($tck) {
        $model = new OnAir24hModel();
        $obj = $model->getLastDetail($tck, $tck->n_round);
        $obj = new ObjUtil($obj);
        if (!$obj) {
            return null;
        }

        if ($obj->i_state == 0) {
            $this->timer($obj, "d_start24h", 12);
        } else if ($obj->i_state == 1) {
            //3horas...           
            $this->timer($obj, "d_start_temp", 3);
        } else if ($obj->i_state == 2) {
            //Prórroga...
            $this->timer($obj, "d_start_temp", $obj->i_hours);
        } else if ($obj->i_state == 3) {
            return $obj;
        }
        $state = 0;
        //Si el timestamp es menor o igual a 0, empiezan a correr las 3 horas...
        if ($obj->i_timestamp <= 0 && $obj->i_state == 0) {
            $state = 1;
            $model = new OnAir24hModel();
//            $t = date("Y-m-d H:i:s", strtotime("+3 hours"));
            $t = date("Y-m-d H:i:s");
            $model->where("k_id_24h_real", "=", $obj->k_id_24h_real)->update([
                "d_start_temp" => $t,
            ]);
        }


        //Si se terminan las 3 horas, se pasa a la siguiente fase.
//        if ($obj->i_timestamp <= 0 && $obj->i_state == 1) {
//            $ticket = new Dao_ticketOnair_model();
//            $o = new ObjUtil([
//                "idProceso" => $obj->k_id_onair,
//                "fase" => "36h",
//                "comment" => "Actualización automática de fase."
//            ]);
//            $response = $ticket->nextFase($o);
//            $obj->i_state = "CHANGE_FASE";
//            return $obj;
//        }

        if ($obj->i_state == 1) {
            $state = 1;
            $this->updateState($obj->k_id_24h_real, $state);
        } else if ($obj->i_state == 2) {
            $state = 2;
            $this->updateState($obj->k_id_24h_real, $state);
        }

        //Si es prorroga, se comprobará si se ha llegado al final, y se reiniciará el ciclo.
        if ($obj->i_percent == 100 && $obj->i_state == 2) {
            $state = 0;
            $this->updateState($obj->k_id_24h_real, $state, Hash::getDate());
            //Se realizan nuevamente los cálculos necesarios.
            return $this->updateTimeStamp($tck);
        }

        $obj->i_state = $state;
        return $obj;
    }

    private function updateState($id, $state, $date = null) {
        $model = new OnAir24hModel();
        $obj = [];
        $obj["i_state"] = $state;
        if ($date != null) {
            $obj["d_start24h"] = $date;
        }
        $model->where("k_id_24h_real", "=", $id)->update($obj);
    }

}
