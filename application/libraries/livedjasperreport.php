<?php


class LivedJasperReport
{
    private $socket;
    private $jasper_server;
    private $jasper_port;
    private $format;
    private $result;
    private $exec_time;

    private $is_non_blocking = true;

    public function __construct($address = "127.0.0.1", $port = 9999)
    {
        // if ($port == 9999) {
        //     $cfg = new LivedConfig();
        //     $cfg->load();
        //     $port = $cfg->get('jasper_server_port');
        // }

        $port = 9999;

        $this->jasper_server = $address;
        $this->jasper_port = $port;
        $this->exec_time = ini_get("max_execution_time");

        if ($this->exec_time <= 0) {
            $this->exec_time = 90;
        } elseif ($this->exec_time > 180) {
            $this->exec_time = 180;
        }
    }

    public static function getArrayOutputFormats()
    {
        $arr = array("PDF-STREAM" => "PDF Stream",
            "PDF-FILE" => "PDF File",
            "HTML-STREAM" => "HTML Stream",
            "HTML-FILE" => "HTML File",
            "XLS-STREAM" => "Spreadsheet Stream",
            "XLS-FILE" => "Spreadsheet File");
        return $arr;
    }

    public function createReport($modul, $reportName, $format, $params)
    {
        $params = $this->cleanReportParameter($params);
        // echo "$modul<br/> $reportName<br/> $format<br/> $params";exit()-1;

        $this->format = $format;
        try {
            $socket = $this->connectToJasperServer($this->jasper_server, $this->jasper_port);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        $this->socket = $socket;
        $this->sendRequest($reportName, $format, $params);
        $this->result = $this->getResult();
        if (strpos($this->result, "<OK:") === false) {
            throw new \Exception("Failed to create report '$reportName' : [ $this->result ]");
        } else {
            $pos = strpos($this->result, '>');
            $token = trim(substr($this->result, 4, ($pos - 4)));
            return $token;
        }
    }

    private function cleanReportParameter($params)
    {
        $newParams = "";
        if ($params) {
            $arrParams = explode("&", $params);
            foreach ($arrParams as $param) {
                $keyval = explode("=", $param);
                $key = trim($keyval[0]);
                $val = trim(preg_replace("/\r\n/", " ", $keyval[1]));
                $newParams .= "$key=$val&";
            }
        }
        return $newParams;
    }

    public function connectToJasperServer($address = "127.0.0.1", $port = 9999)
    {
        $address = gethostbyname($address);
        $socket = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            throw new \Exception("socket_create() to $address:$port failed.<br>Reason: " . socket_strerror(socket_last_error()));
        }

        if ($this->is_non_blocking) {
            socket_set_nonblock($socket);
        }
        
        $result = @socket_connect($socket, $address, $port);

        if ($result === false) {
            
            if ($this->is_non_blocking) { # Always return false
                
                $w = array($socket);
                $r = null;
                $e = null;
                $t = 5;
                // $ready = socket_select($read, $w, $e, $t);

                $n = socket_select($r , $w, $e , $t);
                echo socket_strerror(socket_last_error($socket));
                
                if ($n == 0) {
                    throw new \Exception("socket_connect() to $address:$port failed.<br>Reason: Timeout");
                }

                if ($n > 0) {
                    return ($socket);
                }

            }
            throw new \Exception("socket_connect() to $address:$port failed.<br>Reason: " . socket_strerror(socket_last_error($socket)));
        }

        return $socket;
    }

    public function sendRequest($reportName, $format, $params)
    {
        $msg = "REPGEN;" . $reportName . ";" . $format . ";" . $params . "\n";
        socket_write($this->socket, $msg, strlen($msg));
    }

    public function getResult()
    {
        $result = "";
        $t1 = time();

        if ($this->is_non_blocking) {
            for (; ;) {
                $r = array($this->socket);
                $w = null;
                $e = null;
                $t = 5;
                $n = socket_select($r, $w , $e , $t);
                if ($n > 0) {
                    $in = socket_read($this->socket, 1);
                    if ($in == "") {
                        throw new \Exception("socket_read() failed.<br>Reason: Connection closed!");
                    }

                    $result = $result . $in;
                    // echo "RESULT:[$result][$in]<br>";
                    if (strrchr($in, "\n")) {
                        break;
                    }

                } elseif ($n == 0) { # Check the timer
                    $t2 = time();
                    if ($t2 - $t1 >= $this->exec_time - 1) {
                        return "Report Generator timeout $this->exec_time sec";
                    }

                } else {
                    throw new \Exception("socket_select() failed.<br>Reason: " . socket_strerror(socket_last_error($this->socket)));
                }
            }
        } else {
            while ($in = socket_read($this->socket, 1)) {
                $result = $result . $in;
                $t2 = time();
                if ($t2 - $t1 >= $this->exec_time - 1) {
                    return "Report Generator timeout $this->exec_time sec";
                }

                if (strrchr($in, "\n")) {
                    break;
                }

            }
        }
        return $result;
    }

    public function showReport()
    {
        if (strpos($this->result, "<OK:") != 0) {
            return 0;
        }
        $pos = strpos($this->result, '>');
        $token = trim(substr($this->result, 4, ($pos - 4)));

        switch ($this->format) {
            case "PDF-STREAM":
                ob_end_clean();
                header("Content-type: application/pdf");
                header("Content-Length: $token");
                header("Content-Disposition: inline; filename=Report-2.pdf");
                $this->showResultStream($token);
                break;
            case "HTML-STREAM":
                $this->showResultStream($token);
                break;
            case "XLS-STREAM":
                ob_end_clean();
                header("Content-type: application/vnd.ms-excel");
                header("Content-Length: $token");
                header("Content-Disposition: inline; filename=Report-2.xls");
                $this->showResultStream($token);
                break;
        }
        return 1;
    }

    public function showResultStream($len)
    {
        $taken = 0;
        $t1 = time();

        if ($this->is_non_blocking) {
            while ($taken < $len) {
                $r = array($this->socket);
                $n = socket_select($r, $w = null, $e = null, 5);
                $lenleft = ($len - $taken);
                if ($lenleft > 2048) {
                    $lenleft = 2048;
                }

                if ($n > 0) {
                    $in = socket_read($this->socket, $lenleft);
                    $l = strlen($in);
                    if ($l == 0) {
                        throw new \Exception("socket_read() failed.<br>Reason: Connection closed!");
                    }

                    $taken += $l;
                    print $in;
                } elseif ($n == 0) { # Check the timer
                    $t2 = time();
                    if ($t2 - $t1 >= $this->exec_time - 1) {
                        return "Report Generator timeout $this->exec_time sec";
                    }

                } else {
                    throw new \Exception("socket_select() failed.<br>Reason: " . socket_strerror(socket_last_error($this->socket)));
                }
            }
        } else {
            while ($taken < $len) {
                $in = socket_read($this->socket, 4096);
                $l = strlen($in);
                if ($l == 0) {
                    break;
                }

                print $in;
                $taken += $l;
            }
        }
        return true;
    }

    public function getReportFileUrl()
    {
        if (strpos($this->result, "<OK:") != 0) {
            return 0;
        }
        $pos = strpos($this->result, '>');
        $token = trim(substr($this->result, 4, ($pos - 4)));

        return "tmp/" . basename($token);
    }

    public function closeConnection()
    {
        $msg = "DONE\n";
        socket_write($this->socket, $msg, strlen($msg));
//        $dummy = $this->getResult();
    }

}
