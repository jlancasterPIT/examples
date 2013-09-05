<?php 
if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed'); 
}

class Calculator extends CI_Controller {
    public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('number1', 'Number1', 'integer');
        $this->form_validation->set_rules('number2', 'Number2', 'integer');

        $options = array(
            '+'=>'+',
            '-'=>'-',
            '*'=>'*',
            '/'=>'/'
        );

        if ($this->form_validation->run() != false) {
            $this->load->library('mathlibrary');
            if ($this->input->post('dirtyinput')) {
                $answerTwo = null;
                $error = null;
                try {
                    $answerTwo = $this->mathlibrary->runString(
                            $this->input->post('dirtyinput')
                        );
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            } else {
                $operator = $this->input->post('operator');
                $number1  = (int) $this->input->post('number1'); 
                $number2  = (int) $this->input->post('number2'); 
                
                try {
                    switch($operator) {
                        case '+':
                            $answer = $this->mathlibrary->add(
                                $number1, 
                                $number2
                            );
                            break;
                        case '-':
                            $answer = $this->mathlibrary->subtract(
                                $number1, 
                                $number2
                            );
                            break;
                        case '*':
                            $answer = $this->mathlibrary->multiply(
                                $number1, 
                                $number2
                            );
                            break;
                        case '/':
                            $answer = $this->mathlibrary->divid(
                                $number1, 
                                $number2
                            );
                            break;
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        $viewOptions = array(
            'options'=>$options
            );
        if (isset($answerTwo)) {
            $viewOptions['answerTwo'] = $answerTwo;
        }
        if (isset($answer)) {
            $viewOptions['answer'] = $answer;
        }
        if (isset($operator)) {
            $viewOptions['operatorSelected'] = $operator;
        }
        if (isset($error)) {
            $viewOptions['error'] = $error;
        } else {
            $viewOptions['error'] = null;
        }

        $this->load->view('calculator_home', $viewOptions);
    }

    public function test() 
    {
        $this->load->library('unit_test');
        $this->load->library('mathlibrary');

        $str = '
        <table border="1" cellpadding="4" cellspacing="1" width="100%">
            {rows}
                <tr>
                <td width="25%">{item}</td>
                <td width="75%">{result}</td>
                </tr>
            {/rows}
        </table><br />';

        $this->unit->set_template($str); 

        $this->unit->run(
            $this->mathlibrary->add(1, 1), 
            2, 
            'Math Library Add Function',
            'Runs a test of 1+1 and expects 2'
        );

        $this->unit->run(
            $this->mathlibrary->subtract(1, 1), 
            0, 
            'Math Library Subtract Function',
            'Runs a test of 1-1 and expects 0'
        );

        $this->unit->run(
            $this->mathlibrary->multiply(1, 1), 
            1, 
            'Math Library Multiply Function',
            'Runs a test of 1*1 and expects 1'
        );
        
        $this->unit->run(
            $this->mathlibrary->divid(1, 1), 
            1, 
            'Math Library Divid Function',
            'Divids 1/1 and expects 1'
        );
        
        $this->unit->run(
            $this->mathlibrary->runString('2+2'), 
            4, 
            'Math Library Run String',
            'Runs a string of a mathmatical formula through the string function'
        );

        echo '<h1>Testing the functions of the calculator app results</h1>';
        echo $this->unit->report();
    }
}