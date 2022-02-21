<?php
namespace Utils\Controllers;

use App\Controllers\BaseController;
use Utils\Libraries\UtilsResponseLib;
use CodeIgniter\HTTP\Response;

class Parser extends BaseController {

    use UtilsResponseLib;
    public function __construct() {
        $config = config(App::class);
        $this->response = new Response($config);
    }

    public function parsePlayers($str='')
    {
        if ($this->request->getPost('str') != '') {
            $search = $this->request->getPost('str');
        } else {
            $search = $str;
        }
        
        $search = trim($search);
        $search = preg_replace('/\//', ' / ', $search);
        $search = preg_replace('!\s+!', ' ', $search);
        $search = preg_replace('/,/', '', $search);
        $pos0 = 0;
        $names = [];
        
        $search2 = $search;
        //print_r(unpack("C*", "$search2"));
        for ($x=0;$x<mb_strlen($search2);$x++) {
            if (ord(substr($search,$x,1)) == 1 && ord(substr($search,$x+1,1)) == 240) {
                $search = substr($search2,$x-1);
                break;
            }
            if (ord(substr($search,$x,1)) == 240) {
                $search = substr($search2,$x-1);
                break;
            }
        }
        if (ord(substr($search,0,1)) == 240) {
            for ($i=1; $i<=24; $i++) {
                $search = preg_replace('/\xF0/',"$i ", $search, 1);
            }
            $search = preg_replace('/\x9F/',"", $search);
            $search = preg_replace('/\x8E/',"", $search);
            $search = preg_replace('/\xBE/',"", $search);
        }

        if (substr($search,0,1) == '1') {
            if (substr($search,1,1) == ' ') {
                $search = trim(preg_replace('/^1 /', '1', $search));
            }
            $search = trim(preg_replace('!\s+!', ' ', $search));
            $names = [];
            $pos1 = 1;
            $pos2 = 0;
            $pos1l = 0;
            $pos2l = 0;
            for ($i=2; $i<=99 ; $i++) {
                $posAdd = mb_strlen($i);
                $pos2 = mb_strpos($search,"$i", $pos1+$posAdd);
                if (!$pos2) {
                    $pos2 = mb_strlen($search)+1;
                    if (mb_strpos($search,"Reserv")) {
                        $pos2 = mb_strpos($search,"Reserv");
                    }
                    $i=200;
                } 
                $string = trim(mb_substr($search,($pos1>1?$pos1:0)+$posAdd+($i>1?0:1),$pos2-$pos1-$posAdd-($i>1?0:1)));

                if (ord(mb_substr($string,0,1)) == 240) {
                    $string = preg_replace('/\xF0/','', $string);
                    $string = preg_replace('/\x9F/',"", $string);
                    $string = preg_replace('/\x8E/',"", $string);
                    $string = preg_replace('/\xBE/',"", $string);
                }

                $string = preg_replace('/^[0-9]/','',$string);
                $string = preg_replace('!\s+!', '  ', $string);
                
                $names[] = ucwords(trim($string));
                $pos1 = $pos2;
            }
        }
        
        $this->sendResponse(UtilsResponseLib::$SUCCESS, $names);

    }
    public function parseGame1()
    {
        
    }
    
