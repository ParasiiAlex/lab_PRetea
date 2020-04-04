<?php
    
    
    class VideoStream
    {
        private $path = "";
        private $stream = "";
        private $buffer = 4086;
        private $start = -1;
        private $end = -1;
        private $size = 0;
        
        public function setPath($path)
        {
            $this->path = $path;
        }
        
        private function open()
        {
            if (!($this->stream = fopen($this->path, 'rb'))) {
                die('Could not open stream for reading');
            }
        }
        
        private function setHeader()
        {
            ob_get_clean();
            $header = "Content-Type: video/mp4"."\n\r";
            
            $this->start = 0;
            $this->size = filesize($this->path);
            $this->end = $this->size - 1;
            
            $header .= "Content-Length: ".$this->size."\n\r\n\r";
            
            return $header;
        }
        
        private function end()
        {
            fclose($this->stream);
        }
        
        private function stream($headers, $socket, $address, $port)
        {
            socket_sendto($socket, $headers, strlen($headers), 0, $address, $port);
            $i = $this->start;
            set_time_limit(0);
            while (!feof($this->stream) && $i <= $this->end) {
                $bytesToRead = $this->buffer;
                if (($i + $bytesToRead) > $this->end) {
                    $bytesToRead = $this->end - $i + 1;
                }
                $data = fread($this->stream, $bytesToRead);
                socket_sendto($socket, $data, $bytesToRead, 0, $address, $port);
                
                $i += $bytesToRead;
            }
        }
        
        function start($socket, $address, $port)
        {
            $this->open();
            $headers = $this->setHeader();
            $this->stream($headers, $socket, $address, $port);
            $this->end();
        }
    }