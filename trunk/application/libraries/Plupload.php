<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Plupload {

    public $target_folder;
    public $execution_time;

    public function __construct()
    {
        $this->CI =& get_instance();
        
        if( $this->CI->config->load('plupload', TRUE, TRUE) ){
                    
            $plupload_config = $this->CI->config->item('plupload');
            $this->config($plupload_config);
        }
    }

    public function config($config)
    {    
        foreach ($config as $key => $value)
        {
            $this->$key = $value;
        }
        
        if (!file_exists($this->target_folder)) 
        {
            @mkdir($this->target_folder);
        }
        @set_time_limit($this->execution_time);
        
    }
    
    public function process_upload($data,$files)
    {
        // Get parameters
        $chunk = isset($data["chunk"]) ? $data["chunk"] : 0;
        $chunks = isset($data["chunks"]) ? $data["chunks"] : 0;
        $fileName = isset($data["name"]) ? $data["name"] : '';
        $targetDir = $this->target_folder;
        
        log_message('error', 'file '.$fileName.' chunk '.$chunk.' of '.$chunks); 
 
        // Clean the fileName for security reasons
        $fileName = preg_replace('/[^\w\._]+/', '', $fileName);
        
        // Make sure the fileName is unique but only if chunking is disabled
        if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);
        
            $count = 1;
            while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
            {
                $count++;
            }
        
            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }
        
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Create target dir
        if (!file_exists($targetDir)) {
            if (!is_writable(dirname($targetDir))) {
                return '{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Cant create temp dir."}, "id" : "id"}';
                return false;
            }
            mkdir($targetDir, 0777, true);
        }

        // Check permissions
        if (!is_writable($targetDir)) {
            return '{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Unable to write to temp directory."}, "id" : "id"}';
        }

        // Look for the content type header
        $contentType = null;

        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
        {
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];
        }
        if (isset($_SERVER["CONTENT_TYPE"]))
        {
            $contentType = $_SERVER["CONTENT_TYPE"];
        }
        
        // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
        if (strpos($contentType, "multipart") !== false)
        {
            if (isset($files['file']['tmp_name']) && is_uploaded_file($files['file']['tmp_name']))
            {
                // Open temp file
                $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out)
                {
                    // Read binary input stream and append it to temp file
                    $in = fopen($files['file']['tmp_name'], "rb");
        
                    if ($in)
                    {
                        while ($buff = fread($in, 4096))
                        {
                            fwrite($out, $buff);
                        }
                    }
                    else
                    {
                        return '{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}';
                    }
                    fclose($in);
                    fclose($out);
                    @unlink($files['file']['tmp_name']);
                }
                else
                {
                    return '{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}';
                }
            }
            else
            {
                return '{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}';
            }
        }
        else
        {
            // Open temp file
            $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out)
            {
                // Read binary input stream and append it to temp file
                $in = fopen("php://input", "rb");
        
                if ($in)
                {
                    while ($buff = fread($in, 4096))
                    {
                        fwrite($out, $buff);
                    }
                }
                else
                {
                    return '{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}';
                }
                fclose($in);
                fclose($out);
            }
            else
            {
                return '{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}';
            }
        }
        
        // Return JSON-RPC response
        return '{"jsonrpc" : "2.0", "result" : "'.$fileName.'", "id" : "id"}';
    }

    private function _load($lib=NULL)
    {
        if($lib == NULL) return FALSE;
        
        if( isset($this->loaded[$lib]) ):
            return FALSE;
        else:
            $this->CI->load->library($lib);
            $this->loaded[$lib] = TRUE;
            return TRUE;
        endif;
    }
} 
