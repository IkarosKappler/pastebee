<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-12
 * @version 1.0.0
 **/

class RequestValidator {

    /**
     * @array:array
     **/
    private $rules;

    /**
     * @array
     **/
    public $errors;

    /**
     * @number
     **/
    public $errorCount;

    public function __construct( $_rules ) {

        $this->rules = [];

        // Split all rules the the pipe delimiter '|'
        foreach( $_rules as $name => $raw ) {
            $ruleSet = preg_split('/\|/', $raw, -1, PREG_SPLIT_NO_EMPTY );
            $this->rules[$name] = array();
            foreach( $ruleSet as $i => $rule ) {
                $this->rules[$name][$i] = preg_split('/:/',$rule);
                $ruleName = $this->rules[$name][$i][0];
                switch( true ) {
                case $ruleName=='require': break;
                case $ruleName=='min'||$ruleName=='max': if( count($this->rules[$name][$i]) < 2 ) throw new Exception("Numeric parameter expected for 'min'."); 
                }
            }             
        }
        
    }

    public function validate( $request ) {
        $sanitized    = [];
        $this->errors = [];
        $this->errorCount = 0;
        foreach( $this->rules as $name => $ruleSet ) {
            foreach( $ruleSet as $i => $rule ) {
                try {
                    $sanitized[$name] = RequestValidator::validateRule( $name, $rule, array_key_exists($name,$request) ? $request[$name] : null );
                } catch( Exception $e ) {
                    $this->errors[$name] = $e->getMessage();
                    $this->errorCount++;
                    continue;
                }
            }
        }
        if( $errors == 0 ) return $sanitized;
        else               return false;
    }


    public static function validateRule( string $name, Array $rule, $value ) {
        switch( $rule[0] ) {
        case 'required':
            if( $value == null ) throw new Exception("Argument '".$name."' is required.");
            break;
        case 'min':
            if( count($value) < $rule[1] ) throw new Exception("Argument '".$name."' is too short (".count($value)." < ".$rule[1].")");
            break;
        case 'maxn':
            if( count($value) > $rule[1] ) throw new Exception("Argument '".$name."' is too long (".count($value)." > ".$rule[1].")");
            break;
        }
        return $value;
    }
    

}