    public function parseGame2()
    {
        $players = $this->request->getPost('players');
        $pairmode1 = $this->request->getPost('pairmode1');
        $pairmode2 = $this->request->getPost('pairmode2');
        $numpartidos = $this->request->getPost('numpartidos');
        $descansos = $this->request->getPost('descansos');
        $sistema = $this->request->getPost('sistema');
        $fechahora = $this->request->getPost('fechahora');
        $club = $this->request->getPost('club');
        
        $numPlayers = 0;
        
        $xDobles = 1;
        $players2 = [];
        if ($pairmode1 == 1) {
            foreach ($players as $key => $val) {
                if (trim($val) != '') {
                    $players2[] = $val;
                }
            }
            $players = $players2;
            $players2 = [];    
            shuffle($players);
            $pairmode1 = 0;
        }
        
         if (strpos($players[0],' / ') > 0) {
            $xDobles = 2;
            $players2 = $players;
            $numPlayers = count($players);
        } else {
            if ($pairmode1 == 0) {
                for ($i=0; $i<count($players); $i=$i+2) {
                    if (isset($players[$i+1])) {
                        $numPlayers = $numPlayers + 2;
                        $players2[] = array(0 => $players[$i], 1 => $players[$i+1]);
                    }
                }
            } 
        }
        $playersWhats = "*EQUIPOS/JUGADORES*\n\n";
        foreach ($players2 as $key => $val) {
            $players2[$key] = $val;
            $playersWhats .= "  ".($key+1)."🎾 ".$val[0]." / ".$val[1]."\n";
        }
        $data = new \stdClass();
        $data->players = $players2;
        var_dump($data->players); exit;
        $data->playersWhats = $playersWhats;
        $data->numplayers = count($data->players);
        $data->numPistas = count($data->players)/2;
        $data->partidos = [];
        $data->sistema = $sistema;
        $data->club = $club;
        $data->fechahora = $fechahora;
        for ($i=0; $i<count($data->players); $i=$i+2) {
            $data->partidos[0][] = array($data->players[$i] , $data->players[$i+1]);
        }
        
        if ($sistema == 0 && $data->numPistas <= $numpartidos) {
            for ($p=1;$p<$numpartidos;$p++) {
                for ($i=0; $i<$data->numPistas; $i++) {
                    if ($i==0) {
                        $data->partidos[$p][] = array(lang('Games.ganador')." P".($i+1), lang('Games.ganador')." P".($i+2));
                    } elseif ($i==$data->numPistas-1) {
                        $data->partidos[$p][] = array(lang('Games.perdedor')." P".($i), lang('Games.perdedor')." P".($i+1));
                    } else {
                        $data->partidos[$p][] = array(lang('Games.ganador')." P".($i+2), lang('Games.perdedor')." P".($i));
                    }
                }
            }
        } 

        if ($sistema == 4 && $data->numPistas <= $numpartidos) {
            $combinatorias = [];
            $padding = -1;
            if ($pairmode2 == 1) {
                $padding = 0;
            }
            for ($i=0;$i<count($data->players)-$padding;$i++) {
                for ($j=0;$j<count($data->players);$j++) {
                    if ($j==0) {
                        $combinatorias[$i][$j] = 1;
                    } else {
                        $combinatorias[$i][$j] = 0;
                    }
                }
            }
            $inicio = 2;
            $max = count($data->players); 
            for ($i=0; $i<count($data->players)-$padding; $i++) {
                for ($j=1;$j<count($data->players); $j++) {
                    $combinatorias[$i][$j] = $inicio;
                    if ($j < count($data->players)-1) {
                        $inicio++;  
                    }
                    if ($inicio>$max) {
                        $inicio = 2;
                    }
                }
            }
            var_dump($combinatorias); exit;
            foreach ($combinatorias as $key => $ronda) {
                $data->partidos[$key] = [];
                for ($i=0; $i <count($ronda); $i=$i+2) { 
                    $player1 = $ronda[$i];
                    $player2 = $ronda[$i+1];
                    if ($pairmode2 == 1) { 
                        $data->partidos[$key][] = array($data->players[$player1-1][0]. " / " . $data->players[$player2-1][0] , $data->players[$player1-1][1]. " / " . $data->players[$player2-1][1]);
                    } else { 
                        $data->partidos[$key][] = array($data->players[$player1-1][0]. " / " . $data->players[$player1-1][1] , $data->players[$player2-1][0]. " / " . $data->players[$player2-1][1]);
                    }
                        
                }
            }
                
        } 

        $gamesWhats = '';
        $gamesWhats = "*PARTIDOS*\n\n";
        foreach ($data->partidos as $key => $val) {
            $gamesWhats .= "  *Ronda ".($key+1)."*\n\n";
            foreach ($val as $key2 => $val2) {
                $player1 = preg_replace('/ \/ /','/', $val2[0]);
                $player1 = preg_replace('/([0-9])/',' *${1}* ', $player1);
                $player1 = preg_replace('!\*+!', '*', $player1);
                $player1 = preg_replace('!\s+!', ' ', $player1);

                $player2 = preg_replace('/ \/ /','/', $val2[1]);
                $player2 = preg_replace('/([0-9])/',' *${1}* ', $player2);
                $player2 = preg_replace('!\*+!', '*', $player2);
                $player2 = preg_replace('!\s+!', ' ', $player2);

                $gamesWhats .= "  P *".($key2+1)."* -- ".$player1." _vs_ ".$player2."\n";
            }
            $gamesWhats .= "\n";
        }
        $gamesWhats .= "\n";
        $data->gamesWhats = $gamesWhats;
        
        $this->sendResponse(UtilsResponseLib::$SUCCESS, $data);        
        
    }    
    
    public function playersWhats($players)
    {
        $playersWhats = "*EQUIPOS/JUGADORES*\n\n";
        foreach ($players2 as $key => $val) {
            $playersWhats .= "  ".($key+1)."🎾 ".$val."\n";
        }
        return $playersWhats;
        
    }
}
