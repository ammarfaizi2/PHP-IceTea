<?php

namespace Console\Commands;

use Console\Color\Message;
use System\Crayner\Contracts\Console\Command;
use Console\Exception\InvalidArgumentException;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Make implements Command
{
    /**
     *
     * @var	bool
     */
    private $force = false;

    
    public function prepare($selection, $optional, $command)
    {
        $this->selection = $selection;
        $this->command   = strtolower($command);
        $this->optional  = $optional;
    }

    public function argument($argument)
    {
        try {
            if (count($argument) > 1) {
                throw new InvalidArgumentException("Invalid command argument !", 400);
            } else {
                $this->filename = $argument[0];
            }
        } catch (InvalidArgumentException $e) {
            print Message::error($e->getMessage(), "InvalidArgumentException", $e->getFile(), $e->getLine());
            die;
        } catch (\Exception $e) {
            print Message::error($e->getMessage(), "\\Exception", $e->getFile(), $e->getLine());
        }
    }

    private function parseSelection()
    {
        if (is_array($this->selection)) {
            foreach ($this->selection as $v) {
                if ($v === "f") {
                    $this->force = true;
                } else {
                    try {
                        throw new InvalidArgumentException("Invalid -".$v." argument!", 400);
                    } catch (InvalidArgumentException $e) {
                        print Message::error($e->getMessage(), "InvalidArgumentException", $e->getFile(), $e->getLine());
                        die;
                    } catch (\Exception $e) {
                        print Message::error($e->getMessage(), "\\Exception", $e->getFile(), $e->getLine());
                    }
                }
            }
        }
    }

    private function makeFile($template, $filename, $function = null)
    {
        if (!file_exists($filename) or $this->force === true) {
            $fileContent = file_get_contents(TEMPLATE_DIR . '/' . $template . '.ice');
            if ($function !== null) {
                $fileContent = $function($fileContent);
            }
            file_put_contents($filename, $fileContent);
            if (file_exists($filename) and file_get_contents($filename) === $fileContent) {
                $this->result = array(
                    "type" => "success",
                    "msg"  => "Berhasil membuat ".ucfirst($template)." ".realpath($filename)
                );
            } else {
                $this->result = array(
                    "type" => "error",
                    "msg"  => "Gagal membuat ".ucfirst($template)." ".realpath($filename)
                );
            }
        } else {
            $this->result = array(
                    "type" => "error",
                    "msg"  => ucfirst($template)." ".realpath($filename)." already exists!"
                );
        }
    }

    public function execute()
    {
        $this->parseSelection();
        switch ($this->command) {
            case 'controller':
                    $this->makeFile("controller", APP_DIR . '/Controllers/' . $this->filename . '.php',
                    function ($str) {
                        return str_replace("~~~controller_name~~~", $this->filename, $str);
                    });
                break;
            case 'model':
                    $this->makeFile("model", APP_DIR . '/Models/' . $this->filename . '.php',
                    function ($str) {
                        return str_replace("~~~model_name~~~", $this->filename, $str);
                    });
                break;
            default:
                try {
                    throw new InvalidArgumentException("Invalid make:{$this->command} !", 400);
                } catch (InvalidArgumentException $e) {
                    print Message::error($e->getMessage(), "InvalidArgumentException", $e->getFile(), $e->getLine());
                    die;
                } catch (\Exception $e) {
                    print Message::error($e->getMessage(), "\\Exception", $e->getFile(), $e->getLine());
                }
                break;
        }
    }


    public function showResult()
    {
        return $this->result;
    }
}
